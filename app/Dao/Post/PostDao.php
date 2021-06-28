<?php

namespace App\Dao\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Contracts\Dao\Post\PostDaoInterface;

class PostDao implements PostDaoInterface
{

    public function getExportList()
    {


        
    }
    public function getListForAdmin($searchValue)
    {
        $postData=Post::leftjoin('users','users.id','=','posts.created_user_id')
        ->select('posts.*','users.name')
         ->where('users.name', 'LIKE', "%$searchValue%")
        ->orWhere('posts.title', 'LIKE', "%$searchValue%")
        ->orWhere('posts.description', 'LIKE', "%$searchValue%")
        ->paginate(10); 
        //->paginate(10);

        return $postData;
    }

    public function getListForUser($id,$searchValue)
    {
        $postData=Post::leftjoin('users','users.id','=','posts.created_user_id')
        ->select('posts.*','users.name')
        ->where('posts.created_user_id','=',$id)
        ->where('users.name', 'LIKE', "%$searchValue%")
        ->orWhere('posts.title', 'LIKE', "%$searchValue%")
        ->orWhere('posts.description', 'LIKE', "%$searchValue%")        
        ->paginate(10); 

        return $postData;
    }

    public function getListForGuest($searchValue)
    {
        $postData=Post::leftjoin('users','users.id','=','posts.created_user_id')
        ->select('posts.*','users.name')
        ->where('posts.status','1')
        ->whereNull('posts.deleted_at')
        ->where('users.name', 'LIKE', "%$searchValue%")
        ->orWhere('posts.title', 'LIKE', "%$searchValue%")
        ->orWhere('posts.description', 'LIKE', "%$searchValue%") 
       ->paginate(10); 

        return $postData;
    }
    public function getPostbyId($id)
    {
        $postData=Post::find($id);
        return $postData;
    }
    public function getPostInfo($id)
    {
        $postData=Post::leftjoin('users','users.id','=','posts.created_user_id')
        ->select('posts.*','users.name')
        ->where('posts.id',$id)
        ->first();   
                
        return $postData;
    }

    public function updatePost($request,$id)
    {
        $old_post_data=Post::find($id);
        $old_post_data->title=$request->title;
        $old_post_data->description=$request->description;
        $old_post_data->updated_user_id=$request->updated_user_id;
        $old_post_data->status=$request->status;
        $old_post_data->updated_at=now();
        $old_post_data->updated_user_id=Auth::user()->id;
        $old_post_data->save();
    }
    public function savePost($request)
    {
        $post=new Post;
        $post->title=$request->title;
        $post->description=$request->description;
        $post->created_user_id=Auth::user()->id;
        $post->updated_user_id=Auth::user()->id;         
        $post->status='1';          

       $post->Save(); 
    }
   
    public function getPostedUsers($id)
    {
        $posted_user=Post::where('created_user_id',$id)->get();
        return $posted_user;
    }
    public function deletePost($id)
    {
                    //delete
                    //$is_deleted=DB::table('posts')->where('id', '=', $id)->delete();
                    Post::find($id)->update(['deleted_user_id' => Auth::user()->id]);
                    $is_deleted=  Post::find($id)->delete();
                    return $is_deleted;
    }

    public function search($searchValue)
    {
      


        return $postData;

    }


}
