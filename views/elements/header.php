<?php require get_template('elements/head'); ?>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
     <div class="container-fluid d-flex justify-content-between align-items-center">

     <h1 class="logo"><a href="<?= generate_url('home') ?>">Kelly</a></h1>
     <!-- Uncomment below if you prefer to use an image logo -->
     <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

     <?php if (is_home()): ?>
          <nav class="nav-menu d-none d-lg-block">
          <ul>
               <li <?php if(generate_url('home') === get_current_url()): ?> class="active" <?php endif; ?> >
                         <a href="<?= generate_url('home') ?>">Home</a>
               </li>
               <li  <?php if(generate_url('about') === get_current_url()): ?> class="active" <?php endif; ?> >
                    <a href="<?= generate_url('about') ?>">About</a>
               </li>
               <li  <?php if(generate_url('contact') === get_current_url()): ?> class="active" <?php endif; ?> >
                    <a href="<?= generate_url('contact') ?>">Contact</a>
               </li>
               <li  <?php if( is_blog() ): ?> class="active" <?php endif; ?> >
                    <a href="<?= generate_url('blog') ?>">Blog</a>
               </li>
          </ul>
     </nav><!-- .nav-menu -->
     <?php endif; ?>

     <div class="header-social-links">
          <a href="https://twitter.com" target="_blank" class="twitter"><i class="icofont-twitter"></i></a>
          <a href="https://facebook.com" target="_blank" class="facebook"><i class="icofont-facebook"></i></a>
          <a href="https://instagram.com" target="_blank" class="instagram"><i class="icofont-instagram"></i></a>
          <a href="https://linkedin.com" target="_blank" class="linkedin"><i class="icofont-linkedin"></i></i></a>
     </div>

     </div>

</header><!-- End Header -->
