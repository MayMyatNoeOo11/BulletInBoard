<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
class PostService implements PostServiceInterface
{
    public $postDao;
    public function __construct(PostDaoInterface $post_dao_interface){
        $this->postDao = $post_dao_interface;
    }

    public function getListForAdmin()
    {
        return $this->postDao->getListForAdmin();
    }
    public function getListForUser($id)
    {
        return $this->postDao->getListForUser($id);
    }
    public function getListForGuest()
    {
        return $this->postDao->getListForGuest();
    }
    public function getPostbyId($id)
    {
        return $this->postDao->getPostbyId($id);
    }
    public function updatePost($request,$id)
    {
        return $this->postDao->updatePost($request,$id);
    }
    public function savePost($request)
    {
        return $this->postDao->savePost($request);
    }

}
