<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $username           = 'Khoa';
    private $controller_name    = 'admin';
    private $path_to_view       = 'admin.pages.';
    private $path_to_ui         = 'ui_resources/startbootstrap-sb-admin-2/';

    public function __construct()
    {
        // Var want to share
        view()->share('controller_name', $this->controller_name);
        view()->share('path_to_ui', $this->path_to_ui);
        view()->share('username', $this->username);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view($this->path_to_view . 'dashboard');
    }

    public function viewProfile()
    {
        return view($this->path_to_view . 'view_profile');
    }

    public function addUser()
    {
        return view($this->path_to_view . 'add_user');
    }

    public function editUser()
    {
        return view($this->path_to_view . 'edit_user');
    }

    public function searchUser()
    {
        return view($this->path_to_view . 'search_user');
    }

    public function addCategory()
    {
        return view($this->path_to_view . 'add_category');
    }

    public function searchCategory()
    {
        return view($this->path_to_view . 'search_category');
    }

    public function addPost()
    {
        return view($this->path_to_view . 'add_post');
    }

    public function searchPost()
    {
        return view($this->path_to_view . 'search_post');
    }
}
