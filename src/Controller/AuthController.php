<?php 

namespace App\Controller;

use App\Entity\Users;
use App\Helpers\Helpers;
use App\Model\UsersModel;
use App\Services\Request;
use App\Services\Session;
use App\Services\FormBuilder;
use App\Controller\AbstractController;
use App\Services\Mailer;

class AuthController extends AbstractController
{

     protected $um;
     protected $session;
     private $request;

     public function __construct()
     {
          $this->um = new UsersModel();
          $this->session = new Session();
          $this->request = new Request();
          $this->mailer = new Mailer();
     }

     public function forget()
     {
          $form = new FormBuilder();
          return $this->view('auth.forget', compact('form'));
     }
     
     public function sendPasswordToken()
     {
          $data = (object) json_decode($this->request->getContent());
          if ( !Helpers::checkCsrfToken($data->csrf_token) ) {
               return $this->json([
                    'message' => $this->setJsonMessage('danger', ' 🛑 Vous n\'êtes pas autorisé à soumettre ce formulaire!')                     
               ], 403);
          }
          if ($data->email === "") return $this->json([
               'message' => [
                    'type' =>'warning',
                    'content' =>' Vous devez renseignez votre adresse email', 
               ]
          ]);
          if ( $this->um->checkUserExists($data->email) ) {
               $user = $this->um->findUserByEmail($data->email);
               if ( $this->mailer->sendPasswordToken($user, 'Réinitialiser votre mot de passe') ) {
                    return $this->json([
                         'message' => [
                              'type' =>'success',
                              'content' =>' Un email vous a été envoyé 👍', 
                              ]
                         ]);
               }
               return $this->json([
                    'message' => [
                         'type' =>'warning',
                         'content' =>' Un erreur est survenue lors de l\'envoi d\'email 👎', 
                         ]
                    ]);
          } else {
               return $this->json([
                    'message' => [
                         'type' =>'info',
                         'content' =>' 🛑 Aucun compte avec cet adresse email existe !', 
                         ]
                    ], 401);
          }
     }

     public function reset(array $params = []) 
     {
          $token = $params['s'];
          $form = new FormBuilder();
          return $this->view('auth.reset-password', compact('form', 'token'));
     }

     public function changePassword(array $params = []) 
     {
          $data = (object) json_decode($this->request->getContent());
          if ( !Helpers::checkCsrfToken($data->csrf_token) ) {
               return $this->json([
                    'message' => $this->setJsonMessage('danger', ' 🛑 Vous n\'êtes pas autorisé à soumettre ce formulaire!')                     
               ], 403);
          }
          $user = $this->um->findUserByToken($data->token); 
          if ($user instanceof Users) {
               if ( pass_valid($data->password) ) {
     
                    if ($data->password !== $data->password_confirm) {
                         return $this->json([
                              'message' => $this->setJsonMessage('danger', ' Les deux mots de passes doivent être identiques ! '),
                              'violation' => 'password_confirm' 
                         ], 200);
                    }
     
                    $set = ['password' => encrypt_password($data->password), 'roles' => 'user', 'token' => generate_token(80) ];
                    $where = ['id' => $user->getId()];
                    if ( $this->um->update($set, $where) ) return $this->json([
                         'message' => $this->setJsonMessage('success', ' Votre mot de pass a bien été modifié 👍' ), 
                         'url' => generate_url('auth.login')
                    ], 200);
     
               } elseif ( !pass_valid($data->password) ) {
                    return $this->json([
                         'message' => $this->setJsonMessage('danger', 'Le mot de passe doit contenir au moins une minuscule, une majuscule et un chiffre ! '),
                         'violation' => 'password' 
                    ], 200);
               }
          } else {
               return $this->json([
                    'message' => $this->setJsonMessage('danger', ' 🤕 Ce jeton n\'est plus valide ! ')
               ], 400);
          }
          return $this->json([
               'message' => $this->setJsonMessage('danger', ' 👎 Nous n\'avouns rien reçu ! ')
          ], 400);
     }

     public function register() 
     {
          $form = new FormBuilder();
          $title = "Inscription ";
          return $this->view('auth.register', compact('form', 'title'));
     }

     public function store() 
     {
          $data = (array) json_decode($this->request->getContent());
          $errors = [];
          if ( !Helpers::checkCsrfToken($data['csrf_token']) ) {
               return $this->json([
                    'message' => $this->setJsonMessage('danger', ' 🛑 Vous n\'êtes pas autorisé à soumettre ce formulaire ! ')                     
               ], 403);
          }
          if ( !Helpers::checkFieldsSet($data) ) {
               $errors['formulaire'] = "Tous les champs du formulaire doivent être complétés ";
               return $this->json(['message' => $this->setJsonMessage('danger', $errors['formulaire'] )], 400);
          } else if (Helpers::checkFieldsSet($data) === true) {
               $data = (object) Helpers::sanitize($data);
               $user = [];
               $user['firstname'] = $data->firstname;
               $user['lastname'] = $data->lastname;
               $password_confirm = $data->password_confirm;
               if ( $password_confirm === $data->password ) {
                    if (pass_valid($data->password) === true) {
                         $user['password'] = encrypt_password($data->password);
                    } else {
                         $errors['password'] = "Le mot de passe doit contenir au moins une minuscule, une majuscule et un chiffre ! ";
                    }
               } else  {
                    $errors['password_confirm'] = "Les deux mots de passes ne sont pas identiques ! ";
               }
               if (email_valid($data->email) === true) {
                    if ( $this->um->findUserByEmail($data->email) instanceof Users ) {
                         $errors['email'] = "Cette adresse électronique existe déjà ! ";
                    } else {
                         $user['email'] = $data->email;
                    }                    
               } else {
                    $errors['email'] = "Cette adresse électronique n'est pas valide ! ";
               }
               if (count($errors) > 0 ) {
                    return $this->json(['errors' => $errors]);
               } else {
                    $user['token'] = generate_token(80);
                    $user['role'] = "user";
                    $user['confirm'] = '0';
                    $newUser = $this->um->insert($user, true);
                    $this->mailer->sendConfirmEmail($newUser);
                    $this->session->unset('csrf_token');
                    return $this->json(['message' => $this->setJsonMessage('success','Votre demande d\'inscription a bien été prise en compte. Un courrier électronique vous a été envoyé pour confirmer votre inscription. ') ]);
               }
          }
          
          return $this->json(['message' => $this->setJsonMessage('success','Vous n\'êtes pas autorisé à soumettre ce formulaire ! ') ]);
     }

     public function login()
     {
          if ($this->session->isLoggedUser()) $this->redirect(generate_url('blog'));
          $form = new FormBuilder();
          $title = "Connexion ";
          return $this->view("auth.login", compact('form', 'title'));
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
                    $this->session->setAuth($user);
                    return $this->json([
                         'message' => [
                              'type' => 'success',
                              'content' => "Bonjour {$user->getFirstname()} ! ", 
                         ], 
                         'url' => generate_url('blog')
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

     public function confirm(array $params = []) 
     {
          $confirm = $this->um->findUserByToken($params['s']);
          if ($confirm instanceof Users && $confirm->getToken() === $params['s']) {
               $this->um->confirmUser($confirm);
               // Envoyer une vue : Bienvenue sur Mon Super Blog
          }
          return $this->view('auth.confirm', compact('confirm'));  
     }

     public function logout()
     {
          $this->session->unset('auth');
          if ( array_key_exists( "Referer", apache_request_headers() ) ) return $this->redirect(apache_request_headers()["Referer"]);
          return $this->redirect(generate_url('blog'));
     }

}