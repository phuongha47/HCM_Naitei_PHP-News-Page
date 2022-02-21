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
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
    public function tearDown(): void
    {
        $this->post = null;
        $this->category = null;
        $this->user = null;
        $this->image = null;
        $this->comment = null;
        parent::tearDown();
    }
    
    /** @test */
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
        $this->assertEquals("user_id", $this->post->user()->getForeignKeyName());
    }
    // Post HasMany Images
    public function testPostHasManyImages()
    {
        $this->assertInstanceOf(MorphMany::class, $this->post->images());
    }
    // Post HasMany Comments
    public function testPostHasManyComments()
    {
        //  Check foreignkey
        $this->assertEquals("post_id", $this->post->comments()->getForeignKeyName());
        //  Posts related category
        $this->assertInstanceOf(HasMany::class, $this->post->comments());
    }
}
