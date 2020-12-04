<div class="hidden" data-tabs="params"> 
     <h3 class="mt-3">Votre email</h3>
     <div class="row">
          <div class="col-lg-6 col-md-9 col-xs-12">               
               <?php 
                    echo $params->form->start(generate_url('auth.email.reset.send', [
                              's' => $params->auth->getEmail(),
                              'id' => $params->auth->getId()
                         ]), 
                         "handleEmailReset(this, event)", 
                         true, 
                         [
                              'id' => 'email-form'
                         ]); 
                    echo $params->form->input('mail', [
                              'type' => 'email',
                              'label' => 'Adresse e-mail actuelle',
                              'attr' => [
                                   'value' => $params->auth->getEmail(),
                                   'disabled' => 'disabled',
                              ]
                         ], true); 
                    echo $params->form->input('email', [
                              'type' => 'email',
                              'label' => 'Nouvel e-mail',
                         ], true);
                    echo $params->form->submit('Envoyer', 'primary');
                    echo $params->form->end();
               ?>
          </div>
     </div>
     <div class="row bg-light mt-5 pt-4 pb-4 mb-4">
          <div class="col-lg-6 col-md-9 col-xs-12">  
               <h5>Changer votre mot de passe</h5>             
               <?php 
                    echo $params->form->start( generate_url('auth.profile.change.password', [
                              'id' => $params->auth->getId()
                         ])
                         , "handleProfileResetPassword(this, event)", 
                         false, 
                         [
                              'id' => 'password-form'
                         ]); 
                    echo $params->form->input( 'password', [
                              'type' => 'password',
                              'label' => 'Nouveau mot de passe',
                         ], true);
                    echo $params->form->input( 'password_confirm', [
                              'type' => 'password',
                              'label' => 'Saisir à nouveau le mot de passe',
                         ], true);
                    echo $params->form->submit('Modifier le mot de passe', 'primary');
                    echo $params->form->end();
               ?>
          </div>
     </div>
     <p class="mt-5">
          <a 
               href="<?= generate_url('auth.delete', [
                    'id' => $params->auth->getId()
               ]); ?>" 
               class="text-danger"
               title="Supprimer votre compte utilisateur"
               onclick="deleteAuth(this, event)"
               style="text-decoration: underline; font-weight: 600;"
          >
               Supprimer mon compte
          </a>
     </p>
     <small>Si vous supprimez votre compte, toutes vos données personnelles seront effacées conformément à notre politique concernant les données personnelles.</small>
</div>