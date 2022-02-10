<?php
use Illuminate\Support\Facades\Route;
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
Route::get('lang/{lang}', [
    'as' => 'lang.switch',
    'uses' => 'LanguageController@switchLang',
]);

Auth::routes();

$userHomeController = 'App\Http\Controllers\Users\HomeController@';
Route::get('/', $userHomeController . 'show')->name('home.index');
Route::get('/show/{id}', $userHomeController . 'show')->name('home.category');
Route::get('/search', $userHomeController . 'search')->name('home.search');

$userCategoryController = 'App\Http\Controllers\Users\UserCategoryController@';
Route::get('/category/show/{id}', $userCategoryController . 'show')->name('userCategory.show');
Route::get('/category/showCategory/{id}', $userCategoryController . 'showCategory')
    ->name('userCategory.showCategory');

$userPostController = 'App\Http\Controllers\Users\PostController@';
Route::get('/show/{id}', $userPostController . 'show')->name('userPost.show');

// ==================================== ADMIN ====================================
$adminPostController = 'App\Http\Controllers\Admin\PostController@';
$adminUserController = 'App\Http\Controllers\Admin\UserController@';
$adminCategoryController = 'App\Http\Controllers\Admin\CategoryController@';
Route::prefix('admin')->middleware('is_admin')->group(
    function () use ($adminPostController, $adminUserController, $adminCategoryController) {
        Route::get("/", [
            "as" => 'admin.index',
            "uses" => 'App\Http\Controllers\Admin\AdminController@index',
        ]);
        // ------------------------------- Admin Post ---------------------------------
        Route::get("/admin/post", [
            "as" => 'post.index',
            "uses" => $adminPostController . 'index',
        ]);
        Route::get("/admin/create", [
            "as" => 'post.create',
            "uses" => $adminPostController . 'create',
        ]);
        Route::post("/admin/store", [
            "as" => 'post.store',
            "uses" => $adminPostController . 'store',
        ]);
        Route::get("/admin/show/{id}", [
            "as" => 'post.show',
            "uses" => $adminPostController . 'show',
        ]);
        Route::get("admin/edit/{post_id}", [
            "as" => 'post.edit',
            "uses" => $adminPostController . 'edit',
        ]);
        Route::put("admin/update/{id}", [
            "as" => 'post.update',
            "uses" => $adminPostController . 'update',
        ]);
        Route::delete("admin/delete/{id}", [
            "as" => 'post.destroy',
            "uses" => $adminPostController . 'destroy',
        ]);
        Route::delete("admin/deleteAll", [
            "as" => 'post.deleteAll',
            "uses" => $adminPostController . 'deleteAll',
        ]);
        Route::get("admin/post/search/", [
            "as" => 'post.search',
            "uses" => $adminPostController . 'search',
        ]);
        // ------------------------------- Admin User ---------------------------------
        Route::get("admin/user", [
            "as" => 'user.index',
            "uses" => $adminUserController . 'index',
        ]);
        Route::get("admin/user/create/", [
            "as" => 'user.create',
            "uses" => $adminUserController . 'create',
        ]);
        Route::post("admin/user/store", [
            "as" => 'user.store',
            "uses" => $adminUserController . 'store',
        ]);
        Route::get("admin/user/show/{id}", [
            "as" => 'user.show',
            "uses" => $adminUserController . 'show',
        ]);
        Route::get("admin/user/edit/{id}", [
            "as" => 'user.edit',
            "uses" => $adminUserController . 'edit',
        ]);
        Route::put("admin/user/update/{id}", [
            "as" => 'user.update',
            "uses" => $adminUserController . 'update',
        ]);
        Route::delete("admin/user/delete/{id}", [
            "as" => 'user.destroy',
            "uses" => $adminUserController . 'destroy',
        ]);
        Route::delete("admin/user/deleteAll", [
            "as" => 'user.deleteAll',
            "uses" => $adminUserController . 'deleteAll',
        ]);
        Route::get("admin/user/search/", [
            "as" => 'user.search',
            "uses" => $adminUserController . 'search',
        ]);
        // ------------------------------- Admin Category ---------------------------------
        Route::get("admin/category", [
            "as" => 'category.index',
            "uses" => $adminCategoryController . 'index',
        ]);
        Route::get("admin/category/create/", [
            "as" => 'category.create',
            "uses" => $adminCategoryController . 'create',
        ]);
        Route::get("admin/categorySub", [
            "as" => 'categorysub.create',
            "uses" => $adminCategoryController . 'createSubCategory',
        ]);
        Route::post("admin/category/store", [
            "as" => 'category.store',
            "uses" => $adminCategoryController . 'store',
        ]);
        Route::get("admin/category/show/{id}", [
            "as" => 'category.show',
            "uses" => $adminCategoryController . 'show',
        ]);
        Route::get("admin/category/edit/{post_id}", [
            "as" => 'category.edit',
            "uses" => $adminCategoryController . 'edit',
        ]);
        Route::put("admin/category/update/{id}", [
            "as" => 'category.update',
            "uses" => $adminCategoryController . 'update',
        ]);
        Route::delete("admin/category/delete/{id}", [
            "as" => 'category.destroy',
            "uses" => $adminCategoryController . 'destroy',
        ]);
        Route::delete("admin/category/deleteAll", [
            "as" => 'category.deleteAll',
            "uses" => $adminCategoryController . 'deleteAll',
        ]);
        Route::get("admin/category/search/", [
            "as" => 'category.search',
            "uses" => $adminCategoryController . 'search',
        ]);
    }
);
