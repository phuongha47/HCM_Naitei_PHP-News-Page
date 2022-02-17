<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserBelongsToRole()
    {
        $role = Role::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id]);

        // Test user belongs to role
        $this->assertInstanceOf(BelongsTo::class, $user->role());
        // Test foreign key
        $this->assertEquals('role_id', $user->role()->getForeignKeyName());
    }

    public function testUserMorphOneImage()
    {
        $user = User::factory()->create();
        // Test user morph one image
        $this->assertInstanceOf(MorphOne::class, $user->image());
        // Test imageable_id
        $this->assertEquals('imageable_id', $user->image()->getForeignKeyName());
        // Test imageable_type
        $this->assertEquals('imageable_type', $user->image()->getMorphType());


    }

    public function testUserHasManyComments()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user->id]);
        
        // Test user has many comments
        $this->assertInstanceOf(HasMany::class, $user->comments());
        // Test foreign key
        $this->assertEquals('user_id', $user->comments()->getForeignKeyName());
    }

    public function testUserHasManyPosts()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['author_id' => $user->id]);
        
        // Test user has many posts
        $this->assertInstanceOf(HasMany::class, $user->posts());
        // Test foreign key
        $this->assertEquals('author_id', $user->posts()->getForeignKeyName());
    }
}
