<?php

namespace App\Contracts\Services\User;


interface UserServiceInterface
{
    public function getUserList($request);
    public function getUserbyId($id);
    public function getUserInfo($id);
    public function saveUser($request);
    public function updateUser($request,$id);
    public function deleteUser($id);
    public function changePassword($id,$new_password);

}
