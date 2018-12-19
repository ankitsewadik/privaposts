<?php /* Template Name: How it works */ 

if(is_user_logged_in()){
	get_header('profile-logein');
}else{
	get_header();	
}

$how_it_work_item = get_option('how_it_work_item');
 $how_it_work_autoplay = get_option('how_it_work_autoplay');
 $how_it_work_loop = get_option('how_it_work_loop');
 $how_it_work_autoplaytimeout = get_option('how_it_work_autoplaytimeout');


       $items = isset($how_it_work_item) ? $how_it_work_item : 1;
       $autoplay = (isset($how_it_work_autoplay)) && $how_it_work_autoplay ==1 ? true : false;
       $loop = (isset($how_it_work_loop)) && $how_it_work_loop ==1 ? true : false;
       $autoplayTimeout = isset($how_it_work_autoplaytimeout) ? $how_it_work_autoplaytimeout : 2000;
?>
<div class="cont-wrp"> 
	<section class="pri-sec">
	<div class="container"> 
		<div class="row">
			<div class="col-md-12">
						<div class="main-heading">
							<h1><?php echo get_the_title(); ?></h1>
							  </div>
			        
		  
		<?php
                $args = array('post_type' => 'slider', 'posts_per_page' => -1,'post_status' => 'publish','category_name' => 'how_it_work');
                $query = new WP_Query( $args );
              ?>
            <div class="slider-how-works">
                <div id="how-slide" class="owl-carousel owl-theme">
                <?php  
                while ( $query->have_posts() ) : $query->the_post();
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                  $imageUrl=(isset($image[0]) && $image[0]!='')?$image[0]:'';
                ?>
                <div class="item"> 
                          <img src="<?php echo $imageUrl;?>" alt="">
                        <div class="cap-slide">
                         <p><?php echo the_content();?> </p>
                        </div>
            </div>

   <?php  endwhile;

    ?>
      
       
      
      
      </div>
     </div>
<div class="sub-heading">
<h4>How much could you earn?</h4>
</div>
<div class="fool-count">
  <div class="head-lft">Number Of Followers? <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>&nbsp;<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>&nbsp;<a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>&nbsp;<a href="#"><i class="fa fa-snapchat-ghost" aria-hidden="true"></i></a> 
      </div>
<div class="range-slider"><span class="left-value">1,000</span>
<input id="slider1" type="text" data-slider-min="1000" data-slider-max="1000000" data-slider-step="1000" data-slider-value="10000" />
<span class="rgt-value">1,000,000</span></div>
</div>
<div class="mnth-sub-price">
<div class="head-lft">Monthly Subscription Price</div>
<div class="range-slider"><span class="left-value">$1</span>
<input id="slider2" type="text" data-slider-min="1" data-slider-max="100" data-slider-step="1" data-slider-value="15" />
<span class="rgt-value">$100</span></div>
</div>
<!-- <div class="info-txt">
      <h1>You earnings would be between <strong id="priceC1">$2,500</strong> and <strong id="priceC2">$12,500</strong> per month</h1>
      <p>Based on <span>1%</span> and <span>5%</span> of your followers subscribing.</p>
      <p>Doesn’t include income from Tips and Pay per view messages.</p>
     </div> -->


     <div class="info-txt">
      <h1>Your earnings would be between <strong id="priceC1">$2,500</strong> and <strong id="priceC2">$12,500</strong> per month</h1>
      <p>Based on <span>1%</span> and <span>5%</span> of your followers subscribing. On average 8% to 10% of our content creators’ followers on social media will pay for exclusive content.</p>
      
     </div>


    

			</div>
		</div>
	</div>
	</section>
</div>

<script type="text/javascript">
  
  $('#how-slide').owlCarousel({
     loop:'<?php echo $loop;?>',
        margin:10,
        nav:true,
        items:'<?php echo $items;?>',
        lazyLoad: true,
        autoplay: '<?php echo $autoplay;?>',
        autoplayTimeout: '<?php echo $autoplayTimeout;?>',
  
    navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
});


$("#slider1").slider({
 tooltip: 'always', 
  min: 1000,
  max: 1000000,
  
  step: 1000,
  formatter: function(slider1) {
    var slider2 = $('#slider2').val();

    calculatesliderPrice(slider1,slider2);
    var commaNum = numberWithCommas(slider1);
    return commaNum;
  },
}).on('change', function(event) {
    //calculatesliderPrice();
});

$("#slider2").slider({
 tooltip: 'always', 
  min: 1,
  max: 100,
  
  step: 1,
  formatter: function(slider2) {
    var slider1 = $('#slider1').val();
    calculatesliderPrice(slider1,slider2);
      var commaNum = numberWithCommas(slider2);
    return commaNum;
    //return slider2;
  },

}).on('change', function(event, ui) {
    //console.log(ui.values[ 0 ]);
   // calculatesliderPrice();
});

// $('#slider1').slider().on('change', function(event) {
//     alert('dd');
// });

  

// $("#slider2").slider({
//  tooltip: 'always',
//   min: 1,
//   max: 100,
//   scale: 'logarithmic',
//   step: 1,
// }).on('change', function(event) {
//     calculatesliderPrice();
// });

function calculatesliderPrice(slider1,slider2){
  //var slider1 = $('#slider1').val();
  //var slider2 = $('#slider2').val();
  console.log(slider1+'-'+slider2);
  var price1  = slider1*slider2*0.01;
  var price2  = slider1*slider2*0.05;
  var commaNum1 = numberWithCommas(price1);
  var commaNum2 = numberWithCommas(price2);

  $('#priceC1').text('$'+commaNum1);
  $('#priceC2').text('$'+commaNum2); 
}


function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

</script>


<?php //get_sidebar(); ?>
<?php get_footer(); ?>