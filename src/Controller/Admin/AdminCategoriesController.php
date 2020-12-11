<?php 

namespace App\Controller\Admin;

use App\Helpers\Helpers;
use App\Services\Request;
use App\Services\Session;
use App\Entity\Categories;
use App\Services\FormBuilder;
use App\Model\CategoriesModel;
use App\Controller\AbstractController;

class AdminCategoriesController extends AbstractController
{

     protected $pm;
     protected $session;
     protected $request;

     public function __construct()
     {
          $this->session = new Session;
          $this->request = new Request;
          $this->cm = new CategoriesModel;
     }

     public function index()
     {
          $form = new FormBuilder();
          $categories = $this->cm->findAll(Categories::class);
          $title = "Gestion des catégories";
          return $this->adminView('categories.index', compact('form', 'categories', 'title')); 
     }  
     
     public function delete(array $params = [])
     {
          $category = $this->cm->find((int) $params['id'], Categories::class);
          if ( $this->request->checkAuthorization() ) {
               if ($category instanceof Categories) {
                    $this->cm->delete( (int) $category->getId() );
                    return $this->json(['message' => $this->setJsonMessage('success', 'La catégorie a été supprimé avec succès 🚀')]); 
               } else if ($category === NULL) {
                    return $this->json(['message' => $this->setJsonMessage('warning', 'La catégorie que vous essayé de supprimer n\'exite pas')], 500); 
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
     
     public function store()
     {
          $data = (array) json_decode( $this->request->getContent() );
          if ( $this->request->checkAuthorization() ) {
               $data = Helpers::sanitize($data);
               unset($data['id'], $data['csrf_token']);
               $data['id'] = 22;
               $category = $this->cm->insert($data, true);
               return $this->json([
                    'message' => $this->setJsonMessage('success', 'La catégorir a bien été enregistrée ! '),
                    'category' => [
                         'id' => $category->getId(),
                         'slug' => $category->getSlug(),
                         'description' => $category->getDescription(),
                         'category' => $category->getCategory()
                    ]
               ]); 
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

     public function update(array $params = [])
     {
          $data = (array) json_decode($this->request->getContent());
          $category = $this->cm->find((int) $params['id'], Categories::class);
          if ($category instanceof Categories) {
               unset($data['id'], $data['csrf_token']);
               $category = $this->cm->update($data, ['id' => $category->getId()], true);
               return $this->json([
                    'message' => $this->setJsonMessage('success', 'La catégorie a bien été modifiée ! 👍'), 
                    'category' => [
                         'id' => $category->getId(), 
                         'category' => $category->getCategory(),
                         'slug' => $category->getSlug(),
                         'description' => $category->getDescription()
                    ],
               ]);
               dd(['data' => $data,'params' => $params, 'category' => $category]);
          }
     }

}