<section class="container-fluid">
     <main id="main">
          <h1 class="h3">Réinitialiser votre mot de passe</h1>
          <?php 
          
               echo $params->form->start(generate_url('auth.reset'), 'resetPassword(this,event)');

               echo $params->form->input('password', ['type' => 'password','label' => 'Mot de passe'], true);

               echo $params->form->input('password_confirm', ['type' => 'password','label' => 'Confirmer le mot de passe'], true);
               
               echo $params->form->csrf();
               
               echo $params->form->submit('Envoyer', 'primary');
               
               echo $params->form->end();

          ?>
     </main>
</section>
<script>
     localStorage.setItem('token', '<?= $params->token; ?>' );
</script>