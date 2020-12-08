<section class="container-fluid">
     <main id="main">
          <h1 class="h3">Réinitialiser votre mot de passe</h1>
          <?php 
          
               _e( $params->form->start( esc_url( generate_url('auth.reset') ), 'resetPassword(this,event)') );

               _e( $params->form->input('password', ['type' => 'password','label' => 'Mot de passe'], true) );

               _e( $params->form->input('password_confirm', ['type' => 'password','label' => 'Confirmer le mot de passe'], true) );
               
               _e( $params->form->csrf() );
               
               _e( $params->form->submit('Envoyer', 'primary') );
               
               _e( $params->form->end() );

          ?>
     </main>
</section>