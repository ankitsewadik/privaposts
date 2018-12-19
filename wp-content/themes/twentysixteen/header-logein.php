<?php
   /**
    * The template for displaying the header
    *
    * Displays all of the head element and everything up until the "site-content" div.
    *
    * @package WordPress
    * @subpackage Twenty_Sixteen
    * @since Twenty Sixteen 1.0
    */
 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <title>Privaposts</title>
      <!-- <link href="<?php //echo get_template_directory_uri()?>/assets/css/style.css" rel="stylesheet"> -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,500" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!--[if lt IE 9]>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
      <![endif]-->
      <script type="text/javascript">
         var theme_path = '<?php echo get_template_directory_uri(); ?>';
         var is_puuser = '<?php echo is_pu_user(get_current_user_id());  ?>';
         var ajax_url= "<?php echo admin_url('admin-ajax.php'); ?>";
         var siteurl="<?php echo site_url(); ?>/"; 
         var profile_id = '<?php echo um_profile_id(); ?>';
         var pageId = "<?php echo get_the_ID(); ?>";
      </script>
      <?php wp_head(); ?>

      <?php 
         $isPuUser = (get_user_meta( um_profile_id(), 'subscription_price', true))?true:false;
         if(!$isPuUser){
           // if(is_currentUser())
           // wp_redirect(home_url('new-post')); exit;
         }
         $isPuUser = true;
         
         $subscription_price =  get_user_meta( um_profile_id(), 'subscription_price', true); 
         $subscription_price =  ($subscription_price)?$subscription_price:'0.00';
         
         ?>
   </head>


   <body <?php body_class(); ?>>

<?php if(!is_user_logged_in()){ ?>
    <header class="header" <?php if( $post->ID == 20 || $post->ID == 22) { ?> style="display:none;" <?php } ?>>
 <div class="container">
  <div class="logo-lft">
  <?php  //twentysixteen_the_custom_logo(); ?>
  <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri()?>/assets/images/privaposts-white-logo.png"></a>
  </div> 
  <div class="menu-rgt">
    
           <?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
      <?php if ( has_nav_menu( 'primary' ) ) : ?>
      <?php
        if(is_user_logged_in()){
                  wp_nav_menu( array(
              'theme_location' => 'primary',
              'menu_class'     => 'slimmenu',
            ) );
        }
      ?>
      <?php endif; ?>
      <?php endif; ?>
  </div>
 </div>
</header>
<?php } ?>

      <div class="dash-head-wrp <?php if(!$isPuUser ){ ?> login-home-dash <?php } ?>" >
         <?php   if(is_user_logged_in()){ ?>
      <div class="icon-nav-wrp">
         <div class="container">
         
            <?php get_template_part( 'template-parts/content', 'menus' ); ?>
        
         </div>
      </div>
        <?php } ?>  
      <?php 
         $current_user = get_user_by('id', um_profile_id());
         $description = get_user_meta(um_profile_id(), 'description', true );
           // echo 'Username: ' . $current_user->user_login . '<br />';
           // echo 'User email: ' . $current_user->user_email . '<br />';
           // echo 'User first name: ' . $current_user->user_firstname . '<br />';
           // echo 'User last name: ' . $current_user->user_lastname . '<br />';
           // echo 'User display name: ' . $current_user->display_name . '<br />';
           // echo 'User ID: ' . $current_user->ID . '<br />';
         ?>
      <?php if($isPuUser){ ?>
      <?php 
         $default_cover = UM()->options()->get( 'default_cover' );
           um_fetch_user(um_profile_id() ); 
              $cover_uri = um_get_cover_uri_id( um_profile( 'cover_photo' ), array());
              

  if ($cover_uri) { 

    ?>
      <?php 

         $cover_uri = um_get_cover_uri_id( um_profile( 'cover_photo' ), array());
         
         ?>
            <script type="text/javascript">
              var coverImgurl = '<?php echo $cover_uri; ?>';
          </script>

         <div class="cover-new-one" style="background-image: url(<?php  echo $cover_uri; ?>);"></div>
         <div class="cover-desktop"><img class="img-resposive coverimageurl" src="<?php  //echo $cover_uri; ?>" /></div>
      <div class="dash-user-info " >
      <?php }else if ($default_cover && $default_cover['url']) { ?>

        <div class="cover-new-one" style="background-image: url(<?php  echo $default_cover['url']; ?>);"></div>
        <div class="cover-desktop"><img class="img-resposive coverimageurl" src="<?php // echo $cover_uri; ?>" /></div>
      <div class="dash-user-info" >
         <?php }else{  
           $url = (!is_user_logged_in())?site_url().'/wp-content/uploads/ultimatemember/'.um_profile_id().'/cover_photo.jpg?1537006979':site_url().'/wp-content/uploads/dummy-cover-new.jpg';
          ?>
          <script type="text/javascript">
              var coverImgurl = '<?php echo $url; ?>';
          </script>
          <div class="cover-new-one" style="background-image: url(<?php //  echo $url; ?>);" ></div>
          <div class="cover-desktop"><img class="img-resposive coverimageurl" src="<?php // echo $url; ?>" /></div>
            <div class="dash-user-info">
            <?php } ?>

            <div class="dui-inner">
               <div class="container">
                  <div class="dash-user-info-inn topfixedh">
                     
                     <?php /* if(is_currentUser()){ ?>
                     <div class="foll-btn-top"> <a href="<?php echo home_url('edit-profile'); ?>">Edit Profile</a> </div>
                     <?php }else{ 
                        $user_id = um_profile_id();
                        
                        if ( UM()->Followers_API()->api()->followed( um_profile_id(), get_current_user_id() ) ) { ?>
                     <div class="foll-btn-top">
                     	<?php $check =  is_addedpaymentinfo(get_current_user_id()); 
                     		  $customerId = $check['customer_id'];
                     		  if(isset($customerId) && $customerId !=""){ 	?>
                     		  	<a data-toggle="modal" data-backdrop="static" data-keyboard="false" href="javascript:void(0)" data-target="#sendtipwithcard-popup" >Send a Tip</a>  
                     	<?php  }else{ ?>
                     			<a data-toggle="modal" data-backdrop="static" data-keyboard="false" href="javascript:void(0)" data-target="#sendtip-popup" >Send a Tip</a>  
                     	<?php  } ?>
                        
                     </div>
                     <?php } //send tip of subscribed?>
                     <?php 
                        } */ ?>
                     <div class="user-img-bx">

                        <div class="user-in-bx">
                          <?php  $umid = um_profile_id();

                            $loginStatus= get_user_meta( $umid, 'login_status', true);

                          if($loginStatus){ ?>
                            <div class="online-icon"></div>
                          <?php }
                          ?>
                         
                           <?php if(is_currentUser()){ ?>
                           <!-- <div class="edit-ico"><a href="#"><i class="fa fa-camera"></i></a></div>  -->
                           <?php } ?>
                           <div class="usr-img">
                              <?php echo get_avatar(  um_profile_id(), 175 ); ?>
                           </div>
                        </div>
                     </div>
                     <div class="user-info-top">
                      
                           <div class="user-name">

                            <h3><div class="user-overflow"><?php echo isset($current_user->first_name) && $current_user->first_name != ''?$current_user->first_name.' '.$current_user->last_name:$current_user->user_login; ?></div><span class="verify-user">

                           <img src="<?php echo get_template_directory_uri()?>/assets/images/tick_small_edit.png" />

                            </span>
                            </h3>


                             
                              <p>@<?php echo $current_user->user_login; ?></p>
                           </div>
                           <!-- follow button condtion -->
                       
                     </div>
                    
                     <div class="user-info-botm topfixbtm">
                       
                      
                           <div class="usr-info-list">
                              <div class="button-list">

                      <?php if(is_currentUser()){ ?>
                      				<a class="btn btn-default profilebtn blue-btn-hover" href="<?php echo home_url('edit-profile'); ?>">Edit Profile</a> 
                     <?php }else{ 
                        $user_id = um_profile_id();
                        
                        if ( UM()->Followers_API()->api()->followed( um_profile_id(), get_current_user_id() ) ) { ?>
                     
                     	<?php $check =  is_addedpaymentinfo(get_current_user_id()); 
                     		  $customerId = $check['customer_id'];
                     		  if(isset($customerId) && $customerId !=""){ 	?>
                     		  	<a class="btn btn-default sendtip blue-btn-hover" data-toggle="modal" data-backdrop="static" data-keyboard="false" href="javascript:void(0)" data-target="#sendtipwithcard-popup" ><img src="<?php echo get_template_directory_uri()?>/assets/images/dolar-w-ico.png" />Send a Tip</a>  
                     	<?php  }else{ ?>
                     			<a class="btn btn-default sendtip blue-btn-hover" data-toggle="modal" data-backdrop="static" data-keyboard="false" href="javascript:void(0)" data-target="#sendtip-popup" ><img src="<?php echo get_template_directory_uri()?>/assets/images/dolar-w-ico.png" />Send a Tip</a>  
                     	<?php  } ?>
                        
                        <a class="btn btn-default ppvbtn blue-btn-hover" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#sendppv1-popup"  href="javascript:void(0);"><img src="<?php echo get_template_directory_uri()?>/assets/images/doallar-w-ico.png" />PPV</a> 
                     
                     <?php } //send tip of subscribed?>
                     <?php 
                        } ?>


                                  <?php if(!is_currentUser() && is_pu_user(um_profile_id())){
                                    if ( UM()->Followers_API()->api()->followed( um_profile_id(), get_current_user_id() ) ) {
                                       $targetId = is_user_logged_in()?'#subscription-popup':'#loginpopup-popup'; 
                                   ?>
                                 <a href="javascript:void(0);" data-message_to="<?php echo um_profile_id(); ?>" class="um-message-btn btn btn-default msg-btn blue-btn-hover"><img src="<?php echo get_template_directory_uri()?>/assets/images/msg-w-icon.png" />
                                 Message</a>

                               

                                  <?php
                                      }
                                   } ?>

                                        <?php if ( !UM()->Followers_API()->api()->followed( um_profile_id(), get_current_user_id()) && !is_currentUser() ) {
                      if(is_pu_user(um_profile_id())){

                        $targetId = is_user_logged_in()?'#subscription-popup':'#loginpopup-popup';
                      ?>
                  
                        <a class="follow-request followclass btn btn-default blue-btn-hover"  href="javascript:void(0)" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="<?php echo $targetId; ?>" >FOLLOW  $<?php echo $subscription_price; ?></a>   
                   

                     <?php }
                        }
                      ?>

                              </div>
                              <?php  if(is_pu_user(um_profile_id())){
                                ?>
                              <ul class="usr-info-lst-bx">
                                 <li>
                                    <div class="info-heading"><?php echo count_user_posts( um_profile_id() ); ?></div>
                                    <p>Posts</p>
                                 </li>
                                 <?php 
                                     $record = get_videoimagecount(um_profile_id()); 
                                  ?>
                                 <li>
                                    <div class="info-heading">
                                      <?php echo $record['photos']; ?>
                                    </div>
                                    <p>Photos</p>
                                 </li>
                                 <li>
                                    <div class="info-heading">
                                      <?php echo $record['videos']; ?>
                                    </div>
                                    <p>Videos</p>
                                 </li>
                                  <?php
                                     $on='';
                                    $on = get_user_meta( um_profile_id(), 'like_count', true );
                                     if(is_currentUser() || $on=='on'){ ?>
                                 <li>

                                    <div class="info-heading"><?php echo get_totallikecountbyUser(um_profile_id()); ?></div>
                                    <p>Likes</p>
                                  
                                 </li>
                                      <?php } ?>

                                        <?php
                                     $on1='';
                                     $on1 = get_user_meta( um_profile_id(), 'follwer_count', true );
                                     if(is_currentUser() || $on1=='on'){ ?>

                                 <li>
                                
                                    <div class="info-heading">
                                      <?php echo UM()->Followers_API()->api()->count_followers_plain( um_profile_id() ); ?>
                                    </div>
                                    <p>Followers</p>
                               
                                 </li>
                                    <?php } ?>
                              </ul>
                            <?php } ?>
                           </div>
                       
                           
                     </div>
                
                  </div>
                  <?php 

                  $price= is_pu_user(get_current_user_id()); 

                  if(is_currentUser() && $price!='' && isset($price)){ ?>
                  <div class="new-info">
                     <ul class="fund-info">
                        <li> <img src="<?php echo get_template_directory_uri();?>/assets/images/dimond.png"> My Funds: <span>$0.00</span> </li>
                        <li> <img src="<?php echo get_template_directory_uri();?>/assets/images/note-dollar.png"> My Income: <span>$0.00</span><span>(per-month)</span> </li>
                        <li> <img src="<?php echo get_template_directory_uri();?>/assets/images/dollar.png"> My Price: <span>$<?php echo get_user_meta( um_profile_id(), 'subscription_price', true); ?></span><span>(per-month)</span> </li>
                     </ul>
                  </div>
                  <?php } ?>
               </div>
               <?php if(is_currentUser()){ ?>
                  <a href="<?php echo home_url('edit-profile/'); ?>" class="edit-btn"><i class="fa fa-pencil"></i></a> 
               <?php } ?>
            </div>
         </div>
         <?php } ?>
      </div>
<?php get_template_part( 'template-parts/content', 'subscriptionpopup' ); ?>
<?php get_template_part( 'template-parts/content', 'sendtippopup' ); ?>
<script type="text/javascript">
    $(".coverimageurl").attr("src",coverImgurl);
</script>