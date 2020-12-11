<main id="main">
     <section class="container" id="blog-list">
          <h1>Tous les articles</h1>
          <div class="post-list">
               <?php require get_template('posts/repeater'); ?>
          </div>
          <?php _e( $params->pagination->create() ) ?> 
     </section>
</main><!-- End of Main -->