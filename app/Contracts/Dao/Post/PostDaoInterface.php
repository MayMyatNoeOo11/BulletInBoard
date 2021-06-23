<?php

namespace App\Contracts\Dao\Post;


interface PostDaoInterface
{
    public function getListForAdmin();
    public function getListForUser($id);
    public function getListForGuest();
    public function getPostbyId($id);
    public function updatePost($request,$id);
    public function savePost($request);



}