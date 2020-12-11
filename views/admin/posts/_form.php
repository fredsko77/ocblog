<?php _e( $params->form->start( 
     esc_url( !property_exists($params->form->getData(), "id") ? generate_url('admin.posts.store') : generate_url('admin.posts.update', [
          'id' => $params->form->getData()->id]
     )),
     'handleSubmitPost(this,event)', true ) ); 
?>

<div class="col-12 row" id="form-post">
     <div class="col-12"> 
          <a href="<?= esc_url( generate_url('admin.posts') ); ?>" title="Revenir en arrière" class="text-secondary mb-3 mt-3 text-underline">Revenir aux articles</a>
          <h1 class="h3 mt-2 mb-4">
               <?= !property_exists($params->form->getData(), "id") ? 
               'Ajouter un nouvel article'
               : "Modifier l'article #{$params->form->getData()->id}"
               ?>
          </h1>
          <div class="row mb-4">
               <div class="col-xs-12 col-lg-9">
                    <?php 
                         _e( $params->form->input('title', [
                              'type' => 'text', 
                              'label' => null, 
                              'attr' => [
                                   'placeholder' => "Titre de l'article"
                         ]], true) );
                         _e( $params->form->textarea('content', [
                              'label' => null,
                              'attr' => [
                                   'rows' => 20
                              ],
                         ], true) );
                    ?>
                    <div class="col-12 drop-down">
                         <div class="drop-btn" onclick="dropdown(this)"> Châpo <i class="icofont-caret-down float-right" style="transform: rotate(0deg);"></i> </div>
                         <div class="drop position-relative hidden">
                              <?php 
                                   _e( $params->form->textarea('chapo',[
                                        'label' => null, 
                                        'attr' => [
                                             'placeholder' => "Châpo de l&#39;article ici",
                                             'rows' => 4
                                        ]
                                   ], true) ); 
                              ?>
                         </div>
                    </div>
               </div>
               <div class="col-xs-12 col-lg-3">
                    <div class="col-12 drop-down">
                         <div class="drop-btn"> Informations </div>
                         <div class="drop position-relative">
                              <?php _e( $params->form->select('status', $params->status, "Status", false, true) ); ?>
                              <?php _e( $params->form->select('writer', $params->writers, "Auteur", true, true) ); ?>
                              <?php if ( property_exists($params->form->getData(), "id") ): ?>
                                   <p> 
                                        <a 
                                             href="<?= esc_url( generate_url('blog.show', [
                                                  'id' => $params->form->getData()->id,
                                                  'slug' => $params->form->getData()->slug,
                                             ]) ); ?>"
                                             style="font-size: .9rem;"
                                             target="_blank"
                                        >
                                             <i class="icofont-eye"></i> Visualiser l'article en direct
                                        </a>
                                   </p>
                              <?php endif; ?>
                         </div>
                    </div> 
                    <div class="col-12 drop-down">
                         <div class="drop-btn" onclick="dropdown(this)"> Lien personnalisé <i class="icofont-caret-down float-right" style="transform: rotate(0deg);"></i> </div>
                         <div class="drop position-relative hidden">
                              <?php _e( $params->form->input('slug', ['label' => null], true) ); ?>
                         </div>
                    </div>
                    <div class="col-12 drop-down">
                         <div class="drop-btn" onclick="dropdown(this)"> Catégorie <i class="icofont-caret-down float-right" style="transform: rotate(0deg);"></i> </div>
                         <div class="drop position-relative hidden">
                              <?php _e( $params->form->select('category_id', $params->categories, null, false, true) ); ?>
                         </div>
                    </div> 
                    <div class="col-12 drop-down">
                        <?php if (property_exists($params, 'post')): ?>
                            <div class="drop-btn" onclick="dropdown(this)"> Image 
                                <i class="icofont-caret-down float-right" style="transform: rotate(<?= $params->post->getImage()->path === NULL ? '0' : '180' ?>deg);"></i> 
                            </div>
                            <div class="drop position-relative <?= $params->post->getImage() !== NULL ? '' : 'hidden' ?>">
                                <img 
                                    src="<?= $params->post->getImage()->path ?? '' ?>" 
                                    alt="Image de l'article" 
                                    srcset="<?= $params->post->getImage()->path ?? '' ?>" 
                                    title="Affiche de l'article"
                                    class="<?= $params->post->getImage()->path !== NULL ? '' : 'hidden' ?>" 
                                    id="uploaded-img"
                                >
                                <?php _e( $params->form->file('image', "Choisir un fichier", ['onchange' => 'loadUploadedImage(this, event)']) ); ?>
                                <p class="hidden text-danger" id="error-upload"></p>
                            </div>
                        <?php else : ?>
                                <div class="drop-btn" onclick="dropdown(this)"> Image 
                                    <i class="icofont-caret-down float-right" style="transform: rotate(0deg);"></i> 
                                </div>
                                <div class="drop position-relative hidden">
                                    <img 
                                        src="" 
                                        alt="Image de l'article" 
                                        srcset="" 
                                        title="Affiche de l'article"
                                        class="hidden" 
                                        id="uploaded-img"
                                    >
                                    <?php _e( $params->form->file('image', "Choisir un fichier", ['onchange' => 'loadUploadedImage(this, event)']) ); ?>
                                    <p class="hidden text-danger" id="error-upload"></p>
                                </div>
                        <?php endif; ?>
                    </div> 
                    <div class="col-12 d-flex justify-content-end mb-2" style="padding-right: 0 !important;">
                         <?php _e( $params->form->submit("Enregistrer", "outline-primary") ); ?>  
                    </div>                     

               </div>
          </div>
          
     </div>
</div>

<?php 

_e( $params->form->csrf() );

_e( $params->form->end() );