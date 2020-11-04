<section id="main">
     <div id="login-form">
          <?php 
     
          echo $params->form->start('/auth/authenticate', 'authenticateUsers(this,event)'); 
     
          echo $params->form->input('username', ['label' => 'Nom d\'utilisateur'], true);
     
          echo $params->form->input('password', ['label' => 'Nom d\'utilisateur', 'type' => 'password'], true);
     
          echo $params->form->csrf();
          
          echo $params->form->submit('Se connecter', 'success');

          ?> 

          <a class="ml-3" href="<?= generate_url('auth.forget') ?>">Mot de passe oublié.</a>

          <?php

          echo $params->form->end();
     
          ?>

          <p class="mt-2">Vous n'avez pas encore de compte, inscrivez-vous <a href="<?= generate_url('auth.register') ?>">ici</a></p>
     </div>
</section>