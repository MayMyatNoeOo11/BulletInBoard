<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Show active Posts List 
     */
   public function showAllPosts()
   { 
        $postData=Post::leftjoin('users','users.id','=','posts.created_user_id')
                    ->select('posts.*','users.name')
                    ->where('posts.status','1')
                    ->paginate(10);
       return view('post.index',compact('postData'))
            ->with('i',(request()->input('page',1)-1)*10); 
    }

     public function create()
     {
         return view('post.create');
     }

     /**
      * Create Post
      */
      public function create_post(Request $request)
      { 
         // return  $request;
        /**
         * Validations
         */
        $request->validate([
            'title'=>'bail|required|unique:posts|max:255',
            'description'=>'required'
        ]);

          $post=new Post;

          $post->title=$request->title;
          $post->description=$request->description;
          $post->created_user_id='1';
          $post->status='1';

          return view('post.create-confirm',compact('post'));          

         // $post->save();       

         //return redirect('post.create')->with('msg','New post is inserted.');
          
      }

      public function confirm_post(Request $request)
      { 
         // return  $request;
        /**
         * Validations
         */
        $request->validate([
            'title'=>'bail|required|unique:posts|max:255',
            'description'=>'required'
        ]);

          $post=new Post;

          $post->title=$request->title;
          $post->description=$request->description;
          $post->created_user_id='1';
          $post->updated_user_id='1';
          $post->deleted_user_id='1';
          $post->status='1';

          //return view('post.create-confirm',compact('post'));          

         $post->save();       

         return redirect()->route('showAllPosts');//->with('success','New post is created successfully.');
          
      }
         /**
       * @param  \App\Models\Post  $post
      * Delete Post
      */
    public function update(Post $post)
    {
     return "";
    
        
    
    }

      /**
       * @param  \App\Models\Post  $post
      * Delete Post
      */
    public function delete(Post $post)
    {
        return redirect()->route('showAllPosts')
                        ->with('success','Post deleted successfully');
       // $post->delete();
    
        
    
    }
}
