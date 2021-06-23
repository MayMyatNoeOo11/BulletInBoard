<?php

namespace App\Contracts\Dao\User;


interface UserDaoInterface
{
    public function getUserList();
    public function getUserbyId($id);
    public function saveUser($request);
    public function updateUser($request,$id);




}
