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
        $this->user = User::factory()->make();
        $this->category = Category::factory()->make();
        $this->post = Post::factory()->make(["category_id" => $this->category->id]);
    }
    public function test_post_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns("images",
            [
            "imageable_id", "link", "imageable_type",
            ]
        ), 1);
    }
    public function test_imageable_with_post()
    {
        $images = Image::factory()->make(
            [
                "imageable_id" => $this->post->id,
                "imageable_type" => Post::class,
            ]
        ); 
        $relation = $this->post->images();
        
        $this->assertInstanceOf(MorphMany::class, $this->post->images());
        $this->assertEquals("imageable_type", $relation->getMorphType());
        $this->assertEquals("imageable_id", $relation->getForeignKeyName());
        $this->assertInstanceOf("Illuminate\Database\Eloquent\Collection", $this->post->images);
    }
     public function test_imageable_with_user()
    {
        $image = Image::factory()->make(
            [
                "imageable_id" => $this->user->id,
                "imageable_type" => User::class,
            ]
        ); 
        $relation = $this->user->image();
        
        $this->assertEquals("imageable_type", $relation->getMorphType());
        $this->assertEquals("imageable_id", $relation->getForeignKeyName());
        $this->assertInstanceOf(MorphOne::class, $this->user->image());

        // $this->assertInstanceOf("Illuminate\Database\Eloquent\Collection", $user->image);
    }
    /** @test */
}
