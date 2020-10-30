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
          $this->pm = new PostsModel();
          $this->session = new Session();
     }

     public function home()
     {
          return $this->view("home");
     }

     public function notFound()
     {
          return $this->view("404");
     }
     
     public function show(array $params)
     {
          $post = $this->pm->find($params['id'], Posts::class);
          if ( $post->getSlug() && $post->getSlug() !== $params['slug'] ) return $this->redirect( generate_url('posts.show', ['slug' => $post->getSlug(), 'id' => $post->getId() ] ) );         

          $user = $this->session->getUser();
          return $this->view('blog.show',compact('post', 'user') );
     }

     public function index() 
     {
          return $this->view('blog.index');
     }

}