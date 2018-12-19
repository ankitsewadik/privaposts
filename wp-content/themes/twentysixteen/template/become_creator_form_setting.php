<h3 class="text-center"><?php echo the_title();?></h3>
<?php 
    if(!is_user_logged_in()){
        wp_redirect(home_url()); exit();
    }
    session_start();
    global $current_user; 
    $subscription_price = get_user_meta( $current_user->ID, 'subscription_price', true );
    $subscription_price_val = get_user_meta( $current_user->ID, 'subscription_price_val', true );
    $user_bank_details = get_user_meta( $current_user->ID, 'user_bank_details', true );
    
    $user_bank_details= unserialize($user_bank_details);
    //print_r($user_bank_details);
    if($user_bank_details && !empty($user_bank_details)){
     
    $legal_name=($user_bank_details['legel_name'] && $user_bank_details['legel_name']!='')?$user_bank_details['legel_name']:'';
       
    $bank_country=($user_bank_details['bank_country'] && $user_bank_details['bank_country']!='')?$user_bank_details['bank_country']:'';
    $document_url=(isset($user_bank_details['document_url']) && $user_bank_details['document_url']!='')?$user_bank_details['document_url']:'';  
    }

if(isset($_POST['subscription_bank_detail']) && $_POST['subscription_bank_detail']!='' && $_POST['subscription_bank_detail']=='subscription_bank_detail'){
 
 $subscription_price=(isset($_POST['subscription_price']) && $_POST['subscription_price']!='')?$_POST['subscription_price']:'';

 $added_subscription_price = ( isset($_POST['added_subscription_price']) && $_POST['added_subscription_price'] != '' ) ? $_POST['added_subscription_price'] : '';

    if($subscription_price!=''){
         if($subscription_price<=4.99){
          $subscription_price=4.99;
         }
   // update_user_meta( $current_user->ID, 'subscription_price', $subscription_price);
    update_user_meta( $current_user->ID, 'subscription_price',  number_format((float)$subscription_price, 2, '.', ''));
    }

    if(($added_subscription_price == '' || $added_subscription_price =='0.00') && ($subscription_price!='' && $subscription_price !='0.00')){

         $message = 'Subscription price added successfully!';
            $message .='<div style="max-width: 560px; padding: 20px; background: #ffffff; border-radius: 5px; margin: 40px auto; font-family: Open Sans,Helvetica,Arial; font-size: 15px; color: #666;">
                        <div style="color: #444444; font-weight: normal;">
                        <div style="text-align: center; font-weight: 600; font-size: 26px; padding: 10px 0; border-bottom: solid 3px #eeeeee;">Privaposts</div>
                        <div style="clear: both;"> </div>
                        </div>
                        <div style="padding: 0 30px 30px 30px; border-bottom: 3px solid #eeeeee;">
                        <div style="padding: 30px 0; font-size: 24px; text-align: center; line-height: 40px;">Subscription Price added successfully!</span></div>


                        <div style="padding: 10px 0 50px 0; text-align: center;"><a style="background: #555555; color: #fff; padding: 12px 30px; text-decoration: none; border-radius: 3px; letter-spacing: 0.3px;" href="#">$'.$subscription_price.'</a></div>
                        
                        <div style="color: #999; padding: 20px 30px;">
                        <div>Thank you!</div>
                        <div>The <a style="color: #3ba1da; text-decoration: none;" href="#">privapost</a> Team</div>
                        </div>
                        </div>';
            $adminemail=get_option('admin_email');
            //$mailResult = wp_mail( $adminemail, 'Subscription Price added successfully!', $message );
            
        $_SESSION['message'] = '<div class="alert alert-success alert-become"><strong>Success!</strong> Congratulations you are now a Privapost content creator, have fun and earn easy money!</div> '; 
        wp_redirect( site_url('/become-creator') );
        exit;

    }else{
        $_SESSION['message'] = '<div class="alert alert-success alert-become"><strong>Success!</strong> Subscription price updated successfully!</div> '; 
        wp_redirect( site_url('/become-creator') );
        exit;    
    }

}
if(isset($_POST['bank_detail']) && $_POST['bank_detail']!='' && $_POST['bank_detail']=='bank_detail'){
   
    $user_bank_information=array();    
    $subscription_price=(isset($_POST['subscription_price']) && $_POST['subscription_price']!='')?$_POST['subscription_price']:'';
    $legal_name=(isset($_POST['legal_name']) && $_POST['legal_name']!='')?$_POST['legal_name']:'';
    $bank_country=(isset($_POST['bank_country']) && $_POST['bank_country']!='')?$_POST['bank_country']:'';
    $document_url_added=(isset($_POST['document_url_added']) && $_POST['document_url_added']!='')?$_POST['document_url_added']:'';
        
        //print_r($_FILES);

        if(isset($current_user->ID) && $current_user->ID!=''){
            
           $user_bank_information=array('legel_name'=>$legal_name,'document_id'=>$document_id,'bank_country'=>$bank_country,'document_url'=>'');
           
           
            
            if ( !function_exists("wp_handle_upload") ) {
                require_once(ABSPATH . "wp-admin/includes/file.php");
            }
            if(isset($_FILES['document']['name']) && $_FILES['document']['name']!=''){
              
               $movefile = wp_handle_upload($_FILES['document'], array('test_form' => false,'unique_filename_callback'=>'my_custom_filename') );
                if($movefile['url']!=''){
                  $user_bank_information['document_url']=$movefile['url'];
                } 

                 $message = 'Document added successfully!';
            $message .='<div style="max-width: 560px; padding: 20px; background: #ffffff; border-radius: 5px; margin: 40px auto; font-family: Open Sans,Helvetica,Arial; font-size: 15px; color: #666;">
                        <div style="color: #444444; font-weight: normal;">
                        <div style="text-align: center; font-weight: 600; font-size: 26px; padding: 10px 0; border-bottom: solid 3px #eeeeee;">Privaposts</div>
                        <div style="clear: both;"> </div>
                        </div>
                        <div style="padding: 0 30px 30px 30px; border-bottom: 3px solid #eeeeee;">
                        <div style="padding: 30px 0; font-size: 24px; text-align: center; line-height: 40px;">Subscription Price added successfully!</span></div>


                        <div style="padding: 30px 0; font-size: 24px; text-align: center; line-height: 40px;"><img src="'.$user_bank_information['document_url'].'"></span></div>
                        <div style="padding: 20px;">If you have any problems, please contact us at ankit.s@cisinlabs.com</div>
                        </div>
                        <div style="color: #999; padding: 20px 30px;">
                        <div>Thank you!</div>
                        <div>The <a style="color: #3ba1da; text-decoration: none;" href="#">privapost</a> Team</div>
                        </div>
                        </div>';
            $adminemail=get_option('admin_email');
            $mailResult = wp_mail( $adminemail, 'Subscription Price added successfully!', $message );

            
            }else{
                $user_bank_information['document_url']=$document_url_added;
            }

            //print_r($user_bank_information);
            
            update_user_meta( $current_user->ID, 'user_bank_details', serialize($user_bank_information));
            update_user_meta( $current_user->ID, 'user_bank_details_status', 0);
            
            $_SESSION['message'] = '<div class="alert alert-success alert-become"><strong>Success!</strong> Your account is now pending for approval, please allow 24-48 hrs.</div> ';
            
            wp_redirect( site_url('/become-creator') );
            exit;

        }else{
           $_SESSION['message'] = '<div class="alert alert-danger alert-become"><strong>Error!</strong> Something goes wrong please try again later.</div>';
            wp_redirect( site_url('/become-creator') );
             exit;
        }

}
if(isset($_SESSION['message']) && $_SESSION['message']!=''){
 echo $_SESSION['message'];  
 $_SESSION['message']=''; 
}
   
?> 

<div class="bcme-creator-info">
 <ul class="fa-ul">
  <li>
   <i class="fa fa-li fa-usd"></i>
   <h4>Step 1 - Enter Subscription price</h4>
   <p>Is the only step needed to post content and earn money from subscribers!</p>
  </li>
  <li>
   <i class="fa fa-li fa-picture-o"></i>
   <h4>Step 2 - Upload profile and cover photos</h4>
   <p>Optional but strongly recommended to market your profile.</p>
  </li>
  <li>
   <i class="fa fa-li fa-university"></i>
   <h4>Step 3 - Enter your bank details</h4>
   <p>Only required to withdraw your earnings.</p>
  </li>
 </ul>
 
    <!--<p><strong>Step 1</strong> is the only step required to become a Creator. 
Once you set your Subscription Price you will be able to post content and instantly earn money from subscribers.</p><p><strong>Step 2</strong> is optional, and <strong>Steps 3 </strong> &<strong> 4</strong> are only required to withdraw your earnings.</p>-->
</div>

<form class="cmxform" id="subscription_price_detail" name="subscription_price_detail"  method="post" action="" enctype="multipart/form-data"> 
 <input type="hidden" name="subscription_bank_detail" value="subscription_bank_detail" >  
<div class="row">
    <div class="set-panels  bec-crt-step">
        <div class="panel panel-default">
            <div class="panel-heading">
               <i class="fa fa-usd"></i>Step 1 - </i><span>Enter Subscription Price ($)*</span>
            </div>
             <?php 
                if($subscription_price_val && $subscription_price_val=='off'){
                  $disabled='readonly';
                }else{
                  $disabled='';
                }
            ?>
            <div class="panel-body">
                <div class="entr-price">
                    <input type="text" class="form-control subscription_price"  placeholder="$0.00" name="subscription_price" id="subscription_price" value="<?php echo $subscription_price;?>" <?php // echo $disabled;?>>USD per month<span class="mandatory-star">*</span>
                    <input type="hidden" name="added_subscription_price" id="added_subscription_price" value="<?php echo @$subscription_price;?>">
                   
                    <button type="submit" class="btn save-price theme-btn blue-btn-hover">Save Price</button>
                </div>
                <p>*Subscription price required in order to post content. Money earned will be kept in a holding account until you Enter Bank Details below to collect your money. By setting a subscription price, you confirm you are at least 18 years old and agree to our terms &amp; conditions for posting content</p>
            </div>
        </div>
</form>

<form class="cmxform" id="bank_detail" name="bank_detail"  method="post" action="" enctype="multipart/form-data">
     <input type="hidden" name="bank_detail" value="bank_detail" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-picture-o"></i>Step 2 -  </i><span>Upload your cover photo and profile photo</span>
            </div>
            <div class="panel-body">
                <div class="profilebox">
                    <div class="upload-img profile-edit-pic">
                        <p>Profile</p>
                        <div class="upload-img-bx">
                            <?php echo do_action( 'um_profile_header', array() ); ?>
                        </div>

                    </div>
                    <div class="upload-img cover-edit-pic">
                        <p>Cover</p>
                        <div class="upload-img-bx">
                            <?php do_action( 'um_profile_header_cover_area', array('cover_enabled' =>1)  ); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php /* ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Step 3 - <span>Verify your ID</span>
            </div>
            <div class="panel-body">
                <div class="area-box ">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Legal Name</label>
                       <input type="text" class="form-control" id="pass" placeholder="" name="legal_name" id="legal_name" value="<?php echo $legal_name;?>">

                    </div>
                </div>
                <div class="upl-doc">
                    <p>Please upload a Government issued photo ID Document (i.e. Passport, Drivers Licence)</p>
                    <div class="btn-pas up-btn">
                        <input type="file"  class="form-control" id="document" name="document" placeholder="">
                        <label for="upload" class="btn theme-btn btn-default">Upload File</label>
                    </div>
                    <input type="hidden" name="document_url_added" id="document_url_added" value="<?php echo $document_url;?>">
                </div>
             <?php 
          
                    if(isset($document_url)&& $document_url!=''){

                        $imagename=basename($document_url);
                       ?>
                            <div class="click-link">
                            <a href="<?php echo $document_url;?>" target="_blank">  <?php echo $imagename;?></a>
                            </div>
                   <?php  } ?>
            </div>
        </div>
        <?php */ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-university"></i>Step 3 - <span>Verify  your bank details to receive payments from your Subscribers</span>
            </div>
            <div class="panel-body">
                <div class="area-box ">
                    <div class="form-group">
                        <label for="sel2">Bank account country</label>

                         <?php                          
            $cntCode="13,14,21,38,58,74,75,82,98,105,107,109,127,154,155,157,164,176,196,205,211,212,230,231";
            $countryDropdown=countryDropdown($cntCode);
        ?>

                        <select class="form-control" id="bank_country" name="bank_country">
                            <option value="">Select a option</option>
                            <?php foreach ($countryDropdown as $value) {
                            ?>
                            <option <?php if($bank_country==$value->sortname){?>  selected <?php } ?> value="<?php echo $value->sortname;?>"><?php echo $value->name;?></option>
                            
                        <?php } ?>  
                        </select>
                    </div>
                </div>
             <div class="sub-btn">
            <div class="btns clearfix">
                <button type="button" class="btn btn-default cancel blue-btn-hover" data-dismiss="modal">Cancel</button>
                <button type="submit" class=" btn btn-default save blue-btn-hover">Submit</button>
            </div>
        </div>
            </div>
        </div>
        

    </div>
</div>

</form>