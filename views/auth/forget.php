<section class="container-fluid">
     <main id="main">
          <p>Vous avez oublié votre mot de passe, entrez votre adresse électronique dans le champs ci-dessous, un lien vous permettant de changer votre mot de passe vous sera envoyé par email.</p>
          <?php 
               _e( $params->form->start( esc_url( generate_url('auth.password.token') ), 'forgetPassword(this,event)') );

               _e( $params->form->input('email', ['type' => 'email','label' => 'Adresse email'], true) );
               
               _e( $params->form->csrf() );
               
               _e( $params->form->submit('Envoyer le mail', 'primary') );
               
               _e( $params->form->end() );

          ?>
     </main>
</section>