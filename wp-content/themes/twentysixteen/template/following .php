<?php /* Template Name: Following Template */ ?>
<?php
get_header('profile-logein');
 ?>
<div class="dash-cnt-wrp">
	<section class="set-cover">
	<div class="container"> 
		<div class="row">
			<div class="col-md-12">
			     <?php
		// Start the loop.
				while ( have_posts() ) : the_post();
				// Include the page content template.
					the_content();
				// End of the loop.
	       	endwhile;
  		?>
			</div>
		</div>
	</div>
	</section>
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>