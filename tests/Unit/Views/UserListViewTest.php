<?php

namespace Tests\Unit\Views;

use App\Models\User;
use Tests\TestCase;
use Mockery;
use App\Http\Controllers\Admin\UserController;

class UserListViewTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // view display
    public function testRenderViewUserList()
    {
        $response = $this->get(route('user.index'));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.pages.listUser');
    }
    //  check var in view
    public function testVarUserFromDatabase()
    {
        $this->get('admin/user')->assertViewHas('searchKeyWord');
    }

}
