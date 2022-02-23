<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use Mockery;
use Mockery\MockInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserControllerTest extends TestCase
{
    public $mockObject;
    public $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockObject = Mockery::mock(UserRepository::class)->makePartial();
        $this->controller = new UserController($this->mockObject);
    }

    public function tearDown(): void
    {
        unset($this->controller);
        Mockery::close();
        parent::tearDown();
    }

    //  test_show_list
    public function testIndexUserList()
    {
        $users = User::factory(5)->make();
        $this->mockObject->shouldReceive('getAll')
            ->times(1)
            ->withNoArgs()
            ->andReturn($users);
        $response = $this->controller->index();

        $this->assertEquals('admin.pages.listUser', $response->getName());
    }
    public function testIndexUserListFails()
    {
        $users = User::factory(5)->make();
        $this->mockObject->shouldReceive('getAll')
            ->times(1)
            ->withNoArgs()
            ->andThrow(new ModelNotFoundException);
        $response = $this->controller->index();
        
        $this->assertEquals(route('post.index'), $response->getTargetUrl());
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }
    //  test_return_form_create
    public function testCreateReturnsView()
    {
        $view = $this->controller->create();

        $this->assertEquals('admin.pages.addUser', $view->getName());
    }
    
    //  test_return_form_edit
    public function testEditReturnsView()
    {
        $user = User::factory()->make();
        $this->mockObject->shouldReceive('edit')
            ->times(1)
            ->with($user->id)
            ->andReturn($user);
        $view = $this->controller->edit($user->id);

        $this->assertEquals('admin.pages.editUser', $view->getName());
    }

    //  test_store
    public function testStoreUser()
    {
        $user = new UserAddRequest([
            'name' => 'jmac',
            'email' => 'jmac@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role_id' => 1,
        ]);
        $this->mockObject->shouldReceive('create')
            ->times(1)
            ->with($user)
            ->andReturn($user);
            
        $response = $this->controller->store($user);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }

    //  test_update
    public function testUpdateUser()
    {
        $user = User::factory()->make();
        $user_edit_info = new UserEditRequest([
            'name' => 'jmac',
            'email' => 'jmac@example.com',
        ]);
        $this->mockObject->shouldReceive('update')
            ->times(1)
            ->with($user->id, $user_edit_info)
            ->andReturn($user_edit_info);
        $response = $this->controller->update($user_edit_info, $user->id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }

    //  test_delete
    public function testDeleteUser()
    {
        $user = User::factory()->make();
        $this->mockObject->shouldReceive('delete')
            ->times(1)
            ->with($user->id)
            ->andReturnNull();
        $response = $this->controller->destroy($user->id);

        $this->assertEquals(302, $response->getStatusCode());
    }

    //  test_password_hashed
    public function testPasswordWillBeHashed()
    {
        Hash::shouldReceive('make')
            ->once()
            ->andReturn('hashed');
        $user = new User([
            'name' => 'User',
            'password' => 'rawpassword',
        ]);
        $password = Hash::make($user->password);

        $this->assertEquals('hashed', $password);
    }

    //  test_email_varified
    public function testCheckUserEmailVerified()
    {
        $user = User::factory()->make();
        $user->email_verified_at = now();

        $this->assertTrue($user->hasVerifiedEmail());
    }
    
    //  test_search
    public function testCheckSearch()
    {
        $user = User::factory()->make();
        $key = new Request(['user1']);
        $response = $this->mockObject->shouldReceive('search')
            ->times(1)
            ->with($key)
            ->andReturn($key, $user);
        $view = $this->controller->search($key);

        $this->assertEquals('admin.pages.listUser', $view->getName());
    }
}
