<?php 

namespace App\Controller\Admin;

use App\Entity\Posts;
use App\Helpers\Helpers;
use App\Model\PostsModel;
use App\Services\Request;
use App\Services\Session;
use App\Services\FormBuilder;
use App\Controller\AbstractController;
use App\Model\UploadsModel;
use App\Model\UsersModel;

class AdminUploadsController extends AbstractController
{

     protected $pm;
     protected $session;
     public $request;

     public function __construct()
     {
          $this->pm = new PostsModel;
          $this->session = new Session;
          $this->request = new Request;
          $this->model = new UploadsModel;
          $this->um = new UsersModel;
     }

     public function index()
     {
          return $this->view('uploads.index'); 
     }
     

}