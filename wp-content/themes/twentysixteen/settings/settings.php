<?php
/** setting page **/


	if ( is_admin() ){ // admin actions
		add_action( 'admin_menu',  'add_setting_menu' );
	  	add_action( 'admin_init', 'register_mysettings' );
	} else {
	  // non-admin enqueues, actions, and filters
	}
	function register_mysettings() { // whitelist options
		//add_options_page('Welldrills Settings', 'Welldrills Settings', 'manage_options', 'myoption', 'my_options_page')
	  register_setting( 'slider-group', 'how_it_work_item' );
	  register_setting( 'slider-group', 'how_it_work_autoplay' );
	  register_setting( 'slider-group', 'how_it_work_loop' );
	  register_setting( 'slider-group', 'how_it_work_dots' );
	  register_setting( 'slider-group', 'how_it_work_autospeed' );
	  register_setting( 'slider-group', 'how_it_work_autoplaytimeout' );

	  register_setting( 'slider-group', 'login_slider_item' );
	  register_setting( 'slider-group', 'login_slider_autoplay' );
	  register_setting( 'slider-group', 'login_slider_loop' );
	  register_setting( 'slider-group', 'login_slider_dots' );
	  register_setting( 'slider-group', 'login_slider_autospeed' );
	  register_setting( 'slider-group', 'login_autoplaytimeout' );

/*	  register_setting( 'myoption-group', 'refferal_id' );
*/	}
	function my_options_page()
	{
	?>
		<div class="wrap">
		<h1>Slider Setting Page</h1>
		<form method="post" action="options.php"> 
		<?php
		settings_fields( 'slider-group' );
		do_settings_sections( 'slider-group' );
		?>
		
		  <table class="form-table">
	      
	        <tr>
	        <th scope="row">How it works slider</th>
	        <td><fieldset><p><label style="padding-right: 6px;">Items</label><label><input type="number" name="how_it_work_item" min="0" value="<?php echo esc_attr( get_option('how_it_work_item') ); ?>" style="width: 80px;"></label></p></fieldset><fieldset><label><p>Autoplay</p>
			<label><input name="how_it_work_autoplay" value="1" type="radio" <?php checked( '1', get_option( 'how_it_work_autoplay' ) ); ?>> True</label>
			<label><input name="how_it_work_autoplay" value="0" type="radio" <?php checked( '0', get_option( 'how_it_work_autoplay' ) ); ?>> False</label>
			</fieldset>
			</fieldset><fieldset><label><p>Loop</p>
			<label><input type="radio" name="how_it_work_loop" value="1" <?php checked( '1', get_option( 'how_it_work_loop' ) ); ?>> True</label>
			<label><input type="radio" name="how_it_work_loop" value="0" <?php checked( '0', get_option( 'how_it_work_loop' ) ); ?>> False</label>
			</fieldset>
			
			<fieldset><label style="padding-right: 6px;">Autoplay Timeout(ms)</label><label><input type="number" name="how_it_work_autoplaytimeout" min="0" step="0" value="<?php echo esc_attr( get_option('how_it_work_autoplaytimeout') ); ?>" style="width: 80px;"></label></fieldset>
			</td>
	        </tr>
	         <tr>
	        <th scope="row">Log In slider</th>
	        <td><fieldset><p><label style="padding-right: 6px;">Items</label><label><input type="number" name="login_slider_item" min="0" value="<?php echo esc_attr( get_option('login_slider_item') ); ?>" style="width: 80px;"></label></p></fieldset><fieldset><label><p>Autoplay</p>
			<label><input name="login_slider_autoplay" value="1" type="radio" <?php checked( '1', get_option( 'login_slider_autoplay' ) ); ?>> True</label>
			<label><input name="login_slider_autoplay" value="0" type="radio" <?php checked( '0', get_option( 'login_slider_autoplay' ) ); ?>> False</label>
			</fieldset>
			</fieldset><fieldset><label><p>Loop</p>
			<label><input name="login_slider_loop" value="1" type="radio" <?php checked( '1', get_option( 'login_slider_loop' ) ); ?>> True</label>
			<label><input name="login_slider_loop" value="0" type="radio" <?php checked( '0', get_option( 'login_slider_loop' ) ); ?>> False</label>
			</fieldset>
			<fieldset><label><p>Dots</p>
			<label><input name="login_slider_dots" value="1" type="radio" <?php checked( '1', get_option( 'login_slider_dots' ) ); ?>> True</label>
			<label><input name="login_slider_dots" value="0" type="radio" <?php checked( '0', get_option( 'login_slider_dots' ) ); ?>> False</label>
			</fieldset>
			<fieldset><label style="padding-right: 6px;">Autoplay Timeout(ms)</label><label><input type="number" name="login_autoplaytimeout" min="0" step="0" value="<?php echo esc_attr( get_option('login_autoplaytimeout') ); ?>" style="width: 80px;"></label></fieldset>
			</td>
	        </tr>
	         
	        <!-- <tr valign="top">
	        <th scope="row">Copyright</th>
	        <td><input type="text" name="copyright" value="<?php //echo esc_attr( get_option('copyright') ); ?>" /></td>
	        </tr> -->
	     </table>
	<?php
		submit_button(); 
		?>
		</form>
		</div>
	<?php
	}

	function add_setting_menu()
    {
        // This page will be under "Settings"
        add_options_page(
            'Slider Settings', 
            'Slider Settings', 
            'manage_options', 
            'my-setting-admin', 
            'my_options_page'
        );
    }
	
