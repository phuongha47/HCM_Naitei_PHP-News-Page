<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Tests\TestCase;

class UserTest extends TestCase
{
    public $role;
    public $user;
    public $comment;
    public $post;

    public function setUp(): void
    {
        parent::setUp();
        $this->role = Role::factory()->make();
        $this->user = User::factory()->make(['role_id' => $this->role->id]);
        $this->comment = Comment::factory()->make(['user_id' => $this->user->id]);
        $this->post = Post::factory()->make(['author_id' => $this->user->id]);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->role = null;
        $this->user = null;
        $this->comment = null;
        $this->post = null;
    }

    public function testUserBelongsToRole()
    {
        // Test user belongs to role
        $this->assertInstanceOf(BelongsTo::class, $this->user->role());
        // Test foreign key
        $this->assertEquals('role_id', $this->user->role()->getForeignKeyName());
    }

    public function testUserMorphOneImage()
    {
        // Test user morph one image
        $this->assertInstanceOf(MorphOne::class, $this->user->image());
        // Test imageable_id
        $this->assertEquals('imageable_id', $this->user->image()->getForeignKeyName());
        // Test imageable_type
        $this->assertEquals('imageable_type', $this->user->image()->getMorphType());
    }

    public function testUserHasManyComments()
    {
        // Test user has many comments
        $this->assertInstanceOf(HasMany::class, $this->user->comments());
        // Test foreign key
        $this->assertEquals('user_id', $this->user->comments()->getForeignKeyName());
    }

    public function testUserHasManyPosts()
    {
        // Test user has many posts
        $this->assertInstanceOf(HasMany::class, $this->user->posts());
        // Test foreign key
        $this->assertEquals('author_id', $this->user->posts()->getForeignKeyName());
    }
}
