<?php

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
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

/*
 * Route for task
 */

Route::get("/", function () {
    return view("welcome");
});
Route::get('registration', [AuthenController::class, 'registration'])->name('register');
Route::post('register-user', [AuthenController::class, 'registerUser'])->name('register-user');

Route::get('login', [AuthenController::class, 'login'])->name('login');
Route::post('login-user', [AuthenController::class, 'loginUser'])->name('login-user');
Route::get('user/inactive', [AuthenController::class, 'inactiveUser'])->name('user.inactive');

Route::middleware(['auth.check'])->group(function () {

    Route::get('dashboard', [AuthenController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [AuthenController::class, 'logout'])->name('logout');
    Route::get('user/profile', [AuthenController::class, 'editProfile'])->name('user.profile.edit');
    Route::put('user/profile/update', [AuthenController::class, 'updateProfile'])->name('user.profile.update');

    Route::resource('/products', ProductController::class);

    Route::get('/eloquentQuery/{min_price?}/{category_id?}', [ProductController::class, 'eloquentQuery'])
        ->where('min_price', '[0-9]+')
        ->where('category_id', '[0-9]+')
        ->name('products.eloquentQuery');

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/users/{userId}/posts', [PostController::class, 'userPosts'])->name('posts.user');

    Route::post('/poststest', [PostController::class, 'storetest'])->name('posts.storetest');
    Route::put('/poststest/{post}/edit', [PostController::class, 'updatetest'])->name('posts.updatetest');
    Route::delete('/poststest/{post}', [PostController::class, 'destroytest'])->name('posts.destroytest');
});

/*
 * Route for comment
 */
