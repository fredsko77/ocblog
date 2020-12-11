<h1 class="h3">Liste des commentaires (<o id="count-comment"><?= count($params->comments) ?></o>)</h1>

<!-- <i class="icofont-user-female" style="color: pink;"></i> -->

<div class="table-responsive-md">
     <table class="table table-striped table-hover table-bordered">
          <thead class="thead-light">
               <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Status </th>
                    <th scope="col">Date</th>
                    <th scope="col">Article</th>
                    <th scope="col">Actions</th>
               </tr>
          </thead>
          <tbody>
               <?php foreach ($params->comments as $key => $comment): ?>
                    <tr data-comment="<?= $comment->getId() ?>">
                         <th scope="row">
                              <?= $comment->getId() ?>                        
                         </th>
                         <td>
                              <?= $comment->getAuthor()->getId() ?>
                         </td>
                         <td>
                              <?= $comment->getComment() ?>
                         </td>
                         <td data-status="<?= $params->status[ $comment->getStatus() ] ?>">
                              <?= $params->status[ $comment->getStatus() ] ?>
                         </td>
                         <td>
                              <?= fr_date( $comment->getCreatedAt() ) ?>
                         </td>
                         <td>
                              <?= $comment->getPostId() ?>
                         </td>
                         <td>
                              <a 
                                   href="<?= esc_url( generate_url("admin.comments.edit", [
                                        'id' => $comment->getId()
                                   ]) ); ?>" 
                                   class="btn btn-green"
                                   title="Valider le commentaire"
                                   onclick="validateComment(this, event)"
                                   data-id="<?= $comment->getId() ?>"
                              >
                                   Valider
                              </a>
                              <a 
                                   href="<?= esc_url( generate_url("admin.comments.delete", [
                                        'id' => $comment->getId()
                                   ]) ); ?>" 
                                   title="Supprimer le commentaire"
                                   onclick="deleteComment(this, event)"
                                   data-id="<?= $comment->getId() ?>"
                              >
                                   <i class="icofont-ui-delete"></i>
                              </a>
                         </td>
                    </tr>
               <?php endforeach; ?>
          </tbody>
     </table>
     
     <p class="font-weight-bold <?php if ( count($params->comments) > 0 ): ?>hidden<?php endif; ?>" id="comment-none"> Aucun commentaire à valider. </p>
</div>