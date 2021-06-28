<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
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


Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

/**
 * Show Posts Page
 */
Route::get('/', [PostController::class, 'showAllPosts'])->name('showAllPosts');

Route::get('/logins', [UserController::class,'index'])->name('index');

//Route::resource('/tests','App\Http\Controllers\TestController');
Route::get('export',[PostController::class,'export'])->name('export');
Route::get('/post/show/{id}',[PostController::class,'show'])->name('showPost');
//Auth Routes
Route::group(['middleware' => ['auth']], function(){
    Route::get('/common',[UserController::class,'common'])->name('common');
    Route::get('/post/create',[PostController::class,'create'])->name('create');
    Route::post('/post/create-post',[PostController::class,'create_post'])->name('createPost');
    Route::post('/post/create-confirm',[PostController::class,'create_confirm_post'])->name('createConfirmPost');
    Route::get('/post/edit/{id}',[PostController::class,'edit'])->name('editPost');
    Route::post('/post/update/{id}',[PostController::class,'update_post'])->name('updatePost');
    Route::post('/post/update-confirm/{post}',[PostController::class,'update_confirm_post'])->name('updateConfirmPost');
    Route::get('/post/delete/{id}',[PostController::class,'delete_post'])->name('deletePost');
    Route::post('/post/delete-post',[PostController::class,'delete_post_confirm'])->name('deletePostConfirm');
     
    
    Route::get('/user/update/{id?}',[UserController::class,'update'])->name('update');
    Route::post('/user/update/{id}',[UserController::class,'update_user'])->name('updateUser');
    Route::post('/user/update-confirm/{user}',[UserController::class,'update_confirm_user'])->name('updateConfirmUser');
    Route::get('/user/profile/{id}',[UserController::class,'profile'])->name('profile');
    Route::get('/user/change-password/{id}',[UserController::class,'changePasswordForm'])->name('changePasswordForm');
    Route::post('/user/change-password',[UserController::class,'changePassword'])->name('changePassword');
    
    
});
Route::group(['middleware' => ['auth','verify.admin']], function(){
    Route::get('/user/all-user',[UserController::class,'index'])->name('showAllUsers');
    Route::get('/user/show/{id}',[UserController::class,'show'])->name('showUser');
    
    Route::get('/user/create',[UserController::class,'create'])->name('createUserForm');
    Route::post('/user/create-user',[UserController::class,'create_user'])->name('createUser');
    Route::post('/user/confirm-user',[UserController::class,'confirm_user'])->name('confirmUser');


    Route::get('/user/delete/{id}',[UserController::class,'delete'])->name('delete');
    Route::post('/user/delete-user',[UserController::class,'delete_user'])->name('deleteUser');

    Route::get('/user/search',[UserController::class,'search'])->name('search');
    Route::get('/post/import-form',[PostController::class,'importForm'])->name('importForm');
    Route::post('/post/import',[PostController::class,'import'])->name('import');

    


});




