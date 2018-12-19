<?php 
	if(!is_user_logged_in()){
		wp_redirect( home_url() );
		exit;
	}
 $description = get_user_meta( um_profile_id(), 'description', true );

$subscribed = is_currentUser() ? True: false;
 
?>

<div class="dash-cnt-wrp">
 <div class="container">
  <div class="row">
   <div class="col-md-12">
   	  <div class="dash-content">
     <h4>My Bio:</h4>
     <p><?php echo $description; ?></p>
    </div>

    <?php if(is_currentUser()){ ?>
    <div class=row>
        <div class="col-md-12"> 
            <div class="form-search">
     <div class="fl-search-bx form-group">
      
     </div>
     <form id="new_post" name="new_post" method="post" action="" onsubmit="return false;">

     <div class="fl-text-bx form-group">
      <textarea class="form-control" id="description" name="description"" placeholder="Create new Post..."></textarea>
     </div>
     <div class="file-upload-btn clearfix form-group">
      <div class="fil-upload">
       
        <button type="button" class="btn fileup-btn">
        <span class="img-ico"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/gal-ico.png" alt=""></span><span>Photo/Video</span>
        <input id="upload-2" multiple="" type="file">
        </button>
        <a class="control-button btn btn-link" style="display: none" href="javascript:$.fileup('upload-2', 'upload', '*')">Upload all</a> <a class="control-button btn btn-link" style="display: none" href="javascript:$.fileup('upload-2', 'remove', '*')">Remove all</a>
        <div id="upload-2-queue" class="queue"></div>

      </div>
        <input type="hidden" name="post_type" id="post_type" value="post" />
        <input type="hidden" name="action" value="post" />

      <div class="share-btn"><button href="#" type="submit" id="submit" name="submit" class="btn-shr"><i class="fa fa-paper-plane"></i></button> </div>
      <?php wp_nonce_field( 'new-post' ); ?>
       </form>
     </div>
    </div> 
        </div>
      <?php } ?>
     
  <!-- <div class="center-pro">
     <div class="in-pro">
      <div class="in-text"> <img src="<?php // echo get_template_directory_uri(); ?>/assets/images/ban-logo.png" alt="ban-logo">
       <h3>Follow to see my private posts</h3>
       <a href="#" class="btn btn-default theme-btn">Follow</a> </div>
     </div>
    </div> -->
  
    </div>

  

    <!-- Row Started for post --> 
     <!-- Row Started for post -->  
  <?php $articles = get_posts(
 array(
   'author'        =>  um_profile_id(),
   'orderby'       =>  'post_date',
   'order'         =>  'Desc',
   'post_type' => 'post',

 )
); 
//global $wpdb;
 ///echo $wpdb->last_query;
  ?>
  <div id="load-comments">
  <?php
if(!empty($articles)  ){
foreach ($articles as $article) {  

  $userdata = get_userdata($article->post_author);
  
?>  


<div class="row" id="post_<?php echo $article->ID; ?>">
  <hr>       
   <div class="col-md-12">

    <div class="user-info clearfix">
     <div class="info-lft pull-left">
      <div class="usr-img img-div">
        <?php echo get_avatar( $article->post_author, 178 ); ?>
      </div>
      <div class="user-name">
       <p><?php echo $userdata->data->display_name; ?><span>@<?php echo $userdata->data->user_nicename; ?></span></p>
      </div>
     </div>
     <div class="info-riht pull-right">
      <p><?php echo timeAgo($article->post_date_gmt); ?></p>
     </div>
    </div>

    <div class="slider-zoom">
     <p><?php echo $article->post_content; ?>  </p>
    </div>
     <div class="new-drop clearfix">
     <div class="imp-links"> 
      <span class="ad-fav"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/heart.png" alt="">0</span> 
      <span class="comm-ico"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/comment.png" alt=""><?php echo get_comments_number($article->ID); ?></span>
      <span class="send-ico"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dollar.png" alt="">Send Tip</span> 
    </div>
     <div class="dot-dop">
      <div class="dropdown">
       <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> </button>
       <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li><a href="javascript:void(0);">Copy link to post</a></li>
        <li><a href="javascript:void(0);">Pin to Your profile page</a></li>
        <li><a href="javascript:void(0);">Edit Post</a></li>
        <li><a class="deletepost" ref="<?php echo $article->ID; ?>" href="javascript:void(0);">Delete post</a></li>
       </ul>
      </div>
     </div>
    </div>
    
    <div class="wrt-commt form-group">
     <textarea name="commnet_<?php echo $article->ID; ?>" class="form-control"></textarea>
    </div>
    
    <div class="share-btn-btm text-right">
       <a href="#" class="btn-shr"><i class="fa fa-paper-plane"></i></a>
    </div>
    
   </div>
  </div>
  <!-- Row end for post -->

 

  <!-- Row end for post -->
<?php } }else{?>

  <?php if(!$subscribed){ ?>
    <div class="center-pro">
     <div class="in-pro">
      <div class="in-text"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ban-logo.png" alt="ban-logo">
       <h3>Follow to see my private posts</h3>
        <?php
          $user_id = um_profile_id();
           if ( UM()->Followers_API()->api()->can_follow( um_profile_id(), get_current_user_id() ) ) { ?>
       <div class="foll-btn">
            <?php echo UM()->Followers_API()->api()->follow_button( um_profile_id(), get_current_user_id() ); ?>
      </div>
     <?php } ?>
     </div>
    </div>

  <?php }else{ ?>
      <div class="row" id="no-postdivId">
        <div class="col-md-12">
          <hr>       
            <p style="text-align: center;">Currently there are no posts added.</p>
        </div>
      </div>  
 <?php }?>
 
<?php } ?> 
 </div>       
   </div>
  </div>
 </div>
</div>

