<main id="main">
     <!-- ======= About Section ======= -->
     <section id="about" class="about">
          <div class="container" data-aos="fade-up">

               <div class="section-title">
                    <h2>A propos</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
               </div>

               <div class="row">
                    <div class="col-lg-4">
                         <img 
                              src="<?= esc_url(file_exists( get_image('about.jpg') ) ? get_image('about.jpg') : get_image('about_default.jpg') ) ?>" 
                              srcset="<?= esc_url(file_exists( get_image('about.jpg') ) ? get_image('about.jpg') : get_image('about_default.jpg') ) ?>" 
                              class="img-fluid" 
                              alt="photo a propos"
                         >
                    </div>
                    <div class="col-lg-8 pt-4 pt-lg-0 content">
                         <h3>Développeur d'application PHP/Symfony</h3>
                         <p class="font-italic">
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                              magna aliqua.
                         </p>
                         <div class="row">
                              <div class="col-lg-6">
                                   <ul>
                                        <li><i class="icofont-rounded-right"></i> <strong>Date de naissance:</strong> 31 Mai 1995</li>
                                        <li><i class="icofont-rounded-right"></i> <strong>Mon site:</strong> www.agathefrederick.com</li>
                                        <li><i class="icofont-rounded-right"></i> <strong>Téléphone:</strong> +33 6 49 64 01 19</li>
                                        <li><i class="icofont-rounded-right"></i> <strong>Ville:</strong> Croissy-Beabourg</li>
                                   </ul>
                              </div>
                              <div class="col-lg-6">
                                   <ul>
                                        <li><i class="icofont-rounded-right"></i> <strong>Age:</strong> 25</li>
                                        <li><i class="icofont-rounded-right"></i> <strong>Niveau d'études:</strong> Bac +2</li>
                                        <li><i class="icofont-rounded-right"></i> <strong>Email:</strong> agathefrederick@gmail.com</li>
                                        <li><i class="icofont-rounded-right"></i> <strong>Disponibilité:</strong> Dès que possible</li>
                                   </ul>
                              </div>
                         </div>
                         <p>
                              Officiis eligendi itaque labore et dolorum mollitia officiis optio vero. Quisquam sunt adipisci omnis et ut. Nulla accusantium dolor incidunt officia tempore. Et eius omnis.
                              Cupiditate ut dicta maxime officiis quidem quia. Sed et consectetur qui quia repellendus itaque neque. Aliquid amet quidem ut quaerat cupiditate. Ab et eum qui repellendus omnis culpa magni laudantium dolores.
                         </p>
                    </div>
               </div>

          </div>
     </section><!-- End About Section -->

     <!-- ======= Skills Section ======= -->
     <section id="skills" class="skills">
          <div class="container" data-aos="fade-up">

               <div class="section-title">
                    <h2>Compétences</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
               </div>

               <div class="row skills-content">

                    <div class="col-lg-6">

                         <div class="progress">
                              <span class="skill">HTML <i class="val">100%</i></span>
                              <div class="progress-bar-wrap">
                                   <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                         </div>

                         <div class="progress">
                              <span class="skill">CSS <i class="val">90%</i></span>
                              <div class="progress-bar-wrap">
                                   <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                         </div>

                         <div class="progress">
                              <span class="skill">JavaScript <i class="val">75%</i></span>
                              <div class="progress-bar-wrap">
                                   <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                         </div>

                    </div>

                    <div class="col-lg-6">

                         <div class="progress">
                              <span class="skill">PHP <i class="val">80%</i></span>
                              <div class="progress-bar-wrap">
                                   <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                         </div>

                         <div class="progress">
                              <span class="skill">WordPress/CMS <i class="val">90%</i></span>
                              <div class="progress-bar-wrap">
                                   <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                         </div>

                         <div class="progress">
                              <span class="skill">Photoshop <i class="val">55%</i></span>
                              <div class="progress-bar-wrap">
                                   <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                         </div>

                    </div>

               </div>

          </div>
     </section><!-- End Skills Section -->

</main><!-- End #main -->