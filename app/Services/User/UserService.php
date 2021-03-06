<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
class UserService implements UserServiceInterface
{
    public $userDao;
    public function __construct(UserDaoInterface $user_dao_interface)
    {
        $this->userDao = $user_dao_interface;
    }

    public function getUserList($request)
    {
        return $this->userDao->getUserList($request);
    }
    public function getUserbyId($id)
    {
        return $this->userDao->getUserbyId($id);
    }
    public function getUserInfo($id)
    {
        return $this->userDao->getUserInfo($id);
    }
    public function saveUser($request)
    {
        return $this->userDao->saveUser($request);
    }
    public function updateUser($request,$id)
    {
        return $this->userDao->updateUser($request,$id);
    }
    public function checkUserPosted($id)
    {
        return $this->userDao->checkUserPosted($id); 
    }
    public function deleteUser($id)
    {
        return $this->userDao->deleteUser($id);
    }
    public function changePassword($id,$new_password)
    {
        return $this->userDao->changePassword($id,$new_password);
    }

}