<?php

namespace App\Dao\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Contracts\Dao\User\UserDaoInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserDao implements UserDaoInterface
{
    public function getUserList()
    {
        $userData=DB::table('users as u1')
        ->join('users as u2','u1.created_user_id','=','u2.id')
        ->select('u1.*','u2.name as created_user_name') 
        ->where('u1.id','<>',Auth::user()->id) 
        ->whereNull('u1.deleted_user_id')            
        ->paginate(5);
        return $userData;
    }

    public function getUserbyId($id)
    {
        $userData=User::Find($id);
        return $userData;
    }

    public function getUserInfo($id)
    {
        $userData=DB::table('users as u1')
        ->join('users as u2','u1.created_user_id','=','u2.id')
        ->select('u1.*','u2.name as created_user_name') 
        ->where('u1.id','=',$id)
        ->whereNull('u1.deleted_user_id') 
        ->first();
       // $userData=User::Find($id);   
        

        return $userData;
    }

    public function saveUser($request)
    {
        //User::create($request->all());
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->address=$request->address;  
        $user->password=Hash::make($request->password) ;     
        $user->type='1';  
        $user->date_of_birth=$request->date_of_birth;
        $user->created_user_id=Auth::user()->id;  
        $user->updated_user_id=Auth::user()->id;  
        $user->created_at=now();   
        $user->updated_at=now(); 
        $user->profile_photo=$request->profile_photo;        

      $user->Save();
       
    }

    public function updateUser($request,$id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'profile_photo'=>$request->profile_photo,
                'date_of_birth'=>$request->date_of_birth,
                'type'=>$request->type,
                'updated_user_id'=>Auth::user()->id,
                'updated_at'=>now()

            ]);
          


        //$old_user_data=User::find($id);
        // $old_user_data->name=$request->name;
        // $old_user_data->email=$request->email;
        // $old_user_data->phone=$request->phone;
        // $old_user_data->address=$request->address;  
        // $old_user_data->password=Hash::make($request->password) ;     
        // $old_user_data->type=$request->type;  
        // $old_user_data->date_of_birth=$request->date_of_birth;
        // //$old_user_data->created_user_id=Auth::user()->id;  
        // $old_user_data->updated_user_id=Auth::user()->id;  
        // //$old_user_data->created_at=now();   
        // $old_user_data->updated_at=now();
        //$old_user_data->Save();  
    }

    public function deleteUser($id)
    {   
        $result= DB::table('posts')->where('created_user_id', '=',$id)->get();
       
        if ($result->isEmpty()) 
        { 
            //delete
            $is_deleted=DB::table('users')->where('id', '=', $id)->delete();
            return $is_deleted;

        }
        return 0;
 

      //  User::where('id',$id)->delete();
    }
    
    
    
}