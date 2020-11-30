<?php 

namespace App\Controller\Admin;

use App\Model\PostsModel;
use App\Services\Request;
use App\Services\Session;
use App\Controller\AbstractController;
use App\Model\UsersModel;

class AdminUsersController extends AbstractController
{

     protected $pm;
     protected $session;
     protected $request;

     public function __construct()
     {
          $this->pm = new PostsModel;
          $this->session = new Session;
          $this->request = new Request;
          $this->um = new UsersModel;
     }

     public function index()
     {
          return $this->adminView('users.index'); 
     }
     

}