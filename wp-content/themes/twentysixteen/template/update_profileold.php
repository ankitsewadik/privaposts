<?php
session_start();
$id = get_current_user_id();
$user = get_user_by( 'ID', $id );
$user_login = ( $user->user_login != '' ) ? $user->user_login : '';
$user_email = ( $user->user_email != '' ) ? $user->user_email : '';

global $current_user;
$subscription_price = get_user_meta( $current_user->ID, 'subscription_price', true );
$subscription_price_val = get_user_meta( $current_user->ID, 'subscription_price_val', true );

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

 $subscription_price = ( isset( $_POST['subscription_price'] ) && $_POST['subscription_price'] != '' ) ? $_POST['subscription_price'] : '';
 $userbio = ( isset( $_POST['userbio'] ) && $_POST['userbio'] != '' ) ? $_POST['userbio'] : '';
 $user_loaction = ( isset($_POST['user_loaction'] ) && $_POST['user_loaction' ] != '' ) ? $_POST['user_loaction' ] : '';
 $user_sex = ( isset( $_POST['user_sex'] ) && $_POST['user_sex'] != '' ) ? $_POST['user_sex'] : '';
 $user_website_url = ( isset( $_POST['user_website_url'] ) && $_POST['user_website_url'] != '' ) ? $_POST['user_website_url' ]: '';
 $firtsname = ( isset( $_POST['firtsname'] ) && $_POST['firtsname'] != '' ) ? $_POST['firtsname'] : '';
 $lastname = ( isset( $_POST['lastname']) && $_POST['lastname'] != '' ) ? $_POST['lastname'] : '';
 $address = ( isset( $_POST['address']) && $_POST[ 'address' ] != '' ) ? $_POST[ 'address' ] : '';
 $dob = ( isset( $_POST['dob']) && $_POST['address'] != '' ) ? $_POST['dob'] : '';

 //print_r($_FILES);

 if ( isset( $userid ) && $userid != '' ) {
  update_user_meta( $userid, 'subscription_price', $subscription_price );
  update_user_meta( $userid, 'description', $userbio );
  update_user_meta( $userid, 'user_loaction', $user_loaction );
  update_user_meta( $userid, 'user_website_url', $user_website_url );
  update_user_meta( $userid, 'user_sex', $user_sex );
  update_user_meta( $userid, 'last_name', $lastname );
  update_user_meta( $userid, 'first_name', $firtsname );
  update_user_meta( $userid, 'address', $address );
  update_user_meta( $userid, 'dob', $dob );
  update_user_meta( $userid, 'full_name', $firtsname . " " . $lastname );



  if ( !function_exists( "wp_handle_upload" ) ) {
   require_once( ABSPATH . "wp-admin/includes/file.php" );
  }


  $movefile = wp_handle_upload( $_FILES[ 'cover_image' ], array( 'test_form' => false, 'unique_filename_callback' => 'my_custom_filename' ) );

  $movefile1 = wp_handle_upload( $_FILES[ 'profile_photo' ], array( 'test_form' => false, 'unique_filename_callback' => 'my_custom_filename' ) );


  if ( $movefile[ 'url' ] != '' ) {
   update_user_meta( $userid, 'cover_photo', $movefile[ 'url' ] );
  }
  if ( $movefile1[ 'url' ] != '' ) {
   update_user_meta( $userid, 'profile_photo', $movefile1[ 'url' ] );
  }


  //echo "User profile information have been updated successfully.";
  $_SESSION['message'] = '<div class="alert alert-success"><strong>Success!</strong> User profile information have been updated successfully.</div> ';
    wp_redirect( site_url('/edit-profile') );
  exit;

 } else {
  $_SESSION['message'] = '<div class="alert alert-danger"><strong>Success!</strong> Something goes wrong please try again</div> ';
            wp_redirect( site_url('/edit-profile') );
            exit;
 }

}

 if(isset($_SESSION['message']) && $_SESSION['message']!=''){
    echo $_SESSION['message'];
    $_SESSION['message']='';
  } 
?>
<div class="editing">
 <div class="haed-set">
  <h1>Edit Profile Setting</h1>
 </div>
 <div class="foot-btn"><a class="btn theme-btn btn-default" href="<?php echo site_url();?>/settings/">Advanced Setting</a>
 </div>
</div>
<div class="row">
 <div class="col-md-12">
  <form class="cmxform" id="edit_profile" name="edit_profile" method="post" action="" enctype="multipart/form-data">

   <input type="hidden" name="updateuser" value="updateuser">
   <div class="up-img">
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
    <div class="copy-url-wrp">
     <div class="copy-url">
      <p>YOUR PERSONAL REFERRAL URL</p>
      <input value="https://mysafestory.com/?ref=12345" id="myInput" class="form-control" type="text">
      <!-- The button used to copy the text -->
      <button onclick="myFunction()" class="btn btn-default">Copy Link</button>
     </div>
    </div>
   </div>
   <input type="hidden" name="userid" id="userid" value="<?php echo $id;?>">
   <div class="upload-img sub-prc clearfix">
    <div class="lft-con">
     <label for="exampleInputEmail1">Subscription Price</label>
    </div>
    <?php 
                                    if($subscription_price_val && $subscription_price_val=='off'){
                                      $disabled='readonly';
                                    }else{
                                      $disabled='';
                                    }
                                    ?>
    <div class="rt-con smal">
     <input type="text" class="form-control" placeholder="00.00" name="subscription_price" id="subscription_price" value="<?php echo $subscription_price;?>" <?php echo $disabled;?>>
     <span>USD per month</span>
     <div class="p-text">
      <p>*Subscription price required in order to post content. Money earned will be kept in a holding account until you <a href="<?php echo site_url()?>/become-creator">Enter Bank Details</a> to collect your money. By setting a subscription price, you confirm you are at least 18 years old and agree to our terms &amp; conditions for posting content</p>
     </div>
    </div>
   </div>
   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">User name</label>
    </div>
    <div class="rt-con larg">
     <input type="text" name="username" id="username" class="form-control" placeholder="" disabled="true" value="<?php echo $user_login;?>">
     <span>https://privaposts.com</span> </div>
   </div>
    <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Email address</label>
    </div>
    <div class="rt-con larg">
     <input type="email" name="useremail" id="useremail" class="form-control" id="3" placeholder="" disabled="true" value="<?php echo $user_email;?>">
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

   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Bio</label>
    </div>
    <div class="rt-con larg">
     <textarea class="form-control" rows="3" name="userbio" id="userbio" required><?php echo $userbio; ?></textarea>
     <span>(200 characters)</span> </div>
   </div>

   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Dob</label>
    </div>
    <div class="rt-con larg">
     <input type="text" name="dob" id="dob" class="form-control datePicker" placeholder="" value="<?php echo $dob;?>">
    </div>
   </div>

   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Address</label>
    </div>
    <div class="rt-con larg">

     <textarea class="form-control" rows="3" name="address" id="address" required><?php echo $address; ?></textarea>


    </div>
   </div>



  
   <div class="upload-img clearfix">
    <div class="lft-con">
     <label for="3">Website URL</label>
    </div>
    <div class="rt-con larg">
     <input type="text" class="form-control" placeholder="" name="user_website_url" id="user_website_url" value="<?php echo $user_website_url;?>">
    </div>
   </div>
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
                                      ?>
     <input type="radio" name="user_sex" value="male" <?php echo $checked1; ?> > Male
     <input type="radio" name="user_sex" value="female" <?php echo $checked2; ?>> Fermale
    </div>
   </div>
   <span class="return_msg"></span>
   <div class="upload-img clearfix">
    <div class="lft-con"> </div>
    <div class="rt-con larg">
     <div class="sub-btn">
      <div class="btns clearfix">
       <button type="button" class="btn btn-default cancel cancel-btn" data-dismiss="modal">Cancel</button>
       <button type="submit" class=" btn btn-default save">Submit</button>
      </div>
     </div>
    </div>
   </div>
  </form>
 </div>
</div>