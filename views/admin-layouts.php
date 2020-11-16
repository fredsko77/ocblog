               <?php echo $content; ?>
          
          </main>
     
     </div>
     
     <div class="flash"></div>

     <div id="loader-container" class="hidden"> <div class="loader"></div> </div>

     <?php generate_csrf() ?>

     <!-- Vendor JS Files -->
     <script src="assets/vendor/jquery/jquery.min.js"></script>
     <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
     <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
     <script src="assets/vendor/venobox/venobox.min.js"></script>
     <script src="assets/vendor/aos/aos.js"></script>
     <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
     <script src="assets/vendor/counterup/counterup.min.js"></script>
     <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
     <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
     <script src="<?php echo get_vendor("tinymce/js/tinymce/tinymce.min.js") ?>"></script>

     <!-- Axios Ajax library Js File --> 
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

     <!-- Template App JS File -->
     <?php echo get_script('config'); ?>

     <!-- Template App JS File -->
     <?php echo get_script('app'); ?>

     <!-- Template Main JS File -->     
     <?php echo get_script('main'); ?>
     
     <!-- Template Admin JS File -->
     <?php echo get_script('admin'); ?>
     
     </body> 
</html>