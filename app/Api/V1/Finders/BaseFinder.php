<?php

namespace App\Api\V1\Finders;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Base class to finder builder for repository.
 */
class BaseFinder implements FinderInterface
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->builder = $model->newQuery();
    }

    /**
     * {@inheritdoc}
     */
    public function all(): Collection
    {
        return $this->builder->get();
    }

    /**
     * {@inheritdoc}
     */
    public function one(): Model
    {
        return $this->builder->firstOrFail();
    }

    /**
     * {@inheritdoc}
     */
    public function paginate(int $perPage): LengthAwarePaginator
    {
        return $this->builder->paginate($perPage);
    }

    /**
     * @param int $offset
     *
     * @return $this
     */
    public function offset(int $offset): self
    {
        $this->builder->offset($offset);

        return $this;
    }

    /**
     * @param int $limit
     *
     * @return $this
     */
    public function limit(int $limit): self
    {
        $this->builder->limit($limit);

        return $this;
    }
}
