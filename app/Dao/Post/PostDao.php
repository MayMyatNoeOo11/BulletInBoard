<?php

namespace App\Dao\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Contracts\Dao\Post\PostDaoInterface;

class PostDao implements PostDaoInterface
{
    public function getListForAdmin()
    {
        $postData=Post::leftjoin('users','users.id','=','posts.created_user_id')
        ->select('posts.*','users.name')    
        ->paginate(10);

        return $postData;
    }

    public function getListForUser($id)
    {
        $postData=Post::leftjoin('users','users.id','=','posts.created_user_id')
        ->select('posts.*','users.name')
        ->where('posts.created_user_id','=',$id)
        //->where('posts.status','1')
        ->paginate(10); 

        return $postData;
    }

    public function getListForGuest()
    {
        $postData=Post::leftjoin('users','users.id','=','posts.created_user_id')
        ->select('posts.*','users.name')
        ->where('posts.status','1')
        ->paginate(10);  

        return $postData;
    }
    public function getPostbyId($id)
    {
        $postData=Post::find($id);
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
   


}
