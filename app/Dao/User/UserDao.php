<?php

namespace App\Dao\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Contracts\Dao\User\UserDaoInterface;

class UserDao implements UserDaoInterface
{
    public function getUserList()
    {
        $userData=DB::table('users as u1')
        ->join('users as u2','u1.created_user_id','=','u2.id')
        ->select('u1.*','u2.name as created_user_name') 
        ->where('u1.id','<>',Auth::user()->id)               
        ->paginate(5);
        return $userData;
    }
    public function getUserbyId($id)
    {
        $userData=User::Find($id);
        return $userData;
    }
    public function saveUser($request)
    {
        User::create($request->all());
    }
    public function updateUser($request,$id)
    {

    }
    
}