<?php 
	if(!is_user_logged_in()){
		wp_redirect( home_url() );
		exit;
	}
 $description = get_user_meta( um_user( 'ID' ), 'description', true );
?>

<div class="dash-cnt-wrp">
 <div class="container">
  <div class="row">
   <div class="col-md-12">
   	  <div class="dash-content">
     <h4>My Bio:</h4>
     <p><?php echo $description; ?></p>
    </div>
    <div class=row>
        <div class="col-md-12"> 
            <div class="form-search">
     <div class="fl-search-bx form-group">
      
     </div>
     <form id="postcommentForm" name="new_post" method="post" action="">

     <div class="fl-text-bx form-group">
      <textarea class="form-control" name="description" placeholder="Create Post..."></textarea>
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
    </div>
    <!-- Row Started for post --> 
     <!-- Row Started for post -->  
  <?php $articles = get_posts(
 array(
  
  'post_author'  => um_user( 'ID' ),
  'post_type'  => 'post'
  
 )
); 

  

foreach ($articles as $article) {  ?>  
<hr>       
<div class="row">
   <div class="col-md-12">

    <div class="user-info clearfix">
     <div class="info-lft pull-left">
      <div class="usr-img img-div">
        <?php echo get_avatar( $article->post_author, 178 ); ?>
      </div>
      <div class="user-name">
       <p>Chrissy<span>@chrissyishere123</span></p>
      </div>
     </div>
     <div class="info-riht pull-right">
      <p><?php echo timeAgo($article->post_date_gmt); ?></p>
     </div>
    </div>

    <div class="slider-zoom">
     <p><?php echo $article->post_content; ?>  </p>
    </div>
    
    
    <div class="imp-links">
     <span class="ad-fav"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/heart.png" alt="">0</span>
     <span class="comm-ico"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/comment.png" alt=""><?php echo get_comments_number($article->ID); ?></span>
     <span class="send-ico"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dollar.png" alt="">Send Tip</span>
    </div>
    
    
    <div class="wrt-commt form-group">
     <!-- <textarea class="form-control"></textarea> -->
         
    </div>
    
    <div class="share-btn-btm text-right">
       <a href="#" class="btn-shr"><i class="fa fa-paper-plane"></i></a>
    </div>
    
   </div>
  </div>
  <!-- Row end for post -->
 
 

  <!-- Row end for post -->
<?php } ?>        
   </div>
  </div>
 </div>
</div>
