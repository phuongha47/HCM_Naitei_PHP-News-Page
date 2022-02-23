<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Category;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddSubCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use Illuminate\Http\Request;
use Mockery;
use Mockery\MockInterface;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\RedirectResponse;

class CategoryControllerTest extends TestCase
{
    public $mockObject;
    public $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->limit = config('app.limit');
        $this->mockObject = Mockery::mock(CategoryRepository::class)->makePartial();
        $this->controller = new CategoryController($this->mockObject);
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->limit);
        unset($this->controller);
        parent::tearDown();
    }

    // test_index_category
    public function testIndexCategory()
    {
        $categories = Category::factory(5)->make();
        $this->mockObject->shouldReceive('index')
            ->times(1)
            ->with($this->limit)
            ->andReturn($categories);
        $response = $this->controller->index();

        $this->assertEquals('admin.pages.search_category', $response->getName());
    }

    // test_create_category
    public function testCreateCategory()
    {
        $view = $this->controller->create();

        $this->assertEquals('admin.pages.addCategory', $view->getName());
    }

    // test_store_sub_category
    public function testStoreSubCategory()
    {
        $category = new AddSubCategoryRequest([
            'name' => 'category A',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->mockObject->shouldReceive('create')
            ->times(1)
            ->with($category)
            ->andReturn($category);
        $response = $this->controller->storeSubCategory($category);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }

    // test_store_category
    public function testStoreCategory()
    {
        $category = new AddCategoryRequest([
            'name' => 'Parent category B',
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->mockObject->shouldReceive('create')
            ->times(1)
            ->with($category)
            ->andReturn($category);
        $response = $this->controller->storeCategory($category);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }

    // test_update_category
    public function testUpdateCategory()
    {
        $category = Category::factory()->make();
        $editedCategory = new EditCategoryRequest([
            'name' => 'edited category name',
        ]);
        $this->mockObject->shouldReceive('update')
            ->times(1)
            ->with($category->id, $editedCategory)
            ->andReturn($editedCategory);
        $response = $this->controller->update($editedCategory, $category->id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }

    // test_destroy_category
    public function testDestroyCategory()
    {
        $category = new Request([Category::factory()->make()]);
        $this->mockObject->shouldReceive('delete')
            ->times(1)
            ->with($category->id)
            ->andReturnNull();
        $response = $this->controller->destroy($category, $category->id);

        $this->assertEquals(302, $response->getStatusCode());
    }
}
