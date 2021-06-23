<?php

namespace App\Http\Controllers;
use Log;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contracts\Services\User\UserServiceInterface;
class UserController extends Controller
{
    public $userService;
  public function __construct(UserServiceInterface $user_service_interface)
  {
      $this->userService = $user_service_interface;
  }
     /**
     * Show All Users
     *
     * @return void
     */
    
    public function index()
    {
        

        $userData=$this->userService->getUserList();
            
           return view('user.index',compact('userData'))
           ->with('k',(request()->input('page',1)-1)*5);    
  
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
        $userData=$this->userService->getUserbyId($id);
        
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

     $request->validate([
        'name'=>'required',
        'email' => 'required|unique:users',
        'password' => 'required',
        'profile_photo'=>'required',
       'date_of_birth'=>'required|date',
       'password' => 'required|min:6|confirmed',
       'password_confirmation' => 'required| min:6'
   ]);

        $userData=$request;
       return view('user.create_confirm',compact('userData'));  
    }
       /**
     * Store User 
     * 
     */
    public function confirm_user(Request $request)
    {
     
        $userData=$this->userService->saveUser($request);
        return redirect()->route('showAllUsers')->with('success','New user is created successfully.');
    }
    /**
     *  Update User View    
     * GET Method
     */
    public function update($id)
    {
        $userData=$this->userService->getUserbyId($id);
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
