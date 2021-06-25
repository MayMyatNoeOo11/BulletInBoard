<?php

namespace App\Contracts\Services\Post;


interface PostServiceInterface
{
    public function getListForAdmin();
    public function getListForUser($id);
    public function getListForGuest();
    public function getPostbyId($id);
    public function getPostInfo($id);
    public function updatePost($request,$id);
    public function savePost($request);
    public function getPostedUsers($id);
    public function deletePost($id);

}
