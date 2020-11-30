
<?php echo $params->form->start(generate_url('admin.posts.store'), 'handleCreatePost(this,event)', true ) ?>

<div class="col-12 row" id="form-post">
     <div class="col-12"> 
          <a href="<?= generate_url('admin.posts') ?>" title="Revenir en arrière" class="text-secondary mb-3 mt-3 text-underline">Revenir aux articles</a>
          <h1 class="h3 mt-2 mb-4">Ajouter un nouvel article</h1>
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
                                   'rows' => 20
                              ],
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

/** <p>
* Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor quisquam doloremque incidunt perferendis aut! Totam alias sunt ullam dolor repellendus animi nostrum itaque facilis molestiae. Doloremque vero quam provident nihil veritatis, similique quod magni dolore deserunt optio, laboriosam perferendis * voluptatibus porro, dolorem minima dolor ducimus ad. Omnis qui eos blanditiis.
*</p>  
*/