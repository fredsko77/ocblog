<section id="main">
     <div class="container">
          <h1 class="h3">Inscription</h1>

          <div id="error_msg_form"></div>

          <?php 
               
               _e( $params->form->start( esc_url( generate_url('auth.store') ), 'handleRegister(this,event)') );

               _e( $params->form->select('gender', ['mr' => 'M', 'mme' => 'Mme'], "Civilité", false, true) );

               _e( $params->form->input('firstname', ['label' => 'Prénom'], true) );

               _e( $params->form->input('lastname', ['label' => 'Nom'], true) );

               _e( $params->form->input('email', ['type' => 'email','label' => 'Adresse email'], true) );

               _e( $params->form->input('password', ['type' => 'password','label' => 'Mot de passe'], true) );

               _e( $params->form->input('password_confirm', ['type' => 'password','label' => 'Confirmer le mot de passe'], true) );
               
               _e( $params->form->csrf() );
               
               _e( $params->form->submit('Envoyer', 'primary') );
               
               _e( $params->form->end() );

          ?>
     </div>
</section>