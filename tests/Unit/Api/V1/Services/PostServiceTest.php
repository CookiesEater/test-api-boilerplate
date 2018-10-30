<?php

namespace Unit\Api\V1\Models;

use App\Api\V1\Builders\PostBuilder;
use App\Api\V1\Models\Post;
use App\Api\V1\Repositories\PostRepository;
use App\Api\V1\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var PostService
     */
    protected $service;

    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->service = app(PostService::class);
        $this->repository = app(PostRepository::class);
    }

    /**
     * Testing creating.
     */
    public function testCreate()
    {
        $model = factory(Post::class)->make();
        $builder = new PostBuilder($model->getAttributes());
        $this->service->create($builder);

        $this->assertDatabaseHas($model->getTable(), $model->getAttributes());
    }

    /**
     * Testing updating.
     */
    public function testUpdate()
    {
        $oldModel = factory(Post::class)->create();
        $fakeModel = factory(Post::class)->make();
        $attributes = $fakeModel->getAttributes();
        unset($attributes['id']);
        $builder = new PostBuilder($attributes);
        $this->service->update($oldModel->id, $builder);
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
        $this->service->delete($model->id);

        $this->assertDatabaseMissing($model->getTable(), $model->getAttributes());
    }

    /**
     * @param array $attributes
     * @return Request
     */
    protected function makeRequest(array $attributes): Request
    {
        $request = request();
        $request->initialize($attributes);

        return $request;
    }
}
