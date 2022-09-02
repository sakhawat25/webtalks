<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as Auth;
use App\Http\Controllers\admin\ResetPasswordController as AdminResetPassword;
use App\Http\Controllers\admin\MessagesController;
use App\Http\Controllers\PagesController as Pages;
use App\Http\Controllers\PostsController as Posts;
use App\Http\Controllers\admin\ForgotPasswordController as AdminForgotPassword;
use App\Http\Controllers\CommentsController as Comments;
use App\Http\Controllers\admin\AuthController as AdminAuth;
use App\Http\Controllers\admin\PagesController as AdminPages;
use App\Http\Controllers\admin\PostsController as AdminPosts;
use App\Http\Controllers\admin\UsersController as AdminUsers;
use App\Http\Controllers\ResetPasswordController as ResetPassword;
use App\Http\Controllers\admin\CommentsController as AdminComments;
use App\Http\Controllers\ForgotPasswordController as ForgotPassword;
use App\Http\Controllers\admin\CategoriesController as AdminCategories;
use App\Http\Controllers\ResetPasswordController;

/*
 * Frontend routes
 */
Route::get('/posts/frontend/search', [Posts::class, 'search'])->name('frontend.search');
Route::get('posts/{post}/single', [Posts::class, 'single']);
Route::get('/posts/all', [Posts::class, 'all']);
Route::get('/register', [Auth::class, 'registerForm'])->middleware('guest');
Route::get('/login', [Auth::class, 'loginForm'])->name('login')->middleware('guest');
Route::get('/logout', [Auth::class, 'logout'])->middleware('auth');
Route::get('/verify/{code}', [Auth::class, 'verifyEmail'])->name('verify_email');
Route::post('/comments/store', [Comments::class, 'store']);
Route::delete('/comments/{comment}', [Comments::class, 'destroy']);
Route::post('/register', [Auth::class, 'register']);
Route::post('/login', [Auth::class, 'login']);
Route::get('/about', [Pages::class, 'about']);
Route::get('/contact', [Pages::class, 'showContact']);
Route::post('/contact', [Pages::class, 'contact']);
Route::get('/profile/deletepicture', [Auth::class, 'delete']);
Route::get('/profile', [Pages::class, 'showProfile'])->middleware('auth');
Route::post('/profile', [Auth::class, 'update']);
Route::get('/forgot-password', [ForgotPassword::class, 'index'])->middleware('guest');
Route::post('/forgot-password', [ForgotPassword::class, 'sendRecoveryLink'])->middleware('guest');
Route::get('/reset-password/{token}', [ResetPassword::class, 'index'])->middleware('guest');
Route::post('/reset-password', [ResetPassword::class, 'resetPassword'])->middleware('guest');


/*
 * Admin routes
 */
Route::middleware(['admin.auth'])->group(function () {
    Route::get('admin/posts/featured', [AdminPosts::class, 'showFeatured']);
    Route::get('/admin/posts/search', [AdminPosts::class, 'search']);
    Route::get('/admin/posts/{post}/feature', [AdminPosts::class, 'feature']);
    Route::resource('/admin/posts', AdminPosts::class);

    Route::resource('/admin/categories', AdminCategories::class);

    Route::get('/admin/comments/{comment}', [AdminComments::class, 'show']);
    Route::get('/admin/comments', [AdminComments::class, 'index']);
    Route::delete('/admin/comments/{comment}', [AdminComments::class, 'destroy']);

    Route::get('/admin/users/{user}/verify', [AdminUsers::class, 'verify']);
    Route::delete('/admin/users/{user}', [AdminUsers::class, 'destroy']);
    Route::get('/admin/users/{user}', [AdminUsers::class, 'show']);    
    Route::get('/admin/users', [AdminUsers::class, 'index']);

    Route::get('/admin/messages/{message}', [MessagesController::class, 'show']);
    Route::get('/admin/messages', [MessagesController::class, 'index']);
    Route::post('/admin/messages', [MessagesController::class, 'store']);
    Route::delete('/admin/messages/{message}', [MessagesController::class, 'destroy']);
    
    Route::get('/admin/logout', [AdminAuth::class, 'logout']);

    Route::get('/admin', [AdminPages::class, 'dashboard']);
});

Route::get('/admin/login', [AdminAuth::class, 'showLogin'])->middleware('admin.guest');
Route::post('/admin/login', [AdminAuth::class, 'login']);
Route::get('/admin/forgot-password', [AdminForgotPassword::class, 'getEmail'])->middleware('admin.guest');
Route::post('/admin/forgot-password', [AdminForgotPassword::class, 'postEmail'])->middleware('admin.guest');
Route::get('/admin/reset-password/{token}', [AdminResetPassword::class, 'showResetForm'])->middleware('admin.guest');
Route::post('/admin/reset-password', [AdminResetPassword::class, 'resetPassword'])->middleware('admin.guest');

Route::get('hashpassword', function() {
    dd(str_replace('/', '', bcrypt(time())));
});

Route::get('/', [Pages::class, 'home']);

// Route::get('adminPassword', function() {
//     dd(bcrypt('12345'), bcrypt(time()));
// });

