<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
</div><!-- .site-content -->
<?php get_template_part( 'template-parts/content', 'bcmcrerpopup' ); ?>
<?php get_template_part( 'template-parts/content', 'nopaymentaddedpopup' ); ?>
<?php get_template_part( 'template-parts/content', 'paymentpopup' ); ?>
<?php get_template_part( 'template-parts/content', 'sendtipwithcard' ); ?>
<?php get_template_part( 'template-parts/content', 'editpostpopup' ); ?>
<?php get_template_part( 'template-parts/content', 'resetpwdpopup' ); ?>
<?php get_template_part( 'template-parts/content', 'messagepopup' ); ?>
<?php get_template_part( 'template-parts/content', 'thankyou' ); ?> 
<?php get_template_part( 'template-parts/content', 'sendppv' ); ?> 

<?php 
  if(!is_user_logged_in()){
      get_template_part( 'template-parts/content', 'loginpopup' ); 
  }
?>



<footer class="foot-wrp">
 <div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php dynamic_sidebar( 'content bottom 1' ); ?>
     
     <div class="foot-lnks">
       
       	   <?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<?php
					wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'list-inline',
			    	) );
			?>
			<?php endif; ?>
   		<?php endif; ?>
   		
         
       
     </div>
    </div>
  </div>
 </div>  
 
</footer> 
<a href="javascript:" id="return-to-top"><i class="fa  fa-angle-up"></i></a>
<?php wp_footer(); ?>
<div class="loader">
 <div class="loader-inner">
  <img src="https://privaposts.vn.cisinlive.com/wp-content/themes/twentysixteen/assets/css/Preloader.png">
 <p>Please wait...</p>
</div>
</div>

<div class="loader-new loaderpost">
 <div class="loader-inner-new">
  <div class="progress"></div>
 <p>Please wait...</p>
</div>
</div>
<style type="text/css">
  .loader-new{
    display: none;
    position: fixed;

left: 0px;

top: 0px;

width: 100%;

height: 100%;

z-index: 9999999;

text-align: center;

background: rgba(255, 255, 255, 0.79);



  }

  .loader-inner-new {

    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    width: 50%;

}

.progress {
    display: block;
    text-align: center;
    width: 0;
    height: 20px;
    background: #0097fe;
    transition: width .3s;
    color: white;
    font-weight: bold !important;
}
.progress.hide {
    opacity: 0;
    transition: opacity 1.3s;
}
</style>

</body>
</html>




		
