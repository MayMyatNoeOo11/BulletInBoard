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

    public function getUserList()
    {
        return $this->userDao->getUserList();
    }
    public function getUserbyId($id)
    {
        return $this->userDao->getUserbyId($id);
    }
    public function saveUser($request)
    {
        return $this->userDao->saveUser($request);
    }
    public function updateUser($request,$id)
    {
        return $this->userDao->updateUser($request,$id);
    }
}