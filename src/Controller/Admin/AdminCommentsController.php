<?php 

namespace App\Controller\Admin;

use App\Entity\Comments;
use App\Services\Request;
use App\Services\Session;
use App\Model\CommentsModel;
use App\Services\FormBuilder;
use App\Controller\AbstractController;

class AdminCommentsController extends AbstractController
{

     protected $pm;
     protected $session;
     protected $request;

     public function __construct()
     {
          $this->session = new Session;
          $this->request = new Request;
          $this->cm = new CommentsModel;
     }

     public function index()
     {
          $comments = $this->cm->pending();
          $status = Comments::STATUS;
          $title = 'Gestion des commentaires';
          return $this->adminView('comments.index', compact('comments', 'status', 'title'));
     }

     public function edit(array $params = [])
     {
          $comment = $this->cm->find((int) $params['id'], Comments::class);
          if ( $this->request->checkAuthorization() ) {
               if ($comment instanceof Comments) {
                    $comment = $this->cm->update(['status' => 'validated'], ['id' => $comment->getId()], true);
                    return $this->json([
                         'message' => $this->setJsonMessage('success', 'Le commentaire a été validé avec succès 🚀'),
                         'status' => Comments::STATUS,
                    ]); 
               } else if (!$comment instanceof Comments) {
                    return $this->json([
                         'message' => $this->setJsonMessage('warning', 'Le commentaire que vous essayé de valider n\'exite pas')
                    ], 500); 
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

     public function delete(array $params = [])
     {
          $comment = $this->cm->find((int) $params['id'], Comments::class);
          if ( $this->request->checkAuthorization() ) {
               if ($comment instanceof Comments) {
                    $this->cm->delete( $comment->getId() );
                    return $this->json(['message' => $this->setJsonMessage('success', 'Le commentaire a été supprimé avec succès 🚀')]); 
               } else if (!$comment instanceof Comments) {
                    return $this->json(['message' => $this->setJsonMessage('warning', 'Le commentaire que vous essayé de supprimer n\'exite pas')], 500); 
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