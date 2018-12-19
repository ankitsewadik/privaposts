<?php /* Template Name: My Refferal Template */ ?>
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
		endwhile;
		?>
  <div class="cont-head">
           <h2>Referral program</h2>
         </div>
         <div class="cur-ref">
           <div class="in-ref clearfix">
              <div class="lft-ref pull-left">
                <h3>Current Referral Earnings</h3>
                <h2>$0.00</h2>
                <p>Please note, if you do not reach the minimum payout ($50.00), your earnings will rollover to the next monthly payout.</p>
              </div>
              <div class="right-ref pull-right">
                <div class="in-rgt">
                    <p>YOUR PERSONAL REFERRAL URL
 <?php 
                $udata = get_userdata(get_current_user_id());
                $login_name = $udata->data->user_login;

       $encodeid= numhash(get_current_user_id());
       echo $refurl= site_url()."/".$login_name."?ref=".$encodeid; ?>
     </p>
                </div>
              
              </div>
           </div>
          
         </div>
         <div class="second-con">
          <div class="cont-head">
           <h2> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/money.png" alt="money"> Referral Earnings Statement</h2>
         </div>

         <div class="set-sec">
           <p>You Do Not Have Payouts Yet</p>
         </div>
         </div>
         <div class="third-con">
           <div class="cont-head">
           <h2> Your Referrals</h2>
         </div>
          
          <ul class="list-unstyled foll-bx-lst my-ref-bx">
             <?php $record = get_referalusers(get_current_user_id()); 
          if($record && !empty($record)){ 

                foreach ($record as $key => $info) {
              
                um_fetch_user( $info->reffer_id ); 
                
                $udata = get_userdata($info->reffer_id );
                $registered = $udata->data->user_registered;
               $subscription_price =  get_user_meta($info->reffer_id , 'subscription_price', true); 
                

            ?>

          <li>
         <div class="ref-new">
           <div class="img-div">
            <?php 
              if(um_user('cover_photo')){ 
                  echo um_user('cover_photo');
               }else{
                   echo '<img src="'.site_url().'/wp-content/uploads/dummy-cover-new.jpg" />';
               }

             ?>
           </div>
           <div class="cover-div">
             <div class="cont-one">
             <div class="usr-img">
                  <?php echo get_avatar( $info->reffer_id,95 ); ?>
            </div>
             <p><?php echo um_user('display_name'); ?></p>
             <p><span><a href="<?php echo um_user('user_url'); ?>">@<?php echo um_user('user_login'); ?></a></span></p>
           </div>
           <div class="cont-two">
            <ul class="list-unstyled">
                    <li>
                     <span>Joined:</span>
                     <strong><?php echo date( "d/m/Y", strtotime( $registered )); ?></strong>
                    </li>
                    <li>
                     <span>Earnings:</span>
                     <strong>$0.00</strong>
                    </li>
                   </ul>
           </div>
           <div class="foll-btn">
            <?php 
              $isfollowed = UM()->Followers_API()->api()->followed( $info->reffer_id,um_profile_id() );
                if($subscription_price){
              if($isfollowed){ ?>
                <a href="javascript:void(0);" class="unfollow btn theme-btn btn-default blue-btn-hover" data-user_id1="<?php echo $info->reffer_id; ?>" data-user_id2="<?php echo get_current_user_id(); ?>" data-following="Following" data-unfollow="Unfollow">Unfollow</a>
             <?php  }else{  ?>
                <a  href="javascript:void(0);"  data-user="<?php echo $info->reffer_id; ?>" class="btn theme-btn btn-default subscription-monthly blue-btn-hover">Follow</a>
             <?php }  ?>
           <?php } ?>
             
           </div>
           </div>

         </div> 
           </li>

    <?php  }}else{ ?>
              <p>You dont have Referral</p>
    <?php }   ?>
         </ul>
         </div>
     
    
			</div>
		</div>
	</div>
	</section>
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>