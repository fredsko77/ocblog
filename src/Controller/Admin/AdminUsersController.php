<?php 

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Helpers\Helpers;
use App\Services\Mailer;
use App\Model\UsersModel;
use App\Services\Request;
use App\Services\Session;
use App\Services\Validator;
use App\Services\FormBuilder;
use App\Controller\AbstractController;

class AdminUsersController extends AbstractController
{

     protected $session;
     protected $request;

     public function __construct()
     {
          $this->session = new Session;
          $this->request = new Request;
          $this->user = new UsersModel;
          $this->mailer = new Mailer;
     }

     public function index()
     {
          $users = $this->user->exceptAuth();
          $form = new FormBuilder;
          $roles = Users::ROLES;
          $title = 'Gestion des utilisateurs';
          return $this->adminView('users.index', compact('users', 'form', 'roles', 'title')); 
     }

     public function delete(array $params = [])
     {
          $user = $this->user->find((int) $params['id'], Users::class);
          if ( $this->request->checkAuthorization() ) {
               if ($user instanceof Users) {
                    // $this->user->delete( $user->getId()); 
                    if( 1 === 1 ) {
                         return $this->json([
                              'message' => $this->setJsonMessage('success', 'Votre compte utilisateur a été supprimé avec succès 🚀'),
                              
                         ]); 
                    };
                    $this->session->unset('auth');
                    return $this->json([
                         'message' => $this->setJsonMessage('danger', '🛑 Une erreur est survenu lors de la suppression de ce compte !'), 
                    ], 400);
               }
               return $this->json([
                    'message' => $this->setJsonMessage('danger', 'Une erreur est survenu lors du traitement de votre requête 🤕')
               ], 500);
          } 
          return $this->json([
               'message' => $this->setJsonMessage('danger', '🛑 Vous n\'êtes pas autorisé à effectuer cette action !')
          ], 401);
          
     }

     public function create() 
     {
          $form = new FormBuilder();
          $roles = Users::ROLES;
          $title = 'Création d\'un utilisateur';
          return $this->adminView("users.create", compact('form', 'roles', 'title'));
     }

     public function store()
     {
          $data = (array) json_decode( $this->request->getContent() ); 
          if ( $this->request->checkAuthorization() ) { 
               $errors = [];
               $data['password'] = encrypt_password('123MSBlog');
               $data['slug'] = Helpers::generateSlug($data['firstname'], $data['lastname']);
               $data['token'] = generate_token(80);
               $data['created_at'] = now();
               $data['confirm'] = 0; 
               if ((new Validator)->email($data["email"]) === true) {
                    if ( $this->user->findUserByEmail($data["email"]) instanceof Users ) {
                         $errors['email'] = "Cette adresse électronique existe déjà ! ";
                    }                     
               } else {
                    $errors['email'] = "Cette adresse électronique n'est pas valide ! ";
               }
               if ( count($errors) > 0 ) {
                    return $this->json([
                         'message' => $this->setJsonMessage('warning', $errors['email']),
                    ]);                    
               } else {                  
                    $newUser = $this->user->insert($data, true);
                    $this->mailer->sendConfirmEmail($newUser);
                    return $this->json([ 
                         'message' => $this->setJsonMessage('success','L\'utilisateur a bien été enregistré.Un courrier électronique lui sera envoyé pour confirmer son inscription. '),
                         'url' => generate_url('admin.users'), 
                    ]);
               }
               return $this->json([
                    'message' => [
                         'type' => 'danger',
                         'content' => ' Une erreur est survenue lors de l\'enregiqtrement de l\'utilisateur !', 
                    ]
               ], 500);
          }else {
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

     public function editRole(array $params = [])
     {
          $data = (array) json_decode($this->request->getContent());
          if ( $this->request->checkAuthorization() ) { 
               $user = $this->user->find((int) $params['id'], Users::class);
               if ($user instanceof Users) {                  
                    $user = $this->user->update($data,['id' => (int) $params['id']] ,true);
                    return $this->json([ 
                         'message' => $this->setJsonMessage('success','L\'utilisateur a bien été mis à jour. '),
                         'role' => [
                              'key' => $user->getRole(),
                              'value' => Users::ROLES[$user->getRole()],
                         ], 
                         'id' => (string) $user->getId(),

                    ]);
               }
               return $this->json([
                    'message' => [
                         'type' => 'danger',
                         'content' => ' Une erreur est survenue lors de la mise à jour de l\'utilisateur !', 
                    ]
               ], 500);
          }else {
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
          dd(['data' => $data, 'params' => $params]);
     }
     

}