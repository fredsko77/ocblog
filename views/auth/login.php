<section id="main">
     <div id="login-form">

          <h1 class="h3 mb-4">Connexion</h1>
          
          <?php 
     
               _e( $params->form->start( esc_url( generate_url('auth.authenticate') ), 'authenticateUsers(this,event)') ); 
     
               _e( $params->form->input('username', ['label' => 'Nom d\'utilisateur'], true) );
     
               _e( $params->form->input('password', ['label' => 'Mot de passe', 'type' => 'password'], true) );
     
               _e( $params->form->csrf() );
          
               _e( $params->form->submit('Se connecter', 'success') );

          ?> 

          <a class="ml-3" href="<?= esc_url( generate_url('auth.forget') ); ?>">Mot de passe oublié.</a>

          <?php _e( $params->form->end() );
     
          ?>

          <p class="mt-2">Vous n'avez pas encore de compte, inscrivez-vous <a href="<?= esc_url( generate_url('auth.register') ); ?>">ici</a></p>
     </div>
</section>