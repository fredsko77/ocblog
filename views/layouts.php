
   
     <?php echo $content; ?>

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
     <script src="https://cdn.tiny.cloud/1/bf8h5df57k7p928sv5wrubivsekxgv64ihbdvzmtsbm1rbt6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

     <!-- Axios Ajax library Js File --> 
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
     
     <!-- Template Config JS File -->
     <?php esc_url( get_script('config') ); ?>

     <!-- Template App JS File -->     
     <?php esc_url( get_script('app') ); ?>

     <!-- Template Main JS File -->     
     <?php esc_url( get_script('main') ); ?>

     <!-- Template Contact JS File -->
     <?php esc_url( get_script('contact') ); ?>

     <!-- Template Contact JS File -->
     <?php  if ( is_blog() ) esc_url( get_script('form') ); ?>

     <!-- Template Auth JS File -->
     <?php if ( is_auth() ) esc_url( get_script('auth') ); ?>

     <!-- Template Home JS File -->
     <?php if (is_home()) esc_url( get_script('home') ); ?>

     </body> 
</html>