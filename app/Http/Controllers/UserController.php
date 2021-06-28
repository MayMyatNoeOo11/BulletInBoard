<?php

namespace App\Http\Controllers;
use Log;
use Auth;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use File;
class UserController extends Controller
{
    public $userService;
  public function __construct(UserServiceInterface $user_service_interface)
  {
      $this->userService = $user_service_interface;
  } 
   //$photo_destination_path=Config::get('constants.options.profile_photo_destination_path');
  public function photo_store(Request $request)
  {
      
      if($request->hasFile('profile_photo'))
      {               // Get image file
           $image = $request->file('profile_photo'); 
           $destinationPath = 'storage/images/'; // upload path
           $profileImage = date('YmdHis') . "_Profile." . $image->getClientOriginalExtension();
           $file_full_path=$destinationPath.'/'.$profileImage;
           $image->move($destinationPath, $profileImage); 

       return $profileImage;
      // $image->move(public_path('images'), $imageName);//store in public
      }
      else
      {
          $profileImage="";

      }
      return $profileImage;
  }
  
 /**\
  * Show user detail
  */
  public function show($id)
  {   
       $user=$this->userService->getUserInfo($id);

     return view('user.show', compact('user'));
  }

     /**
     * Show All Users
     *
     * @return void
     */

    
    
    public function index(Request $request)
    {   
          $userData=$this->userService->getUserList($request);

          $name=$request->input('name');
          $email=$request->input('email');
          $created_from_date=$request->input('created_from_date');
          $created_to_date=$request->input('created_to_date');

           // dd($userData);
           return view('user.index',compact('userData'))
           ->with('k',(request()->input('page',1)-1)*5)
           ->with('name',$name)
           ->with('email',$email)
           ->with('created_from_date',$created_from_date)
           ->with('created_to_date',$created_to_date);
  
    }

    /**
     *  Common Menu Screen View     
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
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg,jfif,gif,svg|max:2048',//|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'date_of_birth'=>'required|date',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required| min:6'
   ]);

    $profileImage=$this->photo_store($request);
    $userData=$request;
    return view('user.create_confirm',compact('userData'))->with('image',$profileImage);  
    }

           /**
     * Store User 
     * 
     */
    public function confirm_user(Request $request)
    {     
        $this->userService->saveUser($request);
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
    public function update_user(Request $request,$id)
    {
      $request->validate([
        'name'=>'required',
        'email' => ['required', Rule::unique('users')->ignore($id)],
        'date_of_birth'=>'required|date'
    ]);
    if($request->hasFile('profile_photo'))//new profile
    { 
        $old_photo=$request->old_photo;
        File::delete('storage/images/'.$old_photo);
        $profileImage=$this->photo_store($request);
              
    }
    else //old profile
    {
    $profileImage=$request->old_photo;       
    }
    $userData=$request;  

    return view('user.update_confirm',compact('userData'))->with('image',$profileImage);
    }

    /**
     * confirm update user
     */
    public function update_confirm_user(Request $request,$id)
    {
            //dd($request);
        $this->userService->updateUser($request,$id);     
        return redirect()->route('showAllUsers')->with('success','User is updated successfully.');      
    }

    /**
     *  Delete User by id
     * 
     */
    public function delete($id)
    {
        $data=$this->userService->getUserbyId($id);     
        //dd($data);
        return view('user.delete',compact('data'));    
    }

    /**
     * delete confirm
     */
    public function delete_user(Request $request)
    {
        $name=$request->name;
      
       $is_deleted=$this->userService->deleteUser($request->id);
      if($is_deleted==1)
      {
          $message="User has been deleted successfully.";
          return redirect()->route('showAllUsers')->with('success',$message);
      }
      else
      {
        $message="User delete fail ! The user  ' $name'  is posted and cannot be deleted.";
        return redirect()->route('showAllUsers')->with('fail',$message);
      }
      
    }

    /**
     * Change Password Form
     * Get Method
     */
    public function changePasswordForm($id)
    {
        $userData=$this->userService->getUserbyId($id);
        //$password= Hash::make('$userData->password');
      //  $password=Hash::make('123');
        return view('user.change_password',compact('userData'));
   
    }

        /**
     * Change Password 
     * Post Method
     */
    public function changePassword(Request $request)
    {
        
     $request->validate([
        'old-password' =>['required',new MatchOldPassword($request->password)],
        'new_password' => ['required','min:6'],
        'new_confirm_password' => ['required','min:6','same:new_password']
   ]);
   $is_change_password=$this->userService->changePassword($request->id,$request->new_password);
   return redirect()->route('showAllUsers')->with('success','Change Password Successful.');

    }
}
