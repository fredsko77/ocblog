<?php if ( is_admin() ): ?>
<?php else: ?>
     <!-- ======= Footer ======= -->
     <footer id="footer">
          <div class="container content">
               <div class="row">
                    <div class="web-map col-12 col-md-6">
                         <h4 class="">Plan du site</h4>
                         <ul class="web-map-list">
                              <li class="web-map-item">
                                   <a href="<?= generate_url('home') ?>">
                                        Accueil
                                   </a>
                              </li>
                              <li class="web-map-item">
                                   <a href="<?= generate_url('about') ?>">
                                        A propos
                                   </a>
                              </li>
                              <li class="web-map-item">
                                   <a href="<?= generate_url('contact') ?>">
                                        Contact
                                   </a>
                              </li>
                              <?php if (is_blog()):
                                        if ( property_exists($params, 'auth')  ): 
                                             if ( $params->auth->getRole() === "admin" && $params->auth !== null ): ?>
                                                  <li class="web-map-item">
                                                       <a href="<?= generate_url('admin') ?>">
                                                            Administration
                                                       </a>
                                                  </li>
                              <?php          endif;
                                        endif;
                                   endif; 
                              ?>
                         </ul>
                    </div>
                    <div class="kelly col-12 col-md-6">
                         <div class="copyright">
                              &copy; Copyright <strong><span>Kelly</span></strong>. All Rights Reserved
                         </div>
                         <div class="credits">
                              <!-- All the links in the footer should remain intact. -->
                              <!-- You can delete the links only if you purchased the pro version. -->
                              <!-- Licensing information: https://bootstrapmade.com/license/ -->
                              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/kelly-free-bootstrap-cv-resume-html-template/ -->
                              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                         </div>
                    </div>              
               </div>
                              </div>
     </footer><!-- End  Footer -->

     <div class="flash"></div>

     <div id="preloader"></div>
     <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
<?php endif; ?>