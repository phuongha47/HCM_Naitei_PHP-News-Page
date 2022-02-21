<?php

namespace Tests\Unit\Models;

use App\Models\Image;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ImageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public $post;
    public $user;
    public $image;
    public $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->make();
        $this->category = Category::factory()->make();
        $this->post = Post::factory()->make(["category_id" => $this->category->id]);
    }
    public function tearDown(): void
    {
        $this->post = null;
        $this->category = null;
        $this->user = null;
        $this->image = null;
        parent::tearDown();
    }
    // Images with post
    public function testImageableWithPost()
    {
        $images = Image::factory()->make([
                "imageable_id" => $this->post->id,
                "imageable_type" => Post::class,
        ]);
        $relation = $this->post->images();
        
        $this->assertEquals("imageable_type", $relation->getMorphType());
        $this->assertEquals("imageable_id", $relation->getForeignKeyName());
        $this->assertInstanceOf("Illuminate\Database\Eloquent\Collection", $this->post->images);
    }
    // Image with user
    public function testImageableWithUser()
    {
        $image = Image::factory()->make([
                "imageable_id" => $this->user->id,
                "imageable_type" => User::class,
        ]);
        $relation = $this->user->image();
        
        $this->assertEquals("imageable_type", $relation->getMorphType());
        $this->assertEquals("imageable_id", $relation->getForeignKeyName());
        $this->assertInstanceOf(MorphOne::class, $this->user->image());
    }
}
