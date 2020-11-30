<?php 

namespace App\Controller;

use App\Helpers\Helpers;
use App\Services\Mailer;
use App\Services\Request;
use App\Services\Session;
use App\Services\FormBuilder;
use App\Controller\AbstractController;
use App\Model\ContactsModel;

class HomeController extends AbstractController
{
     
     protected $request;
     protected $session;

     public function __construct()
     {
          $this->request = new Request;
          $this->session = new Session;
          $this->contact = new ContactsModel;
     }

     public function index()
     {
          $title = "Page d'acceuil";
          return $this->view("home/home", compact('title'));
     }

     public function about()
     {
          $title = "A propos";
          return $this->view("home/about", compact('title'));
     }
     
     public function contact()
     {
          $title = "Nous contacter";
          $form = new FormBuilder();
          return $this->view("home/contact", compact('title', 'form'));          
     }

     public function postContact() 
     {
          $data = json_decode($this->request->getContent());
          $mail = new Mailer();
          if ( !Helpers::checkCsrfToken($data->csrf_token) ) {
               return $this->json([
                    'message' => [
                         'type' =>'danger',
                         'content' =>' 🛑 Vous n\'êtes pas autorisé à soumettre ce formulaire!', 
                         ]
                    ], 401);
          }
          if (Helpers::checkFieldsSet((array) $data)) {
               $data = Helpers::sanitize((array) $data);
               unset($data['csrf_token']);
               $data['status'] = 'pending';
               if ($mail->sendConfirmContact((object) $data)) {
                    $contact = $this->contact->insert($data, true);
                    return $this->json([
                         'message' => [
                              'type' =>'success',
                              'content' =>'Nous avons bien reçu votre message 👍.', 
                         ]
                    ], 200);
               }
          }
          
          return $this->json([
               'message' => [
                    'type' =>'warning',
                    'content' =>'🚒 Oops, une erreur est survenue lors du traitement de votre requête !', 
                    ]
               ], 500); 
     }

     public function resume()
     {
          $file = 'assets/CV_AGATHE_Frederick.pdf';
          $filename = 'moncv'; /* Note: Always use .pdf at the end. */

          header('Content-type: application/pdf');
          header('Content-Disposition: inline; filename="' . $filename . '"');
          header('Content-Transfer-Encoding: binary');
          header('Content-Length: ' . filesize($file));
          header('Accept-Ranges: bytes');
          
          @readfile($file);
     }

}