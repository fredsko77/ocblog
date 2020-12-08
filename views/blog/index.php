<main id="main">
     <section class="container" id="blog-list">
          <h1>Tous les articles</h1>
          <div class="post-list">
               <?php require_once get_template('posts/repeater'); ?>
          </div>
          <div class="d-flex flex-row justify-content-center hidden">
               <svg version="1.1" id="L4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                    <circle fill="#D9D9D9" stroke="none" cx="6" cy="50" r="6">
                         <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite" begin="0.1"></animate>    
                    </circle>
                    <circle fill="#C4C2C4" stroke="none" cx="26" cy="50" r="6">
                         <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite" begin="0.2"></animate>       
                    </circle>
                    <circle fill="#AAAAAA" stroke="none" cx="46" cy="50" r="6">
                         <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite" begin="0.3"></animate>     
                    </circle>
               </svg>
          </div>
          <?php _e( $params->pagination->create() ) ?> 
     </section>
</main><!-- End of Main -->