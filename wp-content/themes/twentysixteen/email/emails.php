<?php 


function sendCustomEmail($type = 0, $toemail = "", $data = array()){
	    $subject = '';
		$body = '';

	  switch ($type) {
		
		case '1': // New subscription email to SU
			$subject = 'New subscription to '.$data['pu_name'].'';
			$body = 'Congratulations!<br>
				 You have successfully subscribed to '.$data['pu_name'].' for $'.$data['amount'].' USD per month.<br>
				 Please note as this is a monthly subscription, your payment card
				 will be re-billed monthly. Any payments made will appear on
				 your bank statement as Privaposts.';		
		break;
		case '2': // New subscription email to PU
			$subject = 'You have a new follower '.$data['su_name'];
			$body = 'Congratulations '.$data['pu_name'].'!<br>
				'.$data['su_name'].' has just subscribed to your
				Privaposts profile for $'.$data['amount'].' USD per month.';		
		break;	  
		case '3': // Sent tip to PU
			$subject = '$'.$data['amount'].' USD Tip Received from '.$data['su_name'];
			$body = 'Congratulations '.$data['pu_name'].'!<br>
				You have received a tip for $'.$data['amount'].' USD from '.$data['su_name'].'.
				View tip now and thank '.$data['su_name'].' for their support :)';	 	
		break;
		case '4': // New PPV request from SU to PU
			$subject = 'New Pay Per View request for $'.$data['su_name'].' from '.$data['su_name'];
			$body = 'Congratulations '.$data['pu_name'].'!<br>
				You have a new Pay Per View message request for $'.$data['su_name'].' from '.$data['su_name'].'.';	 	
		break;		
	}
    	$to = $toemail;
		$headers = array('Content-Type: text/html; charset=UTF-8');
		wp_mail( $to, $subject, $body, $headers );
}