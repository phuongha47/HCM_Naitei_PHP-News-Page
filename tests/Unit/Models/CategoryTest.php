<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public $post;
    public $category;
    public function setUp(): void
    {
        parent::setUp();
        $this->category = Category::factory()->make();
        $this->post = Post::factory()->make(["category_id" => $this->category->id]);
    }
    public function tearDown(): void
    {
        $this->post = null;
        $this->category = null;
        parent::tearDown();
    }
    public function testCategoryHasManyPosts()
    {
        $this->assertInstanceOf(HasMany::class, $this->category->posts());
        //  Check foreignkey
        $this->assertEquals("category_id", $this->category->posts()->getForeignKeyName());
    }
    public function testCategoryHasManyChildrens()
    {
        $this->assertInstanceOf(HasMany::class, $this->category->childrens());
        //  Check foreignkey
        $this->assertEquals("parent_id", $this->category->childrens()->getForeignKeyName());
    }
    public function testCategoryBelongToParent()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->category->parent());
    }
}
