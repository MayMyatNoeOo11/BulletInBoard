<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     /**
     * Show All Users
     *
     * @return void
     */
    
    public function index()
    {$userData=new User;
        return view('user.index',compact('userData'));
    }

    /**
     *  Common Screen View     
     * 
     */
    public function common()
    {
        return view('user.common');
    }
    /**
     *  Create User    
     * 
     */
    public function create(Request $request)
    {
        return view('user.create');
    }
    /**
     *  Update User    
     * 
     */
    public function update()
    {
        return view('user.common');
    }
    /**
     *  Delete User by id
     * 
     */
    public function delete()
    {
        return "";
    }
}
