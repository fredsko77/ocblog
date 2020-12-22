<?php 

namespace App\Controller;

use App\Entity\Posts;
use App\Model\PostsModel;
use App\Services\Request;
use App\Services\Session;
use App\Controller\AbstractController;
use App\Entity\Categories;
use App\Helpers\Helpers;
use App\Model\CategoriesModel;
use App\Model\CommentsModel;
use App\Services\FormBuilder;
use App\Services\Pagination;
use DateTime;

class BlogController extends AbstractController
{

     protected $session;

     public function __construct()
     {
          $this->post = new PostsModel;
          $this->session = new Session;
          $this->request = new Request;
          $this->comment = new CommentsModel;
          $this->category = new CategoriesModel;
     }

     public function notFound()
     {
          return $this->view("404");
     }
     
     public function index(array $params = []) 
     { 
          $nbPosts = (float) ($this->post->nbPost())->nb_posts;
          $nbPages = ceil( $nbPosts / 10 );
          $currentPage = array_key_exists('id', $params) ? (int) $params['id'] : 0;
          $posts = $this->post->pagePosts((int) $currentPage);
          $pagination = new Pagination($nbPages, $currentPage);
          return $this->view('blog.index', compact('posts', 'pagination'));
     }
     
     public function category(array $params = []) 
     { 
          $posts    = $this->post->category((int) $params['id']);
          $category = $this->category->find((int) $params['id'], Categories::class);
          $title    = "Articles - {$category->getCategory()}";
          return $this->view('blog.category', compact('posts', 'title'));
     }
     
     public function show(array $params = []) 
     {
          $post = $this->post->find((int) $params['id'], Posts::class);
          if ($post instanceof Posts) {
               if ($params['slug'] !== $post->getSlug()) return $this->redirect(generate_url('blog.show', [
                    'slug' => $post->getSlug(),
                    'id' => $post->getId(),
               ]));
               $title = $post->getTitle();
               $posts = $this->post->similar((int) $post->getCategoryId()->getId());
               $form = new FormBuilder();
               $comments = $this->comment->getPostComments( (int) $post->getId() );
               return $this->view('blog.show', compact('post', 'title', 'form', 'comments', 'posts'));
          }
          return $this->view('blog.show');
     }

     public function comment(array $params = [])
     {
          $data = (array) json_decode( $this->request->getContent() );
          if ( $this->request->checkAuthorization() || Helpers::checkCsrfToken($data['csrf_token']) ) {
               $data = Helpers::sanitize($data);
               $data['post_id'] = (int) $params['id'];
               $data['author'] = $this->session->getLoggedUser()->getId();
               $data['status'] = 'pending';
               $data['created_at'] = (new DateTime)->format('Y-m-d H:i:s');
               unset($data['csrf_token']);
               // dd($data);
               if ( $this->comment->insert($data) ) return $this->json([
                    'message' => $this->setJsonMessage('success', 'Le commentaire a bien été enregistré 👍, en attente de l\'approbation d\'un modérateur')
               ], 202);
               return $this->json([
                    'message' => $this->setJsonMessage('danger', 'Une erreur est surevnue lors de l\enregistrement de votre commentaire ! 🤕')
               ], 500);
          } else {
               return $this->json([
                    'message' => $this->setJsonMessage('danger', 'Vous n\'êtes pas autorisé à soumettre ce formulaire ! ')
               ], 401);
          }
          return $this->json([
               'message' => $this->setJsonMessage('danger', 'Une erreur est survenue lors du traitement de votre requête ! ')
          ], 500);
     }
     
}