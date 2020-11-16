<?php 

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Services\Session;

class DashboardController extends AbstractController
{

     protected $pm;
     protected $session;

     public function __construct()
     {
          // $this->pm = new PostsModel();
          $this->session = new Session();
     }
     
     public function index() 
     {
          return $this->adminView('index');
     }

}