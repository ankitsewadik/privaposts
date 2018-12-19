<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?>
<?php if(get_the_ID()==20 || get_the_ID()==22){ ?>
<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			the_content();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				//comments_template();
			}

			// End of the loop.
		endwhile;
		?>
<?php }else{ ?>
<div class="cont-wrp"> 
	<section class="pri-sec">
	<div class="container"> 
		<div class="row">
			<div class="col-md-12">
					 
					<?php if( $post->ID != 20 &&  $post->ID != 22) { ?> 
						<div class="main-heading">
							<h1><?php echo get_the_title(); ?></h1>
							  </div>
					<?php } ?>
			  		
			     <?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			the_content();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				//comments_template();
			}

			// End of the loop.
		endwhile;
		?>

			    
			  
			</div>
		</div>
	</div>
	</section>
</div>
<?php } ?>
