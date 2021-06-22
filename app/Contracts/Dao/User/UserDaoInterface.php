<?php

namespace App\Contracts\Dao\User;

interface UserDaoInterface
{
  
  public function index();
  
  public function common();
  
  public function profile($id);
  
  public function create();
 
  public function create_user(Request $request);

  public function confirm_user();

  public function update($id);

  public function delete();

  public function changePassword($id)

}
