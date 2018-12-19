 <div class="followers">
         <!--  <div class="user-show">
             <button class="btn theme-btn btn-default">Show Users</button>
             <div class="form-group">
          </div> -->
          <?php //echo "<pre>";print_r($followers); ?>
           <div class="set-panels bec-set">
            <div class="panel panel-default">
             <div class="panel-heading">Total Followers (<?php echo count($followers); ?>) </div>
             <div class="panel-body clearfix">
                <div class="table-responsive">
                   <table class="table  table-bordered">
                    <thead>
                      <tr>
                        <th>User Name</th>
                        <th>Profile Name</th>
                        <th>Total Paid</th>
                        <th>Tip Paid</th>
                        <th>Likes Posted</th>
                        <th>Muted</th>
                      </tr>
                    </thead>
                    <tbody>

                  <?php 

                  if ( $followers && !empty($followers)) { ?>
                  	
                  	<?php foreach( $followers as $k => $arr ) {
                  		/**
                  		 * @var $user_id2;
                  		 */
                  	    extract( $arr );

                  		um_fetch_user( $user_id2 ); 
                  		
                  		?>
                  	
                  	<tr>
                      <td>	<a href="<?php echo um_user_profile_url(); ?>" title="<?php echo um_user('display_name'); ?>"><?php echo um_user('display_name'); ?></a></td>
                      <td><?php echo um_user('full_name'); ?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      </tr>
                      <?php } ?>

                      <?php } else { ?>
                      	 <tr>
                      	 	<td colspan="6">
                      	 				<div class=""><span>
                                  <?php echo  __('You do not have any followers yet.','um-followers');  ?></span></div>
                      		 </td>
                      	</tr>
			                 <?php } ?>
                    </tbody>
                  </table>
                </div>
             </div>
            </div>
           </div>
         </div>
