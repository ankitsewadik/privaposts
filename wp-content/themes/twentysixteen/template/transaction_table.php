<?php 
global $wpdb;
   $transactions_table = $wpdb->prefix . "stripe_transaction";
  
   $transactionsDetails = $wpdb->get_results("SELECT * FROM $transactions_table");

?>
<div class="wrap">
 <h1>User Transactions Details</h1>
 
 <table class="wp-list-table widefat fixed striped posts">
    <thead>
        <tr>
      
            
            <th scope="col" id="author" class="manage-column column-title column-primary sortable desc"><a href="#">Amount</a> </th>
            <th scope="col" id="title" class="manage-column"><a href="#"><span>Currency</span><span class="sorting-indicator"></span></a></th>
             <th scope="col" id="title" class="manage-column column-title column-primary sortable desc" style=""><a href="#"><span>From Pay User</span></a></th>
                <th scope="col" id="title" class="manage-column column-title column-primary sortable desc" style=""><a href="#"><span>To pay User</span></span></a></th>

             <th scope="col" id="title" class="manage-column column-title column-primary sortable desc" style=""><a href="#"><span>	Subscription Id</span></span></a></th>
             <th scope="col" id="author" class="manage-column column-title column-primary sortable desc"><a href="#">Plan Id</a> </th>

            
            <th scope="col" id="author" class="manage-column column-title column-primary sortable desc"><a href="#">Subscription object </a></th>
            <th scope="col" id="author" class="manage-column column-author"><a href="#">Customer Id</a> </th>
            <th scope="col" id="author" class="manage-column column-author"><a href="#">Payment Status </a></th>
         
        </tr>
    </thead>
    <tbody id="the-list">

        <?php 
        if(!empty($transactionsDetails)){
         foreach ($transactionsDetails as $value) {
            
             $fromuserdata =get_userdata($value->from_pay_userid);
             $fromuserinfo =$fromuserdata->data;
             $fromusername =$fromuserinfo->user_login;

             $touserdata  =get_userdata($value->to_pay_userid);
             $touserinfo =$touserdata->data;
             $tousername =$touserinfo->user_login;
        ?>

         
         <tr id="" class="iedit author-self level-0 post-338 type-slider status-publish has-post-thumbnail hentry category-login">
			<td>$<?php echo $value->amount/100;?></td>
			<td><?php echo $value->currency;?></td>	
			<td><?php echo $fromusername;?></td>	
			<td><?php echo $tousername;?></td>	

			<td><?php echo $value->subscription_id;?></td>	
			<td><?php echo $value->plan_id;?></td>	
			<td><?php echo $value->subscription_object;?></td>
			<td><?php echo $value->customer_id;?></td>
			<td><?php echo $value->status;?></td>		
        </tr>
 
        <?php  }
     

        } else{
        	?>
<tr class="iedit author-self level-0 post-338 type-slider status-publish has-post-thumbnail hentry category-login"><td class="author column-author" data-colname="Author" colspan="9" style="text-align: center;">No Record Found</td></tr>

        	<?php  }  ?>
        
    </tbody>
    <tfoot>
    	<th scope="col" id="author" class="manage-column column-title column-primary sortable desc"><a href="#">Amount</a> </th>
            <th scope="col" id="title" class="manage-column"><a href="#"><span>Currency</span><span class="sorting-indicator"></span></a></th>
             <th scope="col" id="title" class="manage-column column-title column-primary sortable desc" style=""><a href="#"><span>From Pay User</span></a></th>
                <th scope="col" id="title" class="manage-column column-title column-primary sortable desc" style=""><a href="#"><span>To pay User</span></a></th>

             <th scope="col" id="title" class="manage-column column-title column-primary sortable desc" style=""><a href="#"><span>	Subscription Id</span></a></th>
             <th scope="col" id="author" class="manage-column column-title column-primary sortable desc"><a href="#">Plan Id</a> </th>

            
            <th scope="col" id="author" class="manage-column column-author"><a href="#">Subscription object</a> </th>
            <th scope="col" id="author" class="manage-column column-author"><a href="#">Customer Id </a></th>
            <th scope="col" id="author" class="manage-column column-author"><a href="#">Payment Status</a> </th>
    </tfoot>
</table>
</div>