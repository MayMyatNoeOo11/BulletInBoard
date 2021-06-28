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
     * Show the form for creating a new post.
     */
    public function create()
    {
         return view('post.create');
    }

     /**
      * Create Post
      * Return create_confirm 
      */
     public function create_post(Request $request)
     {
        $request->validate([
            'title'=>'required|max:255|unique:posts,title,NULL,id,deleted_at,NULL',
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
            'title'=>'required|max:255|unique:posts,title,NULL,id,deleted_at,NULL',
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
    else{
      $post_status="0";     
    }   


    return view('post.update_confirm',compact('post'))->with('postStatus',$post_status);
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

    /**
     * import view
     */

    public function importForm()
    {
      return view('post.upload');
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
      Excel::import(new PostsImport,request()->file('fileUpload'));
     // return back();
     return redirect()->route('showAllPosts')->with('Upload successful.');  
    }

        /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new PostsExport, 'posts.xlsx');
    }
    public function exportIntoCSV()
    {
      return Excel::download(new PostsExport, 'posts.csv');
    }
}
