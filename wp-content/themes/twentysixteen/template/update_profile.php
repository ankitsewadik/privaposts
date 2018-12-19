<?php
session_start();
$id = get_current_user_id();
$user = get_user_by( 'ID', $id );
$user_login = ( $user->user_login != '' ) ? $user->user_login : '';
$user_email = ( $user->user_email != '' ) ? $user->user_email : '';

global $current_user;
$subscription_price = get_user_meta( $current_user->ID, 'subscription_price', true );
$subscription_price_val = get_user_meta( $current_user->ID, 'subscription_price_val', true );

$userdata= wp_get_current_user(); 
$userdata1=$userdata->data;
$usernameval=$userdata1->user_login;


$userbio = get_user_meta( $current_user->ID, 'description', true );
$user_loaction = get_user_meta( $current_user->ID, 'user_loaction', true );
$user_sex = get_user_meta( $current_user->ID, 'user_sex', true );
$user_website_url = get_user_meta( $current_user->ID, 'user_website_url', true );
$lastname = get_user_meta( $current_user->ID, 'last_name', true );
$firtsname = get_user_meta( $current_user->ID, 'first_name', true );
$address = get_user_meta( $current_user->ID, 'address', true );
$dob = get_user_meta( $current_user->ID, 'dob', true );
$profile_photo = get_user_meta( $current_user->ID, 'profile_photo', true );
$user_cover_photo = get_user_meta( $current_user->ID, 'cover_photo', true );
$userid = ( isset( $_POST[ 'userid' ] ) && $_POST[ 'userid' ] != '' ) ? $_POST[ 'userid' ] : '';


if ( isset( $user_cover_photo ) && $user_cover_photo != '' ) {
 $coverimageurl = $user_cover_photo;
} else {
 $coverimageurl = get_template_directory_uri() . "/assets/images/up-img-user.png";
}


if ( isset( $profile_photo ) && $profile_photo != '' ) {
 $profile_photo = $profile_photo;
} else {
 $profile_photo = get_template_directory_uri() . "/assets/images/up-img-user.png";
}

// print_r($_POST);

if ( isset( $_POST['updateuser'] ) && $_POST['updateuser'] != '' && $_POST['updateuser'] =='updateuser') {


 $userbio = ( isset( $_POST['userbio'] ) && $_POST['userbio'] != '' ) ? $_POST['userbio'] : '';
 $user_loaction = ( isset($_POST['user_loaction'] ) && $_POST['user_loaction' ] != '' ) ? $_POST['user_loaction' ] : '';
 $user_sex = ( isset( $_POST['user_sex'] ) && $_POST['user_sex'] != '' ) ? $_POST['user_sex'] : '';
 $user_website_url = ( isset( $_POST['user_website_url'] ) && $_POST['user_website_url'] != '' ) ? $_POST['user_website_url' ]: '';
 $firtsname = ( isset( $_POST['firtsname'] ) && $_POST['firtsname'] != '' ) ? $_POST['firtsname'] : '';
 $lastname = ( isset( $_POST['lastname']) && $_POST['lastname'] != '' ) ? $_POST['lastname'] : '';
 $address = ( isset( $_POST['address']) && $_POST[ 'address' ] != '' ) ? $_POST[ 'address' ] : '';
 $dob = ( isset( $_POST['dob']) && $_POST['address'] != '' ) ? $_POST['dob'] : '';
 $useremail = ( isset( $_POST['useremail']) && $_POST['useremail'] != '' ) ? $_POST['useremail'] : '';
 $username = ( isset( $_POST['username']) && $_POST['username'] != '' ) ? $_POST['username'] : '';
 
 //print_r($_FILES);

 if ( isset( $userid ) && $userid != '' ) {

   global $wpdb;  
   $users_table = $wpdb->prefix . "users";
   $userQuery1 = $wpdb->get_row("SELECT ID FROM ".$users_table." where user_email='".$useremail."' AND ID !='".$userid."'" );
   
   $userQuery2 = $wpdb->get_row("SELECT ID FROM ".$users_table." where user_login='".$username."' AND ID !='".$userid."'" );

   if($userQuery1){
        $_SESSION['message'] = '<div class="alert alert-danger"><strong>Error!</strong> This email already exists please try again.</div> ';
            wp_redirect( site_url('/edit-profile/') );
            exit;
   }else if($userQuery2){

       $_SESSION['message'] = '<div class="alert alert-danger"><strong>Error!</strong> This username already exists please try again.</div> ';
       wp_redirect( site_url('/edit-profile/') );
       die();
   }else{ 
        if ( is_wp_error( $user_data ) ) {
           
            $_SESSION['message'] = "<div class='alert alert-danger'><strong>Error!</strong> There was an error, probably that user doesn't exist.</div> ";
            wp_redirect( site_url('/edit-profile/') );
            exit;

        } else {

            $display_name = $firtsname." ".$lastname;
            $user_data = wp_update_user( array( 'ID' => $userid, 'user_email' => $useremail, 'display_name'=>$display_name) );
            $updateusername=$wpdb->update($wpdb->users, array('user_login' => $username), array('ID' => $userid));
            //update_user_meta( $userid, 'subscription_price', $subscription_price );
          

            update_user_meta( $userid, 'description', $userbio );
            update_user_meta( $userid, 'user_loaction', $user_loaction );
            update_user_meta( $userid, 'user_website_url', $user_website_url );
            update_user_meta( $userid, 'user_sex', $user_sex );
            update_user_meta( $userid, 'last_name', $lastname );
            update_user_meta( $userid, 'first_name', $firtsname );
            update_user_meta( $userid, 'address', $address );
            update_user_meta( $userid, 'dob', $dob );
            
            //update_user_meta( $userid, 'um_user_profile_url_slug_user_login', $username);

              if($updateusername){
              $_SESSION['message'] = '<div class="alert alert-success"><strong>Success!</strong> User name updated successfully.Please login by updated user name.</div> ';
                  wp_redirect( site_url('/profile') );
                  exit;
              }else{
                $_SESSION['message'] = '<div class="alert alert-success"><strong>Success!</strong> Settings updated.</div> ';
                   wp_redirect( site_url('/edit-profile/') );
                   exit;
              }   
        }
   }

 } else {
  $_SESSION['message'] = "<div class='alert alert-danger'><strong>Error!</strong> There was an error, probably that user doesn't exist.</div> ";
            wp_redirect( site_url('/edit-profile/') );
            exit;
 }

}

if ( isset( $_POST['updateuser_sub'] ) && $_POST['updateuser_sub'] != '' && $_POST['updateuser_sub'] =='updateusersub') {

  if ( isset( $userid ) && $userid != '' ) {
            
        $added_subscription_price = ( isset( $_POST['added_subscription_price']) && $_POST['added_subscription_price'] != '' ) ? $_POST['added_subscription_price'] : '';
         

        $subscription_price = ( isset( $_POST['subscription_price1'] ) && $_POST['subscription_price1'] != '' ) ? $_POST['subscription_price1'] : '';


            update_user_meta( $userid, 'subscription_price',  number_format((float)$subscription_price, 2, '.', ''));

             if(($added_subscription_price == '' || $added_subscription_price =='0.00') && ($subscription_price!='' && $subscription_price !='0.00')){
                
                $_SESSION['message'] = '<div class="alert alert-success"><strong>Success!</strong> Congratulations you are now a Privapost content creator, have fun and earn easy money.</div> ';
                  wp_redirect( site_url('/edit-profile/') );
                  exit;

              }else{
                $_SESSION['message'] = '<div class="alert alert-success"><strong>Success!</strong> Settings updated.</div> ';
                   wp_redirect( site_url('/edit-profile/') );
                   exit;
              }   
  }else{
     $_SESSION['message'] = "<div class='alert alert-danger'><strong>Error!</strong> There was an error, probably that user doesn't exist.</div> ";
            wp_redirect( site_url('/edit-profile/') );
            exit;
  }            
}

if ( isset( $_POST['updateuser_image'] ) && $_POST['updateuser_image'] != '' && $_POST['updateuser_image'] =='updateuserimage') {
    $current_user = wp_get_current_user();
wp_update_user( array( 'ID' => $current_user->ID, 'user_email' => $current_user->user_email) );

    $_SESSION['message'] = '<div class="alert alert-success"><strong>Success!</strong> Settings updated.</div> ';
                   wp_redirect( site_url('/edit-profile/') );
                   exit;
}


 if(isset($_SESSION['message']) && $_SESSION['message']!=''){
    echo $_SESSION['message'];
    $_SESSION['message']='';
  } 
?>
<div class="editing">
 <div class="haed-set">
  <h1>Edit Profile Settings</h1>
 </div> 
 <div class="advance-btn text-center"><a class="btn btn-default theme-btn" href="<?php echo site_url();?>/settings/">Advanced Settings</a>
 </div>
</div>

<div class="row">
 <div class="col-md-12">
  <div class="copy-url-wrp">
     <div class="copy-url">
      <p>YOUR PERSONAL REFERRAL URL</p>
      <?php 
       $encodeid= numhash(get_current_user_id());
       $refurl= site_url()."/".$usernameval."?refid=".$encodeid; ?>
      <input value="<?php echo $refurl; ?>" id="referralurl" class="form-control" type="text">
      <!-- The button used to copy the text -->
      <button onclick="Copyurl()" class="btn btn-default blue-btn-hover">Copy Link</button>
     </div>
  </div>

<form class="cmxform" id="edit_profile_image" name="edit_profile_image" method="post" action="" enctype="multipart/form-data"> 
  <input type="hidden" name="updateuser_image" value="updateuserimage">
   <input type="hidden" name="userid" id="userid" value="<?php echo $id;?>">

   <div class="edit-form-copy-url bx-bg-shadow">
    <div class="img-cover-prof">
     <div class="profilebox">
      <div class="upload-img profile-edit-pic">
       <p>Profile</p>
       <div class="upload-img-bx">
        <?php echo do_action( 'um_profile_header', array() ); ?>
       </div>
       
      </div>
      <div class="upload-img cover-edit-pic">
       <p>Cover</p>
       <div class="upload-img-bx">
        <?php do_action( 'um_profile_header_cover_area', array('cover_enabled' =>1)  ); ?>
       </div>
       
      </div>
     </div>
    </div>
    
    <div class="save-profile-pics clearfix">
     <div class="col-md-7">
      <p>*Profile images must  not contain nudity or explicit material.</p>

     </div> 
     <div class="col-md-5 text-right">      
      <a href="#" class="btn btn-default btn-cncl cancel-btn blue-btn-hover">Cancel</a>      
      <button type="submit" class="btn btn-default btn-save blue-btn-hover">Save Changes</button>   
     </div>
    </div>
</div>
</form>


  <form class="cmxform" id="edit_subscription" name="edit_subscription" method="post" action="" enctype="multipart/form-data">  
   <input type="hidden" name="updateuser_sub" value="updateusersub">
   <input type="hidden" name="userid" id="userid" value="<?php echo $id;?>">
   <div class="upload-img sub-prc  bx-bg-shadow clearfix">
    <div class="lft-con">
     <label for="exampleInputEmail1">Subscription Price ($)<span class="mandatory-star">*</span></label>
    </div>
    <?php 
                                    if($subscription_price_val && $subscription_price_val=='off'){
                                      $disabled='';
                                    }else{
                                      $disabled='';
                                    }
                                    ?>
    <div class="rt-con smal entr-price">
     <input type="text" class="form-control subscription_price" placeholder="$0.00" name="subscription_price1" id="subscription_price1" value="<?php echo $subscription_price;?>" <?php echo $disabled;?>>
     <input type="hidden" name="added_subscription_price" id="added_subscription_price" value="<?php echo @$subscription_price;?>">
     <span>USD per month</span>
     <button type="submit" class="btn save-price theme-btn blue-btn-hover">Save Price</button>
     
    </div>
    <div class="p-text">
      <p>*Subscription price required in order to post content. Money earned will be kept in a holding account until you <a href="<?php echo site_url()?>/become-creator">Enter Bank Details</a> to collect your money. By setting a subscription price, you confirm you are at least 18 years old and agree to our terms &amp; conditions for posting content</p>
     </div>
   </div>
</form>



 <form class="cmxform" id="edit_profile" name="edit_profile" method="post" action="" enctype="multipart/form-data">  
   <input type="hidden" name="updateuser" value="updateuser">
   <input type="hidden" name="userid" id="userid" value="<?php echo $id;?>">

  <div class="bx-bg-shadow">
   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Username</label>
     <label for="st"><span class="mandatory-star">*</span></label>
    </div>
    <div class="rt-con larg">
     <input type="text" name="username" id="username" class="form-control" placeholder=""  value="<?php echo $user_login;?>">
     <span><?php 
     
  echo site_url()."/".$usernameval;
     ?></span> </div>
   </div>
    <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Email address</label>
     <label for="st"><span class="mandatory-star">*</span></label>
    </div>
    <div class="rt-con larg">
     <input type="email" name="useremail" id="useremail" class="form-control" id="3" placeholder=""  value="<?php echo $user_email;?>">
    </div>
   </div>
  
   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">First name</label>
    </div>
    <div class="rt-con larg">
     <input type="text" name="firtsname" id="firtsname" class="form-control" placeholder="" value="<?php echo $firtsname;?>">
    </div>
   </div>


   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Last name</label>
    </div>
    <div class="rt-con larg">
     <input type="text" name="lastname" id="lastname" class="form-control" placeholder="" value="<?php echo $lastname;?>">
    </div>
   </div>

    <?php 
     $subscribe_user_ids = UM()->Followers_API()->api()->following(get_current_user_id());
     $puuser=is_pu_user(get_current_user_id());
     if($puuser || !empty($subscribe_user_ids)){
    ?>
      <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Website URL</label>
    </div>
    <div class="rt-con larg">
     <input type="text" class="form-control" placeholder="" name="user_website_url" id="user_website_url" value="<?php echo $user_website_url;?>">
    </div>
   </div>

    <?php 
     }
    ?>
 

   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Bio</label>
    </div>
    <div class="rt-con larg">
     <textarea class="form-control" rows="3" name="userbio" id="userbio" maxlength="1000"><?php echo $userbio; ?></textarea>
     <span>(1000 characters)</span> </div>
   </div>

   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">D.O.B</label>
    </div>
    <div class="rt-con larg">
     <input type="text" name="dob" id="dob" class="form-control datePicker" placeholder="" value="<?php echo $dob;?>">
    </div>
   </div>
   <?php /*?>
   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Address</label>
    </div>
    <div class="rt-con larg">

     <textarea class="form-control" rows="3" name="address" id="address" ><?php echo $address; ?></textarea>


    </div>
   </div>
  <?php */ ?>


  
   
   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Location</label>
    </div>
    <div class="rt-con larg">

     <?php
     $countryDropdown = countryDropdown();
     ?>
     <select class="form-control" id="user_loaction" name="user_loaction">
      <option value="">Select Location</option>
      <?php foreach ($countryDropdown as $value) {?>
      <option <?php if($value->sortname==$user_loaction){?> selected <?php } ?> value="<?php echo $value->sortname?>"><?php echo $value->name;?></option>
      <?php } ?>
     </select>
    </div>
   </div>
   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Gender</label>
    </div>
    <div class="rt-con larg">
     <?php 
                                      if($user_sex && $user_sex=='male'){
                                        $checked1='checked';
                                      }else{
                                        $checked1 ='';
                                      }
                                      if($user_sex && $user_sex=='female'){
                                        $checked2='checked';
                                      }else{
                                         $checked2='';
                                      }

                                      if($checked1=='' && $checked2==''){
                                         $checked1='checked';
                                      }


                                      ?>
     <input type="radio" name="user_sex" value="male" <?php echo $checked1; ?> > Male
     <input type="radio" name="user_sex" value="female" <?php echo $checked2; ?>> Female
    </div>
   </div>
   <span class="return_msg"></span>
     <div class="upload-img clearfix">
     <div class="lft-con"></div>
     <div class="rt-con larg">
       <div class="sub-btn">
        <div class="btns clearfix">
         <button type="button" class="btn btn-default cancel cancel-btn blue-btn-hover" data-dismiss="modal">Cancel</button>
         <button type="submit" class=" btn btn-default save blue-btn-hover">Save</button>
        </div>
       </div>
      </div>
     </div>

 </div>
   
  
 </div>
</div>
    </form>