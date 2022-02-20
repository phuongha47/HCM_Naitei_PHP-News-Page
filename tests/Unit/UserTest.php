<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
<<<<<<< HEAD
=======
use Illuminate\Foundation\Testing\DatabaseMigrations;
>>>>>>> master
use Tests\TestCase;

class UserTest extends TestCase
{
<<<<<<< HEAD
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
=======
    use DatabaseMigrations;

    public function testUserBelongsToRole()
    {
        $role = Role::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id]);

        // Test user belongs to role
        $this->assertInstanceOf(BelongsTo::class, $user->role());
        // Test foreign key
        $this->assertEquals('role_id', $user->role()->getForeignKeyName());
>>>>>>> master
    }

    public function testUserMorphOneImage()
    {
<<<<<<< HEAD
        // Test user morph one image
        $this->assertInstanceOf(MorphOne::class, $this->user->image());
        // Test imageable_id
        $this->assertEquals('imageable_id', $this->user->image()->getForeignKeyName());
        // Test imageable_type
        $this->assertEquals('imageable_type', $this->user->image()->getMorphType());
=======
        $user = User::factory()->create();
        // Test user morph one image
        $this->assertInstanceOf(MorphOne::class, $user->image());
        // Test imageable_id
        $this->assertEquals('imageable_id', $user->image()->getForeignKeyName());
        // Test imageable_type
        $this->assertEquals('imageable_type', $user->image()->getMorphType());


>>>>>>> master
    }

    public function testUserHasManyComments()
    {
<<<<<<< HEAD
        // Test user has many comments
        $this->assertInstanceOf(HasMany::class, $this->user->comments());
        // Test foreign key
        $this->assertEquals('user_id', $this->user->comments()->getForeignKeyName());
=======
        $user = User::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user->id]);
        
        // Test user has many comments
        $this->assertInstanceOf(HasMany::class, $user->comments());
        // Test foreign key
        $this->assertEquals('user_id', $user->comments()->getForeignKeyName());
>>>>>>> master
    }

    public function testUserHasManyPosts()
    {
<<<<<<< HEAD
        // Test user has many posts
        $this->assertInstanceOf(HasMany::class, $this->user->posts());
        // Test foreign key
        $this->assertEquals('author_id', $this->user->posts()->getForeignKeyName());
=======
        $user = User::factory()->create();
        $post = Post::factory()->create(['author_id' => $user->id]);
        
        // Test user has many posts
        $this->assertInstanceOf(HasMany::class, $user->posts());
        // Test foreign key
        $this->assertEquals('author_id', $user->posts()->getForeignKeyName());
>>>>>>> master
    }
}
