<?php

namespace App\Api\V1\Repositories;

use App\Api\V1\Builders\BuilderInterface;
use App\Api\V1\Finders\BaseFinder;
use App\Api\V1\Finders\FinderInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Base repository.
 */
abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var string
     */
    protected $finderClass = BaseFinder::class;

    /**
     * Get finder to manage model find conditions.
     *
     * @return FinderInterface
     */
    public function find(): FinderInterface
    {
        return new $this->finderClass($this->model);
    }

    /**
     * Creating new post.
     *
     * @param BuilderInterface $builder
     */
    public function create(BuilderInterface $builder): void
    {
        $this->model->create($builder->getAttributes());
    }

    /**
     * Getting model by its id
     *
     * @param string|int $id
     *
     * @return Model
     */
    public function read($id): Model
    {
        return $this->model::findOrFail($id);
    }

    /**
     * Updating model.
     *
     * @param string|int $id
     * @param BuilderInterface $builder
     */
    public function update($id, BuilderInterface $builder): void
    {
        $attributes = $builder->getAttributes();
        if (isset($attributes['id'])) {
            unset($attributes['id']);
        }
        $model = $this->read($id);
        $model->fill($attributes);

        $model->save();
    }

    /**
     * Deleting model.
     *
     * @param string|int $id
     *
     * @throws \Exception
     */
    public function delete($id): void
    {
        $model = $this->read($id);
        $model->delete();
    }
}
