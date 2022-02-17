<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Role;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRoleHasManyUsers()
    {
        $role = Role::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id]);
        
        // Test hasMany
        $this->assertInstanceOf(HasMany::class, $role->users());
        // Test foreign key
        $this->assertEquals('role_id', $role->users()->getForeignKeyName());
    }
}
