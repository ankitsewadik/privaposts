<?php

// Function to display admin options for the plugin
function sal_mainPage(){
	$templateOption = get_option('display_in_template');
	$displayOption = get_option('after_before_content');
	$loginOption = get_option('only_logged_in_users');
	
	?>
	<form method="post" action="options.php">
    <?php settings_fields( 'like-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'like-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
			<th scope="row">Display automatically in single pages?</th>
			<td>
				<label>Yes<input type="radio" name="display_in_template" id="item1" value="yes"     <?php if($templateOption == 'yes') echo 'checked="checked"'; ?> /></label>
				<label>No<input type="radio" name="display_in_template" id="item2" value="no"     <?php if($templateOption == 'no') echo 'checked="checked"'; ?> /></label>
			<p><span>Note: Choose no if you want Like/Dislike functionality in template files manually</span></p>
			<?php $showMsg = '<?php echo sal_showLikes(); ?>' ?>
			<p>
				<span>Use sal_showLikes() function in your template where you want to display the Likes counter</span>
				<blockquote class="sal_msgbox"><?php echo htmlspecialchars($showMsg) ?></blockquote>
			</p>
			</td>
        </tr>
  		<tr valign="top" id="content_position">
			<th scope="row">Display position in content</th>
			<td>
				<label>Before Content<input type="radio" name="after_before_content" value="before"     <?php if($displayOption == 'before') echo 'checked="checked"'; ?> /></label>
				<label>After Content<input type="radio" name="after_before_content" value="after"     <?php if($displayOption == 'after') echo 'checked="checked"'; ?> /></label>
			</td>
		</tr>
  		<tr valign="top">
			<th scope="row">Only work when user is logged in?</th>
			<td>
				<label>Yes<input type="radio" name="only_logged_in_users" value="yes"     <?php if($loginOption == 'yes') echo 'checked="checked"'; ?> /></label>
				<label>No<input type="radio" name="only_logged_in_users" value="no"     <?php if($loginOption == 'no') echo 'checked="checked"'; ?> /></label>
			</td>
		</tr>
	
    </table>
    
    <?php submit_button(); ?>

	</form>
	<?php
}

// Add Like/Dislike buttons to post content according to admin options choosed
function sal_showBeginsHere($content){

	if ( ! is_single() ) {
        return $content;
    }
	global $wpdb;
	$table_name = $wpdb->prefix . "simplelikecounter";
	global $current_user;
	global $post;
	$templateOption = get_option('display_in_template');
	$displayOption = get_option('after_before_content');

	if ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;	
	}
	$ip_address = $_SERVER['SERVER_ADDR'];
	
	$likeCount = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE like_count='1' AND post_id='$post->ID'" );
	$dislikeCount = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE dislike_count='1' AND post_id='$post->ID'" );
	
	$counterShow = '<div class="like-dislike"><a href="#" data-option="like" data-id="'.$post->ID.'" id="simpleAjaxLike"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;'.$likeCount.'</a><a href="#"  data-option="dislike" data-id="'.$post->ID.'" id="simpleAjaxDislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>&nbsp;'.$dislikeCount.'</a><span id="likesErrorMsg"></span><span id="errorMsg"></span></div>';
	
	if($templateOption == 'yes'){
		if($displayOption == 'before'){
			$content = $counterShow.$content;
			return $content; 
		}
		else{
			$content = $content.$counterShow;
			return $content; 
		}
	}
	else{
		return $content;
	}
}
add_filter('the_content', 'sal_showBeginsHere');

// Function to display Likes/Dislikes button in template file
function sal_showLikes(){

	global $wpdb;
	$table_name = $wpdb->prefix . "simplelikecounter";
	global $post;

	$likeCount = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE like_count='1' AND post_id='$post->ID'" );
	$dislikeCount = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE dislike_count='1' AND post_id='$post->ID'" );
	
	$counterShow = '<div class="like-dislike"><a href="#" data-option="like" data-id="'.$post->ID.'" id="simpleAjaxLike"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;'.$likeCount.'</a><a href="#"  data-option="dislike" data-id="'.$post->ID.'" id="simpleAjaxDislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>&nbsp;'.$dislikeCount.'</a><span id="likesErrorMsg"></span><span id="errorMsg"></span></div>';
	
	return $counterShow;
}

// Main function to process ajax like and dislike clicks
function sal_simpleAjaxCount(){
	global $wpdb;
	$table_name = $wpdb->prefix . "simplelikecounter";
	global $current_user;
	$current_user = wp_get_current_user();
	$userID = $current_user->ID;	

	function get_client_ip_server() {
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	$ipAddress = get_client_ip_server();
	
	$userAction = $_REQUEST['userAction'];
	$postID = $_REQUEST['postID'];
	
	$loginOption = get_option('only_logged_in_users');
	$resultdata = array();

	if($loginOption == 'yes'){
		if(is_user_logged_in()){
			if($userAction == 'like'){
				$result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
				$resultCount = $wpdb->num_rows;
				if($resultCount > 0){
					if($result->dislike_count == '1'){
						$wpdb->update(
							$table_name, 
							array( 
								'like_count' => '1',
								'dislike_count' => '0'
							),
							array(
								'post_id' => $postID,
								'user_id' => $userID
							)	 
						);
					}
					else{
						$wpdb->delete(
							$table_name, 
							array(
								'post_id' => $postID,
								'user_id' => $userID
							)	 
						);
					}
				}
				else{
					$wpdb->insert($table_name, array(
						'post_id' => $postID, 
						'user_id' => $userID,
						'dislike_count' => '0',
						'like_count' => '1',
						'user_ip_address' => '0'
					));
				}
			}
			else{
				$result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
				$resultCount = $wpdb->num_rows;
				if($resultCount > 0){
					if($result->like_count == '1'){
						$wpdb->update(
							$table_name, 
							array( 
								'like_count' => '0',
								'dislike_count' => '1'
							),
							array(
								'post_id' => $postID,
								'user_id' => $userID
							)	 
						);
					}
					else{
						$wpdb->delete(
							$table_name, 
							array(
								'post_id' => $postID,
								'user_id' => $userID
							)	 
						);
					}
				}
				else{
					$wpdb->insert($table_name, array(
						'post_id' => $postID, 
						'user_id' => $userID,
						'dislike_count' => '1',
						'like_count' => '0',
						'user_ip_address' => '0'
					));
				}
			}
		}
		else{
			$resultdata['error_msg'] = 'Need to be logged in to Like/Dislike';
		}
	}
	else{
		if(is_user_logged_in()){
			if($userAction == 'like'){
				$result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
				$resultCount = $wpdb->num_rows;
				if($resultCount > 0){
					if($result->dislike_count == '1'){
						$wpdb->update(
							$table_name, 
							array( 
								'like_count' => '1',
								'dislike_count' => '0'
							),
							array(
								'post_id' => $postID,
								'user_id' => $userID
							)
						);
					}
					else{
						$wpdb->delete(
							$table_name, 
							array(
								'post_id' => $postID,
								'user_id' => $userID
							)	 
						);
					}
				}
				else{
					$wpdb->insert($table_name, array(
						'post_id' => $postID, 
						'user_id' => $userID,
						'dislike_count' => '0',
						'like_count' => '1',
						'user_ip_address' => '0'
					));
				}
			}
			else{
				$result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
				$resultCount = $wpdb->num_rows;
				if($resultCount > 0){
					if($result->like_count == '1'){
						$wpdb->update(
							$table_name, 
							array( 
								'like_count' => '0',
								'dislike_count' => '1'
							),
							array(
								'post_id' => $postID,
								'user_id' => $userID
							)	 
						);
					}
					else{
						$wpdb->delete(
							$table_name, 
							array(
								'post_id' => $postID,
								'user_id' => $userID
							)	 
						);
					}
				}
				else{
					$wpdb->insert($table_name, array(
						'post_id' => $postID, 
						'user_id' => $userID,
						'dislike_count' => '1',
						'like_count' => '0',
						'user_ip_address' => '0'
					));
				}
			}
		}	//Logged in user functionality ends
	
		//Normal user functionality begins
		else{
			if($userAction == 'like'){
				$result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_ip_address = %s AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($ipAddress, $postID ) ));
				$resultCount = $wpdb->num_rows;
				if($resultCount > 0){
					if($result->dislike_count == '1'){
						$wpdb->update(
							$table_name, 
							array( 
								'like_count' => '1',
								'dislike_count' => '0'
							),
							array(
								'post_id' => $postID,
								'user_ip_address' => $ipAddress
							)	 
						);
					}
					else{
						$wpdb->delete(
							$table_name, 
							array(
								'post_id' => $postID,
								'user_id' => $userID
							)	 
						);
					}
				}
				else{
					$wpdb->insert($table_name, array(
						'post_id' => $postID, 
						'user_id' => '0',
						'dislike_count' => '0',
						'like_count' => '1',
						'user_ip_address' => $ipAddress
					));
				}
			}
			else{
				$result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_ip_address = %s AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($ipAddress, $postID ) ));
				$resultCount = $wpdb->num_rows;
				if($resultCount > 0){
					if($result->like_count == '1'){
						$wpdb->update(
							$table_name, 
							array( 
								'like_count' => '0',
								'dislike_count' => '1'
							),
							array(
								'post_id' => $postID,
								'user_ip_address' => $ipAddress
							)	 
						);
					}
					else{
						$wpdb->delete(
							$table_name, 
							array(
								'post_id' => $postID,
								'user_id' => $userID
							)	 
						);
					}
				}
				else{
					$wpdb->insert($table_name, array(
						'post_id' => $postID, 
						'user_id' => '0',
						'dislike_count' => '1',
						'like_count' => '0',
						'user_ip_address' => $ipAddress
					));
				}
			}	
		}
	}
	$resultdata['dislike_count'] = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE dislike_count='1' AND post_id='$postID'" );
	$resultdata['like_count'] = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE like_count='1' AND post_id='$postID'" );
	echo json_encode($resultdata);
	wp_die();
}
add_action("wp_ajax_nopriv_sal_simpleAjaxCount", "sal_simpleAjaxCount");
add_action("wp_ajax_sal_simpleAjaxCount", "sal_simpleAjaxCount");
?>