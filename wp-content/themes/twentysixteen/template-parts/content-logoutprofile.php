<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */


    //  if(!isset($_GET['refid']) || $_GET['refid']==''){
    //   wp_redirect( home_url() );
    //   exit;
    // }else{
    //   $userid=numhash($_GET['refid']); 
    //   $user = get_userdata( $userid );
    //   if ( $user === false ) {
    //      wp_redirect( home_url() );
    //      exit;
    //   } 
    // }


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
            
            <!-- Row Started for post --> 
              
<?php 
     if(empty($articles)){
      if($subscribed){
 ?> 
 <div class="botm-ban">
                     <div class="follow-prv-host-one">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ban-logo-2.png" alt="ban-logo">
                       <h3><span>Follow to see all my private posts</span></h3>
                        <a data-toggle="modal" class="btn btn-default" href="javascript:void(0)" data-target="#loginpopup-popup">FOLLOW  <?php //echo '$'.$subscription_price.' (per month)'; ?></a>
                     </div>
                  </div>

<?php 
  }
    }
//}else{ ?>

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
                           <p><?php echo $userdata->data->display_name; ?><span><a href="<?php echo um_user_profile_url($article->post_author); ?>">@<?php echo $userdata->data->user_login; ?></a></span></p>
                        </div>
                        </div>
                        <div class="info-riht pull-right">
                           <p><?php // echo timeAgo($article->post_date_gmt,true); ?></p>
                        </div>
                     </div>
                     <!-- Div to check user subscribed or not -->
                     <?php if(!$subscribed){ ?>
                          <div class="botm-ban">
                     <div class="follow-prv-host-one">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ban-logo-2.png" alt="ban-logo">
                       <h3><span>Follow to see all my private posts</span></h3>
                        <a data-toggle="modal" class="btn btn-default" href="javascript:void(0)" data-target="#loginpopup-popup">FOLLOW  <?php //echo '$'.$subscription_price.' (per month)'; ?> </a>
                     </div>
                  </div>

                     <?php } ?>
                   
                      <div id="comment-content-div-<?php echo $article->ID;?>" class="remove-div-comment"></div>
                  
                  <!-- Else check the post exists but not subscribed -->  
               </div>
            </div>
            <!-- Row end for post -->
            <!-- Row end for post -->
            <?php 
                      if(!$subscribed){
                       break; 
                      }
            ?>
            <?php } }?>
         </div>

         
<?php //} ?>
            <!-- Row Started for post -->  
      


