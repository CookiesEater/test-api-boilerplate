<?php

namespace App\Api\V1\Services;

use App\Api\V1\Builders\PostBuilder;
use App\Api\V1\Repositories\PostRepository;

/**
 * Service object to manage posts.
 */
class PostService
{
    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Creating post.
     *
     * @param PostBuilder $builder
     */
    public function create(PostBuilder $builder): void
    {
        $this->repository->create($builder);
    }

    /**
     * Updating post.
     *
     * @param string $id
     * @param PostBuilder $builder
     */
    public function update(string $id, PostBuilder $builder): void
    {
        $this->repository->update($id, $builder);
    }

    /**
     * Deleting post.
     *
     * @param string $id
     *
     * @throws \Exception
     */
    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }
}
