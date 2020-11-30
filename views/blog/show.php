<main id="main">
     <section class="container" id="blog-show">
          <div class="post-container">
               <a href="<?= generate_url('blog') ?>" class="btn btn-primary">Retourner aux articles</a>
               <h1 class="post-title text-center">
                    <?= $params->post->getTitle(); ?> 
               </h1>
               <p class="post-chapo">
                    <?= $params->post->getChapo(); ?> 
               </p>
               <p class="post-date">
                    <i class="icofont-clock-time"></i> <?= fr_date( $params->post->getUpdatedAt() ) ?> 
               </p>
               <img 
                    src="<?= $params->post->getImage()->path ?? "uploads/post-default.png" ?>" 
                    alt="Image de l'article" 
                    srcset="<?= $params->post->getImage()->path ?? "uploads/post-default.png" ?>" 
                    title="Affiche de l'article"
                    class="post-image"
               >
               <div class="post-content mb-3">
                    <?= $params->post->getContent() ?>
               </div>
               <div class="mb-5 mt-4">
                    <div class="post-writer col-12 row" style="margin-left: 0;">
                         <div class="col-3 post-writer-writer no-padding-xs">
                              <img 
                                   src="<?= $params->post->getWriter()->getImage()->path ?? "uploads/post-default.png" ?>" 
                                   alt="Image de l'article" 
                                   srcset="<?= $params->post->getWriter()->getImage()->path ?? "uploads/post-default.png" ?>" 
                                   title="Affiche de l'article"
                                   class="post-writer-image"
                              > 
                              <div class="post-writer-socials"></div>
                         </div>
                         <div class="col-9 post-writer-second">
                              <p> 
                                   <strong> 
                                        <?= $params->post->getWriter()->getFirstname() . " " . $params->post->getWriter()->getLastname() ?> 
                                   </strong>
                              </p>
                              <p>
                                   Lorem ipsum dolor sit amet.
                                   <?= $params->post->getWriter()->getChapo(); ?>
                              </p>
                         </div>
                         <p class="d-flex flex-row-reverse">
                              <button class="post-writer-posts">Voir tous ses articles<i class="icofont-rounded-right"></i> </button>
                         </p>
                    </div>
               </div>
               <div class="post-comment-form">
                    <?php 
                         if ( property_exists( $params , 'user' ) ) {                              
                              echo $params->form->start(generate_url('blog.posts.comment.add', [
                                   'id' => $params->post->getId()]
                              ), "handleComment(this, event)" );
                              echo $params->form->textarea('comment',[
                                        'label' => "Commentaire", 
                                        'attr' => [
                                             'placeholder' => "Commentaire ... ",
                                             'rows' => 4,
                                             'required' => 'required',
                                        ]
                                   ], true);
                              echo $params->form->csrf();
                              echo $params->form->submit();
                         }
                    ?>
               </div>
               <ul class="tabs">
                    <li class="nav-item">
                         <a 
                              href="#" 
                              class="nav-item active" 
                              data-target="comments" 
                              onclick="switchTabs(this,event)"
                              style="padding: 0 5px;"
                              >
                              <?= count($params->comments) ?>&nbsp;commentaires
                         </a>
                    </li>
                    <li class="nav-item">
                         <a 
                              href="#" 
                              class="nav-item" 
                              data-target="similar" 
                              onclick="switchTabs(this,event)"
                              style="padding: 0 5px;"
                         >
                              Articles similaires
                         </a>
                    </li>
               </ul>               
               <?php require get_template('posts/comments'); ?>
               <div data-tabs="similar" class="hidden" id="blog-list">
                    <?php require_once get_template("posts/repeater") ?>
               </div>
          </div>
     </section>
</main>