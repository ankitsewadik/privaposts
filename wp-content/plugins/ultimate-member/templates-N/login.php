<section class="login-screen-cmn">
  <div class="login-wrap">
    <div class="row flex-row">
      <div class="col-sm-6 signin-img">
        <div class="iphone-frame"> <img src="<?php echo get_template_directory_uri() ?>/assets/images/iphone-pic.png" alt="">
          <div class="carousel-outer">
            <div id="iphone-carousel" class="owl-carousel owl-theme">
              <div class="item"> <img src="<?php echo get_template_directory_uri() ?>/assets/images/slide1.jpg" alt="" /> </div>
              <div class="item"> <img src="<?php echo get_template_directory_uri() ?>/assets/images/slide1.jpg" alt="" /> </div>
            </div>
          </div>
        </div>
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
<!-- forgot password Modal -->
  <div class="all-pop">
     <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content login-info">
     
         <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
       
       <h1>Reset forgotton password</h1>
       <p>Please enter your current email address.</p>
       <div class="pop-form">
       	<?php// echo do_shortcode('[ultimatemember_password]'); ?>
         <form action="">
            <div class="form-group"> <span class="input-icon"><i class="fa"><img src="<?php echo get_template_directory_uri() ?>/assets/images/icon-user.png" alt=""></i></span>
              <input type="text" id="pwd_text" name="pwd_text" class="form-control" placeholder="Email">
            </div>
             <span id="error_msg" style="display: none"></span>
           <div class="btns clearfix">
                  <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
                  <button type="button" class=" btn btn-default save" id="forget_pwd">Send</button>
            </div>
          </form>
       </div>
       
      </div>
      
    </div>
  </div>
  </div>