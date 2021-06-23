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

Route::resource('/tests','App\Http\Controllers\TestController');
Route::get('/common',[UserController::class,'common'])->name('common');
Route::get('/post/create',[PostController::class,'create'])->name('create');
Route::post('/post/create-post',[PostController::class,'create_post'])->name('createPost');
Route::post('/post/create-confirm',[PostController::class,'create_confirm_post'])->name('createConfirmPost');
Route::get('/post/edit/{id}',[PostController::class,'edit'])->name('editPost');
Route::post('/post/update/{id}',[PostController::class,'update_post'])->name('updatePost');
Route::post('/post/update-confirm/{post}',[PostController::class,'update_confirm_post'])->name('updateConfirmPost');
Route::post('/post/delete',[PostController::class,'delete'])->name('deletePost');
Route::get('/post/upload',[PostController::class,'upload'])->name('uploadPost');  


Route::get('/user/all-user',[UserController::class,'index'])->name('showAllUsers');
Route::get('/post/profile/{id}',[UserController::class,'profile'])->name('profile');
Route::get('/user/create',[UserController::class,'create'])->name('createUserForm');
Route::post('/user/create-user',[UserController::class,'create_user'])->name('createUser');
Route::post('/user/confirm-user',[UserController::class,'confirm_user'])->name('confirmUser');
Route::get('/user/update/{id?}',[UserController::class,'update'])->name('updateUser');

Route::post('/user/delete',[UserController::class,'delete'])->name('deleteUser');
Route::get('/user/change-password/{id}',[UserController::class,'changePassword'])->name('changePassword');

//Auth Routes
Route::middleware(['auth'])->group(function(){
    /**
     * Common Header Screen Page
     */
    //Route::get('/common',[UserController::class,'common'])->name('common');
    /**
     * User Lists Page
     */ 
    /**
     * Create Post Page
     */ 
    

   
    
  
});




