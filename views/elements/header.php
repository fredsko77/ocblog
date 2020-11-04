<?php require get_template('elements/head'); ?>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
     <div class="container-fluid d-flex justify-content-between align-items-center">

     <h1 class="logo"><a href="<?= generate_url('home') ?>">Kelly</a></h1>
     <!-- Uncomment below if you prefer to use an image logo -->
     <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

     <?php if (is_home() || is_blog()): ?>
          <nav class="nav-menu d-none d-lg-block">
          <ul>
               <li <?php if(generate_url('home') === get_current_url()): ?> class="active" <?php endif; ?> >
                         <a href="<?= generate_url('home') ?>">Accueil</a>
               </li>
               <li  <?php if(generate_url('about') === get_current_url()): ?> class="active" <?php endif; ?> >
                    <a href="<?= generate_url('about') ?>">A propos</a>
               </li>
               <li  <?php if(generate_url('contact') === get_current_url()): ?> class="active" <?php endif; ?> >
                    <a href="<?= generate_url('contact') ?>">Nous contacter</a>
               </li>
               <li  <?php if( is_blog() ): ?> class="active" <?php endif; ?> >
                    <a href="<?= generate_url('blog') ?>">Blog</a>
               </li>
          </ul>
     </nav><!-- .nav-menu -->
     <?php endif; ?>

     <div class="header-social-links">

          <a href="https://github.com/fredsko77" target="_blank" class="github" title="Mon compte github">
               <i class="icofont-github"></i>
          </a>
          <a href="https://www.linkedin.com/in/fr%C3%A9d%C3%A9rick-agathe-027553128/" target="_blank" class="linkedin" title="Mon compte LinkedIn">
               <i class="icofont-linkedin"></i>
          </a>
          
          <a href="<?= generate_url('resume') ?>" target="_blank" class="resume" title="Mon Cv">
               <i class="icofont-file-pdf"></i>
          </a>
          
     </div>

     </div>

</header><!-- End Header -->
