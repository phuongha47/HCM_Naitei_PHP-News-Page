<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public $user;
    public $post;
    public $comment;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->make();
        $this->post = Post::factory()->make();
        $this->comment = Comment::factory()->make([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->user = null;
        $this->post = null;
        $this->comment = null;
    }

    public function testCommentBelongsToAnOwner()
    {
        // Test belongsTo
        $this->assertInstanceOf(BelongsTo::class, $this->comment->user());
        // Test foreign key
        $this->assertEquals('user_id', $this->comment->user()->getForeignKeyName());
    }

    public function testCommentBelongsToAPost()
    {
        // Test belongsTo
        $this->assertInstanceOf(BelongsTo::class, $this->comment->post());
        // Test foreign key
        $this->assertEquals('post_id', $this->comment->post()->getForeignKeyName());
    }
}
