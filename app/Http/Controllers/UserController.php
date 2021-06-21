<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
     /**
     * Show All Users
     *
     * @return void
     */
    
    public function index()
    {
            $userData=DB::table('users as u1')
                ->join('users as u2','u1.created_user_id','=','u2.id')
                ->select('u1.*','u2.name as created_user_name')                
                ->paginate(5);
            
           return view('user.index',compact('userData'))
           ->with('k',(request()->input('page',1)-1)*5);    
       // return view('user.index',compact('userData'));
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
     * Profile View 
     */
    public function profile($id=1)
    {
        return view('user.profile');
    }
    /**
     *  Create User  View  
     * 
     */
    public function create()
    {
        return view('user.create');
    }
    /**
     *  Create User  View  
     * 
     */
    public function create_user()
    {
        return view('user.create');
    }
       /**
     *  Create User Create Confirm View  
     * 
     */
    public function confirm_user()
    {
        return view('user.create_confirm');
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
    /**
     * Change Password
     * Get Method
     */
    public function changePassword()
    {
        return view('user.change_password');
    }
}
