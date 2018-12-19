<?php

     $login_slider_item = get_option('login_slider_item');
     $login_slider_autoplay = get_option('login_slider_autoplay');
     $login_slider_loop = get_option('login_slider_loop');
     $login_slider_dots = get_option('login_slider_dots');

     $login_autoplaytimeout = get_option('login_autoplaytimeout');

  

       $items = isset($login_slider_item) ? $login_slider_item : 1;
       $autoplay = (isset($login_slider_autoplay)) && $login_slider_autoplay ==1 ? true : false;
       $loop = (isset($login_slider_loop)) && $login_slider_loop ==1 ? true : false;
       $dots = (isset($login_slider_dots)) && $login_slider_dots ==1 ? true : false;
       $autoplayTimeout = isset($login_autoplaytimeout) ? $login_autoplaytimeout : 2000;


    ?>

<script type="text/javascript">
	$(document).ready(function(){
	 $('#iphone-carousel').owlCarousel({
        loop:'<?php echo $loop;?>',
        margin:0,
        nav:false,
        dots:'<?php echo (boolean)$dots; ?>',
        items:'<?php echo $items;?>',
        lazyLoad: true,
        autoplay: '<?php echo $autoplay;?>',
        autoplayTimeout: '<?php echo $autoplayTimeout;?>',
    });
	});
</script>
<div class="iphone-frame"> <img src="<?php echo get_template_directory_uri() ?>/assets/images/iphone-pic.png" alt="">
          <div class="carousel-outer">
            <div id="iphone-carousel" class="owl-carousel owl-theme">
            
             	<?php
	$data=getslider();
	if($data){
		
	foreach ($data as $value) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $value ), 'single-post-thumbnail' );
		$backendImage=(isset($image[0]) && $image[0]!='')?$image[0]:'';
		?>
		<div class="item"><img src="<?php echo $backendImage;?>" alt="" /> </div>
		<?php
	}
} ?>

            </div>
          </div>
        </div>



