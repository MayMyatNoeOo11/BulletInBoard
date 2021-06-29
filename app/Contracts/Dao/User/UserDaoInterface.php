<?php

namespace App\Contracts\Dao\User;


interface UserDaoInterface
{
    public function getUserList($request);
    public function getUserbyId($id);
    public function getUserInfo($id);
    public function saveUser($request);
    public function updateUser($request,$id);
    public function checkUserPosted($id);
    public function deleteUser($id);
    public function changePassword($id,$new_password);




}
