<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

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
       
            <div class="dash-content">
              <div class="mybio-cst">
               <h4>My Bio:</h4>
              <div class="more"><?php echo $description; ?></div>
              </div>  
               </div>   
           
            <?php if(is_currentUser()){ ?>
          
                  <div class="form-search">
                     <div class="fl-search-bx form-group">
                     </div>
                     <form id="new_post" name="new_post" method="post" action="" onsubmit="return false;" enctype="multipart/form-data" >
                        <div class="fl-text-bx form-group">
                           <textarea class="form-control" id="description" name="description"" placeholder="Create new post..."></textarea>
                        </div>
                        <div class="file-upload-btn clearfix form-group">
                                              
                           <input class="aryfiles" type="file" id="files" name="files">                           
                           <input type="hidden" name="post_type" id="post_type" value="post" />
                           <input type="hidden" name="action" value="post" />
                           <div class="share-btn">
                            <button href="#" type="submit" id="submit" name="submit" class="btn-shr">
                              <i class="fa fa-paper-plane"></i>
                            </button>
                       </div>
                           <?php wp_nonce_field( 'new-post' ); ?>
                     </form>
                     </div>
                
       <?php } ?>
            <!-- Row Started for post --> 
               <?php if(is_currentUser()){ ?>
                      <?php if(is_pu_user(get_current_user_id())){ ?>
                             <?php echo do_shortcode('[ajax_posts]'); ?>
                      <?php }else{ ?>
                             <div class="bcome-creator text-center">
                                <h3>Earn money from your followers now!</h3>
                                   <a class="btn btn-theme" href="<?php echo home_url('become-creator'); ?>">Become a Creator</a>
                             </div>
                      <?php } ?>
               <?php }else{ ?>
                    <?php echo do_shortcode('[ajax_posts]'); ?>
                <?php } ?>  
