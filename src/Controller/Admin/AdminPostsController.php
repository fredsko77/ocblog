<?php 

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Model\PostsModel;
use App\Services\Session;

class AdminPostsController extends AbstractController
{

     protected $pm;
     protected $session;

     public function __construct()
     {
          $this->pm = new PostsModel();
          $this->session = new Session();
     }

     public function index()
     {
          return $this->view("admin.index");
     }

     public function show()
     {
          return $this->view('admin.posts.show');
     }

}