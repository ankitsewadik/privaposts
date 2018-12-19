 <?php 
    $um_profile_id = numhash($_GET['ref']);
   // $url = (!is_user_logged_in())?site_url().'/wp-content/uploads/ultimatemember/'.$um_profile_id.'/cover_photo.png?1537006979':site_url().'/wp-content/uploads/dummy-cover-new.jpg';
    $url = (!is_user_logged_in())?site_url().'/wp-content/uploads/ultimatemember/'.$um_profile_id.'//cover_photo.png?1537006979':site_url().'/wp-content/uploads/dummy-cover-new.jpg';
    $current_user = get_user_by('id', $um_profile_id);
    $description = get_user_meta($um_profile_id, 'description', true );

    $subscription_price =  get_user_meta( $um_profile_id, 'subscription_price', true); 
    $subscription_price =  ($subscription_price)?$subscription_price:'0.00';

 ?>
<header class="header">
   <div class="container">
      <div class="logo-lft">
         <a href="<?php echo site_url(); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/privaposts-white-logo.png">
        </a>
      </div>
      <div class="menu-rgt"></div>
   </div>
</header>
       
<div class="dash-head-wrp ">
   <div class="cover-new-one" style="background-image: url(<?php echo $url; ?>"></div>
   <div class="cover-desktop">
   <img class="img-resposive" src="<?php echo $url; ?>">
  </div>
   <div class="dash-user-info ">
      <div class="dui-inner">
         <div class="container">
            <div class="dash-user-info-inn topfixedh">
               <div class="user-img-bx">
                  <div class="user-in-bx">
                    <?php  $umid = $um_profile_id;

                            $loginStatus= get_user_meta( $umid, 'login_status', true);

                          if($loginStatus){ ?>
                            <div class="online-icon"></div>
                          <?php }
                          ?>

                     <div class="usr-img">
                         <?php echo get_avatar(  $um_profile_id, 175 ); ?>                    
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
                        <a class="follow-request followclass btn btn-default blue-btn-hover" href="javascript:void(0)" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#loginpopup-popup">FOLLOW  $<?php echo $subscription_price; ?></a>   
                     </div>
                     <ul class="usr-info-lst-bx">
                                 <li>
                                    <div class="info-heading"><?php echo count_user_posts( $um_profile_id ); ?></div>
                                    <p>Posts</p>
                                 </li>
                                 <?php 
                                     $record = get_videoimagecount($um_profile_id); 
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
                                    $on = get_user_meta( $um_profile_id, 'like_count', true );
                                     if(is_currentUser() || $on=='on'){ ?>
                                 <li>

                                    <div class="info-heading"><?php echo get_totallikecountbyUser($um_profile_id); ?></div>
                                    <p>Likes</p>
                                  
                                 </li>
                                      <?php } ?>

                                        <?php
                                     $on1='';
                                     $on1 = get_user_meta( $um_profile_id, 'follwer_count', true );
                                     if($on1=='on'){ ?>

                                 <li>
                                
                                    <div class="info-heading">
                                      <?php echo UM()->Followers_API()->api()->count_followers_plain( $um_profile_id ); ?>
                                    </div>
                                    <p>Followers</p>
                               
                                 </li>
                                    <?php } ?>
                              </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="dash-cnt-wrp">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="dash-content">
               <div class="mybio-cst">
                  <h4>My Bio:</h4>
                  <div class="more">
                    <?php echo $description; ?>
                  </div>
               </div>
            </div>
    <?php 
                      
      $args = array(
                'author'        =>  $um_profile_id, 
                'orderby'       =>  'post_date',
                'order'         =>  'ASC',
          );

      $current_user_posts = get_posts( $args );
      $total = count($current_user_posts);

    ?>        
            <!-- Row Started for post --> 
            <div id="load-comments">
              
               <div class="post-box post-box-follow" id="post_624">
                  <div class="col-md-12">
                     <div class="user-info clearfix">
                        <div class="info-lft pull-left">
                           <div class="usr-img img-div">
                             <?php echo get_avatar(  $um_profile_id, 178 ); ?>                             
                           </div>
                           <div class="user-name">
                              <p><?php echo isset($current_user->first_name) && $current_user->first_name != ''?$current_user->first_name.' '.$current_user->last_name:$current_user->user_login; ?><span><a href="https://privaposts.vn.cisinlive.com/ankit/">@<?php echo $current_user->user_login; ?></a></span></p>
                           </div>
                        </div>
                        <div class="info-riht pull-right">
                           <p></p>
                        </div>
                     </div>
                     <!-- Div to check user subscribed or not -->
                     <div class="botm-ban">
                        <div class="follow-prv-host-one">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ban-logo-2.png" alt="ban-logo">
                           <h3><span>Follow to see all my private posts</span></h3>
                           <a data-toggle="modal" class="btn btn-default" href="javascript:void(0)" data-target="#loginpopup-popup">FOLLOW </a>
                        </div>
                     </div>
                     <!-- Else check the post exists but not subscribed -->  
                  </div>
               </div>
             
               <!-- Row end for post -->
               <!-- Row end for post -->
            </div>
            <!-- Row Started for post -->  
         </div>
      </div>
   </div>
</div>