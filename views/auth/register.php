<section id="main">
     <div class="container">
          <h1 class="h3">Inscription</h1>

          <p>link : </p>

          <div id="error_msg_form"></div>

          <?php 
               
               echo $params->form->start(generate_url('auth.store'), 'handleRegister(this,event)');

               echo $params->form->input('firstname', ['label' => 'Prénom'], true);

               echo $params->form->input('lastname', ['label' => 'Nom'], true);

               echo $params->form->input('email', ['type' => 'email','label' => 'Adresse email'], true);

               echo $params->form->input('password', ['type' => 'password','label' => 'Mot de passe'], true);

               echo $params->form->input('password_confirm', ['type' => 'password','label' => 'Confirmer le mot de passe'], true);
               
               echo $params->form->csrf();
               
               echo $params->form->submit('Envoyer', 'primary');
               
               echo $params->form->end();

          ?>
     </div>
</section>