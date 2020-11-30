<div class="hidden" id="form-profile">  
     <div class="mb-5" id="close">
          <i 
               class="icofont-close float-right" 
               title="Fermer le formulaire" 
               onclick="closeProfile()" id="close-form"
          ></i>
     </div>        
     <?php 
          echo $params->form->start( generate_url('auth.profile.edit', [
                    'id' => $params->user->getId(),
               ]), 
               'handleEditProfile(this, event)', 
               true,
               [
                    'id' => 'profile-form'
               ]);
     ?>
     <div class="col-12">
          <div class="row">
               <div class="col-3 no-padding">
                    <img 
                         title="Photo de profil"
                         class="img-profile" 
                         src="<?= $params->user->getImage()->path ?? "uploads/profile-default.jpg" ?>" 
                         alt="photo de profil" 
                         srcset="<?= $params->user->getImage()->path ?? "uploads/profile-default.jpg" ?>"
                         id="uploaded-img" 
                    >
                    <div class="img-overlay">
                         <label class="btn btn-profile btn-green" for="image">Modifier</label>
                         <input type="file" name="image" id="image" class="hidden" onchange="loadUploadedImage(this, event)">
                    </div>
                    <p class="hidden text-danger" id="error-upload"></p>                       
               </div>
               <div class="col-9 d-flex flex-column justify-content-center">
                    <?php 
                         echo $params->form->input('pseudo', [
                              'label' => null,
                              'attr' => [
                                   'placeholder' => 'Votre pseudo',
                                   'value' => 'fredsko77',
                              ]
                         ], true);
                         if ( $params->user->getRole() === 'admin' ) {
                              echo $params->form->input('position', [
                                   'label' => null,
                                   'attr' => [
                                        'placeholder' => 'Votre poste',
                                        'value' => 'Développeur d\'application Web PHP/Symfony'
                                   ]
                              ], true);
                         }
                    ?>
               </div>
          </div>
     </div>
     <div class="col-12 mt-4 mb-3 pt-2 pb-2 bg-light">
          <h5>Vos informations personnelles</h5>
          <div class="form-row">
               <div class="col-6">
                    <label for="firstname">Prénom</label>
                    <input 
                         type="text" 
                         name="firstname" 
                         id="firstname" 
                         class="form-control" 
                         disabled
                         value="<?= $params->user->getFirstname() ?>"
                    >
               </div>
               <div class="col-6">
                    <label for="lastname">Nom</label>
                    <input 
                         type="text" 
                         name="lastname" 
                         id="lastname" 
                         class="form-control" 
                         disabled
                         value="<?= $params->user->getlastname() ?>"
                    >
               </div>
          </div>
          <?php
               echo $params->form->input('e-mail', [
                    'type' => 'email',
                    'label' => 'Adresse e-mail',
                    'attr' => [
                         'disabled' => 'disabled',
                         'value' => $params->user->getEmail(),
                    ],
               ], true);
          ?>
     </div>          
     <div class="col-12">
          <?php 
               echo $params->form->textarea('chapo',[
                    'label' => 'À propos de moi', 
                    'attr' => [
                         'placeholder' => "Châpo de l&#39;article ici",
                         'rows' => 4,
                         'value' => $params->user->getChapo(),
                    ]
               ], true) 
          ?>
     </div>
     <div class="col-12 mt-2">
          <?php            
               echo $params->form->submit('Enregistrer', 'primary');
               echo $params->form->end(); 
          ?>
     </div>
</div>