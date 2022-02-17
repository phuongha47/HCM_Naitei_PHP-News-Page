<?php

namespace Tests\Unit\Models;

use App\Models\Image;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use WithFaker;

    /** @test */
    // check columns
    public function test_post_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('posts', [
            'id', "title", "body", "author_id", "category_id",
          ]), 1);
    }
    public function test_post_belongs_to_category()
    { 
        $category = Category::factory()->create();
        $post = Post::factory()->create(['category_id' => $category->id]);
        $this->assertInstanceOf(Category::class, $post->category);
        $this->assertEquals('category_id', $post->category()->getForeignKeyName());
    }
    public function test_post_has_many_images()
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create(['category_id' => $category->id]);
        $images = Image::factory()->create(['imageable_id' => $post->id, 'imageable_type' => Post::class]); 
        // kiểm tra foreignkey
        $this->assertEquals('category_id', $category->posts()->getForeignKeyName());
        //posts related category
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $category->posts);
    }
    public function test_post_has_many_comments()
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create(['category_id' => $category->id]);
        $images = Image::factory()->create(['imageable_id' => $post->id, 'imageable_type' => Post::class]); 
        // kiểm tra foreignkey
        $this->assertEquals('category_id', $category->posts()->getForeignKeyName());
        //posts related category
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $category->posts);
    }
}
