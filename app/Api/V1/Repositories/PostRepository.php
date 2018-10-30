<?php

namespace App\Api\V1\Repositories;

use App\Api\V1\Finders\PostFinder;
use App\Api\V1\Models\Post;

/**
 * Post repository.
 */
class PostRepository extends BaseRepository
{
    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
        $this->finderClass = PostFinder::class;
    }
}
