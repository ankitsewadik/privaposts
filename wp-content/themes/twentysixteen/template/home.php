<?php /* Template Name: Home */ ?>
<?php
   get_header('profile-logein');
    
   if(!is_user_logged_in()){
      wp_redirect( home_url() );
      exit;
   }
   // $description = get_user_meta( um_profile_id(), 'description', true );
   //$subscription_price =  get_user_meta( um_profile_id(), 'subscription_price', true); 
   //$subscription_price =  ($subscription_price)?$subscription_price:'0.00';
   
   if(is_currentUser()){
    //$subscribed = true;
   }else{
   /// $subscribed = UM()->Followers_API()->api()->followed( um_profile_id(), get_current_user_id() );  
   }
   
   $author_ids = array();
   $subscribe_user_ids = UM()->Followers_API()->api()->following(get_current_user_id());

   if(!empty($subscribe_user_ids)){
         foreach($subscribe_user_ids as $following){
                    array_push($author_ids, $following['user_id1']);

          }
   }
   $author_ids[] = get_current_user_id();
   $author_ids[] = 1; // for super admin Id*/

   // $articles = query_posts( array( 

   //                             'orderby'  =>  'post_date',
   //                             'order'  =>  'Desc',
   //                             'post_type' => 'post',
   //                              'posts_per_page' => 5,
   //                             'author__in'=> array_values($author_ids)
   //                          )
   //                      );

?>

<div class="dash-cnt-wrp">
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="dash-content">
            <div class="fl-search-bx form-group">
               <input placeholder="Search" class="form-control" type="text">
            </div>
         </div>
         <?php if(is_pu_user(get_current_user_id())){  ?>
       
               <div class="form-search">
                  <div class="fl-search-bx form-group">
                  </div>
                 <form id="new_post" name="new_post" method="post" action="" onsubmit="return false;" enctype="multipart/form-data" >
                     <div class="fl-text-bx form-group">
                        <textarea class="form-control" id="description" name="description"" placeholder="Create new Post..."></textarea>
                     </div>
                     <div class="file-upload-btn clearfix form-group">
                        <input class="aryfiles" type="file" id="files" name="files">
                          <?php if(is_pu_user(get_current_user_id())){ ?>
                        <input type="hidden" name="post_type" id="post_type" value="post" />
                        <input type="hidden" name="action" value="post" />
                        <div class="share-btn">
                          <button href="#" type="submit" id="submit" name="submit" class="btn-shr"><i class="fa fa-paper-plane"></i></button> 
                        </div>
                      <?php } ?>
                        <?php wp_nonce_field( 'new-post' ); ?>
                  </form>
                  </div>
               
            <?php  }   ?>
         </div>
              <!-- load comment div start -->  
         <?php echo do_shortcode('[ajax_home_posts]'); ?>
      </div>
   </div>
<?php //echo do_shortcode('[ajax_posts]'); ?>
<script type="text/javascript">
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
                url: ajax_url,
                type: 'post',
                data: {
                    page: page,
                    action: 'ajax_script_home_load_more'
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

</script>

<?php get_footer(); ?>