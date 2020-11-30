<div class="post-comments" data-tabs="comments">
     <?php foreach($params->comments as $k => $comment): ?>
          <div class="comment row">
               <div class="col-md-2 col-3">     
                    <img 
                         src="<?= $comment->getAuthor()->getImage()->path ?? "uploads/post-default.png" ?>" 
                         alt="Image de l'article" 
                         srcset="<?= $comment->getAuthor()->getImage()->path ?? "uploads/post-default.png" ?>" 
                         title="Affiche de l'article"
                         class="post-writer-image"
                         style="border-radius:0;"
                    >              
               </div>
               <div class="col-md-10 col-9">
                    <h6><?= $comment->getAuthor()->getPseudo() ?>&nbsp;-&nbsp;<small><?= diff($comment->getCreatedAt()) ?></small></h6>
                    <p><?= $comment->getComment(); ?></p>
                    
               </div>
          </div>
     <?php endforeach; ?>
</div>