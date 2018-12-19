<?php
namespace um_ext\um_messaging\core;

// Exit if accessed directly. 
if ( ! defined( 'ABSPATH' ) ) exit;

class Messaging_Main_API {

	var $perms;

	/***
	***	@Construct
	***/
	function __construct() {
		global $wpdb;

		$this->table_name1 = $wpdb->prefix . "um_conversations";
		$this->table_name2 = $wpdb->prefix . "um_messages";

		$this->emoji[':)'] = 'https://s.w.org/images/core/emoji/72x72/1f604.png';
		$this->emoji[':smiley:'] = 'https://s.w.org/images/core/emoji/72x72/1f603.png';
		$this->emoji[':D'] = 'https://s.w.org/images/core/emoji/72x72/1f600.png';
		$this->emoji[':$'] = 'https://s.w.org/images/core/emoji/72x72/1f60a.png';
		$this->emoji[':relaxed:'] = 'https://s.w.org/images/core/emoji/72x72/263a.png';
		$this->emoji[';)'] = 'https://s.w.org/images/core/emoji/72x72/1f609.png';
		$this->emoji[':heart_eyes:'] = 'https://s.w.org/images/core/emoji/72x72/1f60d.png';
		$this->emoji[':kissing_heart:'] = 'https://s.w.org/images/core/emoji/72x72/1f618.png';
		$this->emoji[':kissing_closed_eyes:'] = 'https://s.w.org/images/core/emoji/72x72/1f61a.png';
		$this->emoji[':kissing:'] = 'https://s.w.org/images/core/emoji/72x72/1f617.png';
		$this->emoji[':kissing_smiling_eyes:'] = 'https://s.w.org/images/core/emoji/72x72/1f619.png';
		$this->emoji[';P'] = 'https://s.w.org/images/core/emoji/72x72/1f61c.png';
		$this->emoji[':P'] = 'https://s.w.org/images/core/emoji/72x72/1f61b.png';
		$this->emoji[':stuck_out_tongue_closed_eyes:'] = 'https://s.w.org/images/core/emoji/72x72/1f61d.png';
		$this->emoji[':flushed:'] = 'https://s.w.org/images/core/emoji/72x72/1f633.png';
		$this->emoji[':grin:'] = 'https://s.w.org/images/core/emoji/72x72/1f601.png';
		$this->emoji[':apensive:'] = 'https://s.w.org/images/core/emoji/72x72/1f614.png';
		$this->emoji[':relieved:'] = 'https://s.w.org/images/core/emoji/72x72/1f60c.png';
		$this->emoji[':unamused'] = 'https://s.w.org/images/core/emoji/72x72/1f612.png';
		$this->emoji[':('] = 'https://s.w.org/images/core/emoji/72x72/1f61e.png';
		$this->emoji[':persevere:'] = 'https://s.w.org/images/core/emoji/72x72/1f623.png';
		$this->emoji[":'("] = 'https://s.w.org/images/core/emoji/72x72/1f622.png';
		$this->emoji[':joy:'] = 'https://s.w.org/images/core/emoji/72x72/1f602.png';
		$this->emoji[':sob:'] = 'https://s.w.org/images/core/emoji/72x72/1f62d.png';
		$this->emoji[':sleepy:'] = 'https://s.w.org/images/core/emoji/72x72/1f62a.png';
		$this->emoji[':disappointed_relieved:'] = 'https://s.w.org/images/core/emoji/72x72/1f625.png';
		$this->emoji[':cold_sweat:'] = 'https://s.w.org/images/core/emoji/72x72/1f630.png';
		$this->emoji[':sweat_smile:'] = 'https://s.w.org/images/core/emoji/72x72/1f605.png';
		$this->emoji[':sweat:'] = 'https://s.w.org/images/core/emoji/72x72/1f613.png';
		$this->emoji[':weary:'] = 'https://s.w.org/images/core/emoji/72x72/1f629.png';
		$this->emoji[':tired_face:'] = 'https://s.w.org/images/core/emoji/72x72/1f62b.png';
		$this->emoji[':fearful:'] = 'https://s.w.org/images/core/emoji/72x72/1f628.png';
		$this->emoji[':scream:'] = 'https://s.w.org/images/core/emoji/72x72/1f631.png';
		$this->emoji[':angry:'] = 'https://s.w.org/images/core/emoji/72x72/1f620.png';
		$this->emoji[':rage:'] = 'https://s.w.org/images/core/emoji/72x72/1f621.png';
		$this->emoji[':triumph'] = 'https://s.w.org/images/core/emoji/72x72/1f624.png';
		$this->emoji[':confounded:'] = 'https://s.w.org/images/core/emoji/72x72/1f616.png';
		$this->emoji[':laughing:'] = 'https://s.w.org/images/core/emoji/72x72/1f606.png';
		$this->emoji[':yum:'] = 'https://s.w.org/images/core/emoji/72x72/1f60b.png';
		$this->emoji[':mask:'] = 'https://s.w.org/images/core/emoji/72x72/1f637.png';
		$this->emoji[':cool:'] = 'https://s.w.org/images/core/emoji/72x72/1f60e.png';
		$this->emoji[':sleeping:'] = 'https://s.w.org/images/core/emoji/72x72/1f634.png';
		$this->emoji[':dizzy_face:'] = 'https://s.w.org/images/core/emoji/72x72/1f635.png';
		$this->emoji[':astonished:'] = 'https://s.w.org/images/core/emoji/72x72/1f632.png';
		$this->emoji[':worried:'] = 'https://s.w.org/images/core/emoji/72x72/1f61f.png';
		$this->emoji[':frowning:'] = 'https://s.w.org/images/core/emoji/72x72/1f626.png';
		$this->emoji[':anguished:'] = 'https://s.w.org/images/core/emoji/72x72/1f627.png';
		$this->emoji[':smiling_imp:'] = 'https://s.w.org/images/core/emoji/72x72/1f608.png';
		$this->emoji[':imp:'] = 'https://s.w.org/images/core/emoji/72x72/1f47f.png';
		$this->emoji[':open_mouth:'] = 'https://s.w.org/images/core/emoji/72x72/1f62e.png';
		$this->emoji[':grimacing:'] = 'https://s.w.org/images/core/emoji/72x72/1f62c.png';
		$this->emoji[':neutral_face:'] = 'https://s.w.org/images/core/emoji/72x72/1f610.png';
		$this->emoji[':confused:'] = 'https://s.w.org/images/core/emoji/72x72/1f615.png';
		$this->emoji[':hushed:'] = 'https://s.w.org/images/core/emoji/72x72/1f62f.png';
		$this->emoji[':no_mouth:'] = 'https://s.w.org/images/core/emoji/72x72/1f636.png';
		$this->emoji[':innocent:'] = 'https://s.w.org/images/core/emoji/72x72/1f607.png';
		$this->emoji[':smirk:'] = 'https://s.w.org/images/core/emoji/72x72/1f60f.png';
		$this->emoji[':expressionless:'] = 'https://s.w.org/images/core/emoji/72x72/1f611.png';

		$this->emoji = apply_filters('um_messaging_emoji', $this->emoji );

	}


	/**
	 * @param $user_id
	 * @return bool|mixed|void
	 */
	function get_perms( $user_id ) {
		if ( ! method_exists( UM()->roles(), 'role_data' ) )
			return false;

		$role = UM()->roles()->get_priority_user_role( $user_id );
		$role_data = apply_filters( 'um_user_permissions_filter', UM()->roles()->role_data( $role ), $user_id );

		return $role_data;
	}

	/***
	***	@Blocked a user?
	***/
	function blocked_user( $user_id, $who_blocked = false ) {
		if(!get_current_user_id())
			return false;
			
		if ( !$who_blocked )
			$who_blocked = get_current_user_id();

		$blocked = (array) get_user_meta( $who_blocked, '_pm_blocked', true );
		if ( in_array( $user_id, $blocked ) )
			return true;
		return false;
	}

	/***
	***	@Is it a hidden conversation?
	***/
	function hidden_conversation( $conversation_id ) {
		$hidden = (array) get_user_meta( get_current_user_id(), '_hidden_conversations', true );
		if ( in_array( $conversation_id, $hidden ) )
			return true;
		return false;
	}

	/***
	***	@hides a conversation
	***/
	function hide_conversation( $user_id, $conversation_id ) {
		$hidden = (array) get_user_meta( $user_id, '_hidden_conversations', true );
		if ( !in_array( $conversation_id, $hidden ) ) {
			$hidden[] = $conversation_id;
			update_user_meta( $user_id, '_hidden_conversations', $hidden );
		}
	}
	/**
	 * Can start messages?
	 *
	 * @param $recipient
	 * @return bool
	 */
	function can_message( $recipient ) {
		if ( $this->blocked_user( $recipient, get_current_user_id() ) ||
			 $this->blocked_user( get_current_user_id(), $recipient ) )
			return false;

		$who_can_pm = get_user_meta( $recipient, '_pm_who_can', true );
		if ( $who_can_pm == 'nobody')
			return false;

		$custom_restrict = apply_filters( 'um_messaging_can_message_restrict', false, $who_can_pm, $recipient );
		if ( $custom_restrict )
			return false;

		if ( UM()->options()->get( 'pm_block_users' ) ) {
			$users = str_replace(' ', '', UM()->options()->get( 'pm_block_users' ) );
			$array = explode( ',', $users );
			if ( in_array( $recipient, $array ) )
				return false;
		}

		$role = UM()->roles()->get_priority_user_role( get_current_user_id() );
		$role_data = UM()->roles()->role_data( $role );
		$role_data = apply_filters( 'um_user_permissions_filter', $role_data, get_current_user_id() );

		if ( $role_data['can_start_pm'] )
			return true;

		return false;
	}


	/**
	 * Check if conversation has unread messages
	 *
	 * @param int $conversation_id
	 * @param int $user_id
	 * @return bool
	 */
	function unread_conversation( $conversation_id, $user_id ) {
		global $wpdb;

		$count = $wpdb->get_var( $wpdb->prepare(
			"SELECT COUNT(message_id) 
			FROM {$this->table_name2} 
			WHERE conversation_id = %d AND 
				  recipient = %d AND 
				  status = 0 
			LIMIT 1",
			$conversation_id,
			$user_id
		) );

		if ( $count )
			return true;

		return false;
	}


	/**
	 * Get unread messages count
	 *
	 * @param int $user_id
	 * @return int
	 */
	function get_unread_count( $user_id ) {
		global $wpdb;

		$blocked = get_user_meta( $user_id, '_pm_blocked', true );
		$blocked = is_array( $blocked ) ? array_filter( $blocked, 'intval' ) : array();

		if ( count( $blocked ) ) {
			$count = $wpdb->get_var( $wpdb->prepare(
				"SELECT COUNT( message_id ) 
				FROM {$this->table_name2} 
				WHERE recipient = %d AND 
					  author NOT IN('" . implode( "','", $blocked ) . "') AND 
					  status = 0 
				LIMIT 11",
				$user_id
			) );
		} else {
			$count = $wpdb->get_var( $wpdb->prepare(
				"SELECT COUNT( message_id ) 
				FROM {$this->table_name2} 
				WHERE recipient = %d AND 
					  status = 0 
				LIMIT 11",
				$user_id
			) );
		}

		return intval( $count );
	}


	/**
	 * Remove a message
	 *
	 * @param $message_id
	 * @param $conversation_id
	 */
	function remove_message( $message_id, $conversation_id ) {
		global $wpdb;

		$wpdb->delete(
			$this->table_name2,
			array(
				'conversation_id' => $conversation_id,
				'message_id' => $message_id,
				'author' => get_current_user_id()
			)
		);
	}


	/***
	***	@Check whether limit reached for sending msg
	***/
	function limit_reached() {
		$this->perms = $this->get_perms( get_current_user_id() );

		$user_id = get_current_user_id();
		$msgs_sent = get_user_meta( $user_id, '_um_pm_msgs_sent', true );

		$last_pm = get_user_meta( $user_id, '_um_pm_last_send', true );

		$limit = $this->perms['pm_max_messages'];
		$limit_tf = $this->perms['pm_max_messages_tf'];

		if ( !$limit ) return false;

		if ( $limit_tf ) {

		$numDays = number_format( abs( $last_pm - current_time('timestamp', true ) ) /60/60/24, 2 );
		if ( $numDays > $limit_tf ) { // more than x day since last msg open it again
			delete_user_meta( $user_id, '_um_pm_last_send' );
			delete_user_meta( $user_id, '_um_pm_msgs_sent' );
		} else {

			if ( $msgs_sent >= $limit ) {
				return true;
			} else {
				return false;
			}

		}

		} else {

			if ( $msgs_sent >= $limit ) {
				return true;
			}

		}

		return false;
	}

	/**
	 * Conversation template
	 *
	 * @param int $message_to
	 * @param int $user_id
	 */
	function conversation_template( $message_to, $user_id ) {
		$this->perms = $this->get_perms( get_current_user_id() );

		um_fetch_user( $message_to );
		$contact_name = ( um_user( 'display_name' ) ) ? um_user( 'display_name' ) : __( 'Deleted User', 'um-messaging' );
		$contact_url = um_user_profile_url();

		$limit = UM()->options()->get('pm_char_limit');

		um_fetch_user( $user_id );

		$response = $this->get_conversation_id( $message_to, $user_id );
		$message_history = add_query_arg( 'profiletab', 'messages', um_user_profile_url() ); ?>

		<?php /* <div class="um-message-header um-popup-header">
			<div class="um-message-header-left"><?php echo get_avatar( $message_to, 40 ); ?> <?php echo '<a href="'. um_user_profile_url() . '">' . $contact_name . '</a>'; ?></div>
			<div class="um-message-header-right">
				<a href="#" class="um-message-blocku um-tip-e" title="<?php esc_attr_e( 'Block user', 'um-messaging' ); ?>" data-other_user="<?php echo $message_to; ?>" data-conversation_id="<?php echo $response['conversation_id']; ?>"><i class="um-faicon-ban"></i></a>
				<a href="#" class="um-message-delconv um-tip-e" title="<?php esc_attr_e( 'Delete conversation', 'um-messaging' ); ?>" data-other_user="<?php echo $message_to; ?>" data-conversation_id="<?php echo $response['conversation_id']; ?>"><i class="um-icon-trash-b"></i></a>
				<a href="#" class="um-message-hide um-tip-e" title="<?php esc_attr_e( 'Close chat', 'um-messaging' ); ?>"><i class="um-icon-android-close"></i></a>

				<?php do_action( 'um_messaging_after_conversation_links', $message_to, $user_id ); ?>
			</div>
		</div> */?>



        <div class="curent-chat-user">
        <div class="back-btn um-message-hide um-tip-e"><a href="#"><i class="fa fa-angle-left"></i></a></div>
        <div class="active-user-name">
         <div class="current-img"><?php echo get_avatar( $message_to, 40 ); ?> 
         </div>
         <div class="current-user">
          <div class="usrname"><?php echo '<a href="'. um_user_profile_url() . '">' . $contact_name . '</a>'; ?></div>
         </div>
        </div>
        
        <div class="mute-chat">
         <span>Mute</span>
         <label class="switch">
          <input name="" id="" type="checkbox">
          <span class="slider round"></span> 
         </label>
        </div>
      </div>

		<div class="um-message-body um-popup-autogrow um-message-autoheight chat-current" data-message_to="<?php echo $message_to; ?>" id="chat-current">
            <div class="chat-bx-wrp ">

			<div class="um-message-ajax chat-view " data-message_to="<?php echo $message_to; ?>" data-conversation_id="<?php echo $response['conversation_id']; ?>" data-last_updated="<?php echo $response['last_updated']; ?>">

				<?php if ( $this->perms['can_read_pm'] ) {

					echo $this->get_conversation( $message_to, $user_id, $response['conversation_id'] );

				} else { ?>

					<span class="um-message-notice">
						<?php esc_html_e( 'Your membership level does not allow you to view conversations.', 'um-messaging' ) ?>
					</span>

				<?php } ?>
			</div>
         </div>
		</div>

		<?php //hide blocked users conversations
		if ( $this->can_message( $message_to ) || $this->perms['can_reply_pm'] ) { ?>

			<div class="um-message-footer um-popup-footer" data-limit_hit="<?php esc_attr_e( 'You have reached your limit for sending messages.', 'um-messaging' ); ?>" >

				<?php if ( $this->limit_reached() ) {

					esc_html_e( 'You have reached your limit for sending messages.', 'um-messaging' );

				} elseif ( $this->perms['can_reply_pm'] ) { ?>

					<?php /*<div class="um-message-textarea">

						<?php echo $this->emoji(); ?>

						<textarea name="um_message_text" id="um_message_text" data-maxchar="<?php echo $limit; ?>" placeholder="<?php esc_attr_e( 'Type your message', 'um-messaging' ); ?>"></textarea>

					</div>

					<div class="um-message-buttons">
						<span class="um-message-limit"><?php echo $limit; ?></span>
						<a href="#" class="um-message-send disabled">
							<i class="um-faicon-envelope-o"></i>
							<?php esc_html_e( 'Send message', 'um-messaging' ); ?>
						</a>
					</div> */?> 
             <script type="text/javascript">
					$(document).ready(function(){
						$(".um-message-body").animate({ scrollTop: $('.um-message-body').prop("scrollHeight")}, 1000);
					})
			</script>
			<div class="chat-action">
			<form name="new_message" id="new_message" method="post" action="" onsubmit="return false;">
				<div class="act-reply-bx ">
					<div class="act-text um-message-textarea">
						<?php echo $this->emoji(); ?>
						<textarea name="um_message_text" id="um_message_text" data-maxchar="<?php echo $limit; ?>" placeholder="<?php esc_attr_e( 'Type your message..', 'um-messaging' ); ?>"></textarea>
						</div>
					<div class="act-send um-message-buttons">
						<a href="#" class="um-message-send send-btn">
						<i class="fa fa-paper-plane"></i>
					<input type="submit" name="Save"></a>
					</div>
				</div> 
				<div class="act-icons">
					<div class="act-gallry">
						<div class="up-load">
       						<input type="file" class="files" name="files">
						</div>
						    
					</div>
					<div class="act-dollar">
						<img src="<?php echo site_url();?>/wp-content/themes/twentysixteen/assets/images/dollar-eye.png" alt="">
					</div>
				</div>
				

			</form>
			</div>

			<div class="um-clear"></div>
				<?php } else {
					esc_html_e( 'You are not allowed to reply to private messages.', 'um-messaging' );
				} ?>
			</div>
		<?php } else {
			esc_html_e( 'You are blocked and not allowed continue this conversation.', 'um-messaging' );
		}
	}

	/**
	 * Get conversations
	 *
	 * @param int $user_id
	 * @return array|null|object|string
	 */
	function get_conversations( $user_id ) {
		global $wpdb;
		
		$results = $wpdb->get_results( $wpdb->prepare(
			"SELECT * 
			FROM {$this->table_name1} 
			WHERE user_a = %d OR 
				  user_b = %d 
			ORDER BY last_updated DESC 
			LIMIT 50",
			$user_id,
			$user_id
		) );

		if ( $results ) {
			foreach( $results as $key => $result ) {
				if ( get_userdata( $result->user_b ) === false || get_userdata( $result->user_a ) === false ) {
					unset( $results[$key] );
				}

				//hide blocked users conversations
				/*if ( $user_id != $result->user_a && ! $this->can_message( $result->user_a ) ) {
					unset( $results[$key] );
				}*/
			}
			return $results;
		}
		return '';
	}


	/**
	 * Get a conversation ID
	 *
	 * @param int $user1
	 * @param int $user2
	 * @param null $conversation_id
	 * @return null
	 */
	function get_conversation_id( $user1, $user2, $conversation_id = null ) {
		global $wpdb;
		
		$response = null;
		if ( !$conversation_id ) {
			$conversation = $wpdb->get_results( $wpdb->prepare(
				"SELECT conversation_id,
						last_updated 
				FROM {$this->table_name1} 
				WHERE user_a = %d AND 
					  user_b = %d 
				LIMIT 1",
				$user1,
				$user2
			) );

			if ( isset( $conversation[0]->conversation_id ) ) {
				$response['conversation_id'] = $conversation[0]->conversation_id;
				$response['last_updated'] = $conversation[0]->last_updated;
			} else {
				$conversation = $wpdb->get_results( $wpdb->prepare(
					"SELECT conversation_id, 
							last_updated 
					FROM {$this->table_name1} 
					WHERE user_a = %d AND 
						  user_b = %d 
					LIMIT 1",
					$user2,
					$user1
				) );

				if ( isset( $conversation[0]->conversation_id ) ) {
					$response['conversation_id'] = $conversation[0]->conversation_id;
					$response['last_updated'] = $conversation[0]->last_updated;
				}
			}
		}

		return $response;
	}

	/**
	 * Get a conversation
	 *
	 * @param int $user1
	 * @param int $user2
	 * @param int|null $conversation_id
	 * @return null|string|void
	 */
	function get_conversation( $user1, $user2, $conversation_id = null ) {
		global $wpdb;
		
		// No conversation yet
		if ( !$conversation_id || $conversation_id <= 0 ) return;

		// Get conversation ordered by time and show only 1000 messages
		$messages = $wpdb->get_results( $wpdb->prepare(
			"SELECT * 
			FROM {$this->table_name2} 
			WHERE conversation_id = %d 
			ORDER BY time ASC LIMIT 1000",
			$conversation_id
		) );

		$response = null;
		$update_query = false;
		foreach( $messages as $message ) {

			if ( $message->status == 0 ) {
				$update_query = true;
				$status = 'unread';
			} else {
				$status = 'read';
			}

			if ( $message->author == get_current_user_id() ) {
				$class = 'right_m send-msg reply-bx';
				$remove_msg = '<div class="unsend"><a href="#" class="um-message-item-remove um-message-item-show-on-hover um-tip-s" title="'. __('Remove','um-messaging').'"></a></div>';
				$img='';
			} else {
				$class = ' recive-msg reply-bx';
				$remove_msg = '';
				$img='<div class="user-img">'.get_avatar( $message->author, 40 ).'
           </div>';
			}

			$response .= '<div class="um-message-item ' . $class . ' ' . $status . '" data-message_id="'.$message->message_id.'" data-conversation_id="'.$message->conversation_id.'">'.$img.'<div class="user-reply">';

			
			$response .= '<div class="time-post">' . $this->beautiful_time( $message->time, $class ) . '</div>';
             
			if (strpos($message->content, 'uploads') !== false) {
			    
			     $path = explode('.',$message->content);
				  $ext = end($path);	    
	                if($ext=='mp4' || $ext=='webm' || $ext=='mp4'|| $ext=='mov'){
	                  $imgClass='thumvideo';	
	                  $msg='<video controls><source src="'.$message->content.'" type="video/'.$ext.'"></video>' ;
					}else{
						/*$imgClass='thumimg';
						$msg="<img src=".$message->content.">";*/
						$imgClass='thumimg';
						$imagepath='';
						$new_array= explode('_', $message->content);
                        if($new_array!=''){
                        	$imagepath=$new_array[0].".".$ext;
                        }
						$msg="<a class='fancybox' href='".$imagepath."' data-fancybox-group='gallery'> <img src=".$message->content." ></a>";


					}

			}else{
                $imgClass='';
                $msg=$this->chatize( $message->content );

			}
  
			$response .= '<div class=" user-cmnt '.$imgClass.'">' . $msg . '</div>';

			$response .= $remove_msg;

			$response .= '</div></div>';

		}

		

		if ( $update_query ) {
			$wpdb->query( $wpdb->prepare(
				"UPDATE {$this->table_name2} 
				SET status = 1 
				WHERE conversation_id = %d AND 
					  author != %d",
				$conversation_id,
				get_current_user_id()
			) );
		}


		return $response;
	}

	/***
	***	@Chatize a message content
	***/
	function chatize( $content ) {
		$content = stripslashes( $content );

		// autolink
		$content = preg_replace('$(\s|^)(https?://[a-z0-9_./?=&-:]+)(?![^<>]*>)$i', '<a href="$2" target="_blank" rel="nofollow">$2</a> ', $content." ");
		$content = preg_replace('$(\s|^)(www\.[a-z0-9_./?=&-:]+)(?![^<>]*>)$i', '<a target="_blank" href="http://$2"  target="_blank" rel="nofollow">$2</a> ', $content." ");


		foreach( $this->emoji as $code => $val ) {
			if( strpos( $code, ')' ) !== false ){
				$code = str_replace(')','\)', $code );
			}

			if( strpos( $code, '(' ) !== false ){
				$code = str_replace('(','\(', $code );
			}

			if( strpos( $code, '$' ) !== false ){
				$code = str_replace('$','\$', $code );
			}

			if( strpos($content,':pensive:') !== false ){
				$content = str_replace(':pensive:', ':apensive:', $content );
			}

			$pattern = "~(?i)<a.*?</a>(*SKIP)(*F)|{$code}~";
			$content = preg_replace($pattern, '<img src="'.$val.'" alt="'.$code.'" title="'.$code.'" class="emoji" />', $content);
		
		}

		

		return nl2br( $content );
	}

	/***
	***	@Nice time difference
	***/
	function human_time_diff( $from, $to = '' ) {
		if ( empty( $to ) ) {
			$to = time();
		}

		$diff = (int) abs( $to - $from );


		if ( $diff < 60 ) {
			$since = sprintf( __('%ss','um-messaging'), $diff );
		} elseif ( $diff < HOUR_IN_SECONDS ) {
			$mins = round( $diff / MINUTE_IN_SECONDS );
			if ( $mins <= 1 )
				$mins = 1;
			/* translators: min=minute */
			$since = sprintf( __('%sm','um-messaging'), $mins );
		} elseif ( $diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS ) {
			$hours = round( $diff / HOUR_IN_SECONDS );
			if ( $hours <= 1 )
				$hours = 1;
			$since = sprintf( __('%sh','um-messaging'), $hours );
		} elseif ( $diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS ) {
			$days = round( $diff / DAY_IN_SECONDS );
			if ( $days <= 1 )
				$days = 1;
			$since = sprintf( __('%sd','um-messaging'), $days );
		} elseif ( $diff < 30 * DAY_IN_SECONDS && $diff >= WEEK_IN_SECONDS ) {
			$weeks = round( $diff / WEEK_IN_SECONDS );
			if ( $weeks <= 1 )
				$weeks = 1;
			$since = sprintf( __('%sw','um-messaging'), $weeks );
		} elseif ( $diff < YEAR_IN_SECONDS && $diff >= 30 * DAY_IN_SECONDS ) {
			$months = round( $diff / ( 30 * DAY_IN_SECONDS ) );
			if ( $months <= 1 )
				$months = 1;
			$since = sprintf( __('%sm','um-messaging'), $months );
		} elseif ( $diff >= YEAR_IN_SECONDS ) {
			$years = round( $diff / YEAR_IN_SECONDS );
			if ( $years <= 1 )
				$years = 1;
			$since = sprintf( __('%sy','um-messaging'), $years );
		}

		return apply_filters( 'um_messaging_human_time_diff', $since, $diff, $from, $to );
	}

	/***
	***	@Show time beautifully
	***/
	function beautiful_time( $time, $pos ) {
		$from_time_unix = strtotime( $time );
		$offset = get_option( 'gmt_offset' );
		$offset = apply_filters("um_messages_time_offset", $offset );

		$from_time = $from_time_unix - $offset * HOUR_IN_SECONDS; 
		$from_time = apply_filters("um_messages_time_from", $from_time, $time );

		$current_time = current_time('timestamp') - $offset * HOUR_IN_SECONDS;
		$current_time = apply_filters("um_messages_current_time", $current_time );

		$nice_time = $this->human_time_diff( $from_time, $current_time  );
		$nice_time = apply_filters("um_messages_time_nice", $nice_time, $from_time, $current_time );

		$clean_date_time = date("F d, Y, h:i A", $from_time );
		$clean_date_time = apply_filters("um_messages_time_clean", $clean_date_time, $from_time );
         
        $pos = apply_filters("um_messages_time_position", $pos );
         
		if ( $pos == 'right_m' ) {
			return '<span class="um-message-item-time um-tip-e" title="" um-messsage-timestamp="'.$from_time.'" um-message-utc-time="'.$clean_date_time.'">' . $nice_time . '</span>';
		} else {
			return '<span class="um-message-item-time um-tip-w"  title="" um-messsage-timestamp="'.$from_time.'" um-message-utc-time="'.$clean_date_time.'">' . $nice_time . '</span>'; 
		}
	}

	/***
	***	@Checks if user enabled email notification
	***/
	function enabled_email( $user_id ) {
		$_enable_new_pm = true;
		if ( get_user_meta( $user_id, '_enable_new_pm', true ) == 'yes' ) {
			$_enable_new_pm = 1;
		} else if ( get_user_meta( $user_id, '_enable_new_pm', true ) == 'no' ) {
			$_enable_new_pm = 0;
		}
		return $_enable_new_pm;
	}

	/**
	 * Create a conversation between both parties
	 *
	 * @param int $user1
	 * @param int $user2
	 * @return bool|int|null|string
	 */
	function create_conversation( $user1, $user2 ,$msg='') {
		global $wpdb;
		
		$conversation_id = false;

		// Test for previous conversation
		$conversation_id = $wpdb->get_var( $wpdb->prepare(
			"SELECT conversation_id 
			FROM {$this->table_name1} 
			WHERE user_a = %d AND 
				  user_b = %d 
			LIMIT 1",
			$user1,
			$user2
		) );

		if ( empty( $conversation_id ) ) {
			$conversation_id = $wpdb->get_var( $wpdb->prepare(
				"SELECT conversation_id 
				FROM {$this->table_name1} 
				WHERE user_a = %d AND 
					  user_b = %d 
				LIMIT 1",
				$user2,
				$user1
			) );
		}

		// Build new conversation
		if ( ! $conversation_id ) {

			$wpdb->insert(
				$this->table_name1,
				array(
					'user_a' => $user1,
					'user_b' => $user2
				)
			);

			$conversation_id = $wpdb->insert_id;

			do_action('um_after_new_conversation', $user1, $user2, $conversation_id );

		} else {

			do_action('um_after_existing_conversation', $user1, $user2, $conversation_id );

		}

		// Insert message
		$wpdb->update(
			$this->table_name1,
			array(
				'last_updated' 			=> current_time( 'mysql', true ),
			),
			array(
				'conversation_id' 		=> $conversation_id,
			)
		);

		$wpdb->insert(
			$this->table_name2,
			array(
				'conversation_id' => $conversation_id,
				'time' => current_time( 'mysql' ),
				'content' => strip_tags( $msg ),
				'status' => 0,
				'author' => $user2,
				'recipient' => $user1
			)
		);

		$this->update_user( $user2 );

		$hidden = (array) get_user_meta( $user1, '_hidden_conversations', true );
		if ( in_array( $conversation_id, $hidden ) ) {
			$hidden = array_diff($hidden, array( $conversation_id ) );
			update_user_meta( $user1, '_hidden_conversations', $hidden );
		}

		$hidden = (array) get_user_meta( $user2, '_hidden_conversations', true );
		if ( in_array( $conversation_id, $hidden ) ) {
			$hidden = array_diff($hidden, array( $conversation_id ) );
			update_user_meta( $user2, '_hidden_conversations', $hidden );
		}

		do_action('um_after_new_message', $user1, $user2, $conversation_id );

		return $conversation_id;

	}

	/***
	***	@Update user
	***/
	function update_user( $user_id ) {

		update_user_meta( $user_id, '_um_pm_last_send', current_time( 'timestamp' ) );
		$msgs_sent = get_user_meta( $user_id, '_um_pm_msgs_sent', true );
		update_user_meta( $user_id, '_um_pm_msgs_sent', (int) $msgs_sent + 1 );

	}

	/***
	***	@Show available emoji
	***/
	function emoji() {

		?>

		<div class="um-message-emoji">
			<a href="#" class="um-message-emo"><img src="<?php echo um_messaging_url . 'assets/img/emoji_init.png'; ?>" alt="" title="" /></a>
			<span class="um-message-emolist">

		<?php foreach( $this->emoji as $emoji_code => $emoji_url ) { ?>

			<span data-emo="<?php echo $emoji_code; ?>" title="<?php echo $emoji_code; ?>" class="um-message-insert-emo">
				<img src="<?php echo $emoji_url; ?>" alt="<?php echo $emoji_code; ?>" title="<?php echo $emoji_code; ?>" class="emoji">
			</span>

		<?php } ?>

		</span>
		</div>

		<?php
	}

	/***
	***	@Hex to RGB
	***/
	function hex_to_rgb( $hex ) {
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		return "$r, $g, $b";
	}


	/**
	 * @param $url
	 *
	 * @return bool|string
	 */
	public function set_redirect_to( $url ) {
		return ! empty( $_SESSION['um_social_login_redirect'] ) ? $_SESSION['um_social_login_redirect'] : ' ';
	}


	/***
	 ***	@unblock a user
	 ***/
	function ajax_messaging_unblock_user(){
		$output = array();
		if ( !isset( $_POST['user_id'] ) || !is_numeric( $_POST['user_id'] ) || !is_user_logged_in() ) die();

		$blocked = (array) get_user_meta( get_current_user_id(), '_pm_blocked', true );
		if ( !in_array( $_POST['user_id'] , $blocked ) ) die();

		$blocked = array_diff($blocked, array( $_POST['user_id'] ) );
		update_user_meta( get_current_user_id(), '_pm_blocked', $blocked );

		$output['success'] = 1;
		$output=json_encode($output);
		if(is_array($output)){print_r($output);}else{echo $output;}die;
	}

	/***
	 ***	@block a user
	 ***/
	function ajax_messaging_block_user(){
		$output = array();
		if ( !isset( $_POST['other_user'] ) || !is_numeric( $_POST['other_user'] ) || !is_user_logged_in() ) die();

		$blocked = (array) get_user_meta( get_current_user_id(), '_pm_blocked', true );
		$blocked[] = $_POST['other_user'];
		update_user_meta( get_current_user_id(), '_pm_blocked', $blocked );

		$output['success'] = 1;
		$output=json_encode($output);
		if(is_array($output)){print_r($output);}else{echo $output;}die;
	}

	/***
	 ***	@delete a conversation
	 ***/
	function ajax_messaging_delete_conversation(){
		global $wpdb;
		$output = array();

		if ( !isset( $_POST['conversation_id'] ) || !is_numeric( $_POST['conversation_id'] ) || !is_user_logged_in() ) die();
		if ( !isset( $_POST['other_user'] ) || !is_numeric( $_POST['other_user'] ) || !is_user_logged_in() ) die();

		$table = $wpdb->prefix . "um_conversations";
		$current_user = get_current_user_id();
		$other_user = sanitize_text_field( $_POST['other_user'] );
		$conversation_id = $wpdb->get_var( $wpdb->prepare(
			"SELECT conversation_id 
			FROM {$table} 
			WHERE ( user_a = %d AND user_b = %d ) OR 
				  ( user_b = %d AND user_a = %d ) 
		    LIMIT 1",
			$current_user,
			$other_user,
			$current_user,
			$other_user
		) );

		if ( empty( $conversation_id ) ) {
			wp_send_json_error();
		}

		$this->hide_conversation( get_current_user_id(), $conversation_id );
		//$output['success'] = 1;

		wp_send_json_success();

		//$output=json_encode($output);
		//if(is_array($output)){print_r($output);}else{echo $output;}die;
	}

	/***
	 ***	@Remove a message
	 ***/
	function ajax_messaging_remove(){
		$output = array();
		if ( !isset( $_POST['message_id'] ) || !is_numeric( $_POST['message_id'] ) || !is_user_logged_in() ) die();
		if ( !isset( $_POST['conversation_id'] ) || !is_numeric( $_POST['conversation_id'] ) || !is_user_logged_in() ) die();

        $this->remove_message( $_POST['message_id'], $_POST['conversation_id'] );

		$output=json_encode($output);
		if(is_array($output)){print_r($output);}else{echo $output;}die;
	}

  
    /***
	 ***	@Send a multimessage
	 ***/
     function ajax_multimessaging_send(){
      
       if(isset($_POST) && $_POST['message_to']!=''){

       	$msgids=$_POST['message_to'];
       	$idsArray=explode(',', $msgids);
       	    
       	    if (!function_exists('wp_handle_upload')) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
            }

            $urls = array();
            //Upload Images
            if ( $_FILES ) {
			  	$files = $_FILES['files'];
			  	if(($files['type'][0] == "image/jpeg") || ($files['type'][0] == "image/png") || ($files['type'][0] ==  "image/jpg") || ($files['type'][0] == "video/mp4") || ($files['type'][0] == "video/webm") || ($files['type'][0] == "video/mov") ){
			    	foreach ($files['name'] as $key => $value) {
						if ($files['name'][$key]) {
							$file = array(
								'name'     => $files['name'][$key],
								'type'     => $files['type'][$key],
								'tmp_name' => $files['tmp_name'][$key],
								'error'    => $files['error'][$key],
								'size'     => $files['size'][$key]
							);
							$upload_overrides = array('test_form' => false,'unique_filename_callback'=>'my_custom_filename');
							$newupload = wp_handle_upload($file, $upload_overrides);
							/*$filename = $file['name'];
							$arr = explode(".", $filename, 2);
							$first = $arr[0];
							$imagename = $first.rand();
							$urls[]=$newupload['url'];*/


							$filename = $file['name'];
							$arr = explode(".", $filename, 2);
							$first = $arr[0];
							$imagename = $first."_".time().rand();
		                    $second = $arr[1];

							if($second == "png" || $second == "jpeg" || $second == "jpg" || $second == "gif"){
								
								$uploads = wp_upload_dir();
			     				$upload_path = $uploads['path'];

								exec('convert  -resize 50X50 '.$upload_path.'/'.$filename.' '.$upload_path.'/'.$imagename.'.'.$second);
								$url = $newupload['url'];
								$url = explode('/', $url);
								array_pop($url);
								$urlss = implode('/', $url); 
								$urls[]=$urlss.'/'.$imagename.'.'.$second;

							}else{
								$urls[]=$newupload['url'];
							}

							

						}
					}
				}
			}
			//Send Chat content and Images
	        if(!empty($idsArray)){
	           $firstId = $idsArray[0];
	           	foreach ($idsArray as $id) {
	           	 	if (isset($_POST['content']) && !empty($_POST['content'])) {
					    $conversation_id = $this->create_conversation( $id, get_current_user_id(), $_POST['content'] );
			        }
			        if(!empty($urls) && is_array($urls)){
			         	foreach ($urls as $value) {
			         		$conversation_id = $this->create_conversation( $id, get_current_user_id(), $value );
			         		$conid[]=$conversation_id;
			         	}
			        }
	           	}//end idsArray
                 
               $output['is_table_exist'] = true; 
               
               $output['messages'] = $this->get_conversation( $firstId, get_current_user_id(), $conversation_id );

               if($conid){
               	 $output=json_encode($output);
               	 echo $output;
               	 die();
               }     

	        }
       }
    }


    /*function ajax_multimessaging_send_olddd(){
       
      // print_r($_FILES);
       if($_POST['message_to']!=''){

       	$msgids=$_POST['message_to'];
       	$idsArray=explode(',', $msgids);
       	    
       	    if (!function_exists('wp_handle_upload')) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
            }

	        if(!empty($idsArray)){
	           $firstId = $idsArray[0];
	           foreach ($idsArray as $id) {
	           	 
			    if ( $_FILES ) {
				      	$files = $_FILES['files'];
				    
				      	if(($files['type'][0] == "image/jpeg") || ($files['type'][0] == "image/png") || ($files['type'][0] ==  "image/jpg") || ($files['type'][0] == "video/mp4") || ($files['type'][0] == "video/webm") || ($files['type'][0] == "video/mov") ){
					    
					    foreach ($files['name'] as $key => $value) {

							if ($files['name'][$key]) {
								$file = array(
									'name'     => $files['name'][$key],
									'type'     => $files['type'][$key],
									'tmp_name' => $files['tmp_name'][$key],
									'error'    => $files['error'][$key],
									'size'     => $files['size'][$key]
								);
								
									$upload_overrides = array('test_form' => false,'unique_filename_callback'=>'my_custom_filename');
									$newupload = wp_handle_upload($file, $upload_overrides);
									$filename = $file['name'];
									$arr = explode(".", $filename, 2);
									//print_r($arr);
									$first = $arr[0];
									$imagename = $first.rand();

									if($second == "png" || $second == "jpeg" || $second == "jpg" || $second == "gif"){
										$uploads = wp_upload_dir();
					     				$upload_path = $uploads['path'];
										$url = $newupload['url'];
										$url = explode('/', $url);
										array_pop($url);
										$urlss = implode('/', $url); 
										$urls[]=$urlss.'/'.$imagename.'.png';
									}else{
										$urls[]=$newupload['url'];
									}
							}
						}

						if (isset($_POST['content']) && $_POST['content']!='') {

						     $conversation_id = $this->create_conversation( $id, get_current_user_id(), $_POST['content'] );
				        }

				         if($urls && $urls!=''){
				         	foreach ($urls as $value) {
				         		$conversation_id = $this->create_conversation( $id, get_current_user_id(), $value );
				         		$conid[]=$conversation_id;
				         	}
				         }
						}else{
						   $output['messages']	='nooo';
						}
					}else{
				        if ( !isset( $_POST['content'] ) || trim( $_POST['content'] ) == '' ) die();
						$conversation_id = $this->create_conversation( $id, get_current_user_id(), $_POST['content'] );
						$conid[]=$conversation_id;
					}
	           }//end idsArray
                 
               $output['is_table_exist'] = true; 
               
               $output['messages'] = $this->get_conversation( $firstId, get_current_user_id(), $conversation_id );


               if($conid){
               	 $output=json_encode($output);
               	 echo $output;
               	 die();
               }     

	        }
       }
    }*/
	/***
	 ***	@Send a message
	 ***/
	function ajax_messaging_send(){



        global $wpdb;

		if ( !isset( $_POST['message_to'] ) || !is_numeric( $_POST['message_to'] ) || !is_user_logged_in() ) die();
  
	    if (!function_exists('wp_handle_upload')) {
           require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
    
      if ( $_FILES ) {
      	$files = $_FILES['files'];
    
      	if(($files['type'][0] == "image/jpeg") || ($files['type'][0] == "image/png") || ($files['type'][0] ==  "image/jpg") || ($files['type'][0] == "video/mp4") || ($files['type'][0] == "video/webm") || ($files['type'][0] == "video/mov") ){
	    
	    /*$size = $files['size'];
	    foreach ($size as $s) {
	    	if($s < 150000){
	    		$record = array('error'=>1,'msg'=>"Uploaded image should be larger then 100 Kb!");
				echo json_encode($record); exit();
	    	}
	    }*/
	    
	    //$id = wp_insert_post($post);
	    foreach ($files['name'] as $key => $value) {

			if ($files['name'][$key]) {
				$file = array(
					'name'     => $files['name'][$key],
					'type'     => $files['type'][$key],
					'tmp_name' => $files['tmp_name'][$key],
					'error'    => $files['error'][$key],
					'size'     => $files['size'][$key]
				);
				
					/*$upload_overrides = array('test_form' => false,'unique_filename_callback'=>'my_custom_filename');
					$newupload = wp_handle_upload($file, $upload_overrides);
					$filename = $file['name'];
					$arr = explode(".", $filename, 2);
					//print_r($arr);
					$first = $arr[0];
					$imagename = $first."_".time().rand();
                    $second = $arr[1];
					$imagename = $first.rand();*/


					$upload_overrides = array('test_form' => false,'unique_filename_callback'=>'my_custom_filename');
					$newupload = wp_handle_upload($file, $upload_overrides);


					$filename = $file['name'];
					$arr = explode(".", $filename, 2);
					//print_r($arr);
					$first = $arr[0];
					$imagename = $first."_".time().rand();
                    $second = $arr[1];
					
					if($second == "png" || $second == "jpeg" || $second == "jpg" || $second == "gif"){
						
						$uploads = wp_upload_dir();
	     				$upload_path = $uploads['path'];

						exec('convert  -resize 50X50 '.$upload_path.'/'.$filename.' '.$upload_path.'/'.$imagename.'.'.$second);
						$url = $newupload['url'];
						$url = explode('/', $url);
						array_pop($url);
						$urlss = implode('/', $url); 
						$urls[]=$urlss.'/'.$imagename.'.'.$second;

					}else{
						$urls[]=$newupload['url'];
					}

                    //$urls[]=$newupload['url'];
			}
		}

		if (isset($_POST['content']) && $_POST['content']!='') {

		     $conversation_id = $this->create_conversation( $_POST['message_to'], get_current_user_id(), $_POST['content'] );
		  //$output['messages'] = $this->get_conversation( $_POST['message_to'], get_current_user_id(), $conversation_id );
		  $conid[]=$conversation_id;
        }

         if($urls && $urls!=''){
         	foreach ($urls as $value) {
         		$conversation_id = $this->create_conversation( $_POST['message_to'], get_current_user_id(), $value );
		        //$output['messages'] = $this->get_conversation( $_POST['message_to'], get_current_user_id(), $conversation_id );
		        $conid[]=$conversation_id;
         	}
         	
         }
		}else{
		   $output['messages']	='nooo';
		}
	}else{
        if ( !isset( $_POST['content'] ) || trim( $_POST['content'] ) == '' ) die();
		$conversation_id = $this->create_conversation( $_POST['message_to'], get_current_user_id(), $_POST['content'] );
		//$output['messages'] = $this->get_conversation( $_POST['message_to'], get_current_user_id(), $conversation_id );
		$conid[]=$conversation_id;
	}
	

		// Create conversation and add message
		//$conversation_id = $this->create_conversation( $_POST['message_to'], get_current_user_id() );
		//$output['messages'] = $this->get_conversation( $_POST['message_to'], get_current_user_id(), $conversation_id );

		$output['is_table_exist'] = true;

		$table_name1 = $wpdb->prefix . "um_conversations";

		if( ! $wpdb->get_var("show tables like '{$table_name1}'") ){
			$output['is_table_exist'] = "This {$table_name1} table doesn't exist";
		}

		if ( $this->limit_reached() ) {
			$output['limit_hit'] = 1;
		} else {
			$output['limit_hit'] = 0;
		}
         $output['ids'] =$conid;
		$output['messages'] = $this->get_conversation( $_POST['message_to'], get_current_user_id(), $conversation_id );

         //print_r($output);die;
		$output=json_encode($output);
		if(is_array($output)){
		   print_r($output);
	    }else{
	    	echo $output;
	    }die;
	}

	/***
	 ***	@Login Modal
	 ***/
	function ajax_messaging_login_modal() {
		if ( is_user_logged_in() ) die();

		$message_to = absint( $_POST['message_to'] );
		um_fetch_user( $message_to );

		$url = um_user_profile_url();

		$_SESSION['um_messaging_message_to'] = $message_to;
		$_SESSION['um_social_login_redirect'] = $url;

		ob_start(); ?>

		<div class="um-message-modal" id="msgwindow">

			<div class="um-message-header um-popup-header">
				<div class="um-message-header-left"><?php printf(__('%s Please login to message <strong>%s</strong>','um-messaging'), get_avatar( $message_to, 40 ), um_user('display_name') ); ?></div>
				<div class="um-message-header-right">
					<a href="#" class="um-message-hide"><i class="um-icon-android-close"></i></a>
				</div>
			</div>

			<div class="um-message-body um-popup-autogrow2 um-message-autoheight"></div>

		</div>

		<?php $output = ob_get_clean();
		wp_send_json_success( array( 'content' => $output, 'redirect_url' => $url ) );
	}

	/***
	 ***	@Coming from send message button
	 ***/
	function ajax_messaging_start() {
		
		if ( !isset( $_POST['message_to'] ) || !is_numeric( $_POST['message_to'] ) || !is_user_logged_in() ) die();

		ob_start(); ?>

		<div class="um-message-modal" id="msgwindow">

			<?php $this->conversation_template( $_POST['message_to'], get_current_user_id() ); ?>

		</div>

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		die($output);
	}

	/***
	 ***	@auto refresh of chat messages
	 ***/
	function ajax_messaging_update() {
		global $wpdb;
		$output["errors"] = array();
		if ( !isset( $_POST['message_to'] ) || !is_numeric( $_POST['message_to'] ) || !is_user_logged_in() ) {
			$output['errors'][] = "Invalid target user_ID or user is not logged in";
		}

		$conversation_id = absint( $_POST['conversation_id'] );
		$table_name1 = $wpdb->prefix . "um_conversations";
		$table_name2 = $wpdb->prefix . "um_messages";
		$last_update_query = $wpdb->prepare("SELECT last_updated FROM {$table_name1} WHERE conversation_id = %d LIMIT 1",$conversation_id);
		$results = $wpdb->get_results( $last_update_query );

		if( $wpdb->num_rows <= 0 ) {

			$output['errors'][] = "UM Messaging - invalid query: {$last_update_query}";

		} else {
			if ( ! $results[0]->last_updated ) {
				$output['errors'][] = "UM Messaging - No result found";
			}

			$output['debug']['last_updated_from_query'] = $results[0]->last_updated;
			$output['debug']['last_updated_from_post'] = $_POST['last_updated'];
			$output['debug']['last_updated'] = ( strtotime( $results[0]->last_updated ) > strtotime( $_POST['last_updated'] ) ? true:false );

			if ( strtotime( $results[0]->last_updated ) > strtotime( $_POST['last_updated'] ) ) {

				$last_updated = $_POST['last_updated'];

				// get new messages
				$messages_query = $wpdb->prepare("SELECT * FROM {$table_name2} as tn2 WHERE tn2.conversation_id = %d AND tn2.time > %s ORDER BY tn2.time DESC LIMIT 1",
					$conversation_id,
					strtotime( $last_updated )
				);

				$messages = $wpdb->get_results( $messages_query );

				$output['debug']['messages_query'] = $messages_query;
				$output['debug']['messages_query_results'] = $messages;
				$output['debug']['messages_query_num_rows'] = $wpdb->num_rows;

				foreach( $messages as $message ) {

					$response = null;

					if ( $message->status == 0 ) {
						$status = 'unread';
					} else {
						$status = 'read';
					}

					if ( $message->author == get_current_user_id() ) {
						$class = 'right_m send-msg reply-bx';
						$remove_msg = '<div class="unsend"> <a href="#" class="um-message-item-remove um-message-item-show-on-hover um-tip-s" title="'. __('Remove','um-messaging').'"></a></div>';
						$img='';
					} else {
						$class = ' recive-msg reply-bx';
						$remove_msg = '';
						$img='<div class="user-img">'.get_avatar( $message->author, 40 ).'
                         </div>';


					}



           if (strpos($message->content, 'uploads') !== false) {
			    
			     $path = explode('.',$message->content);
				  $ext = end($path);	    
	                if($ext=='mp4' || $ext=='webm' || $ext=='mp4'|| $ext=='mov'){
	                  $imgClass='thumvideo';	
	                  $msg='<video controls><source src="'.$message->content.'" type="video/'.$ext.'"></video>' ;
					}else{
						$imgClass='thumimg';
						 $msg="<img src=".$message->content.">";
					}

			}else{
                $imgClass='';
                $msg=$this->chatize( $message->content );

			}
  
			
					$response .= '<div class="um-message-item ' . $class . ' ' . $status . '" data-message_id="'.$message->message_id.'" data-conversation_id="'.$message->conversation_id.'">'.$img.'<div class="user-reply">';

                    $response .= '<div class="time-post">' . $this->beautiful_time( $message->time, $class ) . '</div>';

                    $response .= '<div class=" user-cmnt '.$imgClass.'">' . $msg . '</div>';
					

					$response .= $remove_msg;

					$response .= '</div></div>';

					$output['message_id'] = $message->message_id;
					$output['last_updated'] = $message->time;
					$output['response'] = $response;

				}

			} else {

				$output['response'] = 'nothing_new';

			}
		}

		//return $response;

		wp_send_json( $output );

	}

	/***
	 ***	@get read un read messages
	 ***/
	function ajax_messaging_unread(){



		            global $wpdb;
				    global $current_user; 
				    $id=$current_user->ID;
				    if($_POST['flag']==0){
                      $flag=0;
				    }else{
				      $flag=1;
				    }
				    $conversations = $wpdb->get_results(' 
				    
				    SELECT * FROM '.$wpdb->prefix.'um_conversations AS conversations
				    INNER JOIN '. $wpdb->prefix.'um_messages AS messages
				    ON conversations.user_b =  messages.recipient OR conversations.user_a =  messages.recipient
				    WHERE messages.status ='.$flag.' AND messages.recipient= '.$id.' GROUP BY messages.author
');
?>
<ul class="list-unstyled" id="myUL">

	<?php 

					/*echo $wpdb->last_query;
					print_r($conversations);*/
                    $i = 0;
                  foreach ( $conversations as $conversation ) {

                   /* if ( $conversation->user_a == um_profile_id() ) {
                      $user = $conversation->user_b;
                    } else {
                      $user = $conversation->user_a;
                    }*/

                    $user=$conversation->author;

                    if ( UM()->Messaging_API()->api()->blocked_user( $user ) ) {
                      continue;
                    }

                    if ( UM()->Messaging_API()->api()->hidden_conversation( $conversation->conversation_id ) ) {
                      continue;
                    }

                    $i++;

                    if ( $i == 1 && ! isset( $current_conversation ) ) {
                      $current_conversation = $conversation->conversation_id;
                    }

                    um_fetch_user( $user );

                    $user_name = ( um_user( 'display_name' ) ) ? um_user( 'display_name' ) : __( 'Deleted User', 'um-messaging' );

                    $is_unread = UM()->Messaging_API()->api()->unread_conversation( $conversation->conversation_id, um_profile_id() );

                     ?>
                   <li class="">
                    <a href="<?php echo site_url()."/msg?conversation_id=".$conversation->conversation_id; ?>" class="um-message-conv-item <?php if ( $conversation->conversation_id == $current_conversation ) echo 'active '; ?>" data-message_to="<?php echo $user; ?>" data-trigger_modal="conversation" data-conversation_id="<?php echo $conversation->conversation_id; ?>">

                     <div class="um-message-conv-pic usr-pro-pic"><?php echo get_avatar( $user, 40 ); ?></div>
                      <div class="user-msg">
                      <span class="um-message-conv-name usrname"><?php echo $user_name; ?></span>
                      </div>

                      <?php if ( $is_unread ) { ?>
                        <span class="um-message-conv-new"><i class="um-faicon-circle"></i></span>
                      <?php }

                      do_action( 'um_messaging_conversation_list_name' ); ?>
                    </a>
                  </li>

                <?php  } ?>
</ul>  
                <?php  die();

	}
}





			


