<?php
/** setting page **/


	if ( is_admin() ){ // admin actions
		add_action( 'admin_menu',  'add_referralsetting_menu' );
	  	add_action( 'admin_init', 'register_myreferral' );
	} else {
	  // non-admin enqueues, actions, and filters
	}
	function register_myreferral() { // whitelist options
		//add_options_page('Welldrills Settings', 'Welldrills Settings', 'manage_options', 'myoption', 'my_options_page')
	  register_setting( 'myoption-group', 'referral_commision' );
	  register_setting( 'myoption-group', 'max_sub_price' );
	  register_setting( 'myoption-group', 'min_sub_price' );
	  register_setting( 'myoption-group', 'PU_commissionrate' );
	  register_setting( 'myoption-group', 'RU_commissionrate' );
	  register_setting( 'myoption-group', 'RU_override_commissionrate' );



/*	  register_setting( 'myoption-group', 'refferal_id' );
*/	}
	function my_refferaloptions_page()
	{
	?>
		<div class="wrap">
		<h1>Referral Commission page</h1>
		<form method="post" action="options.php"> 
		<?php
		settings_fields( 'myoption-group' );
		do_settings_sections( 'myoption-group' );
		?>
		  <table class="form-table">
		   <tr valign="top">
	        <th scope="row">Referral Comission(%)</th>
	        <td><input type="number" name="referral_commision" min="0" step="0.01" value="<?php echo esc_attr( get_option('referral_commision') ); ?>" /></td>
	        </tr>
	        <tr valign="top">
	        <th scope="row">SUBSCRIPTION PRICES</th>
	        <td><fieldset><p><label style="padding-right: 6px;">Max Subcription Price</label><label><input type="number" name="max_sub_price" min="0" step="0.01" value="<?php echo esc_attr( get_option('max_sub_price') ); ?>" style=""></label></p></fieldset>
 			<fieldset><p><label style="padding-right: 6px;">Min Subcription Price</label><label><input type="number" name="min_sub_price" min="0" step="0.01" value="<?php echo esc_attr( get_option('min_sub_price') ); ?>" style=""></label></p></fieldset></td>
	        </tr>
	        <tr valign="top">
	        <th scope="row">COMMISSION RATES(%)</th>
 			<td><fieldset><p><label style="padding-right: 6px;">PU commission rates(%)</label><label><input type="number" name="PU_commissionrate" min="0" step="0.01" value="<?php echo esc_attr( get_option('PU_commissionrate') ); ?>" style=""></label></p></fieldset>
 			<fieldset><p><label style="padding-right: 6px;">RU commission rates(%)</label><label><input type="number" name="RU_commissionrate" min="0" step="0.01" value="<?php echo esc_attr( get_option('RU_commissionrate') ); ?>" style=""></label></p></fieldset>
 			<fieldset><p><label style="padding-right: 6px;">RU override commission rates(%)</label><label><input type="number" name="RU_override_commissionrate" min="0" step="0.001" value="<?php echo esc_attr( get_option('RU_override_commissionrate') ); ?>" style=""></label></p></fieldset></td>
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

	function add_referralsetting_menu()
    {
        // This page will be under "Settings"
        add_options_page(
            'Referral Commission', 
            'Referral Commission', 
            'manage_options', 
            'my-reffsetting-admin', 
            'my_refferaloptions_page'
        );
    }
	
