<?php echo $params->form->start(generate_url('admin.posts.update', ['id' => $params->post->getId()]), 'handleUpdatePost(this,event)', true ) ?>

<div class="col-12 row" id="form-post">
     <div class="col-12"> 
          <a href="<?= generate_url('admin.posts') ?>" title="Revenir en arrière" class="text-secondary mb-3 mt-3 text-underline">Revenir aux articles</a>
          <h1 class="h3 mt-2 mb-4">Modifier l'article <strong class="text-success">#<?= $params->post->getId() ?></strong></h1>
          <div class="row mb-4">
               <div class="col-xs-12 col-lg-9">
                    <?php 
                         echo $params->form->input('title', [
                              'type' => 'text', 
                              'label' => null, 
                              'attr' => [
                                   'placeholder' => "Titre de l'article"
                              ]], true);
                              echo $params->form->textarea('content', [
                                   'label' => null, 
                                   'attr' => [
                                        'placeholder' => "Contenu de l&#39;article ici",
                                        'rows' => 25
                                   ]
                              ], true);
                    ?>
                    <div class="col-12 drop-down">
                         <div class="drop-btn" onclick="dropdown(this)"> Châpo <i class="icofont-caret-down float-right" style="transform: rotate(0deg);"></i> </div>
                         <div class="drop position-relative hidden">
                              <?php 
                                   echo $params->form->textarea('chapo',[
                                        'label' => null, 
                                        'attr' => [
                                             'placeholder' => "Châpo de l&#39;article ici",
                                             'rows' => 4
                                        ]
                                   ], true) 
                              ?>
                         </div>
                    </div>
               </div>
               <div class="col-xs-12 col-lg-3">
                    <div class="col-12 drop-down">
                         <div class="drop-btn"> Informations </div>
                         <div class="drop position-relative">
                              <?php echo $params->form->select('status', $params->status, "Status", false, true) ?>
                              <?php echo $params->form->select('writer', $params->writers, "Auteur", true, true) ?>
                              <a target="_blank" href="<?= generate_url('blog.show', ['slug' => $params->post->getSlug(), 'id' => $params->post->getId()]) ?>">Voir l'article sur le site</a>
                         </div>
                    </div> 
                    <div class="col-12 drop-down">
                         <div class="drop-btn" onclick="dropdown(this)"> Lien personnalisé <i class="icofont-caret-down float-right" style="transform: rotate(0deg);"></i> </div>
                         <div class="drop position-relative hidden">
                              <?php echo $params->form->input('slug', ['label' => null], true) ?>
                         </div>
                    </div>
                    <div class="col-12 drop-down">
                         <div class="drop-btn" onclick="dropdown(this)"> Catégorie <i class="icofont-caret-down float-right" style="transform: rotate(0deg);"></i> </div>
                         <div class="drop position-relative hidden">
                              <?php echo $params->form->select('category_id', $params->categories, null, false, true) ?>
                         </div>
                    </div> 
                    <div class="col-12 drop-down">
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
                              <?php echo $params->form->file('image', "Choisir un fichier", ['onchange' => 'loadUploadedImage(this, event)']); ?>
                              <p class="hidden text-danger" id="error-upload"></p>
                         </div>
                    </div> 
                    <div class="col-12 d-flex justify-content-end mb-2" style="padding-right: 0 !important;">
                         <?php echo $params->form->submit("Enregistrer", "outline-primary"); ?>  
                    </div>                     

               </div>
          </div>
          
     </div>
</div>

<?php 

echo $params->form->csrf();



echo $params->form->end();