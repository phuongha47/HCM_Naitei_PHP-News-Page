<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Users;

// use App\Http\Controllers\Users\UserPostController as ;

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

Route::get('/', 'App\Http\Controllers\Users\HomeController@show')->name('home.index');
Route::get('/show/{id}', 'App\Http\Controllers\Users\HomeController@show')->name('home.category');
Route::get('/search', 'App\Http\Controllers\Users\HomeController@search')->name('home.search');

Route::get('/category/show/{id}', 'App\Http\Controllers\Users\UserCategoryController@showSubCategories')
    ->name('userCategory.show');
Route::get(
    '/category/showCategory/{id}',
    'App\Http\Controllers\Users\UserCategoryController@showCategories'
)->name('userCategory.showCategory');

Route::get('/show/{id}', 'App\Http\Controllers\Users\UserPostController@show')->name('userPost.show');

Route::get('/admin', 'App\Http\Controllers\Admin\AdminController@index')->name('admin.index');

Route::get('/admin/post', 'App\Http\Controllers\Admin\PostController@index')->name('post.index');
Route::get('admin/create/', 'App\Http\Controllers\Admin\PostController@create')->name('post.create');
Route::post('admin/store', 'App\Http\Controllers\Admin\PostController@store')->name('post.store');
Route::get('admin/show/{id}', 'App\Http\Controllers\Admin\PostController@show')->name('post.show');
Route::get('admin/edit/{post_id}', 'App\Http\Controllers\Admin\PostController@edit')->name('post.edit');
Route::put('admin/update/{id}', 'App\Http\Controllers\Admin\PostController@update')->name('post.update');
Route::delete('admin/delete/{id}', 'App\Http\Controllers\Admin\PostController@destroy')->name('post.destroy');
Route::get('admin/post/search/', 'App\Http\Controllers\Admin\PostController@search')->name('post.search');

Route::get('admin/user', 'App\Http\Controllers\Admin\UserController@index')->name('user.index');
Route::get('admin/user/create/', 'App\Http\Controllers\Admin\UserController@create')->name('user.create');
Route::post('admin/user/store', 'App\Http\Controllers\Admin\UserController@store')->name('user.store');
Route::get('admin/user/show/{id}', 'App\Http\Controllers\Admin\UserController@show')->name('user.show');
Route::get('admin/user/edit/{post_id}', 'App\Http\Controllers\Admin\UserController@edit')->name('user.edit');
Route::put('admin/user/update/{id}', 'App\Http\Controllers\Admin\UserController@update')->name('user.update');
Route::delete('admin/user/delete/{id}', 'App\Http\Controllers\Admin\UserController@destroy')->name('user.destroy');
Route::get('admin/user/search/', 'App\Http\Controllers\Admin\UserController@search')->name('user.search');

Route::get('admin/category', 'App\Http\Controllers\Admin\CategoryController@index')->name('category.index');
Route::get(
    'admin/category/create/',
    'App\Http\Controllers\Admin\CategoryController@create',
)->name('category.create');
Route::get(
    '/admin/categorySub',
    'App\Http\Controllers\Admin\CategoryController@createSubCategory',
)->name('categorysub.create');
Route::post('admin/category/store', 'App\Http\Controllers\Admin\CategoryController@store')->name('category.store');
Route::get('admin/category/show/{id}', 'App\Http\Controllers\Admin\CategoryController@show')->name('category.show');
Route::get(
    'admin/category/edit/{post_id}',
    'App\Http\Controllers\Admin\CategoryController@edit',
)->name('category.edit');
Route::put(
    'admin/category/update/{id}',
    'App\Http\Controllers\Admin\CategoryController@update',
)->name('category.update');
Route::delete(
    'admin/category/delete/{id}',
    'App\Http\Controllers\Admin\CategoryController@destroy',
)->name('category.destroy');
Route::get(
    'admin/category/search/',
    'App\Http\Controllers\Admin\CategoryController@search',
)->name('category.search');

Route::get('lang/{lang}', [
    'as' => 'lang.switch',
    'uses' => 'LanguageController@switchLang'
]);
