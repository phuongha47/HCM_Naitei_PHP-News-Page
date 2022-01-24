<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/', 'PostController@index')->name('post.admin');
Route::get('admin/create/', 'PostController@create')->name('post.create');
Route::post('admin/store', [PostController::class, 'store'])->name('post.store');
Route::get('admin/show/{id}', [PostController::class, 'show'])->name('post.show');
Route::get('admin/edit/{post_id}', [PostController::class, 'edit'])->name('post.edit');
Route::put('admin/update/{id}', [PostController::class, 'update'])->name('post.update');
Route::delete('admin/delete/{id}', [PostController::class, 'destroy'])->name('post.destroy');
Route::delete('admin/deleteAll', [PostController::class, 'deleteAll'])->name('post.deleteAll');
Route::get('admin/post/search/', 'PostsController@search')->name('postSearch');

Route::get('admin/user/search/', 'UserController@search')->name('userSearch');

Route::get('admin/category/search/', 'CategoryController@search')->name('categorySearch');
