<?php foreach($params->posts as $k => $post): ?>
     <div class="post-item">
          <a 
               href="<?php esc_url( generate_url('blog.show', [
                    'id' => $post->getId(), 
                    'slug' => $post->getSlug(),
               ]) ); ?>" 
               class="post-item-thumbnail"
          >
               <img 
                    src="<?= $post->getImage()->path ?? "uploads/post-default.png" ?>" 
                    alt="Image de l'article"  
                    class="post-item-thumbnail"
               >
          </a>
          <div class="post-item-body">
               <?php if ( $post->getCategoryId() !== NULL ) : ?>
                    <p class="post-item-category">
                         <a 
                              href="<?php esc_url( generate_url('blog.category', [
                                   'id' => $post->getCategoryId()->getId(), 
                                   'slug' => $post->getCategoryId()->getSlug(),
                              ]) ); ?>"
                         >     
                              <?= $post->getCategoryId() !== NULL ? $post->getCategoryId()->getCategory() : 'Catégorie' ?> <i class="icofont-rounded-right"></i> 
                         </a>
                    </p>
               <?php endif; ?>
               <a 
                    href="<?php esc_url( generate_url('blog.show', [
                         'id' => $post->getId(), 
                         'slug' => $post->getSlug(),
                    ]) ); ?>" 
                    class="post-item-title">
                    Titre de l'article
               </a>
               <div class="post-item-excerpt">
                    <?= $post->getChapo(); ?>
               </div>
               <div class="post-item-footer">
                    <?= diff( $post->getUpdatedAt() ) ?>
                    &nbsp;
                    <i class="icofont-minus"></i> 
                    &nbsp;
                    <?= count($post->getComments()) ?>
                    <i class="icofont-speech-comments"></i>   
               </div>
          </div>
     </div>
<?php endforeach; ?>