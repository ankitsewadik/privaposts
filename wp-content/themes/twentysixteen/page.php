<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

 ?>

<?php 
	
switch (get_the_ID()) {
	case 18:
		get_header('logein');
		get_template_part( 'template-parts/content', 'loginpage' );
		break;
 	default:
 		if(is_user_logged_in()){
 			get_header('profile-logein');
 			//get_header('logein');	
 			get_template_part( 'template-parts/content', 'loginpage' );
 		}else{
 			get_header();		
 			get_template_part( 'template-parts/content', 'page' );
 		}
		
		break;
}
?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
