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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post=$this->postService->getPostInfo($id);
      
      return view('post.show', compact('post'));
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
          $postData=$this->postService->getListForUser(Auth::user()->id);       
        }
      }       
         //if guest (show all post where status is active)          
      else
      {
        $postData=$this->postService->getListForGuest();
      }

      return view('post.index',compact('postData'))
      ->with('i',(request()->input('page',1)-1)*10);
    }

    /**
     * Show the form for creating a new post.
     */
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
        $request->validate([
            'title'=>'bail|required|unique:posts|max:255',
            'description'=>'required'
        ]);

          $post=new Post;
          $post->title=$request->title;
          $post->description=$request->input('description');      
       
          return view('post.create_confirm',compact('post'));          
      }

      /**
       * Store a newly created post in database.
       */
     public function create_confirm_post(Request $request)
      {       

        $request->validate([
            'title'=>'bail|required|unique:posts|max:255',
            'description'=>'required'
        ]);

          $postData=$this->postService->savePost($request);

         return redirect()->route('showAllPosts')->with('success','New post is created successfully.');          
      }

    /**
     * Show the form for editing the specified post.
     */
    public function edit($id)
    {
      $postData=$this->postService->getPostbyId($id);

     return  view("post.update",compact('postData'));     
    }

    public function update_post(Request $request,$id)
    {
      $request->validate([
        'title'=>['required', Rule::unique('posts')->ignore($id)],
        'description'=>'required'
    ]);
    $post=$request;

    return view('post.update_confirm',compact('post'));
    }
    
    /**
     *  Actually Update the specified post in db.
     */
    public function update_confirm_post(Request $request,$id)
    {
      $this->postService->updatePost($request,$id);

     return redirect()->route('showAllPosts')->with('success','Post is updated successfully.');

    }


    public function delete_post($id)
    {
        $post=$this->postService->getPostbyId($id);     
        //dd($data);
        return view('post.delete',compact('post'));    
    }

    /**
     * delete confirm
     */
    public function delete_post_confirm(Request $request) //delete post confirm
    {
      $is_deleted=$this->postService->deletePost($request->id);
      if($is_deleted==1)
      {
        $message="Post has been deleted successfully.";
        return redirect()->route('showAllPosts')->with('success',$message);
      }
      else
      {
        $message="Post delete fail !";
        return redirect()->route('showAllPosts')->with('fail',$message);
        
      }
    }

    public function upload()
    {
      return view('post.upload');
    }
}
