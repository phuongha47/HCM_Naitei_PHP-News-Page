<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\LanguageController;

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

Route::get('/admin', 'PostController@index')->name('post.index');
Route::get('admin/create/', 'PostController@create')->name('post.create');
Route::post('admin/store', [PostController::class, 'store'])->name('post.store');
Route::get('admin/show/{id}', [PostController::class, 'show'])->name('post.show');
Route::get('admin/edit/{post_id}', [PostController::class, 'edit'])->name('post.edit');
Route::put('admin/update/{id}', [PostController::class, 'update'])->name('post.update');
Route::delete('admin/delete/{id}', [PostController::class, 'destroy'])->name('post.destroy');
Route::delete('admin/deleteAll', [PostController::class, 'deleteAll'])->name('post.deleteAll');
Route::get('admin/post/search/', 'PostController@search')->name('postSearch');

Route::get('admin/user', 'UserController@index')->name('user.index');
Route::get('admin/user/create/', 'UserController@create')->name('user.create');
Route::post('admin/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('admin/user/show/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('admin/user/edit/{post_id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('admin/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('admin/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::delete('admin/user/deleteAll', [UserController::class, 'deleteAll'])->name('user.deleteAll');
Route::get('admin/user/search/', 'UserController@search')->name('userSearch');

Route::get('admin/category', 'CategoryController@index')->name('category.index');
Route::get('admin/category/create/', 'CategoryController@create')->name('category.create');
Route::post('admin/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('admin/category/show/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('admin/category/edit/{post_id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('admin/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::delete('admin/category/deleteAll', [CategoryController::class, 'deleteAll'])->name('category.deleteAll');
Route::get('admin/category/search/', 'CategoryController@search')->name('categorySearch');
