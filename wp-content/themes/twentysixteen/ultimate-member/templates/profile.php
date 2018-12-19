<?php 
   if(is_user_logged_in()){
       get_template_part( 'template-parts/content', 'loginprofile' ); // after login form ?>
       <script type="text/javascript">
       		//page scroll

          $("#new_post").submit(function(){
          
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
                    $(".loader").show();
                      $.ajax({
                          type: "POST",
                          url: ajax_url,
                          dataType: "JSON",
                          data : form_data,
                          contentType: false,
                          processData: false,
                          success: function(response){
                          
                            if(add_post_value==0){
                                $("#description").val('');
                              window.location.href = siteurl+"profile";  
                            }
                            if(response.error == 1){
                              alert(response.msg);
                               return false;
                            }else{
                               $("#description").val('');
                              location.reload();   
                            }
                            
                        }
                    });
                }//inner else
          }//outer else
          
      });
          
  $(window).scroll(function() {
        //init
        
        var page = $('#loadMore').data('page');
        var newPage = page + 1;
        var ajaxurl = $('#loadMore').data('url');
        //check
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            $(".loader").show();
            //ajax call
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    page: page,
                    profile_id: profile_id,
                    action: 'ajax_script_load_more'
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    //check
                    $(".loader").hide();
                    if (response == 0) {
                        $('#loadMore').hide();
                    } else {
                        $('#loadMore').data('page', newPage);
                        $('#ajax-content').append(response);
                        //$('#loadMore').show();
                    }
                }
            });
        }
    });




//page end scroll
       </script>
       <?php 
   }else{
       get_template_part( 'template-parts/content', 'logoutprofile' ); // if any user want to refer
   }
?>


