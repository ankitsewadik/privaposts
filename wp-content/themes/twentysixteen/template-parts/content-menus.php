<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
 <div class="row">
    <div class="col-md-12">
     <ul class="icon-nav">
    <?php
    global $post;
    $post_slug=$post->post_name;
    $class1='';$class2='';$class3='';
     switch ($post_slug) {
       case 'home':
         $class1="active";
         break;
        case 'my-notification':
         $class2="active";
         break;
         case 'new-post':
         $class3="active";
         break;  
        case 'messages':
         $class5="active";
         break;    
       default:
         $class4="active";
         break;

     }

     $notifications = UM()->Notifications_API()->api()->get_notifications( 100,TRUE );
     ?>


      <li class="<?php echo $class1; ?>"><a href="<?php echo home_url('home'); ?>" class="icon1"></a></li>
      <li class="<?php echo $class2; ?>"><a href="<?php echo home_url('my-notification'); ?>" class="icon2">
        <?php if(count($notifications)>1){?>
        <span class="red-notify"><?php echo count($notifications); ?></span>
      <?php } ?>
      </a></li>
      <li class="<?php echo $class3; ?>"><a href="<?php echo home_url('new-post'); ?>" class="icon3"></a></li>
      <li  class="<?php echo $class5; ?>" ><a href="<?php echo home_url('messages'); ?>" class="icon4"></a></li>
      <li class="dropdown <?php echo $class4;?>">

        <a href="#" class="icon5 user-logged-in" type="button" data-toggle="dropdown" style="background: url();" aria-expanded="false">
          <?php
            echo get_avatar( um_user( 'ID' ), 175, '', '', array('class' => 'myclass') );   
          ?>
        </a>
       <ul class="dropdown-menu">
        <li><a href="<?php  echo um_user_profile_url(get_current_user_id());  ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dash-link-1.png" alt="">View Profile</a></li>
        <li><a href="<?php echo home_url('edit-profile'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dash-link-2.png" alt="">My Settings</a></li>
        <li><a href="<?php echo home_url('become-creator'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dash-link-3.png" alt="">Become Creator (Earn $)</a></li>
       
      <?php $price = is_pu_user(get_current_user_id()); 
         if(isset($price) && $price){
          ?>
          <li><a href="<?php echo home_url('performance'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dash-link-4.png" alt="">Performance</a></li>
        <li><a href="<?php echo home_url('followers'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dash-link-5.png" alt="">Followers</a></li>
         <?php } ?>
        
        <li><a href="<?php echo home_url('following'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dash-link-6.png" alt="">Following</a></li>
        <li><a href="<?php echo home_url('my-referrals'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dash-link-7.png" alt="">My Referrals</a></li>
        <li><a href="<?php echo home_url('payment-details'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dash-link-8.png" alt="">Payment Details</a></li>
        <li><a href="<?php echo home_url('contact'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dash-link-9.png" alt="">Contact Us</a></li>
        <li><a href="<?php echo home_url('logout'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dash-link-10.png" alt="">Logout</a></li>
       </ul>
      </li>
     </ul>
    </div>
   </div>