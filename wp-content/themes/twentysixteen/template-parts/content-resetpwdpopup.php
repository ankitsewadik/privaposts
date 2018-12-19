
<!-- forgot password Modal -->
  <div class="all-pop">
     <div class="modal fade" id="reset_password_myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content login-info">
     
         <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
       
       <h1>Reset password</h1>
       <p>Please enter your current email address.</p>
       <div class="pop-form">
        <?php// echo do_shortcode('[ultimatemember_password]'); ?>
         <form action="">
            <div class="form-group"> <span class="input-icon"><i class="fa"><img src="<?php echo get_template_directory_uri() ?>/assets/images/icon-user.png" alt=""></i></span>
              <input type="text" id="pwd_text" name="pwd_text" class="form-control" placeholder="Email">
            </div>
             <span id="error_msg" style="display: none"></span>
           <div class="btns clearfix">
                  <button type="button" class="btn btn-default cancel blue-btn-hover" data-dismiss="modal">Cancel</button>
                  <button type="button" class=" btn btn-default save blue-btn-hover" id="forget_pwd">Send</button>
            </div>
          </form>
       </div>
      </div>
    </div>
  </div>
  </div>