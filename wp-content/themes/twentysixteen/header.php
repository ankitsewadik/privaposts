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
<!-- <link href="<?php //echo get_template_directory_uri()?>/assets/css/style.css" rel="stylesheet"> -->
<link href="https://fonts.googleapis.com/css?family=Poppins:400,500" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--[if lt IE 9]>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<![endif]-->
    <script type="text/javascript">
         var theme_path = '<?php echo get_template_directory_uri(); ?>';
         var is_puuser = '<?php echo is_pu_user(get_current_user_id());  ?>';
         var ajax_url= "<?php echo admin_url('admin-ajax.php'); ?>";
         var siteurl="<?php echo site_url(); ?>/"; 
         var pageId = "<?php echo get_the_ID(); ?>";
      </script>
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
          wp_nav_menu( array(
              'theme_location' => 'primary',
              'menu_class'     => 'slimmenu',
            ) );
      ?>
      <?php endif; ?>
      <?php endif; ?>
  </div>
 </div>
</header>

