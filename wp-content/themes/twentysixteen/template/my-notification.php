<?php /* Template Name: My Notification */ ?>
<?php
get_header('profile-logein');
  
    
?>
<div class="dash-cnt-wrp">
	<section class="set-cover">
	<div class="container"> 
		<div class="row">
			<div class="col-md-12">
			     <?php
		// Start the loop.
				while ( have_posts() ) : the_post();
				// Include the page content template.
					the_content();
				// End of the loop.
		endwhile; ?>

<div class="not-info">
             <div class="set-panels">
       <div class="panel panel-default">
        <div class="panel-heading"> 
          <ul>
<li class="active"><a href="#allnotifcaion" aria-controls="allnotifcaion" role="tab" data-toggle="tab" ><i class="fa fa-align-justify" aria-hidden="true"></i>All</a></li>
<li><a href="#commentnotification" aria-controls="commentnotification" role="tab" data-toggle="tab"><i class="fa fa-comment-o" aria-hidden="true"></i>Comments</a></li>
<li><a href="#liked" aria-controls="liked" role="tab" data-toggle="tab"><i class="fa fa-heart-o" aria-hidden="true"></i>likes</a></li>
<li><a href="#subscribed" aria-controls="subscribed" role="tab" data-toggle="tab"><i class="fa fa-lock"></i>New Subscribers</a></li>
<li><a href="#tippe" aria-controls="tippe" role="tab" data-toggle="tab"><i class="fa fa-usd"></i>Tips</a></li>
<li><a href="#price" aria-controls="price" role="tab" data-toggle="tab"><i class="fa fa-money"></i>Price changes</a></li>
<li><a href="#alerts" aria-controls="alerts" role="tab" data-toggle="tab"><i class="fa fa-exclamation-triangle"></i>Alerts</a></li>
        </ul>
         </div>
         <div class="link-mark">
           <a href="#">Mark all as read</a>
         </div>
         <?php $has_notifications = UM()->Notifications_API()->api()->get_notifications( 1 );?>
         <div class="tab-content">
        <div id="allnotifcaion" class="tab-pane active" role="tabpanel">

 <?php 

    $msg =  '<div class="info-user">
               <div class="user-info clearfix">
                 <div class="info-riht">
                  <p>No notifications for you!</p>
                 </div>
                </div>
             </div>';

    if ( !$has_notifications ) { 

          echo $msg;
      ?>

   <?php } else {
      
            $notifications = UM()->Notifications_API()->api()->get_notifications( 100 );
            $template = 'notifications';
           // echo "<pre>";print_r($notifications);echo "</pre>";die;
    
          }
    ?>
        <?php 

          foreach( $notifications as $notification ) { if ( !isset( $notification->id ) ) continue; 
           
            ?>

        <div class="info-user <?php echo $notification->status; ?>">
           <div class="user-info clearfix">
             <div class="info-lft pull-left">
              <div class="usr-img img-div">
             <?php echo '<img src="'. um_secure_media_uri( $notification->photo ) .'" data-default="'. um_secure_media_uri( um_get_default_avatar_uri() ) .'" alt="" class="um-notification-photo" />'; ?>

              <?php 
              $str = stripslashes( $notification->content );
              preg_match("/\<(\w+)\>(.+?)\<\/\\1\>/", $str, $matches);
              ?>
              </div>
              <div class="user-name">
               <p><?php echo $matches[2]; ?> <!-- <span>@<?php //echo $matches[2]; ?></span> --></p>
               <div class="date">
                   <!-- <p><i class="fa fa-clock-o" aria-hidden="true"></i> 24/08/2018</p> -->
                    <span class="b2"  data-time-raw="<?php echo $notification->time;?>">
                      <?php echo UM()->Notifications_API()->api()->get_icon( $notification->type ); ?>
                        &nbsp;
                      <?php echo UM()->Notifications_API()->api()->nice_time( $notification->time ); ?></span>
               </div>
              </div>
             </div>
             <div class="info-riht pull-right">
              <p><?php echo stripslashes( $notification->content ); ?></p>
             </div>
            </div>
         </div>
        <?php } ?>
        </div>

          <div id="commentnotification" role="tabpanel" class="tab-pane" role="tabpanel">

    <?php 
          $hascomment = false;

          foreach( $notifications as $notification ) { if ( !isset( $notification->id ) ) continue; 
           // echo $notification->type
           if($notification->type == "user_comment" || $notification->type == "comment_reply"){
            $hascomment = true;
            ?>

       <div class="info-user <?php echo $notification->status; ?>">
           <div class="user-info clearfix">
             <div class="info-lft pull-left">
              <div class="usr-img img-div">
             <?php echo '<img src="'. um_secure_media_uri( $notification->photo ) .'" data-default="'. um_secure_media_uri( um_get_default_avatar_uri() ) .'" alt="" class="um-notification-photo" />'; ?>

              <?php 
              $str = stripslashes( $notification->content );
              preg_match("/\<(\w+)\>(.+?)\<\/\\1\>/", $str, $matches);
              ?>
              </div>
              <div class="user-name">
               <p><?php echo $matches[2]; ?> <!-- <span>@<?php //echo $matches[2]; ?></span> --></p>
               <div class="date">
                   <!-- <p><i class="fa fa-clock-o" aria-hidden="true"></i> 24/08/2018</p> -->
                    <span class="b2"  data-time-raw="<?php echo $notification->time;?>">
                      <?php echo UM()->Notifications_API()->api()->get_icon( $notification->type ); ?>
                        &nbsp;
                      <?php echo UM()->Notifications_API()->api()->nice_time( $notification->time ); ?>
                    </span>
               </div>
              </div>
             </div>
             <div class="info-riht pull-right">
              <p><?php echo stripslashes( $notification->content ); ?></p>
             </div>
            </div>
         </div>
        <?php 
          }
        } 
         if($hascomment == false){
                 echo $msg;
               }
        ?>
          </div>
          <div id="liked" class="tab-pane" role="tabpanel">
          
          <?php 
            $haslike = false;

            foreach( $notifications as $notification ) { if ( !isset( $notification->id ) ) continue; 
           // echo $notification->type
              if($notification->type == "post_like"){
                $haslike = true;
            ?>

       <div class="info-user <?php echo $notification->status; ?>">
           <div class="user-info clearfix">
             <div class="info-lft pull-left">
              <div class="usr-img img-div">
             <?php echo '<img src="'. um_secure_media_uri( $notification->photo ) .'" data-default="'. um_secure_media_uri( um_get_default_avatar_uri() ) .'" alt="" class="um-notification-photo" />'; ?>

              <?php 
              $str = stripslashes( $notification->content );
              preg_match("/\<(\w+)\>(.+?)\<\/\\1\>/", $str, $matches);
              ?>
              </div>
              <div class="user-name">
               <p><?php echo $matches[2]; ?> <!-- <span>@<?php //echo $matches[2]; ?></span> --></p>
               <div class="date">
                   <!-- <p><i class="fa fa-clock-o" aria-hidden="true"></i> 24/08/2018</p> -->
                    <span class="b2"  data-time-raw="<?php echo $notification->time;?>">
                      <?php echo UM()->Notifications_API()->api()->get_icon( $notification->type ); ?>
                        &nbsp;
                      <?php echo UM()->Notifications_API()->api()->nice_time( $notification->time ); ?>
                    </span>
               </div>
              </div>
             </div>
             <div class="info-riht pull-right">
              <p><?php echo stripslashes( $notification->content ); ?></p>
             </div>
            </div>
         </div>
        <?php 
          }
        } 
        if($haslike == false){
                 echo $msg;
               }
        ?>
          </div>
          <div id="subscribed" class="tab-pane" role="tabpanel">
         
          <?php 
            $hassubscribed = false;

            foreach( $notifications as $notification ) { if ( !isset( $notification->id ) ) continue; 
              if($notification->type == "new_follow"){
                $hassubscribed= true;
            ?>
               <div class="info-user <?php echo $notification->status; ?>">
                 <div class="user-info clearfix">
                   <div class="info-lft pull-left">
                    <div class="usr-img img-div">
                   <?php echo '<img src="'. um_secure_media_uri( $notification->photo ) .'" data-default="'. um_secure_media_uri( um_get_default_avatar_uri() ) .'" alt="" class="um-notification-photo" />'; ?>

                    <?php 
                    $str = stripslashes( $notification->content );
                    preg_match("/\<(\w+)\>(.+?)\<\/\\1\>/", $str, $matches);
                    ?>
                    </div>
                    <div class="user-name">
                     <p><?php echo $matches[2]; ?> <!-- <span>@<?php //echo $matches[2]; ?></span> --></p>
                     <div class="date">
                         <!-- <p><i class="fa fa-clock-o" aria-hidden="true"></i> 24/08/2018</p> -->
                          <span class="b2"  data-time-raw="<?php echo $notification->time;?>">
                            <?php echo UM()->Notifications_API()->api()->get_icon( $notification->type ); ?>
                              &nbsp;
                            <?php echo UM()->Notifications_API()->api()->nice_time( $notification->time ); ?>
                          </span>
                     </div>
                    </div>
                   </div>
                   <div class="info-riht pull-right">
                    <p><?php echo stripslashes( $notification->content ); ?></p>
                   </div>
                  </div>
               </div>
        <?php 
          }
        } 
         if($hassubscribed == false){
                 echo $msg;
               } 
        ?>
         </div>
          <div id="tippe" class="tab-pane" role="tabpanel"> <div class="info-user">
            <?php 
              $hastip = false;
             
              foreach( $notifications as $notification ) { if ( !isset( $notification->id ) ) continue; 
              if($notification->type == "tip"){
                $hastip= true;
            ?>
               <div class="info-user <?php echo $notification->status; ?>">
                 <div class="user-info clearfix">
                   <div class="info-lft pull-left">
                    <div class="usr-img img-div">
                   <?php echo '<img src="'. um_secure_media_uri( $notification->photo ) .'" data-default="'. um_secure_media_uri( um_get_default_avatar_uri() ) .'" alt="" class="um-notification-photo" />'; ?>

                    <?php 
                    $str = stripslashes( $notification->content );
                    preg_match("/\<(\w+)\>(.+?)\<\/\\1\>/", $str, $matches);
                    ?>
                    </div>
                    <div class="user-name">
                     <p><?php echo $matches[2]; ?> <!-- <span>@<?php //echo $matches[2]; ?></span> --></p>
                     <div class="date">
                         <!-- <p><i class="fa fa-clock-o" aria-hidden="true"></i> 24/08/2018</p> -->
                          <span class="b2"  data-time-raw="<?php echo $notification->time;?>">
                            <?php echo UM()->Notifications_API()->api()->get_icon( $notification->type ); ?>
                              &nbsp;
                            <?php echo UM()->Notifications_API()->api()->nice_time( $notification->time ); ?>
                          </span>
                     </div>
                    </div>
                   </div>
                   <div class="info-riht pull-right">
                    <p><?php echo stripslashes( $notification->content ); ?></p>
                   </div>
                  </div>
               </div>
        <?php 
          }
        } 
        if($hastip == false){
                 echo $msg;
               } 
        ?>
         </div>
         </div>
          <div id="price" class="tab-pane" role="tabpanel"> <div class="info-user">
           <?php 
               $hasprice = false;
              
              foreach( $notifications as $notification ) { if ( !isset( $notification->id ) ) continue; 
              if($notification->type == "send_tip"){
                $hasprice= true;
            ?>
               <div class="info-user <?php echo $notification->status; ?>">
                 <div class="user-info clearfix">
                   <div class="info-lft pull-left">
                    <div class="usr-img img-div">
                   <?php echo '<img src="'. um_secure_media_uri( $notification->photo ) .'" data-default="'. um_secure_media_uri( um_get_default_avatar_uri() ) .'" alt="" class="um-notification-photo" />'; ?>

                    <?php 
                    $str = stripslashes( $notification->content );
                    preg_match("/\<(\w+)\>(.+?)\<\/\\1\>/", $str, $matches);
                    ?>
                    </div>
                    <div class="user-name">
                     <p><?php echo $matches[2]; ?> <!-- <span>@<?php //echo $matches[2]; ?></span> --></p>
                     <div class="date">
                         <!-- <p><i class="fa fa-clock-o" aria-hidden="true"></i> 24/08/2018</p> -->
                          <span class="b2"  data-time-raw="<?php echo $notification->time;?>">
                            <?php echo UM()->Notifications_API()->api()->get_icon( $notification->type ); ?>
                              &nbsp;
                            <?php echo UM()->Notifications_API()->api()->nice_time( $notification->time ); ?>
                          </span>
                     </div>
                    </div>
                   </div>
                   <div class="info-riht pull-right">
                    <p><?php echo stripslashes( $notification->content ); ?></p>
                   </div>
                  </div>
               </div>
        <?php 
          }
        }
         if($hasprice == false){
                 echo $msg;
               }  
        ?>
         </div>
         </div>
          <div id="alerts" class="tab-pane" role="tabpanel"> <div class="info-user">
          <?php 
               $hasalerts = false;
              
              foreach( $notifications as $notification ) { if ( !isset( $notification->id ) ) continue; 
              if($notification->type == "send_tip"){
                $hasalerts= true;
            ?>
               <div class="info-user <?php echo $notification->status; ?>">
                 <div class="user-info clearfix">
                   <div class="info-lft pull-left">
                    <div class="usr-img img-div">
                   <?php echo '<img src="'. um_secure_media_uri( $notification->photo ) .'" data-default="'. um_secure_media_uri( um_get_default_avatar_uri() ) .'" alt="" class="um-notification-photo" />'; ?>

                    <?php 
                    $str = stripslashes( $notification->content );
                    preg_match("/\<(\w+)\>(.+?)\<\/\\1\>/", $str, $matches);
                    ?>
                    </div>
                    <div class="user-name">
                     <p><?php echo $matches[2]; ?> <!-- <span>@<?php //echo $matches[2]; ?></span> --></p>
                     <div class="date">
                         <!-- <p><i class="fa fa-clock-o" aria-hidden="true"></i> 24/08/2018</p> -->
                          <span class="b2"  data-time-raw="<?php echo $notification->time;?>">
                            <?php echo UM()->Notifications_API()->api()->get_icon( $notification->type ); ?>
                              &nbsp;
                            <?php echo UM()->Notifications_API()->api()->nice_time( $notification->time ); ?>
                          </span>
                     </div>
                    </div>
                   </div>
                   <div class="info-riht pull-right">
                    <p><?php echo stripslashes( $notification->content ); ?></p>
                   </div>
                  </div>
               </div>
        <?php 
          }
        }
         if($hasalerts == false){
                 echo $msg;
               }  
        ?>
         </div>
         </div>
        </div>
       </div>
      </div>
          </div>
        </div>
		</div>
	</div>
	</section>
</div>
<?php

  global $wpdb;
    $user_id = get_current_user_id();
    $table_name = $wpdb->prefix . "um_notifications";
    $wpdb->update(
      $table_name,
      array(
        'status'  => 'read',
      ),
      array(
        'user'    => $user_id,
      )
    );

?>
<style type="text/css">
  .red-notify{
    display: none;
  }
</style>
<?php get_footer(); ?>