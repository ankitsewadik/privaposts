$(document).ready(function(e) {
//validation
  $(".a_status").click(function(){
      var ajax_url = 'http://localhost/privaposts/wp-admin/admin-ajax.php';
      var Id = $(this).attr('attr');
      var status = ($(this).attr('attrs')==0)?1:0;
      $.ajax({
               type: "POST",
               url: ajax_url,
               data :{
                     'action': 'bankaccount_status',
                     'b_id':Id,
                     'status':status,
                }, 
                success: function(response){
                  location.reload();
               }
          });
  });
});