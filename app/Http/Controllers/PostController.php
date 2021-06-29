<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Validation\Rule;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Maatwebsite\Excel\Facades\Excel;


class PostController extends Controller
{

  public $postService;
  public function __construct(PostServiceInterface $post_service_interface)
  {
      $this->postService = $post_service_interface;
  }

    /**
     * Display the post detail
     *
     * @param  int  $id
     * @return ..Resources\Views\Post\show.blade.php
     */
    public function show($id)
    {
      $post=$this->postService->getPostInfo($id);
      
      return view('post.show', compact('post'));
    }

    /**
     * Show active Posts List for User itself, Show all posts for Admin
     * @return  ..Resources\Views\Post\index.blade.php
     */
    public function showAllPosts(Request $request)
    {
    
      $searchText=$request->input('search');
      if(Auth::check())
      { 
      $userType=Auth::user()->type;
         if($userType=='0')
         {           
           $postData=$this->postService->getListForAdmin($searchText);
         }       
         else 
         { 
          $postData=$this->postService->getListForUser(Auth::user()->id,$searchText);       
          } 
      }       
         //if guest (show all post where status is active)          
      else
      {
        $postData=$this->postService->getListForGuest($searchText);
      }     
     
      return view('post.index',compact('postData'))
      ->with('i',(request()->input('page',1)-1)*10)
      ->with('searchText',$searchText);
    }

    /**
     * Post create form
     * @return  ..Resources\Views\Post\create.blade.php
     */
    public function create()
    {
         return view('post.create');
    }

    /**
     * Create Post
     * Validations make
     * @return  ..Resources\Views\Post\create_confirm.blade.php 
     */
     public function create_post(Request $request)
    {
      $request->validate([
          'title'=>'required|max:255|unique:posts,title,NULL,id,deleted_at,NULL',
          'description'=>'required'
          ],
          [
          'title.required'=>'Title is required.',
          'title.max'=>'The title cannot be longer than 255 words.',
          'title.unique'=>'Post already exist',
          'description.required'=>'Description is required.'
          ]);      
     

          $post=new Post;
          $post->title=$request->title;
          $post->description=$request->input('description');      
       
          return view('post.create_confirm',compact('post'));          
    }
     
    /**
     * Create Post in db
     * @return redirect to ShowAllPosts
     */     
    public function create_confirm_post(Request $request)
    { 
        $postData=$this->postService->savePost($request);

         return redirect()->route('showAllPosts')->with('success','New post is created successfully.');          
    }

    
    /**
     * Post update form
     * @return  ..Resources\Views\Post\update.blade.php
     * with update post
     */
    public function edit($id)
    {
      $postData=$this->postService->getPostbyId($id);

     return  view("post.update",compact('postData'));     
    }


    /**
     * Update Post
     * Validations
     * @return  ..Resources\Views\Post\update_confirm.blade.php
     */
    public function update_post(Request $request,$id)
    {
      $request->validate([
        'title'=>['required', Rule::unique('posts')->ignore($id)],
        'description'=>'required'],        
    
        ['title.required'=>'Title is required.',
        'title.max'=>'The title cannot be longer than 255 words.',
        'title.unique'=>'Post already exist',
        'description.required'=>'Description is required.'
        ]);
      $post=$request;

      if($request->has('status'))
      {
      
        if($request->status=="0")
        {
        $post_status="0";      
        }
        else
        {
        $post_status="1";  
        }

      }
      else
      {
        $post_status="0";     
      } 

      return view('post.update_confirm',compact('post'))->with('postStatus',$post_status);

    }
    
    /**
     *  Update Post in db
     * @return redirect to ShowAllPosts
     */
    public function update_confirm_post(Request $request,$id)
    {
      $this->postService->updatePost($request,$id);

     return redirect()->route('showAllPosts')->with('success','Post is updated successfully.');

    }

    /**
     * Delete Post Form
     * @parameter $id
     * @return ..Resources\Views\Post\delete.blade.php
     */
    public function delete_post($id)
    {
      $post=$this->postService->getPostbyId($id);     
    
      return view('post.delete',compact('post'));    
    }

    /**
     * Delete Post in db
     * @return redirect to ShowAllPosts
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

    /**
     * Post Upload Form
     * @return ..Resources\Views\Post\upload.blade.php
     */
    public function importForm()
    {
      return view('post.upload');
    }
    
   /**
    * Import CSV 
    */
    public function import(Request $request)
    {
      Excel::import(new PostsImport,request()->file('fileUpload'));
     // return back();
     return redirect()->route('showAllPosts')->with('Upload successful.');  
    }

   /**
    * Export 
    * @return 
    */
    public function export() 
    {
        return Excel::download(new PostsExport, 'posts.xlsx');
    }
    // public function exportIntoCSV()
    // {
    //   return Excel::download(new PostsExport, 'posts.csv');
    // }
}
