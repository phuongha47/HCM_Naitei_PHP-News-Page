<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{lang}', [
    'as' => 'lang.switch',
    'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

// ==================================== ADMIN ====================================
$path_to_admin_controllers = '\App\Http\Controllers\Admin\AdminController@';
$prefix_admin = 'admin';
Route::prefix($prefix_admin)->group(function () use ($path_to_admin_controllers) {
    // -------------------------------- DASHBOARD --------------------------------
    Route::get("/dashboard", [
        "as" => 'admin.dashboard',
        "uses" => $path_to_admin_controllers . 'dashboard'
    ]);
    Route::get("/view_profile", [
        "as" => 'admin.view_profile',
        "uses" => $path_to_admin_controllers . 'viewProfile'
    ]);
    Route::get("/add_user", [
        "as" => 'admin.add_user',
        "uses" => $path_to_admin_controllers . 'addUser'
    ]);
    Route::get("/edit_user", [
        "as" => 'admin.edit_user',
        "uses" => $path_to_admin_controllers . 'editUser'
    ]);
    Route::get("/search_user", [
        "as" => 'admin.search_user',
        "uses" => $path_to_admin_controllers . 'searchUser'
    ]);
    Route::get("/add_category", [
        "as" => 'admin.add_category',
        "uses" => $path_to_admin_controllers . 'addCategory'
    ]);
    Route::get("/search_category", [
        "as" => 'admin.search_category',
        "uses" => $path_to_admin_controllers . 'searchCategory'
    ]);
    Route::get("/add_post", [
        "as" => 'admin.add_post',
        "uses" => $path_to_admin_controllers . 'addPost'
    ]);
    Route::get("/search_post", [
        "as" => 'admin.search_post',
        "uses" => $path_to_admin_controllers . 'searchPost'
    ]);
});
