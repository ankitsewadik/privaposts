<?php /* Template Name: Payment Details */ 
  get_header('profile-logein');
 ?>

  <div class="dash-cnt-wrp">
            <section class="set-cover">
                <div class="container">
                    
                                    <?php
                                    // Start the loop.
                                    while ( have_posts() ) : the_post();
                                    // Include the page content template.
                                    the_content();
                                    // End of the loop.
                                    endwhile;
                                    ?>
                       
                </div>
            </section>
        </div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>