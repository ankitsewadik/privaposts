<h3 class="text-center"><?php echo the_title();?></h3>
<div class="row">
<div class="col-md-12">
   <div class="form-search">
      <div class="fl-search-bx form-group">
      </div>
      <form id="new_post_form" name="new_post" method="post"  enctype="multipart/form-data"  action="" onsubmit="return false;">
         <div class="fl-text-bx form-group">
            <textarea class="form-control" id="description" name="description" placeholder="Create new post..." rows="5"></textarea>
         </div>
         <div class="file-upload-btn clearfix form-group">
            <div class="fil-upload">
               <input class="aryfiles" type="file" id="files" name="files">                     
             

               <input type="hidden" name="post_type" id="post_type" value="post">
            <input type="hidden" name="add_post_value" id="add_post_value" value="0">
            <input type="hidden" name="action" value="post">
            <div class="share-btn">
               <button href="#" type="submit" id="submit" name="submit" class="btn-shr"><i class="fa fa-paper-plane"></i></button> 
            </div>
            <input type="hidden" id="_wpnonce" name="_wpnonce" value="d7a47dd72d"><input type="hidden" name="_wp_http_referer" value="/wp/member/home/"> 
            
            </div>
            <?php// if(is_pu_user(get_current_user_id())){ ?>
                   
            <?php //} ?>
         </div>
      </form>
   </div>
</div>
<?php if(!is_pu_user(get_current_user_id())){ ?>
<div class="col-md-12">
       <div class="bcome-creator text-center">
                    <h3>Earn money from your followers now!</h3>
                    <a class="btn btn-theme" href="<?php echo home_url('become-creator'); ?>?profiletab=main&um_action=edit">Become a Creator</a>
                  </div>
</div>

<?php } ?>
</div>
<script type="text/javascript">
  $(document).ready(function(){


      var is_puuser = '<?php echo is_pu_user(get_current_user_id());  ?>';

      $("#fileuploadbtn1").click(function(){
            if(!is_puuser){
                $('#becomecreator-popup').modal('show');
                return false;  
            }
      });

      $("#new_post_form").submit(function(){

         if(!is_puuser){
              $('#becomecreator-popup').modal('show');
              return false;  
          }else{
                  var add_post_value = $("#add_post_value").val();
                  var p_content = $("#description").val();
                  //var form_elm = $(this);
                  var form_data = new FormData();
                  var files_data = $('.aryfiles');

                  //form_data.append( "image", $('#image')[0].files[0]);
                 var cnt = 0;
                  $.each($(files_data), function(i, obj) {
                     
                      $.each(obj.files,function(j,file){

                        form_data.append('files[' + cnt + ']', file);
                        cnt++;

                      })
                  });
                  
                  form_data.append('action', 'add_post');
                  form_data.append('p_content', p_content);
                  
                  if(p_content == "" && $('#files').val() ==""){
                      $("#description").css('border','1px solid red');
                      return false;  
                  }else{  
                    
                    $(".loaderpost").show();
                      $.ajax({
                          type: "POST",
                          url: ajax_url,
                          dataType: "JSON",
                          data : form_data,
                          contentType: false,
                          processData: false,
                           xhr: function () {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                console.log(percentComplete);
                $('.progress').css({
                    width: percentComplete * 100 + '%'
                });
                $('.progress').html(percentComplete * 100 + '%');
                if (percentComplete === 1) {
                   // $('.progress').addClass('hide');
                }
            }
        }, false);
        xhr.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                console.log(percentComplete);
                $('.progress').css({
                    width: percentComplete * 100 + '%'
                });
            }
        }, false);
        return xhr;
    },
    
                          success: function(response){
                             $(".loaderpost").hide();
                            if(add_post_value==0){
                                $("#description").val('');
                               //window.location.href = siteurl+"profile";  
                            }
                            if(response.error == 1){
                              alert(response.msg);
                               return false;
                            }else{
                               $("#description").val('');
                               // window.location.href = siteurl+"profile";  
                            }
                            
                        }
                    });
                }//inner else

          }//outer else
          
      });
  });

</script>


 