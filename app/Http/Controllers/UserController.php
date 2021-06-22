<?php

namespace App\Http\Controllers;
use Log;
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
    public function profile($id)
    {
        $userData=User::Find($id);
        
      return view('user.profile',compact('userData'));
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
     *  Create User   
     * POST method
     */
    public function create_user(Request $request)
    {
     
       // Log::info($request);
        //validation
        $validated = $request->validate([
             'name'=>'required',
             'email' => 'required|unique:users',
             'password' => 'required',
             'profile'=>'required',
            'date_of_birth'=>'required|date'
        ]);
        dd($validated);
$userData=new User;
       return view('user.create_confirm',compact('userData'));  
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
     *  Update User View    
     * 
     */
    public function update($id)
    {
        $userData=User::Find($id);
        return view('user.update',compact('userData'));
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
     * Change Password View
     * Get Method
     */
    public function changePassword($id)
    {
        $userData=User::Find($id);
        return view('user.change_password',compact('userData'));
    }
}
