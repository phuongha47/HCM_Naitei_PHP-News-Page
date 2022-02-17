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
    public function test_post_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('categories',
            [
                'id', "name", "parent_id",
            ]
        ), 1);
    }
    public function test_category_has_many_posts()
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create(['category_id' => $category->id]);
        
        $this->assertInstanceOf(HasMany::class, $category->posts());
        $this->assertInstanceOf(Category::class, $post->category);
        // kiểm tra foreignkey
        $this->assertEquals('category_id', $category->posts()->getForeignKeyName());
        //count
        $this->assertEquals(1, $category->posts->count());
        //posts related category
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $category->posts);
    }
}
