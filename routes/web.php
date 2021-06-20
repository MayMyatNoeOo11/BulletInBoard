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

// Route::resource('users',UserController::class);
Route::get('/common',[UserController::class,'common'])->name('common');
Route::get('/post/create',[PostController::class,'create'])->name('create');
Route::post('/post/create-post',[PostController::class,'create_post'])->name('createPost');
Route::post('/post/confirm-post',[PostController::class,'confirm_post'])->name('confirmPost');
Route::post('/post/edit',[PostController::class,'update'])->name('updatePost');
Route::post('/post/delete',[PostController::class,'delete'])->name('deletePost'); 

Route::get('/user/all-user',[UserController::class,'index'])->name('showAllUsers');
Route::get('/user/create',[UserController::class,'create'])->name('createUser');
Route::post('/user/update',[UserController::class,'update'])->name('updateUser');
Route::post('/user/delete',[UserController::class,'delete'])->name('deleteUser');

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




