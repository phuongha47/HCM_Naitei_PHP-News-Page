<?php

namespace Tests\Unit\Models;

use App\Models\Image;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;
use Mockery;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use WithFaker;
    public $post;
    public $user;
    public $category;
    public $image;
    public $comment;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->make();
        $this->category = Category::factory()->make();
        $this->post = Post::factory()->make(["category_id" => $this->category->id]);
        $this->images = Image::factory()->make(["imageable_id" => $this->post->id, "imageable_type" => Post::class]);
        $this->comments = Comment::factory()->make(["post_id" => $this->post->id]);
    }
    /** @test */
    // check columns
    public function testPostDatabaseHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns("posts",
            [
                "id","title", "body", "author_id", "category_id",
            ]
        ), 1);
    }
    // Fillable
    public function testContainsValidFillableProperties()
    {
        $post = Post::factory()->make(
            [
                "category_id" => $this->category->id,
            ]
        );
        
        $this->assertEquals(
            [
                "title", "body", "category_id", "author_id",
            ], $post->getFillable());
    }
    // Primary Key
    public function testContainsPrimaryKeyProperties()
    {        
        $this->assertEquals("id", $this->post->getKeyName());
    }
    // Post BelongsTo Category
    public function testPostBelongsToCategory()
    {         
        $this->assertInstanceOf(BelongsTo::class, $this->post->category());
        $this->assertEquals("category_id", $this->post->category()->getForeignKeyName());
    }
    // Post BelongsTo User
    public function testPostBelongsToUser()
    { 
        $this->assertInstanceOf(BelongsTo::class, $this->post->user());
        $this->assertEquals("author_id", $this->post->user()->getForeignKeyName());
    }
    // Post HasMany Images
    public function testPostHasManyImages()
    {
        //  Posts related category
        $this->assertInstanceOf("Illuminate\Database\Eloquent\Collection", $this->post->images);
    }
    // Post HasMany Comments
    public function testPostHasManyComments()
    {        
        //  Check foreignkey
        $this->assertEquals("post_id", $this->post->comments()->getForeignKeyName());
        //  Posts related category
        $this->assertInstanceOf("Illuminate\Database\Eloquent\Collection", $this->post->comments);
    }
}
