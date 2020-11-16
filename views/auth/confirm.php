<section class="container" id="main">
     <div class="text-center">
          <?php if ($params->confirm !== null): ?> 
               <h1 class="h2"> 
                    Bonjour  <?= $params->confirm->getFirstname() ?>,              
               </h1>
               <p class="h3">Bienvenue sur Mon Super Blog, clique <a href="<?= generate_url('auth.login') ?>"> ici </a> pour te connecter </p>
               🚀🚀🚀🚀🚀🚀🚀 
          <?php else : ?>
               <h1>Ce token n'est plus valide</h1>
          <?php endif; ?>
     </div>
</section>