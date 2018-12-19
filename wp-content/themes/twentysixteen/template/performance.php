<?php 
/* Template Name: Performance */ ?>
<?php
get_header('profile-logein');

//print_r($_SESSION);die();
   $userid = get_current_user_id();
   global $wpdb;  
   $table = $wpdb->prefix . "stripe_transaction";
   $earnQuery = $wpdb->get_results("SELECT * FROM ".$table." where to_pay_userid='".$userid."'" );
   $pmntQuery = $wpdb->get_results("SELECT * FROM ".$table." where from_pay_userid='".$userid."'" );

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

     <div class="per-tab">
           <div id="exTab1" class="container">  
<ul  class="nav nav-pills">
      <li class="active">
        <a  href="#1a" data-toggle="tab">Earnings</a>
      </li>
      <li><a href="#2a" data-toggle="tab">Payments</a>
      </li>
      <li><a href="#3a" data-toggle="tab">Earnings Statistics</a>
      </li>
     
    </ul>

      <div class="tab-content clearfix">
        <div class="tab-pane active" id="1a">
          <div class="content-t">
             <div class="table-responsive">          
            <table class="table">
              <thead>
                <tr>
                  <th>Date </th>
                  <th>Time</th>
                  <th>Amount</th>
                  
                  <th>Fee</th>
                  <th>Net </th>
                  <th>Status</th>
                </tr>
              </thead>    
              <?php
                if($earnQuery){
                 ?>
                        
              <tbody>
               <?php  
               foreach ($earnQuery as $earn) { 

                  $timestamp1 = $earn->created_date;

                  $date1 = date('d/m/Y',substr($timestamp1, 0, 10));
                  $time1 = date('H:i A',$timestamp1);
                ?>         
                <tr>
                  <td><?php echo $date1;?></td>
                  <td><?php echo $time1;?></td>
                  <td><?php echo $earn->amount.' '.$earn->currency;?></td>
                  <td><?php echo '0'.' '.$earn->currency;?></td>
                  <td><?php echo '0'.' '.$earn->currency;?></td>
                  <td><span><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php if($earn->status == 'active' || $earn->status == 'succeeded' ){echo 'Complete';}?></span></td>
                </tr> 
                  <?php 
                  }
                  ?>

             </tbody>
             <?php
             }else{
                     ?>
                     <tbody><tr><td></td><td></td><td>
                           <center> No earnings found.</center>
                          </td><td></td><td></td><td></td></tr></tbody>
                          <?php
                    }
                    ?>
            </table>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="2a">
          <div class="content-t">
             <div class="table-responsive">          
            <table class="table">
              <thead>
                <tr>
                  <th>Date </th>
                  <th>Time</th>
                  <th>Amount</th>
                  
                  <th>Fee</th>
                  <th>Net </th>
                  <th>Status</th>
                </tr>
              </thead>  
                            <?php  

                   if($pmntQuery){  
                   ?>                            
              <tbody>
              <?php  
             

                foreach ($pmntQuery as $pymnt) { 
                  $timestamp2 = $pmntQuery->created_date;
                  $date2 = date('d/m/Y',$timestamp2);
                  $time2 = date('H:i A',$timestamp2);

                ?>       
               <tr>
                 <td><?php echo $date2;?></td>
                  <td><?php echo $time2;?></td>
                  <td><?php echo $pymnt->amount.' '.$pymnt->currency;?></td>
                  <td><?php echo '0'.' '.$pymnt->currency;?></td>
                  <td><?php echo '0'.' '.$pymnt->currency;?></td>
                  <td><span><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php if($pymnt->status == 'active'){echo 'Complete';}else{ echo 'Pending';}?></span></td>
                </tr> 
                      <?php 
                  }
                 
                     ?>           
              </tbody>
               <?php
                }else{
                  ?>
                     <tbody><tr><td></td><td></td><td>
                           <center> No payments found.</center>
                          </td><td></td><td></td><td></td></tr></tbody>
                          <?php
                    }
                    ?>
            </table>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="3a">
         <div class="content-t">
             <div class="table-responsive">          
            <table class="table">
              <thead>
                <tr>
                  <th>Date </th>
                  <th>Time</th>
                  <th>Amount</th>
                  
                  <th>Fee</th>
                  <th>Net </th>
                  <th>Status</th>
                </tr>
              </thead>                                           
              <tbody>
                <tr>
                  <td>7/30/18</td>
                  <td> 9:59 PM </td>
                  <td>6.62 aud </td>
                  <td> 1.32 aud </td>
                  <td>5.30 aud</td>
                  <td><span><i class="fa fa-check-circle-o" aria-hidden="true"></i> Complete</span></td>
                </tr> 
                 <tr>
                  <td></td>
                  <td>  </td>
                  <td></td>
                  <td>  </td>
                  <td></td>
                  <td></td>
                </tr>                                        
              </tbody>
            </table>
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
<?php //get_sidebar(); ?>
<?php get_footer(); ?>