<section class="container-fluid">
     <main id="main">
          <p>Vous avez oublié votre mot de passe, entrez votre adresse électronique dans le champs ci-dessous, un lien vous permettant de changer votre mot de passe vous sera envoyé par email.</p>
          <?php 
               echo $params->form->start(generate_url('auth.forget'), 'forgetPassword(this,event)');

               echo $params->form->input('email', ['type' => 'email','label' => 'Adresse email'], true);
               
               echo $params->form->csrf();
               
               echo $params->form->submit('Envoyer le mail', 'primary');
               
               echo $params->form->end();

          ?>
     </main>
</section>