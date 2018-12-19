<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

//get_header(); ?>
<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Privaposts</title>
<link href="https://fonts.googleapis.com/css?family=Poppins:400,500" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--[if lt IE 9]>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="header" <?php if( $post->ID == 20 || $post->ID == 22) { ?> style="display:none;" <?php } ?>>
 <div class="container">
  <div class="logo-lft">
  <?php  //twentysixteen_the_custom_logo(); ?>
  <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri()?>/assets/images/privaposts-white-logo.png"></a>
  </div> 
  <div class="menu-rgt">
    
           <?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
      <?php if ( has_nav_menu( 'primary' ) ) : ?>
      <?php
         
      ?>
      <?php endif; ?>
      <?php endif; ?>
  </div>
 </div>
</header>



 <div class="cont-wrp">
  <div class="container">
   <div class="row">
    <div class="col-md-10 col-md-push-1">
    <div class="error-page text-center">
     <div class="row">
      <div class="col-xs-12">
        <h1>404</h1>
        <h4>Page Not Found</h4>
        <h3>Oh no! Looks like you got lost.</h3>
        <h3>Quick! Make your way back <a href="<?php echo home_url(); ?>">Home!</a></h3>
      </div>
      <div class="col-xs-12 ">
        <div class="error-logo">
         <img src="https://privaposts.vn.cisinlive.com/wp-content/themes/twentysixteen/assets/images/error.png" alt="error-img" >
        </div>
      </div>
     </div>
    </div>
    
    </div>
   </div>
  </div>
 </div>

	<div id="primary" class="content-area" style="padding: 15%; display: none;" >
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				
    
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?></h1>
			

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>

					<?php //get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- .site-main -->

		<?php //get_sidebar( 'content-bottom' ); ?>

	</div><!-- .content-area -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
