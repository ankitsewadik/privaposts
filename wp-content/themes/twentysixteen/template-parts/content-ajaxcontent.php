<?php
   
   $subscription_price =  get_user_meta( um_profile_id(), 'subscription_price', true); 
   $subscription_price =  ($subscription_price)?$subscription_price:'0.00';
   
   if(is_currentUser()){
    $subscribed = true;
   }else{
    $subscribed = UM()->Followers_API()->api()->followed( um_profile_id(), get_current_user_id() );  
   }
   
 	$post_id = get_the_ID();
 	$post_content = get_the_content();
	$author = get_the_author_id();
    $userdata = get_userdata($author);
    $posttime = get_the_date().get_the_time();
    $datetime = get_gmt_from_date( $posttime );
    ?>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/ajax_loadmore.js"></script>


<div id="load-comments">
<div class="post-box" id="post_<?php echo $post_id; ?>">
		<div class="user-info clearfix">
        <div class="info-lft pull-left">
           <div class="usr-img img-div">
              <?php echo get_avatar( $author, 178 ); ?>
           </div>
          <div class="user-name">
           <p><?php echo $userdata->data->display_name; ?><span><a href="<?php echo um_user_profile_url($author); ?>">@<?php echo $userdata->data->user_login; ?></a></span></p>
           <div class="mobile-time"> <?php echo timeAgoforpost($datetime,true); ?></div>
        </div>
        </div>
        <div class="info-riht pull-right">
           <p><?php echo timeAgoforpost($datetime,true); ?></p>
        </div>
     </div>
     <!-- Div to check user subscribed or not -->
	<?php if($subscribed){ 
	$meta = get_post_meta($post_id, "post_image", false);

	if(!empty($meta)){
	?>
		<div class="post-slider">
		<div class="slider-zoom">
	    <div id="pop-slider" class="pop-slider owl-carousel owl-theme owl-loaded owl-drag">
	      <div class="owl-stage-outer">
	         <div class="owl-stage" >
	           <?php
					foreach($meta as $array) {

                        foreach ($array as $value) {
                          $extension = end(explode(".", basename($value)));
                          $video_extsion = array("mp4","webm","3gp","mov"); ?>
        
        				<div class="owl-item" >
				               <div class="item">
				                
				          <?php if(in_array(basename($extension), $video_extsion)){ ?>
			                     <video style="width:100%;"  controls>
			                         <source src="<?php echo $value;?>" type="video/<?php echo $extension; ?>">
			                            Your browser does not support the video tag.
			                      </video>
				          <?php   }else{ ?>
			                     	<a class="fancybox" href="<?php echo $value;?>" data-fancybox-group="gallery"> 
			                          <img src="<?php echo $value;?>" alt="Popup Images"> 
			                      	</a> 
				          <?php   }   ?>
				                
				              </div>
				            </div>

				          <?php }} ?>
				         </div>
				      </div>
		      <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
		   </div>
		</div>
		</div>
		<?php } ?>
		<?php  if($post_content !=''){ ?>
		      <div class="slider-text">
		           <p><?php echo $post_content; ?>  </p>
		      </div>
		<?php } ?>
        <div class="new-drop clearfix">
         <div class="imp-links"> 
          <?php $likecount = get_totallikecountbyPost($post_id);
             ?>
          <?php if($likecount > 0){ ?>
                	<a class="ad-fav simpleAjaxLike" data-option="like" data-check="1" data-id="<?php echo $post_id; ?>" >
                  	<i class="fa fa-heart" aria-hidden="true"></i><?php echo $likecount; ?></a>
                  	<?php }else{ ?>
                  	<a class="ad-fav simpleAjaxLike" data-option="like" data-check="0" data-id="<?php echo $post_id; ?>" >
                  	<i class="fa fa-heart-o" aria-hidden="true"></i>
                  	</a>
                  	<?php } ?> 
                   	<?php 
                     $cmntcunt = get_comments_number($post_id);
                      $class = ($cmntcunt > 0)?'fa fa-comment':'fa fa-comment-o';
                          ?>
       				<a class="comm-ico commenticon" data-id="<?php echo $post_id; ?>">
          			<img src="<?php echo get_template_directory_uri();?>/assets/images/comment.png" alt=""><?php echo $cmntcunt; ?>
                     </a>
					<?php if($author != get_current_user_id()){ ?>
                      <a class="send-ico send_tip" data-profileId = "<?php echo $author; ?>" data-toggle="modal" href="javascript:void(0)">
                          <img src="<?php echo get_template_directory_uri();?>/assets/images/tip-ico.png">Send Tip
                         </a> 
                      <?php } ?>  
						</div>
                           <div class="dot-dop">
                              <div class="dropdown">
                                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> </button>
                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="javascript:void(0);">Copy link to post</a></li>
                                    <li><a href="javascript:void(0);">Report post</a></li>
                                        <?php if($author == get_current_user_id()){ ?>
                              		<li><a href="#" data-toggle="modal" data-target="#pop-edit-post" onclick="getPostId('<?php echo $post_id;?>')">Edit post</a></li>
                              		<li><a class="deletepost" ref="<?php echo $post_id; ?>" href="javascript:void(0);">Delete post</a></li>
                              <?php } ?>
                                 </ul>
                              </div>
                           </div>
                        </div>
               <?php }else{ ?>
                     <div class="botm-ban">
                     <div class="follow-prv-host-one">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ban-logo-2.png" alt="ban-logo">
                       <h3><span>Follow to see all my private posts</span></h3>
                        <a data-toggle="modal" class="btn btn-default" href="javascript:void(0)" data-target="#subscription-popup">FOLLOW  <?php //echo '$'.$subscription_price.' (per month)'; ?> </a>
                     </div>
                  </div>

                     <?php } ?>
                   
                      <div id="comment-content-div-<?php echo $post_id;?>" class="remove-div-comment"></div>
            </div>

</div>
