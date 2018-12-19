<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
    <?php 
         $um_profile_id =  isset($_GET['ref'])?numhash($_GET['ref']):um_profile_id();
         $subscription_price =  get_user_meta( $um_profile_id, 'subscription_price', true); 
         $subscription_price =  ($subscription_price)?$subscription_price:'0.00';
          $current_user = get_user_by('id', $um_profile_id);
?>
<div class="modal modal-sec modal-sub  model-subcription fade" id="loginpopup-popup" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="wra-cont clearfix">
                <button type="button" class="close cls-sub" data-dismiss="modal"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Shape-1.png" alt="Shape-1"> </button>
                <div class="wrp-left pull-left">
                    <div class="wrp-img">
                        <?php echo get_avatar(  $um_profile_id, 240 ); ?>
                    </div>
                    <p>
                        <?php echo isset($current_user->first_name) && $current_user->first_name != ''?$current_user->first_name.' '.$current_user->last_name:'---'; ?>  <span class="apptickicon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/tick_small_edit.png" /></span>
                    </p>
                    <p><span>@<?php echo $current_user->user_login; ?></span></p>
                      <div class="appicon"><img src="<?php echo get_template_directory_uri()?>/assets/images/Priva_app_icon.png" /></div>
                </div>
                <div class="wrp-right pull-right">
                    <div id="right_content" style="display: block;">
                   <div class="flwheader">Sign up to <span>@<?php echo $current_user->user_login; ?></span></div>
                    <ul>
                        <li>Full Access to this user's exclusive content </li>
                        <li>Direct message with this user </li>
                        <li>Request personalised pay per view content from this user</li>
                        <li>Cancel your subscription at any time </li>
                    </ul>
                   </div>
<p class="status error"></p>
                    <div class="login-info register-subscribed" id="register_form">

                        <form id="registration_form" name="registration_form" method="post"action="regs">
                            
                            <div class="um-row _um_row_1 " style="margin: 0 0 30px 0;">
                                <div class="um-col-1">
                                    <div class="um-field um-field-user_login um-field-text um-field-type_text" data-key="user_login">
                                        <div class="form-group um-field-area"><span class="input-icon"><i class="fa"><img src="<?php echo get_template_directory_uri();?>/assets/images/um-faicon-user.png" alt=""></i></span>
                                            <input type="text" autocomplete="off" class="form-control um-form-field valid required" name="user_login" id="user_login" value="" placeholder="Username" data-validate="unique_username" data-key="user_login" type="text">

                                        </div>
                                    </div>
                                    <div class="um-field um-field-user_email um-field-text um-field-type_text" data-key="user_email">
                                        <div class="form-group um-field-area"><span class="input-icon"><i class="fa"><img src="<?php echo get_template_directory_uri();?>/assets/images/um-icon-android-mail.png" alt=""></i></span>
                                            <input autocomplete="off" class="form-control um-form-field valid " name="user_email" id="user_email" value="" type="email" placeholder="Email" data-validate="unique_email" data-key="user_email" >

                                        </div>
                                    </div>
                                    <div class=" um-field um-field-user_password um-field-password um-field-type_password" data-key="user_password">
                                        <div class="form-group um-field-area"><span class="input-icon"><i class="fa"><img src="<?php echo get_template_directory_uri();?>/assets/images/icon-pass.png" alt=""></i></span>
                                            <input type="password" class="form-control um-form-field valid " name="user_password" id="user_password" value="" placeholder="Password" data-validate="" data-key="user_password" size="8" value="" autocomplete="off">

                                        </div>
                                    </div>
                                    <div class="um-field um-field-user_password um-field-password um-field-type_password" data-key="confirm_user_password">
                                        <div class="form-group um-field-area"><span class="input-icon"><i class="fa"><img src="<?php echo get_template_directory_uri();?>/assets/images/icon-pass.png" alt=""></i></span>
                                            <input type="password"  class="form-control um-form-field valid " name="confirm_password" id="confirm_password" value="" placeholder=" Confirm Password" data-validate="" data-key="confirm_user_password" size="8" value="" autocomplete="off">

                                        </div>
                                    </div>
                                    <input type="hidden" name="refid" id="refid" value="<?php echo $_GET['ref'];?>">
                                </div>
                            </div>
                            <input name="form_id" id="form_id_14" value="14" type="hidden">

                            <input name="timestamp" class="um_timestamp" value="1537252473" type="hidden">

                            <p class="request_name">
                                <label for="request_14">Only fill in if you are not human</label>
                                <input name="request" id="request_14" class="input" value="" size="25" autocomplete="off" type="text">
                            </p>

                            <input id="_wpnonce" name="_wpnonce" value="3fb87ba9a0" type="hidden">
                            <input name="_wp_http_referer" value="/register/" type="hidden">
                            <div class="um-col-alt">

                                <div class="um-center">
                                    <input disabled="" value="Sign Up " class="btn btn-theme-sm signupbtn blue-btn-hover" id="um-signupbtn-btn" type="submit">
                                </div>

                                <div class="um-clear"></div>

                            </div>

                        </form>
                        <div class="text-center text-bottom">
                            <div class="check-rem signup">

                                <input name="rememberme" id="check-1" value="1" type="checkbox">
                                <label for="check-1"> By signing up you agree to our <a href="<?php echo site_url()?>/terms/">Terms of Use</a> and <a href="https://privaposts.vn.cisinlive.com/privacy/">Privacy Policy.</a></label>

                            </div>

                            <div class="text-center text-bottom"> Already have an account? <a href="#" class="text-link" onclick="showhideForm();">Log In </a> </div>

                        </div>

                    </div>

                    <div class="login-info login-subscribed" style="display: none;" id="login_form">
                        <form id="login_1" action="login" method="post">
                            
                            <div class="form-group"> <span class="input-icon"><i class="fa"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-user.png" alt=""></i></span>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username or email">
                            </div>
                            <div class="form-group"> <span class="input-icon"><i class="fa"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-pass.png" alt=""></i></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="">
                                <input type="hidden" name="ref_id" id="ref_id" value="<?php echo $_GET['refid'];?>">
                            </div>
                            <input type="hidden" name="um_profile_id" id="um_profile_id" value="<?php echo $um_profile_id; ?>">
                            <div class="form-group text-right">
                                <div class="check-rem">
                                    <input type="checkbox" name="check" id="check-1">
                                    <label for="check-1">Remember Me</label>
                                </div>
                              <a id="forgetpassDiv" class="btn-text" href="#" data-toggle="modal" data-target="#myModal">Forgot Password?</a></div>
                            <button type="submit" class="btn btn-theme-sm blue-btn-hover"> Log In</button>
                            <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                        </form>
                        <div class="text-center text-bottom"> Don't have an account? <a href="#" class="text-link" onclick="showhideForm();">Sign Up </a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showhideForm() {
        $("#register_form").toggle();
        $("#login_form").toggle();
         $("#right_content").toggle();
    }
</script>