

<?php 
   if(!is_user_logged_in()){
    wp_redirect( home_url() );
    exit;
   }
   $description = get_user_meta( um_profile_id(), 'description', true );
   $subscription_price =  get_user_meta( um_profile_id(), 'subscription_price', true); 
   $subscription_price =  ($subscription_price)?$subscription_price:'0.00';
   
   if(is_currentUser()){
    $subscribed = true;
   }else{
    $subscribed = UM()->Followers_API()->api()->followed( um_profile_id(), get_current_user_id() );  
   }
   
   $articles = get_posts(
    array(
       'author'        =>  um_profile_id(),
       'orderby'       =>  'post_date',
       'order'         =>  'Desc',
       'post_type' => 'post',
     )
   ); 
   ?>
<div class="dash-cnt-wrp">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="dash-content">
              <div class="mybio-cst">
               <h4>My Bio:</h4>
              <div class="more"><?php echo $description; ?></div>
              </div>  
               </div>   
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
               <?php }else{ ?>
               <?php   if ( !UM()->Followers_API()->api()->followed( um_profile_id(), get_current_user_id() ) && empty($articles) ) { ?>
               <div class="center-pro">
                  <div class="botm-ban">
                     <div class="follow-prv-host-one">
                        <img src="<?php  echo get_template_directory_uri(); ?>/assets/images/ban-logo.png" alt="ban-logo">
                        <h3>Follow to see my private posts</h3>
                        <a href="#"  data-toggle="modal" href="javascript:void(0)" data-target="#subscription-popup"  class="btn btn-default">Follow</a> 
                     </div>
                  </div>
               </div>
               <?php } ?>
               <?php  } ?>
            </div>
            <!-- Row Started for post --> 
            <!-- Row Started for post -->  
            <div id="load-comments">
               <?php
                  //if($subscribed){
                      if(!empty($articles)){ ?>
               <?php 
                  foreach ($articles as $article) {  
                  
                    $userdata = get_userdata($article->post_author);
                    
                  ?>  
               <div class="post-box" id="post_<?php echo $article->ID; ?>">
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
                     <!-- Div to check user subscribed or not -->
                     <?php if($subscribed){ ?>
                     <div>
                        <div class="slider-zoom">
                           <p><?php echo $article->post_content; ?>  </p>
                        </div>
                        <div class="new-drop clearfix">
                           <div class="imp-links"> 
                              <?php $likecount = get_totallikecountbyPost($article->ID);
                                 ?>
                              <?php if($likecount > 0){ ?>
                              <a class="ad-fav simpleAjaxLike" data-option="like" data-check="1" data-id="<?php echo $article->ID; ?>" >
                              <i class="fa fa-heart" aria-hidden="true"></i>&nbsp;<?php echo $likecount; ?>
                              </a>
                              <?php }else{ ?>
                              <a class="ad-fav simpleAjaxLike" data-option="like" data-check="0" data-id="<?php echo $article->ID; ?>" >
                              <i class="fa fa-heart-o" aria-hidden="true"></i>&nbsp;0
                              </a>
                              <?php } ?> 
                               <?php 
                                 $cmntcunt = get_comments_number($article->ID);
                                  $class = ($cmntcunt > 0)?'fa fa-comment':'fa fa-comment-o';
                          ?>
                           <a class="comm-ico commenticon" data-id="<?php echo $article->ID; ?>">
                                         <i class="<?php echo $class; ?>" aria-hidden="true"></i>&nbsp;
                                         <?php echo $cmntcunt; ?>
                             </a>

                              <a class="send-ico">
                              <i class="fa fa-usd" aria-hidden="true">&nbsp;Send Tip</i>
                              </a>
                           </div>
                           <div class="dot-dop">
                              <div class="dropdown">
                                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> </button>
                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="javascript:void(0);">Copy link to post</a></li>
                                    <li><a href="javascript:void(0);">Pin to Your profile page</a></li>
                                    <?php if(is_currentUser()){ ?>
                                    <li><a href="#" data-toggle="modal" data-target="#pop-edit-post" onclick="getPostId('<?php echo $article->ID;?>')">Edit Post</a></li>
                                    <li><a class="deletepost" ref="<?php echo $article->ID; ?>" href="javascript:void(0);">Delete post</a></li>
                                    <?php } ?>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- <div class="wrt-commt form-group">
                        <textarea name="commnet_<?php //echo $article->ID; ?>" class="form-control"></textarea>
                        </div>
                        <div class="share-btn-btm text-right">
                          <a href="#" class="btn-shr"><i class="fa fa-paper-plane"></i></a>
                        </div> -->
                     <!-- Start comment post -->
                     <div id="cmntbx-<?php echo $article->ID;  ?>" class="pbox" style="display: none;">
                        <?php if(get_comments_number($article->ID)){ // check user has post comment
                           $postid = $article->ID; 
                           ?>
                        <ol id="commentlisting" class="commentlist">
                           <?php    
                              //Gather comments for a specific page/post 
                              $comments = get_comments(array(
                                  'post_id' => $postid
                              ));
                              //Display the list of comments
                              wp_list_comments(array(
                                  'reverse_top_level' => true//Show the latest comments at the top of the list
                                  /*'callback' => 'addCommentReplyForm'*/ 
                              ), $comments);  
                              ?>
                        </ol>
                        <?php 
                           $fields='';
                           $args = array(
                             'id_form'           => 'commentform2',
                             'class_form'      => 'commentform',
                             'id_submit'         => 'submit',
                             'class_submit'      => 'submit',
                             'name_submit'       => 'submit',
                             'title_reply'       => __( 'Leave a Reply' ),
                             'title_reply_to'    => __( 'Leave a Reply to %s' ),
                             'cancel_reply_link' => __( 'Cancel Reply' ),
                             'label_submit'      => __( 'Post Comment' ),
                             'format'            => 'xhtml',
                           
                             'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
                               '</label><textarea id="comment" name="comment" cols="45" rows="4" style="width: 905px; height: 60px;" aria-required="true">' .
                               '</textarea></p>',
                           
                             'must_log_in' => '<p class="must-log-in">' .
                               sprintf(
                                 __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                                 wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
                               ) . '</p>',
                           
                             'fields' => apply_filters( 'comment_form_default_fields', $fields ),
                           );
                           comment_form( $args, $article->ID ); ?>
                     
                     <?php   }else{
                        ?>
                     <div id="respond" class="comment-respond">
                        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                        <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
                        <?php else : ?>
                        <form class="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" >
                           <p class="comment-form-comment">
                           <p><label for="comment">Comment <?php if ($req) echo '<span class="required">*</span>'; ?></label>
                              <textarea name="comment" id="comment" cols="100%" rows="5" tabindex="4" style="width: 905px; height: 60px;"></textarea>
                           </p>
                           <p class="form-submit">
                              <input name="submit" id="submit" tabindex="5" value="Post Comment" type="submit">
                              <input name="comment_post_ID" value="<?php echo $article->ID; ?>" id="comment_post_ID" type="hidden">
                              <input name="comment_parent" id="comment_parent" value="0" type="hidden">
                           </p>
                           <?php do_action('comment_form', $article->ID); ?>           
                        </form>
                        <?php endif; // If registration required and not logged in ?>
                     </div>
                     <?php } //end else ?>
                  </div>
                  <!-- end comment post -->
                  <?php }else{ ?>
                  <div class="botm-ban">
                     <div class="follow-prv-host-one">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ban-logo-2.png" alt="ban-logo">
                        <h3>Follow to see my private posts</h3>
                        <a data-toggle="modal" class="btn btn-default" href="javascript:void(0)" data-target="#subscription-popup">FOLLOW  $<?php echo $subscription_price; ?> (per month)</a>
                     </div>
                  </div>
                  <?php } ?>
                  <!-- Else check the post exists but not subscribed -->  
               </div>
            </div>
            <!-- Row end for post -->
            <!-- Row end for post -->
            <?php } ?>
            <?php /*}else{ ?>
            <div class="row" id="post_<?php echo $article->ID; ?>">
               <div class="col-md-12">
                  <hr>
                  <div class="user-info clearfix" align="center">
                     <p>Currently there are no posts added.</p>
                  </div>
               </div>
            </div>
            <?php } */?>
            <?php }?>
         </div>
      </div>
   </div>
</div>
