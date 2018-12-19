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
	  register_setting( 'myoption-group', 'refferal_commision' );
/*	  register_setting( 'myoption-group', 'refferal_id' );
*/	}
	function my_options_page()
	{
	?>
		<div class="wrap">
		<h1>Referral Commision page</h1>
		<form method="post" action="options.php"> 
		<?php
		settings_fields( 'myoption-group' );
		do_settings_sections( 'myoption-group' );
		?>
		  <table class="form-table">
	        <tr valign="top">
	        <th scope="row">Referral Comission(%)</th>
	        <td><input type="text" name="site_name" value="<?php echo esc_attr( get_option('refferal_commision') ); ?>" /></td>
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
            'Refferal Comission', 
            'Refferal Comission', 
            'manage_options', 
            'my-setting-admin', 
            'my_options_page'
        );
    }
	
