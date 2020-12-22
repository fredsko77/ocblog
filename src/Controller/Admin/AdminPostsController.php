<?php 

namespace App\Controller\Admin;

use \DateTime;
use App\Entity\Posts;
use App\Entity\Users;
use App\Entity\Uploads;
use App\Helpers\Helpers;
use App\Model\PostsModel;
use App\Model\UsersModel;
use App\Services\Request;
use App\Services\Session;
use App\Model\UploadsModel;
use App\Services\FormBuilder;
use App\Model\CategoriesModel;
use App\Controller\AbstractController;
use App\Entity\Categories;

class AdminPostsController extends AbstractController
{

     protected $session;
     public $request;

     public function __construct()
     {
          $this->post = new PostsModel;
          $this->session = new Session;
          $this->request = new Request;
          $this->upload = new UploadsModel;
          $this->user = new UsersModel;
          $this->category = new CategoriesModel;
          $this->config = require "../config/uploads.php";
     }

     public function index()
     {
          $posts = $this->post->findAll(Posts::class, "updated_at.desc");
          $status = Posts::STATUS;
          $title = "Gestion des articles";
          return $this->adminView('posts.index', compact('posts', 'status', 'title')); 
     }     

     public function create()
     {
          $form     = new FormBuilder();
          $status   = Posts::STATUS;
          $writers  = Helpers::getWriters($this->user->findBy("role.admin", Users::class));
          $categories  = Helpers::getCategories($this->category->findAll(Categories::class));
          $title = 'Création d\'un article';
          return $this->adminView('posts.create', compact('form', 'status', 'writers', 'categories', 'title')); 
     }   
     
     public function delete(array $params = [])
     {
          $post = $this->post->find((int) $params['id'], Posts::class);
          if ( $this->request->checkAuthorization() ) {
               if ($post instanceof Posts) {
                    $this->post->delete( $post->getId() );
                    return $this->json(['message' => $this->setJsonMessage('success', 'L\'article a été supprimé avec succès 🚀')]); 
               } else if (!$post instanceof Posts) {
                    return $this->json(['message' => $this->setJsonMessage('warning', 'L\'article que vous essayé de supprimer n\'exite pas')], 500); 
               }
          } else {
               return $this->json([
                    'message' => [
                         'type' =>'danger',
                         'content' =>' 🛑 Vous n\'êtes pas autorisé à effectuer cette action !', 
                         ]
               ], 401);
          }
          return $this->json([
               'message' => $this->setJsonMessage('danger', 'Une erreur est survenu lors du traitement de votre requête 🤕')
          ], 500);
     }

     public function edit(array $params = [])
     {
          $int       = (int) $params['id'];
          $status   = Posts::STATUS;
          $data     = $this->post->find($int);
          $form     = new FormBuilder($data);
          $post     = new Posts($data);
          $writers  = Helpers::getWriters($this->user->findBy("role.admin", Users::class));
          $categories  = Helpers::getCategories($this->category->findAll(Categories::class));
          $title = "Modification de l'article n°{$post->getId()}";
          return $this->adminView('posts.edit', compact('form', 'status', 'post', 'writers', 'categories', 'title'));
     }

     public function update(array $params = [])
     {
          $data = count($this->request->postAll()) > 0 ? Helpers::sanitize($this->request->postAll()) : (array) json_decode($this->request->getContent());
          if ( $this->request->checkAuthorization() || Helpers::checkCsrfToken($data['csrf_token']) ) {
               $post = $this->post->find((int) $params['id'], Posts::class);
               unset($data['csrf_token']);
               if ($data['writer'] === "default") unset($data['writer']);
               $upload = $this->upload->findBy( "posts_id.{$post->getId()}", Uploads::class);
               if ( $post instanceof Posts) {
                    $now = (new DateTime())->format('Y-m-d H:m:s'); 
                    $file = array_key_exists('image', $this->request->files()) ? (object) $this->request->files()['image'] : null ;
                    if ($data['slug'] === "") $data['slug'] = Helpers::generateSlug($data['title']);
                    unset($data['image']);                      
                    if ( count($this->request->files()) > 0 ) {   
                         if ( $file && $file->error === 0 && $file->name !== "" ) {
                              $uploaded_file = (new Uploads)->move_file($file, 'post');
                         
                         if ( is_string($uploaded_file) ) {
                              return $this->json([
                                   'message' => $this->setJsonMessage('danger', $uploaded_file),
                              ], 400);
                         }
                         // Initialiser les données à persister
                         $uploaded_file['created_at'] = $now;
                         $uploaded_file['posts_id'] = (int) $post->getId();
                              if ($upload instanceof Uploads) unlink("../public/{$upload->getPath()}");
                              $upload = $upload instanceof Uploads ? $this->upload->update_image($uploaded_file, true) : $this->upload->insert($uploaded_file, true);
                              $data['image'] = $upload->getId();
                         }
                    }
                    $data['updated_at'] = $now;
                    $post = $this->post->update($data, ['id' => (int) $params['id'] ], true);  
                    if ($post instanceof Posts) {
                         return $this->json(['message' => $this->setJsonMessage('success', 'Cet article a bien été mis à jour 👍') ]);
                    }
               } else {
                    return $this->json(['message' => $this->setJsonMessage('danger', ' Article inexistant ! ') ], 400);
               }
          }
          return $this->json([
               'message' => $this->setJsonMessage('danger', 'Une erreur est survenu lors du traitement de votre requête 🤕')
          ], 500);
     }

     public function store()
     {
          $data = count($this->request->postAll()) > 0 ? Helpers::sanitize($this->request->postAll()) : (array) json_decode($this->request->getContent());
          if ( $this->request->checkAuthorization() || Helpers::checkCsrfToken($data['csrf_token']) ) {
               unset($data['csrf_token']);
               $now = (new DateTime())->format('Y-m-d H:m:s');
               $file = array_key_exists('image', $this->request->files()) ? (object) $this->request->files()['image'] : null ;
               $data['title'] = $data['title'] === "" ? 'Titre de l\'article' : $data['title'];
               $data['slug'] = Helpers::generateSlug($data['slug'] === "" ? $data['title'] : $data['slug']);
               $data['updated_at'] = $now;    
               $data['created_at'] = $now;
               $post = $this->post->insert($data, true); 
               if ( $file && $file->error === 0 && $file->name !== "" )  {
                    if ( $file && $file->error === 0 && $file->name !== "" ) {
                         $uploaded_file = (new Uploads)->move_file($file, 'post');
                    }
                    if ( is_string($uploaded_file) ) {
                         return $this->json([
                              'message' => $this->setJsonMessage('danger', $uploaded_file),
                         ], 400);
                    }
                    // Initialiser les données à persister
                    $uploaded_file['created_at'] = $now;
                    $uploaded_file['posts_id'] = $post->getId();
                    $upload = $this->upload->insert($uploaded_file, true);  
                    $this->post->update([ 'image' => (int) $upload->getId() ], [ 'id' => (int) $post->getId() ]); 
               }
               if ( $post instanceof Posts ) {
                    return $this->json([
                         'message' => $this->setJsonMessage('success', 'Cet article a bien été ajouté 👍'),
                         'url' => generate_url("admin.posts.edit", ['id' => $post->getId()])
                    ]);
               } 
          }
          return $this->json([
               'message' => $this->setJsonMessage('danger', 'Une erreur est survenu lors du traitement de votre requête 🤕')
          ], 500);
     }

}