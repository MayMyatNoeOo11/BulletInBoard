<?php

namespace App\Contracts\Dao\Post;


interface PostDaoInterface
{
    public function getExportList();
    public function getListForAdmin($searchValue);
    public function getListForUser($id,$searchValue);
    public function getListForGuest($searchValue);
    public function getPostbyId($id);
    public function getPostInfo($id);
    public function updatePost($request,$id);
    public function savePost($request);
    public function getPostedUsers($id);
    public function deletePost($id);
    public function search($searchValue);



}
