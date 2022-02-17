<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Role;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public $role;
    public $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->role = Role::factory()->make();
        $this->user = User::factory()->make(['role_id' => $this->role->id]);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->role = null;
        $this->user = null;
    }

    public function testRoleHasManyUsers()
    {
        // Test hasMany
        $this->assertInstanceOf(HasMany::class, $this->role->users());
        // Test foreign key
        $this->assertEquals('role_id', $this->role->users()->getForeignKeyName());
    }
}
