<?php 

namespace App\Controller\Admin;

use App\Entity\Comments;
use App\Helpers\Helpers;
use App\Model\PostsModel;
use App\Model\UsersModel;
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
          $this->pm = new PostsModel;
          $this->session = new Session;
          $this->request = new Request;
          $this->um = new UsersModel;
          $this->cm = new CommentsModel;
     }

     public function index()
     {
          $form = new FormBuilder();
          $comments = $this->cm->pending();
          $status = Comments::STATUS;
          return $this->adminView('comments.index', compact('form', 'comments', 'status'));
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

}