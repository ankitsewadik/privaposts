<div class="following">
      <div class="set-panels">
       <div class="panel panel-default">
        <div class="panel-heading"> Following </div>
        <div class="panel-body clearfix">
         <div class="">
          <div id="exTab1" class="">
           <ul  class="nav nav-pills">
            <li class="active"> <a  href="#1a" data-toggle="tab"><i class="fa fa-check-circle" aria-hidden="true"></i> Active (<?php echo UM()->Followers_API()->api()->count_following_plain( um_profile_id() ); ?>)</a> </li>
            <li><a href="#2a" data-toggle="tab"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Expired (0)</a> </li>
            <li><a href="#3a" data-toggle="tab"><i class="fa fa-align-justify" aria-hidden="true"></i>All (<?php echo UM()->Followers_API()->api()->count_following_plain( um_profile_id() ); ?>)</a> </li>
           </ul>
           <div class="tab-content clearfix">
            <div class="tab-pane active" id="1a">
             <div class="tab-holder clearfix">
            

<?php if ( $following ) { ?>
	  <ul class="foll-bx-lst">
	<?php foreach( $following as $k => $arr ) {
		/**
		 * @var $user_id1;
		 */
	    extract( $arr );

		um_fetch_user( $user_id1 ); 
		
		?>
	<li>
                <div class="ref-new">
                 <div class="img-div"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/prof-1.png" alt="prof-1"> </div>
                 <div class="cover-div">
                  <div class="cont-one">
                   <div class="usr-img">
                  
                   	<?php echo get_avatar( um_user('ID'),95 ); ?>
                   </div>
                   <p><a href="<?php echo um_user_profile_url(); ?>" title="<?php echo um_user('display_name'); ?>"><?php echo um_user('display_name'); ?></a></p>
                   <p><span>@<?php echo um_user('display_name'); ?></span></p>
                  </div>
                  <div class="cont-two">
                   <ul class="list-unstyled">
                    <li>
                     <span>Subscription:</span>
                     <strong><?php 
                          $money = get_user_meta( um_user('ID'), 'subscription_price', true);
                          echo ($money)?'$'.$money:'$'.'0.00';
                       

                      ?></strong>
                    </li>
                    <li>
                     <span>Earnings:</span>
                     <strong>07/30/18-08/30/18</strong>
                    </li>
                   </ul>
                  </div>
                  <?php do_action('um_following_list_pre_user_bio', $user_id, $user_id1 ); ?>
                  <div class="text-con">
                  	
                   <p><?php echo um_get_snippet( um_filtered_value('description'),7).''; ?></p>
                   
                  </div>
                  <?php do_action('um_following_list_post_user_bio', $user_id, $user_id1 ); ?>
                  	<div class="foll-btn">
                      <?php if(um_user('ID') !=1){ ?>
                      <a href="javascript:void(0);" id="unfollow" class="unfollow um-button" data-user_id1="<?php echo $user_id1; ?>" data-user_id2="<?php echo get_current_user_id(); ?>" data-following="Following" data-unfollow="Unfollow">Unfollow</a>
                      <?php } ?>
						<?php


						//echo UM()->Followers_API()->api()->follow_button( $user_id1, get_current_user_id() );
						?>
					</div>
                 </div>
                </div>
               </li>
	
	<?php } ?>
</ul>
<?php } else { ?>
	
	<div class=""><span><?php echo ( $user_id == get_current_user_id() ) ? __('You did not follow anybody yet.','um-followers') : __('This user did not follow anybody yet.','um-followers'); ?></span></div>
	
<?php } ?>

               
             </div>
            </div>


              <div class="tab-pane " id="2a">
             <div class="tab-holder clearfix">
            

<?php if ( $following ) { ?>
    <ul class="foll-bx-lst">
  <?php foreach( $following as $k => $arr ) {
    /**
     * @var $user_id1;
     */
      extract( $arr );

    um_fetch_user( $user_id1 ); 
    
    ?>
  <li>
               
               </li>
  
  <?php } ?>
</ul>
<?php } else { ?>
  
  <div class=""><span><?php echo ( $user_id == get_current_user_id() ) ? __('You did not follow anybody yet.','um-followers') : __('This user did not follow anybody yet.','um-followers'); ?></span></div>
  
<?php } ?>

               
             </div>
            </div>

  <div class="tab-pane " id="3a">
             <div class="tab-holder clearfix">
            

<?php if ( $following ) { ?>
    <ul class="foll-bx-lst">
  <?php foreach( $following as $k => $arr ) {
    /**
     * @var $user_id1;
     */
      extract( $arr );

    um_fetch_user( $user_id1 ); 
    
    ?>
  <li>
                <div class="ref-new">
                 <div class="img-div"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/prof-1.png" alt="prof-1"> </div>
                 <div class="cover-div">
                  <div class="cont-one">
                   <div class="usr-img">
                  
                    <?php echo get_avatar( um_user('ID'),95 ); ?>
                   </div>
                   <p><a href="<?php echo um_user_profile_url(); ?>" title="<?php echo um_user('display_name'); ?>"><?php echo um_user('display_name'); ?></a></p>
                   <p><span>@<?php echo um_user('display_name'); ?></span></p>
                  </div>
                  <div class="cont-two">
                   <ul class="list-unstyled">
                    <li>
                     <span>Subscription:</span>
                     <strong><?php 
                          $money = get_user_meta( um_user('ID'), 'subscription_price', true);
                          echo ($money)?'$'.$money:'$'.'0.00';
                       

                      ?></strong>
                    </li>
                    <li>
                     <span>Earnings:</span>
                     <strong>07/30/18-08/30/18</strong>
                    </li>
                   </ul>
                  </div>
                  <?php do_action('um_following_list_pre_user_bio', $user_id, $user_id1 ); ?>
                  <div class="text-con">
                    
                   <p><?php echo um_get_snippet( um_filtered_value('description'),7).'...'; ?></p>
                   
                  </div>
                  <?php do_action('um_following_list_post_user_bio', $user_id, $user_id1 ); ?>
                    <div class="foll-btn">
            <?php
            echo UM()->Followers_API()->api()->follow_button( $user_id1, get_current_user_id() );
            ?>
          </div>
                 </div>
                </div>
               </li>
  
  <?php } ?>
</ul>
<?php } else { ?>
  
  <div class=""><span><?php echo ( $user_id == get_current_user_id() ) ? __('You did not follow anybody yet.','um-followers') : __('This user did not follow anybody yet.','um-followers'); ?></span></div>
  
<?php } ?>

               
             </div>
            </div>
           
            
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
