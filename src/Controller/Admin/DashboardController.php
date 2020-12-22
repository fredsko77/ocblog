<?php 

namespace App\Controller\Admin;

use App\Model\PostsModel;
use App\Services\Session;
use App\Controller\AbstractController;
use App\Model\CommentsModel;
use App\Model\ContactsModel;

class DashboardController extends AbstractController
{

     protected $pm;
     protected $session;

     public function __construct()
     {
          $this->contact = new ContactsModel;
          $this->comment = new CommentsModel;
          $this->post = new PostsModel;
          $this->session = new Session;
     }
     
     public function index() 
     {
          $contacts = $this->contact->pending();
          $comments = $this->comment->pending();
          $posts = $this->post->draft();
          $latest = $this->post->latest();
          $lastUploadedPost = $this->post->lastUpdatedPost(); 
          $title = "Tableau de bord";
          return $this->adminView('index', compact('contacts', "comments", 'posts', 'latest', 'lastUploadedPost', 'title'));
     }

}