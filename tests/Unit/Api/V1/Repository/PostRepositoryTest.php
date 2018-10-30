<?php

namespace Ylab\Microservice\Rest\Tests;

use App\Api\V1\Builders\PostBuilder;
use App\Api\V1\Models\Post;
use App\Api\V1\Repositories\PostRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->repository = app(PostRepository::class);
    }

    /**
     * Testing creating.
     */
    public function testCreate(): void
    {
        $fakeModel = factory(Post::class)->make();
        $builder = new PostBuilder($fakeModel->getAttributes());
        $this->repository->create($builder);
        $model = $this->repository->find()->one();

        $this->assertDatabaseHas($model->getTable(), $model->getAttributes());
    }

    /**
     * Testing updating.
     */
    public function testUpdate()
    {
        $fakeModel = factory(Post::class)->make();
        $oldModel = factory(Post::class)->create();
        $builder = new PostBuilder($fakeModel->getAttributes());
        $this->repository->update($oldModel->id, $builder);
        $newModel = $this->repository->read($oldModel->id);

        $this->assertDatabaseHas($newModel->getTable(), $newModel->getAttributes());
        $this->assertDatabaseMissing($oldModel->getTable(), $oldModel->getAttributes());
    }

    /**
     * Testing deleting.
     */
    public function testDelete()
    {
        $model = factory(Post::class)->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing($model->getTable(), $model->getAttributes());
    }
}
