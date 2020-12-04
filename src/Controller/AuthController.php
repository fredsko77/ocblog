<?php 

namespace App\Controller;

use DateTime;
use App\Entity\Users;
use App\Entity\Uploads;
use App\Helpers\Helpers;
use App\Services\Mailer;
use App\Model\PostsModel;
use App\Model\UsersModel;
use App\Services\Request;
use App\Services\Session;
use App\Model\UploadsModel;
use App\Services\FormBuilder;
use App\Controller\AbstractController;
use App\Services\Validator;

class AuthController extends AbstractController
{

     protected $um;
     protected $session;
     protected $request;

     public function __construct()
     {
          $this->um = new UsersModel();
          $this->pm = new PostsModel();
          $this->upm = new UploadsModel();
          $this->session = new Session();
          $this->request = new Request();
          $this->mailer = new Mailer();
          $this->config = require "../config/uploads.php";
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
                         'message' => $this->setJsonMessage('warning', ' Vous devez renseignez votre adresse email'),
                    ]);
          if ( $this->um->checkUserExists($data->email) ) {
               $user = $this->um->findUserByEmail($data->email);
               if ( $this->mailer->sendPasswordToken($user, 'Réinitialiser votre mot de passe') ) {
                    return $this->json([
                         'message' => $this->setJsonMessage('success', ' Un email vous a été envoyé 👍'), 
                    ]);
               }
               return $this->json([
                    'message' => $this->setJsonMessage('warning', ' Un erreur est survenue lors de l\'envoi d\'email 👎'),
                    ]);
          } else {
               return $this->json([
                    'message' => $this->setJsonMessage('info', '🛑 Aucun compte avec cet adresse email existe !'), 
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
     
                    $set = ['password' => encrypt_password($data->password), 'token' => generate_token(80) ];
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
               $user['slug'] = Helpers::generateSlug($data->firstname, $data->lastname);
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
               if ((new Validator)->email($data->email) === true) {
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
                    return $this->json([ 'message' => $this->setJsonMessage('success','Votre demande d\'inscription a bien été prise en compte. Un courrier électronique vous a été envoyé pour confirmer votre inscription. ') ]);
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
               $url = $user->getLastConnection() === null ? generate_url('auth.profile') : null;
               if (password_verify($data->password, $user->getPassword())) {
                    $token = generate_token(80);
                    $user->setToken($token)->setLastConnection((new DateTime)->format('Y-m-d H:i:s'));
                    $this->um->updateLogin($user);
                    $user = $this->um->find($user->getId(), Users::class);
                    $this->session->setAuth($user);
                    return $this->json([
                         'message' => [
                              'type' => 'success',
                              'content' => "Bonjour {$user->getFirstname()} ! ", 
                         ], 
                         'user' => $user,
                         'url' => $url,
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

     public function profile()
     {
          if ( !$this->session->isLoggedUser() ) return $this->redirect( generate_url('auth.login') );
          $title = 'Mon profil';
          $form = new FormBuilder();
          $posts = $this->pm->authPosts((int) $this->session->getLoggedUser()->getId());
          return $this->view('auth.profile', compact('title', 'form', 'posts') );
     }

     public function update(array $params = [])
     {
          return $this->json(['params' => $params]);
     }

     public function delete(array $params = [])
     {
          $user = $this->um->find((int) $params['id'], Users::class);
          if ( $this->request->checkAuthorization() ) {
               if ($user instanceof Users) {
                    if( $this->um->delete( $user->getId() ) ) {
                         return $this->json([
                              'message' => $this->setJsonMessage('success', 'Votre compte utilisateur a été supprimé avec succès 🚀'), 
                              'url' => generate_url('blog'),
                              
                         ]); 
                    };
                    $this->session->unset('auth');
                    return $this->json([
                         'message' => $this->setJsonMessage('danger', '🛑 Une erreur est survenu lors de la suppression de ce compte !'), 
                    ], 400);
               }
          } else {
               return $this->json([
                    'message' => $this->setJsonMessage('danger', '🛑 Vous n\'êtes pas autorisé à effectuer cette action !')
               ], 401);
          }
          return $this->json([
               'message' => $this->setJsonMessage('danger', 'Une erreur est survenu lors du traitement de votre requête 🤕')
          ], 500);
     }     

     public function updateProfile(array $params = [])
     {
          $data = count($_POST) > 0 ? Helpers::sanitize($_POST) : (array) json_decode($this->request->getContent());
          $user = $this->um->find((int) $params['id'], Users::class);
          if ( $this->request->checkAuthorization() ) {
               if ( array_key_exists('e-mail', $data) ) {
                    $data['email'] = $data['e-mail'];
                    unset($data['e-mail']);
               }
               if ($user instanceof Users) {
                    $upload = $this->upm->findBy( "users_id.{$user->getId()}", Uploads::class);
                    $now = (new DateTime())->format('Y-m-d H:m:s'); 
                    $file = array_key_exists('image', $_FILES) ? (object) $_FILES['image'] : null ;                 
                    unset($data['image']);
                    if ( count($_FILES) > 0 ) {
                         if ( $file && $file->error === 0 && $file->name !== "" ) {
                              if ( ! Helpers::checkExtension($file->name, $this->config->file_accepted['image'])) return $this->json([
                                   'message' => $this->setJsonMessage('danger', 'Ce type de fichier n\'est pas accepté ! ')
                              ], 400);
                              // Vérifier la taille du fichier
                              if( $file->size > ( (int) $this->config->max_size_accepted * pow(1024, 2)) ) return $this->json([
                                   'message' => $this->setJsonMessage('danger', 'Ce fichier est trop volumineux ! ') 
                              ], 400);
                              // Vérifier que le répertoire existe
                              if ( ! is_dir($this->config->directory."/user") ) mkdir($this->config->directory."/user", 0777, true);  
                              // Générer un nouveau nom au fichier    
                              $filename = generate_filename() . "." . explode('.', $file->name)[1];
                              // Déplacer le fichier téléchargé dans le répertoire
                              if ( ! move_uploaded_file($file->tmp_name, $this->config->directory . "/user/" . $filename) ) {
                                   return $this->json(['message' => $this->setJsonMessage('danger', 'L\'image n\'a pas pu être téléchargée . ')], 500); 
                              }
                              // Initialiser les données à persister
                              $uploaded_file = [
                                   'type' => 'profile',
                                   'path' => str_replace('../public/', '',  $this->config->directory . "/user/" . $filename),
                                   'created_at' => $now,
                                   'users_id' => (int) $user->getId()
                              ]; 
                              if ($upload instanceof Uploads) unlink("../public/{$upload->getPath()}");
                              $count = $upload instanceof Uploads ? 1 : 0;
                              $upload = !$count ? $this->upm->insert($uploaded_file, true) : $this->upm->update_image($uploaded_file, true);
                              $data['image'] = $upload->getId();
                              $image = $upload->getPath() ?? null;
                              unset($_FILES['image']);
                         }
                    }
                    if( $this->um->update($data, ['id' => (int) $params['id'] ]) ) {
                         return $this->json([
                              'message' => $this->setJsonMessage('success', 'Votre compte utilisateur a été supprimé avec succès 🚀'),
                              'image' => $image ?? '',                              
                         ]); 
                    };
                    $this->session->unset('auth');
                    return $this->json([
                         'message' => $this->setJsonMessage('danger', '🛑 Une erreur est survenu lors de la suppression de ce compte !'), 
                    ], 400);
               }
          } else {
               return $this->json([
                    'message' => $this->setJsonMessage('danger', '🛑 Vous n\'êtes pas autorisé à effectuer cette action !')
               ], 401);
          }
          return $this->json([
               'message' => $this->setJsonMessage('danger', 'Une erreur est survenu lors du traitement de votre requête 🤕')
          ], 500);
     }

     public function updatePassword(array $params = []) {
          $data = (object) json_decode($this->request->getContent());
          $user = $this->um->find((int) $params['id'], Users::class);
          if ( $this->request->checkAuthorization() ) {
               if ( $user instanceof Users ) {
                    if ($data->password === $data->password_confirm ) {
                         if ( (new Validator)->password($data->password) ) {
                              $this->um->update(['password' =>  encrypt_password($data->password)], ['id' => $user->getId()]);
                              return $this->json([
                                   'message' => $this->setJsonMessage('success', 'Votre mot de passe a bien été modifié 👍'),
                              ]);
                         }
                         return $this->json([
                              'message' => $this->setJsonMessage('info', 'Le mot de passe doit contenir au moins une minuscule, une majuscule et un chiffre ! '),
                         ]);
                    }
                    return $this->json([
                         'message' => $this->setJsonMessage('warning', 'Les deux mots de passe doivent être identiques ! '),
                    ]);
               }
               return $this->json([
                    'message' => $this->setJsonMessage('danger', 'Cet utilisateur n\'existe pas ! '),
               ]);
          } else {
               return $this->json([
                    'message' => $this->setJsonMessage('danger', '🛑 Vous n\'êtes pas autorisé à effectuer cette action !')
               ], 401);
          }
          return $this->json([
               'message' => $this->setJsonMessage('danger', 'Une erreur est survenu lors du traitement de votre requête 🤕')
          ], 500);
     }

     public function resetEmail(array $params = []) {
          $data = (object) json_decode($this->request->getContent());
          $user = $this->um->find((int) $params['id'], Users::class);
          if ( $this->request->checkAuthorization() ) {
               if ( $user instanceof Users ) {
                    // A modifier
                    if ( (new Validator)->email($data->email) ) {
                         if ( $this->um->checkUserExists($data->email) ) return $this->json([
                              'message' => $this->setJsonMessage('info', 'Cette adresse e-mail est déja utilisée ! ')
                         ]);
                         $this->mailer->sendResetEmail( $data->email,(int) $params['id'] );
                         return $this->json([
                              'message' => $this->setJsonMessage('success', 'Un mail vous a été envoyé pour confirmer votre adresse e-mail .'),
                         ]);
                    }
                    return $this->json([
                         'message' => $this->setJsonMessage('info', 'Le mot de passe doit contenir au moins une minuscule, une majuscule et un chiffre ! '),
                    ]);   
                    // Fin à modifier                 
               }
               return $this->json([
                    'message' => $this->setJsonMessage('danger', 'Cet utilisateur n\'existe pas ! '),
               ]);
          } else {
               return $this->json([
                    'message' => $this->setJsonMessage('danger', '🛑 Vous n\'êtes pas autorisé à effectuer cette action !')
               ], 401);
          }
          return $this->json([
               'message' => $this->setJsonMessage('danger', 'Une erreur est survenu lors du traitement de votre requête 🤕')
          ], 500);
     }

     public function resetEmailConfirm(array $params = [])
     {
          $email = $params['s'];
          $id = (int) $params['id'];
          $user = $this->um->find($id, Users::class);
          $message = "";
          if ($user instanceof Users) {
               if ( $this->um->checkUserExists($email) ) { 
                    $message = "Cette adresse e-mail est déja utilisée ! 🤕";
               } else {
                    $user = $this->um->update(['email' => $email], ['id' => $id], true);
                    $message = "Votre adresse e-mail a bien été modifié !";
               }
          } else {
               $message = 'Une erreur est survenue lors de la mise à jour de votre adresse email';
          }
          return $this->view('auth.confirm-email', compact('user', 'message'));
     }

}