<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
  public $postService;
  public function __construct(PostServiceInterface $post_service_interface)
  {
      $this->postService = $post_service_interface;
  }

    /**
     * Show active Posts List for User itself, Show all posts for Admin
     */
    public function showAllPosts()
    { 
      if(Auth::check())
      {  
     
      $userType=Auth::user()->type;
         if($userType=='0')
         {
           $postData=$this->postService->getListForAdmin();

         }
       
         else 
         {
          $postData=$postService->getListForUser(Auth::user()->id);       
        }        

      }       
         //guest           
      else
      {
        $postData=$this->postService->getListForGuest();
      }

      return view('post.index',compact('postData'))
      ->with('i',(request()->input('page',1)-1)*10); 

    }

    public function create()
    {
         return view('post.create');
    }

     /**
      * Create Post
      * Return create_confirm view
      */
     public function create_post(Request $request)
     {

        /**
         * Validations
         */
        $request->validate([
            'title'=>'bail|required|unique:posts|max:255',
            'description'=>'required'
        ]);

          $post=new Post;
          $post->title=$request->title;
          $post->description=$request->input('description');      
       
          return view('post.create_confirm',compact('post'));
          
      }

      public function create_confirm_post(Request $request)
      {       
       
        /**
         * Validations
         */
        $request->validate([
            'title'=>'bail|required|unique:posts|max:255',
            'description'=>'required'
        ]);


          $postData=$this->postService->savePost($request);
         return redirect()->route('showAllPosts')->with('success','New post is created successfully.');
          
      }
         /**
       * @param  \App\Models\Post  $post
      * Edit Post
      */
    public function edit($id)
    {
      $postData=$this->postService->getPostbyId($id);
     return  view("post.update",compact('postData')); 
    
    }
    /**
     *Update post form
     * POST method
     */
    public function update_post(Request $request,Post $post)
    {
      $request->validate([
        'title'=>['required', Rule::unique('posts')->ignore(Auth::id())],
        'description'=>'required'
    ]);
    $post=$request;

    return view('post.update_confirm',compact('post'));
    }
    /**
     * update Confirm
     */
    public function update_confirm_post(Request $request,$id)
    {

      $this->postService->updatePost($request,$id);
     return redirect()->route('showAllPosts')->with('success','New post is updated successfully.');

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
    /**
     * Upload Post View
     */
    public function upload()
    {
      return view('post.upload');
    }
}
