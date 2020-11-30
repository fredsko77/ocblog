<?php 

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Model\ContactsModel;
use App\Entity\Contacts;
use App\Services\FormBuilder;
use App\Services\Request;
use App\Services\Session;

class AdminContactsController extends AbstractController
{
     protected $request;

     public function __construct()
     {
          $this->contact = new ContactsModel;
          $this->session = new Session;
          $this->request = new Request;
     }

     public function index()
     {
          $contacts = $this->contact->findBy("status.pending", Contacts::class);
          $form = new FormBuilder();
          $status = Contacts::STATUS;
          return $this->adminView('contacts.index', compact('contacts', 'form', 'status') );
     }

     public function read(array $params = [])
     {
          $data = (array) json_decode($this->request->getContent());         
          if ( $this->request->checkAuthorization() ) {
               $contact = $this->contact->update($data, [ 'id' => (int) $params['id'] ], true);
               if ($contact instanceof Contacts) {
                    return $this->json([
                         'message' => $this->setJsonMessage('success', 'Le message a été marqué comme lu avec succès 🚀'),
                    ]); 
               } else if (!$contact instanceof Contacts) {
                    return $this->json(['message' => $this->setJsonMessage('warning', 'Le message que vous essayé de marquer n\'exite pas')], 500); 
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

}