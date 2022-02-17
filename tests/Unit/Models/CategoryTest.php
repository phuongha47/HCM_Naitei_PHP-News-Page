<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\Factory;
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
    public function test_post_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns("categories",
            [
                "id", "name", "parent_id",
            ]
        ), 1);
    }
    public function test_category_has_many_posts()
    {   
        $this->assertInstanceOf(HasMany::class, $this->category->posts());
        //  kiểm tra foreignkey
        $this->assertEquals("category_id", $this->category->posts()->getForeignKeyName());
        //  posts related category
        $this->assertInstanceOf("Illuminate\Database\Eloquent\Collection", $this->category->posts);
    }
    public function test_category_has_many_childrens()
    {        
        $this->assertInstanceOf(HasMany::class, $this->category->children());
        //  kiểm tra foreignkey
        $this->assertEquals("parent_id", $this->category->children()->getForeignKeyName());
        //  posts related category
        $this->assertInstanceOf("Illuminate\Database\Eloquent\Collection", $this->category->children);
    }
}
