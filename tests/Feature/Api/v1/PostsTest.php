<?php

namespace Feature\Api\V1;

use App\Api\V1\Models\Post;
use App\Api\V1\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

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

        $this->repository = app(PostRepository::class);
    }

    /**
     * Testing index endpoint.
     */
    public function testIndex()
    {
        $models = factory(Post::class, 3)->create(); /** @var Collection $models */
        $response = $this->getJson(app(\Dingo\Api\Routing\UrlGenerator::class)->version('v1')->route('posts.index'));
        $data = array_map(function ($model) {
            return [
                'id' => $model->id,
                'title' => $model->title,
                'short_description' => $model->short_description,
                'description' => $model->description,
                'created_at' => $model->created_at->toIso8601String(),
                'updated_at' => $model->updated_at->toIso8601String(),
            ];
        }, $models->all());

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    ['id', 'title', 'short_description', 'description', 'created_at', 'updated_at'],
                ],
            ])
            ->assertJson(['data' => $data]);
    }

    /**
     * Testing show endpoint.
     */
    public function testShow()
    {
        $models = factory(Post::class, 3)->create();
        $model = $models->random();
        $response = $this->get(app(\Dingo\Api\Routing\UrlGenerator::class)->version('v1')->route('posts.show', ['id' => $model->id]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['id', 'title', 'short_description', 'description', 'created_at', 'updated_at'],
            ])
            ->assertJson([
                'data' => [
                    'id' => $model->id,
                    'title' => $model->title,
                    'short_description' => $model->short_description,
                    'description' => $model->description,
                    'created_at' => $model->created_at->toIso8601String(),
                    'updated_at' => $model->updated_at->toIso8601String(),
                ],
            ]);
    }

    /**
     * Testing create endpoint.
     */
    public function testStore()
    {
        $fakeModel = factory(Post::class)->make();
        $response = $this->postJson(app(\Dingo\Api\Routing\UrlGenerator::class)->version('v1')->route('posts.store'), [
            'title' => $fakeModel->title,
            'short_description' => $fakeModel->short_description,
            'description' => $fakeModel->description,
        ]);
        $model = $this->repository->find()->one();

        $response->assertStatus(201);
        $this->assertDatabaseHas($model->getTable(), $model->getAttributes());
    }

    /**
     * Testing update endpoint.
     */
    public function testUpdate()
    {
        $oldModel = factory(Post::class)->create();
        $fakeModel = factory(Post::class)->make();
        $response = $this->putJson(app(\Dingo\Api\Routing\UrlGenerator::class)->version('v1')->route('posts.update', ['id' => $oldModel->id]), [
            'title' => $fakeModel->title,
            'short_description' => $fakeModel->short_description,
            'description' => $fakeModel->description,
        ]);
        $newModel = $this->repository->read($oldModel->id);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $newModel->getAttributes());
        $this->assertDatabaseMissing('posts', $oldModel->getAttributes());
    }

    /**
     * Testing delete endpoint.
     */
    public function testDelete()
    {
        $model = factory(Post::class)->create();
        $response = $this->deleteJson(app(\Dingo\Api\Routing\UrlGenerator::class)->version('v1')->route('posts.destroy', ['id' => $model->id]));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('posts', $model->getAttributes());
    }
}
