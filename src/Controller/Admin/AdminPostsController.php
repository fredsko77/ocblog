<?php 

namespace App\Controller\Admin;

use \DateTime;
use App\Entity\Posts;
use App\Helpers\Helpers;
use App\Model\PostsModel;
use App\Services\Request;
use App\Services\Session;
use App\Services\FormBuilder;
use App\Controller\AbstractController;
use App\Entity\Uploads;
use App\Entity\Users;
use App\Model\UploadsModel;
use App\Model\UsersModel;

class AdminPostsController extends AbstractController
{

     protected $pm;
     protected $session;
     public $request;

     public function __construct()
     {
          $this->pm = new PostsModel;
          $this->session = new Session;
          $this->request = new Request;
          $this->upm = new UploadsModel;
          $this->um = new UsersModel;
          $this->config = require "../config/uploads.php";
     }

     public function index()
     {
          $posts = $this->pm->findAll(Posts::class, "updated_at.desc");
          $status = Helpers::postsStatus();
          return $this->adminView('posts.index', compact('posts', 'status')); 
     }     

     public function create()
     {
          $form     = new FormBuilder();
          $status   = Helpers::postsStatus();
          $writers  = Helpers::getWriters($this->um->findBy("role.admin", Users::class));
          return $this->adminView('posts.create', compact('form', 'status', 'writers')); 
     }   
     
     public function delete(array $params = [])
     {
          $post = $this->pm->find((int) $params['id'], Posts::class);
          if ( $this->request->checkAuthorization() ) {
               if ($post instanceof Posts) {
                    $this->pm->delete( $post->getId() );
                    return $this->json(['message' => $this->setJsonMessage('success', 'L\article a été supprimé avec succès 🚀')]); 
               } else if (!$post instanceof Posts) {
                    return $this->json(['message' => $this->setJsonMessage('warning', 'L\article que vous essayé de supprimer n\'exite pas')], 500); 
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
          $id       = (int) $params['id'];
          $status   = Helpers::postsStatus();
          $data     = $this->pm->find($id);
          $form     = new FormBuilder($data);
          $post     = new Posts($data);
          $writers  = Helpers::getWriters($this->um->findBy("role.admin", Users::class));
          return $this->adminView('posts.edit', compact('form', 'status', 'post', 'writers'));
     }

     public function update(array $params = [])
     {
          $data = count($_POST) > 0 ? Helpers::sanitize($_POST) : (array) json_decode($this->request->getContent());
          if ( $this->request->checkAuthorization() || Helpers::checkCsrfToken($data['csrf_token']) ) {
               $post = $this->pm->find((int) $params['id'], Posts::class);
               unset($data['csrf_token']);
               $upload = $this->upm->findBy( "posts_id.{$post->getId()}", Uploads::class);
               if ( $post instanceof Posts) {
                    $file = array_key_exists('image', $_FILES) ? (object) $_FILES['image'] : null ;
                    $now = (new DateTime())->format('Y-m-d H:m:s');
                    if ( $file && $file->error === 0 && $file->name !== "" ) {
                         if ( ! Helpers::checkExtension($file->name, $this->config->file_accepted['image'])) return $this->json([
                              'message' => $this->setJsonMessage('danger', 'Ce type de fichier n\'est pas accepté ! ')
                         ], 400);
                         if( $file->size > ( (int) $this->config->max_size_accepted * pow(1024, 2)) ) return $this->json([
                              'message' => $this->setJsonMessage('danger', 'Ce fichier est trop volumineux ! ') 
                         ], 400);
                         if ( ! is_dir($this->config->directory."/post") ) mkdir($this->config->directory."/post", 0777, true);                         
                         $filename = generate_filename() . "." . explode('.', $file->name)[1];
                         if ( ! move_uploaded_file($file->tmp_name, $this->config->directory . "/post/" . $filename) ) {
                              return $this->json(['message' => $this->setJsonMessage('danger', 'L\'image n\'a pas pu être téléchargée . ')], 500); 
                         }
                         $uploaded_file = [
                              'type' => 'poster',
                              'path' => str_replace('../public/', '',  $this->config->directory . "/post/" . $filename),
                              'created_at' => $now,
                              'posts_id' => (int) $post->getId()
                         ];
                         if ($upload instanceof Uploads) unlink("../public/{$upload->getPath()}");
                         $upload = $upload === null ? $this->upm->insert($uploaded_file, true) : $this->upm->update_image($uploaded_file, true);
                    }
                    $data['updated_at'] = $now;
                    $data['image'] = $upload->getId();
                    $post = $this->pm->update($data, ['id' => (int) $params['id'] ], true);  
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
          $data = count($_POST) > 0 ? Helpers::sanitize($_POST) : (array) json_decode($this->request->getContent());
          if ( $this->request->checkAuthorization() || Helpers::checkCsrfToken($data['csrf_token']) ) {
               unset($data['csrf_token']);
               $now = (new DateTime())->format('Y-m-d H:m:s');
               $file = array_key_exists('image', $_FILES) ? (object) $_FILES['image'] : null ;
               $data['title'] = $data['title'] === "" ? 'Titre de l\'article' : $data['title'];
               $data['slug'] = Helpers::generateSlug($data['slug'] === "" ? $data['title'] : $data['slug']);
               $data['updated_at'] = $now;    
               $data['created_at'] = $now;
               $post = $this->pm->insert($data, true); 
               if ( $file && $file->error === 0 && $file->name !== "" )  {
                    if ( ! Helpers::checkExtension($file->name, $this->config->file_accepted['image']) ) return $this->json([
                         'message' => $this->setJsonMessage('danger', 'Ce type de fichier n\'est pas accepté ! ')
                    ], 400);
                    if( $file->size > ((int) $this->config->max_size_accepted * pow(1024, 2)) ) return $this->json([
                         'message' => $this->setJsonMessage('danger', 'Ce fichier est trop volumineux ! ') 
                    ], 400);
                    if ( ! is_dir($this->config->directory."/post") ) mkdir($this->config->directory."/post", 0777, true);                         
                    $filename = generate_filename() . "." . explode('.', $file->name)[1];
                    if ( ! move_uploaded_file($file->tmp_name, $this->config->directory."/post/".$filename) ) {
                         return $this->json(['message' => $this->setJsonMessage('danger', 'L\'image n\'a pas pu être téléchargée . ')], 500); 
                    }
                    $uploaded_file = [
                         'type' => 'poster',
                         'path' => str_replace('../public/', '',  $this->config->directory."/post/".$filename),
                         'created_at' => $now,
                         'posts_id' => (int) $post->getId()
                    ];
                    $upload = $this->upm->insert($uploaded_file, true);  
                    $this->pm->update([ 'image' => (int) $upload->getId() ], [ 'id' => (int) $post->getId() ]); 
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