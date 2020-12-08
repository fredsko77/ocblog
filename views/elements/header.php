<?php require get_template('elements/head'); ?>

<?php //dd( $params ); ?>

<!-- ======= Header ======= -->
<header id="header">
     <div class="container-fluid d-flex justify-content-between align-items-center">

     <h1 class="logo"><a href="<?php esc_url( generate_url('home') ); ?>">Kelly</a></h1>
     <!-- Uncomment below if you prefer to use an image logo -->
     <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

     <?php if (is_home() || is_blog() || generate_url('auth.profile') ) : ?>
          <nav class="nav-menu d-none d-lg-block">
               <ul>
                    <li <?php if( generate_url('home') === get_current_url() ): ?> class="active" <?php endif; ?> >
                              <a href="<?php esc_url( generate_url('home') ); ?>">Accueil</a>
                    </li>
                    <li  <?php if( generate_url('about') === get_current_url() ): ?> class="active" <?php endif; ?> >
                         <a href="<?php esc_url( generate_url('about') ); ?>">A propos</a>
                    </li>
                    <li  <?php if( generate_url('contact') === get_current_url() ): ?> class="active" <?php endif; ?> >
                         <a href="<?php esc_url( generate_url('contact') ); ?>">Nous contacter</a>
                    </li>
                    <li  <?php if( is_blog() ): ?> class="active" <?php endif; ?> >
                         <a href="<?php esc_url( generate_url('blog') ); ?>">Blog</a>
                    </li>
               </ul>
          </nav><!-- .nav-menu -->
     <?php endif; ?>

     <div class="header-social-links">
          <?php if ( is_home() ): ?>
               <a 
                    href="https://github.com/fredsko77" 
                    target="_blank" 
                    class="github" 
                    title="Mon compte github"
               >
                    <i class="icofont-github"></i>
               </a>
               <a 
                    href="https://www.linkedin.com/in/fr%C3%A9d%C3%A9rick-agathe-027553128/" 
                    target="_blank" 
                    class="linkedin" 
                    title="Mon compte LinkedIn"
               >
                    <i class="icofont-linkedin"></i>
               </a>               
               <a 
                    href="<?php esc_url( generate_url('resume') ); ?>" 
                    target="_blank" 
                    class="resume" 
                    title="Mon Cv"
               >
                    <i class="icofont-file-pdf"></i>
               </a>
          <?php else: ?> 
               <?php if ( !is_auth() || generate_url('auth.profile') ): ?> 
                    <?php if ( is_connected_user() ): ?>
                         <a 
                              href="#"
                              onclick="showUserMenu(event)"
                         >
                              <img 
                                   class="img_profile_circle" 
                                   src="<?= $params->auth->getImage()->path ?? "uploads/profile-default.jpg" ?>" 
                                   alt="photo de profil" 
                                   srcset="<?= $params->auth->getImage()->path ?? "uploads/profile-default.jpg" ?>"
                              >
                         </a>
                         <div class="position-absolute" id="menu-user">
                              <ul class="nav-drop">
                                   <li>
                                        <a href="<?php esc_url( generate_url('auth.profile') ); ?>"> 
                                             <i class="icofont-user-alt-3"></i> &nbsp; Mon profil
                                        </a>
                                   </li>

                                   <?php if ( property_exists($params, 'auth')  ): 
                                             if ( $params->auth->getRole() === "admin" && $params->auth !== null ): 
                                   ?>
                                             <li>
                                                  <a href="<?php esc_url( generate_url('admin') ); ?>"> 
                                                       <i class="icofont-home"></i> &nbsp; Tableau de bord
                                                  </a>
                                             </li> 
                                   <?php     endif; 
                                        endif; 
                                   ?>
                                   <li>
                                        <a href="<?php esc_url( generate_url('auth.logout') ); ?>"> 
                                             <i class="icofont-power"></i> &nbsp; Se déconnecter
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    <?php else: ?>
                         <span>
                              <a 
                                   href="<?php esc_url( generate_url('auth.login') ); ?>" 
                                   class=""
                              >
                                   Se connecter
                              </a>
                              |
                              <a 
                                   href="<?php esc_url( generate_url('auth.register') ); ?>"  
                                   class=""
                              >
                                   S'inscrire
                              </a>
                         </span>
                         
                    <?php endif; ?>
               <?php endif; ?>
          <?php endif; ?>
     </div>
     
</div>

</header><!-- End Header -->

<?php 
// dump($params->auth->getRole());
 