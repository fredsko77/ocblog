<div class="hidden" id="form-profile">  
     <div class="mb-5" id="close">
          <i 
               class="icofont-close float-right" 
               title="Fermer le formulaire" 
               onclick="closeProfileform()" 
               id="close-form"
          ></i>
     </div>        
     <?php 
          _e( $params->form->start( esc_url( generate_url('auth.profile.edit', [
               'id' => $params->auth->getId(),
          ]) ), 
          'handleEditProfile(this, event)', 
          true,
          [
               'id' => 'profile-form'
          ]) );
     ?>
     <div class="col-12">
          <div class="row">
               <div class="col-3 no-padding">
                    <img 
                         title="Photo de profil"
                         class="img-profile" 
                         src="<?= $params->auth->getImage()->path ?? "uploads/profile-default.jpg" ?>" 
                         alt="photo de profil" 
                         srcset="<?= $params->auth->getImage()->path ?? "uploads/profile-default.jpg" ?>"
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
                         _e( $params->form->input('pseudo', [
                              'label' => null,
                              'attr' => [
                                   'placeholder' => 'Votre pseudo',
                                   'value' => 'fredsko77',
                              ]
                         ], true) );
                         if ( $params->auth->getRole() === 'admin' ) {
                              _e( $params->form->input('position', [
                                   'label' => null,
                                   'attr' => [
                                        'placeholder' => 'Votre poste',
                                        'value' => 'Développeur d\'application Web PHP/Symfony'
                                   ]
                              ], true) );
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
                         value="<?= $params->auth->getFirstname() ?>"
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
                         value="<?= $params->auth->getlastname() ?>"
                    >
               </div>
          </div>
          <?php
               _e( $params->form->input('e-mail', [
                    'type' => 'email',
                    'label' => 'Adresse e-mail',
                    'attr' => [
                         'disabled' => 'disabled',
                         'value' => $params->auth->getEmail(),
                    ],
               ], true) );
          ?>
     </div>          
     <div class="col-12">
          <?php 
               _e( $params->form->textarea('chapo',[
                    'label' => 'À propos de moi', 
                    'attr' => [
                         'placeholder' => "Châpo de l&#39;article ici",
                         'rows' => 4,
                         'value' => $params->auth->getChapo(),
                    ]
               ], true) ); 
          ?>
     </div>
     <div class="col-12 mt-2">
          <?php            
               _e( $params->form->submit('Enregistrer', 'primary') );
               _e( $params->form->end() ); 
          ?>
     </div>
</div>