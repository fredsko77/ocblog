<?php 

namespace App\Controller;

use App\Entity\Posts;
use App\Entity\Users;
use App\Controller\AbstractController;
use App\Model\PostsModel;
use App\Services\Session;

class BlogController extends AbstractController
{

     protected $pm;
     protected $session;

     public function __construct()
     {
          // $this->pm = new PostsModel();
          $this->session = new Session();
     }

     public function notFound()
     {
          return $this->view("404");
     }
     
     public function index() 
     {
          return $this->view('blog.index');
     }

}