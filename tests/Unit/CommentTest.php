<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use DatabaseMigrations;

    public function testCommentBelongsToAnOwner(){
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        // Test belongsTo
        $this->assertInstanceOf(BelongsTo::class, $comment->user());
        // Test foreign key
        $this->assertEquals('user_id', $comment->user()->getForeignKeyName());
    }

    public function testCommentBelongsToAPost(){
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        // Test belongsTo
        $this->assertInstanceOf(BelongsTo::class, $comment->post());
        // Test foreign key
        $this->assertEquals('post_id', $comment->post()->getForeignKeyName());
    }
}
