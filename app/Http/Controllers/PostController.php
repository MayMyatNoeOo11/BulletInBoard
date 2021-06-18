<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
   public function index()
   {
       //retrieve all posts 
       $posts=Post::All();
       
       //retireve all users 
       $users=User::All();

       return $users;
       //return view('post.index',['posts'=>$posts]);
   }
}
