<?php 

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\PostsModel;
use App\Services\Session;

class BlogController extends AbstractController
{

     protected $pm;
     protected $session;

     public function __construct()
     {
          $this->pm = new PostsModel();
          $this->session = new Session();
     }

     public function notFound()
     {
          return $this->view("404");
     }
     
     public function index(array $params = []) 
     { 
          $posts = $this->pm->pagePosts();
          $page = array_key_exists('id', $params) ? (int) $params['id'] : 0;
          dd($page);
          return $this->view('blog.index', compact('posts', 'page'));
     }
     
     public function show(array $params = []) 
     {
          $posts = $this->pm->pagePosts();
          return $this->view('blog.index', compact('posts'));
     }

}