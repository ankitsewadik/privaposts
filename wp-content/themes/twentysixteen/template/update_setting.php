<?php
     session_start();
     global $current_user; 
     $follwer_count = get_user_meta( $current_user->ID, 'follwer_count', true );
     $like_count = get_user_meta( $current_user->ID, 'like_count', true );
     $my_tag = get_user_meta( $current_user->ID, 'my_tag', true );
     $my_interested_tag = get_user_meta( $current_user->ID, 'my_interested_tag', true );
     $new_subscriber = get_user_meta( $current_user->ID, 'new_subscriber', true );
     $subscription_price = get_user_meta( $current_user->ID, 'subscription_price_val', true );
     $new_tip = get_user_meta( $current_user->ID, 'new_tip', true );
     $new_private_message = get_user_meta( $current_user->ID, 'new_private_message', true );
     $new_referral = get_user_meta( $current_user->ID, 'new_referral', true );
     
if(isset($_POST['advancesetting']) && $_POST['advancesetting']=='advancesetting'){ 
    $follwer_count=(isset($_POST['follwer_count']))?$_POST['follwer_count']:'off';
    $like_count=(isset($_POST['like_count']))?$_POST['like_count']:'off';
    
    $my_tag=(isset($_POST['my_tag']))?$_POST['my_tag']:'';
    $my_interested_tag=(isset($_POST['my_interested_tag']))?$_POST['my_interested_tag']:'';
    $new_subscriber=(isset($_POST['new_subscriber']))?$_POST['new_subscriber']:'off';
    $subscription_price=(isset($_POST['subscription_price']))?$_POST['subscription_price']:'off';
    $new_tip=(isset($_POST['new_tip']))?$_POST['new_tip']:'off';
    $new_private_message=(isset($_POST['new_private_message']))?$_POST['new_private_message']:'off';
    $new_referral=(isset($_POST['new_referral']))?$_POST['new_referral']:'off';
    $userid = get_current_user_id();        
 
        if(isset($userid)){

            
            update_user_meta( $userid, 'follwer_count', $follwer_count);
            update_user_meta( $userid, 'like_count', $like_count);
            update_user_meta( $userid, 'my_tag', $my_tag);
            update_user_meta( $userid, 'my_interested_tag', $my_interested_tag);
            update_user_meta( $userid, 'new_subscriber', $new_subscriber);
            update_user_meta( $userid, 'subscription_price_val', $subscription_price);
            update_user_meta( $userid, 'new_tip', $new_tip);
            update_user_meta( $userid, 'new_private_message', $new_private_message);
            update_user_meta( $userid, 'new_referral', $new_referral);
            wp_update_user($userdata);
            $_SESSION['message'] = '<div class="alert alert-success"><strong>Success!</strong> Advanced setting updated successfully.</div> ';

        }else{
            $_SESSION['message'] = '<div class="alert alert-danger"><strong>Error!</strong> Some thin goes wrong please try again latter.</div>';
        }


}else{
  $_SESSION['message']='';
}
if(isset($_SESSION['message']) && $_SESSION['message']!=''){
 echo $_SESSION['message'];   
}
?>

<div class="haed-set">
<h1>Advanced Settings</h1>
</div>
<form id="advance_setting" name="advance_setting" action="" method="post">
<input type="hidden" name="advancesetting" id="advancesetting" value="advancesetting">
    <div class="set-panels">
        <div class="panel panel-default">
            <div class="panel-heading">
               Profile statistics visible to other users
            </div>
            <div class="panel-body">

                <div class="Chat-wrap"> <span>Show Followers Count</span>
                    <label class="switch">
                        <input type="checkbox" <?php  if(isset($follwer_count) && $follwer_count=='on'){ ?>  checked=""; <?php } ?> name="follwer_count" id="follwer_count">
                        <span class="slider round"></span> </label>
                </div>

                <div class="Chat-wrap"> <span>Show Likes Count</span>
                    <label class="switch">
                        <input type="checkbox" <?php  if(isset($like_count) && $like_count=='on'){ ?>  checked=""; <?php } ?> name="like_count" id="like_count">
                        <span class="slider round"></span> </label>
                </div>

            </div>
        </div>
    </div>
    <div class="set-panels">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tags
            </div>
            <div class="panel-body clearfix">
                <div class="area-box pull-left">
                    <div class="form-group">
                        <label>My Tags</label>
                        <textarea class="form-control" rows="3" name="my_tag" id="my_tag"><?php echo $my_tag; ?></textarea>
                    </div>
                </div>
                <div class="area-box pull-right">
                    <div class="form-group">
                        <label>Tags I'm Interested in</label>
                        <textarea class="form-control" rows="3"  name="my_interested_tag" id="my_interested_tag"><?php echo $my_interested_tag; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="set-panels">






        <div class="panel panel-default">
            <div class="panel-heading">
                Email Notifications
            </div>
            <div class="panel-body">

                <div class="Chat-wrap"> <span>New Subscriber</span>
                    <label class="switch">
                        <input type="checkbox"  <?php  if(isset($new_subscriber) && $new_subscriber=='on'){ ?>  checked=""; <?php } ?> name="new_subscriber" id="new_subscriber">
                        <span class="slider round"></span> </label>
                </div>
                <div class="Chat-wrap"> <span>Subscription Price Change</span>
                    <label class="switch">
                        <input type="checkbox" <?php  if(isset($subscription_price) && $subscription_price=='on'){ ?>  checked=""; <?php } ?>  name="subscription_price" id="subscription_price">
                        <span class="slider round"></span> </label>
                </div>
                <div class="Chat-wrap"> <span>New Tip</span>
                    <label class="switch">
                        <input type="checkbox" <?php  if(isset($new_tip) && $new_tip=='on'){ ?>  checked=""; <?php } ?>  name="new_tip" id="new_tip">
                        <span class="slider round"></span> </label>
                </div>
                <div class="Chat-wrap"> <span>New Private Message</span>
                    <label class="switch">
                        <input type="checkbox" <?php  if(isset($new_private_message) && $new_private_message=='on'){ ?>  checked=""; <?php } ?>  name="new_private_message" id="new_private_message">
                        <span class="slider round"></span> </label>
                </div>
                <div class="Chat-wrap"> <span>New Referral</span>
                    <label class="switch">
                        <input type="checkbox" <?php  if(isset($new_referral) && $new_referral=='on'){ ?>  checked=""; <?php } ?>  name="new_referral" id="new_referral">
                        <span class="slider round"></span> </label>
                </div>
            </div>
        </div>
    </div>
  
    <div class="sub-btn">
        <div class="btns clearfix">
            <button type="button" class="btn btn-default cancel cancel-btn blue-btn-hover" data-dismiss="modal">Cancel</button>
            <button type="submit" class=" btn btn-default save blue-btn-hover">Save</button>
        </div>
    </div>
</form>
<?php
if(isset($_POST['updatepassword']) && $_POST['updatepassword']=='updatepassword'){

    $id = get_current_user_id();
    $user = get_user_by( 'ID', $id );
    $old_pass=$_POST['old_pass'];
    $new_pass=$_POST['new_pass'];

    if ( $user && wp_check_password( $old_pass, $user->data->user_pass, $user->ID) ){
        $userdata = array(
                    'ID'           => $user->ID,
                    'user_pass'   => esc_attr($_POST['new_pass']),
                    ); 
        wp_update_user($userdata);
        
         $_SESSION['message'] = '<div class="alert alert-success"><strong>Success!</strong> Password updated successfully.</div>';

        }else{
            $_SESSION['message'] = '<div class="alert alert-danger"><strong>Error!</strong> Old password does not match please enter correct password.</div>';
        }
    }else{
       $_SESSION['message']=''; 
    }
?>

<br><br>
<?php
  if(isset($_SESSION['message']) && $_SESSION['message']!=''){
    echo $_SESSION['message'];
  }
 ?>
<form id="change_password" name="change_password" action="" method="post">
 
  <div class="set-panels">
        <input type="hidden" name="updatepassword" id="updatepassword" value="updatepassword">
        

        <div class="panel panel-default">
        <div class="panel-heading"> Password </div>
        <div class="panel-body clearfix">
         <div class="row">
         <div class=" pass-bx col-md-4">
          <div class="form-group">
           <label for="exampleInputEmail1">Current Password</label>
           <label for="st"><span class="mandatory-star">*</span></label>
           <input type="text" class="form-control" id="old_pass" name="old_pass"  placeholder="">
          </div>
         </div>
         <div class="pass-bx col-md-4">
          <div class="form-group">
           <label for="exampleInputEmail1">New Password</label>
           <label for="st"><span class="mandatory-star">*</span></label>
           <input type="text" class="form-control" id="new_pass" name="new_pass" placeholder="">
          </div>
         </div>
         <div class=" pass-bx col-md-4">
          <div class="form-group">
           <label for="exampleInputEmail1">Confirm New Password</label>
           <label for="st"><span class="mandatory-star">*</span></label>
           <input type="text" class="form-control" id="new_cnf_pass" name="new_cnf_pass"  placeholder="">
          </div>
         </div>
         </div> 
         <div class="btn-pas">
          <button type="submit" class="btn theme-btn btn-default blue-btn-hover">Change Password</button>
         </div>
        </div>
       </div>


       
    </div>
</form>    