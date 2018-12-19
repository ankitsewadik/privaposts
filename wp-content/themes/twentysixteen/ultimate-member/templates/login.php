<?php
	if(isset($_GET['ref']) & $_GET['ref'] !=''){ 
		     $user_profileId = numhash($_GET['ref']);
		     $user = get_userdata( $user_profileId );
			if ( $user === false ) {
    				wp_redirect(site_url()); exit(0);
			} else {
    				get_header('reffer');
			}
	?>

<?php	}else{ ?>

		<section class="login-screen-cmn">
  <div class="login-wrap">
    <div class="row flex-row">
      <div class="col-sm-6 signin-img">
         	<?php get_template_part( 'template-parts/content', 'slider' ); ?>
      </div>
      <div class="col-sm-6 col-xs-12">
        <div class="login-info">
          <h2><?php  twentysixteen_the_custom_logo(); ?>
          <?php 
          	$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						  <span><?php echo $description; ?></span>
					<?php endif; ?>
          

          </h2>

            
            <form id="login" method="post" action="" autocomplete="off">
	
		<?php
		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_before_form
		 * @description Some actions before login form
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_before_form', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_before_form', 'my_before_form', 10, 1 );
		 * function my_before_form( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( "um_before_form", $args );

		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_before_{$mode}_fields
		 * @description Some actions before login form fields
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_before_{$mode}_fields', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_before_{$mode}_fields', 'my_before_fields', 10, 1 );
		 * function my_before_form( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( "um_before_{$mode}_fields", $args );

		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_main_{$mode}_fields
		 * @description Some actions before login form fields
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_before_{$mode}_fields', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_before_{$mode}_fields', 'my_before_fields', 10, 1 );
		 * function my_before_form( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( "um_main_{$mode}_fields", $args );

		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_after_form_fields
		 * @description Some actions after login form fields
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_after_form_fields', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_after_form_fields', 'my_after_form_fields', 10, 1 );
		 * function my_after_form_fields( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( "um_after_form_fields", $args );

		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_after_{$mode}_fields
		 * @description Some actions after login form fields
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_after_{$mode}_fields', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_after_{$mode}_fields', 'my_after_form_fields', 10, 1 );
		 * function my_after_form_fields( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( "um_after_{$mode}_fields", $args );

		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_after_form
		 * @description Some actions after login form fields
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_after_form', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_after_form', 'my_after_form', 10, 1 );
		 * function my_after_form( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( "um_after_form", $args ); ?>
		
		</form>
          <div class="text-center text-bottom"> Don’t have an account? <a href="<?php echo home_url( '/register/' ); ?>" class="text-link">Sign Up </a> </div>
        </div>
      </div>
    </div>
  </div>
</section>



<style>
 a#return-to-top{display: none !important;}
</style>

<?php	}  ?>
