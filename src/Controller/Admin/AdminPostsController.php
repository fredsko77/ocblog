<?php 

namespace App\Controller\Admin;

use App\Controller\Controller;
use App\Model\PostsModel;
use App\Services\Session;

class AdminPostsController extends Controller
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