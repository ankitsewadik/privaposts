<?php 



if(isset($_POST) && $_POST['function_name']=='user_update_password'){


    		echo $email = trim($_POST['user_value']);
			
			if( empty( $email ) ) {
				$error = 'Enter a username or e-mail address..';
			} else if( ! is_email( $email )) {
				$error = 'Invalid username or e-mail address.';
			} else if( ! email_exists( $email ) ) {
				$error = 'There is no user registered with that email address.';
			} else {
				
				/*$random_password = wp_generate_password( 12, false );
				$user = get_user_by( 'email', $email );
				
				$update_user = wp_update_user( array (
						'ID' => $user->ID, 
						'user_pass' => $random_password
					)
				);
				
				// if  update user return true then lets send user an email containing the new password
				if( $update_user ) {
					$to = $email;
					$subject = 'Your new password';
					$sender = get_option('name');
					
					$message = 'Your new password is: '.$random_password;
					
					$headers[] = 'MIME-Version: 1.0' . "\r\n";
					$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers[] = "X-Mailer: PHP \r\n";
					$headers[] = 'From: '.$sender.' < '.$email.'>' . "\r\n";
					
					$mail = wp_mail( $to, $subject, $message, $headers );
					if( $mail )
						$success = 'Check your email address for you new password.';
						
				} else {
					$error = 'Oops something went wrong updaing your account.';
				}*/
				
			}
			
			/*if( ! empty( $error ) )
				echo '<div class="message"><p class="error"><strong>ERROR:</strong> '. $error .'</p></div>';
			
			if( ! empty( $success ) )
				echo '<div class="error_login"><p class="success">'. $success .'</p></div>';*/

            if( ! empty( $error ) )
		$data=array('status'=>0,'msg'=>$error);
	
	if( ! empty( $success ) )
		$data=array('status'=>1,'msg'=>$success);

 print_r($data);
			 //echo json_encode($data);
	die();

}


?>

