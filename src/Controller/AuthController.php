<?php 

namespace App\Controller;

use App\Entity\Users;
use App\Helpers\Helpers;
use App\Model\UsersModel;
use App\Services\Request;
use App\Services\Session;
use App\Services\FormBuilder;
use App\Controller\AbstractController;

class AuthController extends AbstractController
{

     protected $um;
     protected $session;
     private $resuest;

     public function __construct()
     {
          $this->um = new UsersModel();
          $this->session = new Session();
          $this->request = new Request();
     }

     public function login()
     {
          if ($this->session->isLoggedUser()) $this->redirect(generate_url('blog'));
          $form = new FormBuilder();
          return $this->view("auth.login", compact('form'));
     }
     
     public function register() 
     {
          $form = new FormBuilder();
          return $this->view('auth.register', compact('form'));
     }

     public function store() 
     {
          return $this->json([
               'message' => [
                    'type' =>'danger',
                    'content' =>' 🛑 Vous n\'êtes pas autorisé à soumettre ce formulaire!', 
               ]
          ]);
     }

     public function authenticate() 
     {
          $data = json_decode($this->request->getContent());
          if ( !Helpers::checkCsrfToken($data->csrf_token) ) {
               return $this->json([
                    'message' => [
                         'type' =>'danger',
                         'content' =>' 🛑 Vous n\'êtes pas autorisé à soumettre ce formulaire!', 
                         ]
                    ], 401);
          }
          if ( $this->um->checkUserExists($data->username) ) {
               $user = $this->um->findUserByEmail($data->username);
               if (password_verify($data->password, $user->getPassword())) {
                    $token = generate_token(80);
                    $user->setToken($token)->setLastConnection();
                    $this->um->updateLogin($user);
                    $user = $this->um->find($user->getId(), Users::class);
                    dd($user);
                    $this->session->setAuth($user);
                    return $this->json([
                         'message' => [
                              'type' => 'success',
                              'content' => "Bonjour {$user->getFirstname()} ! ", 
                              ]
                         ], 200);
               }
          }
          return $this->json([
               'message' => [
                    'type' =>'danger',
                    'content' =>' 🛑 Nom d\'utilisateur ou mot de passe incorrect !', 
                    ]
               ], 401);
          
     }

}