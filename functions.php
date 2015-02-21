<?php
/**
 * Slightly Modified Options Framework
*/
require_once ('admin/index.php');


load_theme_textdomain( 'crumble', get_template_directory_uri() . '/languages' );


function register_crumble_menu() { 
  register_nav_menus(
    array(
      'main_menu' => __( 'main navigation' , 'framework' ),
      'secondary_menu' => __( 'additional navigation' , 'framework' )
    )
  );
}


add_action( 'init', 'register_crumble_menu' ); 



/*require_once('includes/el-metabox-portfolio.php');*/


if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<div class="widget-title"><h4>',
        'after_title' => '</h4></div>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Magazine',
        'before_widget' => '',
        'after_widget' => '<div class="clear"></div><div class="margin-30b"></div>',
        'before_title' => '<div class="post-title"><h4>',
        'after_title' => '</h4></div>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Single Post Widget',
        'before_widget' => '',
        'after_widget' => '<div class="clear"></div><div class="margin-30b"></div>',
        'before_title' => '<div class="post-title"><h4>',
        'after_title' => '</h4></div>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Top Blog',
        'before_widget' => '',
        'after_widget' => '<div class="clear"></div><div class="margin-30b"></div>',
        'before_title' => '<div class="post-title"><h4>',
        'after_title' => '</h4></div>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Bottom Blog',
        'before_widget' => '',
        'after_widget' => '<div class="clear"></div><div class="margin-30b"></div>',
        'before_title' => '<div class="post-title"><h4>',
        'after_title' => '</h4></div>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Reviews',
        'before_widget' => '',
        'after_widget' => '<div class="clear"></div><div class="margin-30b"></div>',
        'before_title' => '<div class="post-title"><h4>',
        'after_title' => '</h4></div>',
    ));


if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer: First Column',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer: Second Column',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer: Third Column',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer: Fourth Column',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
));



if ( !isset( $content_width ) ) 
    $content_width = 980;


function remove_category_list_rel($output)
{
  $output = str_replace(' rel="category"', '', $output);
  return $output;
}

add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');

remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );

add_theme_support( 'automatic-feed-links' );

function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');


function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');




 add_theme_support( 'post-thumbnails' );
	 if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
	}

 add_image_size('mag-carousel', 420, 300, true); 
 set_post_thumbnail_size('mag-carousel', 420, 300, true);

 add_image_size('big-post-thumb', 630, 315, true); 
 set_post_thumbnail_size('big-post-thumb', 630, 315, true);

 add_image_size('single-post-thumb', 630, 280, true); 
 set_post_thumbnail_size('single-post-thumb', 630, 280, true);

 add_image_size('small-post-thumb', 80, 50, true); 
 set_post_thumbnail_size('small-post-thumb', 80, 50, true);


 add_image_size('related-post-thumb', 137, 85, true); 
 set_post_thumbnail_size('related-post-thumb', 137, 85, true);

 add_image_size('mag-slider', 630, 390, true); 
 set_post_thumbnail_size('mag-slider', 630, 390, true);

 add_image_size('fix', 80, 80, true); 
 set_post_thumbnail_size('fix', 80, 80, true);




 add_filter('show_admin_bar', '__return_false');





add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );



add_filter('widget_text', 'do_shortcode');




function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type',  array( 'post', 'reviews'));
}
return $query;
}
add_filter('pre_get_posts','SearchFilter'); 


function my_scripts_method() {
	global $data;
	

	wp_enqueue_script('jquery');

	if( !is_admin() ) {

		/* Super Fish JS */
		wp_register_script('super-fish',get_template_directory_uri().'/js/superfish.js',false, null , true);
		wp_enqueue_script('super-fish',array('jquery'));	

		/* Jquery-Easing */
		wp_register_script('jquery-easing',get_template_directory_uri().'/js/jquery.easing.1.3.js',false, null , true);
		wp_enqueue_script('jquery-easing',array('jquery'));	



		/* JCarousel */
		$carousel_visible = stripslashes ( $data['crumble_carousel_visible'] ); 
		if ( $carousel_visible == "Enable" ) {
		
			wp_register_script('jquery-carousel',get_template_directory_uri().'/js/jcarousel.min.js',false, null , true);
			wp_enqueue_script('jquery-carousel',array('jquery'));	
			
			wp_register_script('jquery-carousel-responsive',get_template_directory_uri().'/js/jcarousel_update.js',false, null , true);
			wp_enqueue_script('jquery-carousel-responsive',array('jquery','jquery-carousel'));	
			
		}

		/* Nivo Slider */
		$enable_slider = stripslashes( $data['crumble_slider_visible'] ); 
		

		if( $enable_slider == 'Enable' ) {
		
			wp_register_script('jquery-nivoslider',get_template_directory_uri().'/js/jquery.nivo.slider.js',false, null , true);
			wp_enqueue_script('jquery-nivoslider',array('jquery'));	
		}

		/* Flickr */
		wp_register_script('jquery-flickr',get_template_directory_uri().'/js/jflickrfeed.min.js',false, null , true);
		wp_enqueue_script('jquery-flickr',array('jquery'));	

		/* Twitter */
		wp_register_script('jquery-tweet',get_template_directory_uri().'/js/jquery.tweet.js',false, null , true);
		wp_enqueue_script('jquery-tweet',array('jquery'));	

		/* Collapse */
		wp_register_script('jquery-collapse',get_template_directory_uri().'/js/jquery.collapse.js',false, null , true);
		wp_enqueue_script('jquery-collapse',array('jquery'));	

		/* Tabs */
		wp_register_script('jquery-tabs',get_template_directory_uri().'/js/tabs.js',false, null , true);
		wp_enqueue_script('jquery-tabs',array('jquery'));	

		
	
		/* Flex Slider */
		wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
		wp_enqueue_script('flex-min-jquery',array('jquery'));	



		/* Prettyphoto */
		wp_register_script('prettyphoto-js',get_template_directory_uri().'/js/jquery.prettyphoto.js',false, null , true);
		wp_enqueue_script('prettyphoto-js',array('jquery'));

		/* Masonry */
		wp_register_script('masonry-js',get_template_directory_uri().'/js/jquery.masonry.min.js',false, null , true);
		wp_enqueue_script('masonry-js',array('jquery'));

		/* To Top */
		wp_register_script('scrolltopcontrol-js',get_template_directory_uri().'/js/scrolltopcontrol.js',false, null , true);
		wp_enqueue_script('scrolltopcontrol-js',array('jquery'));


		/* Custom JS */
		wp_register_script('custom-js',get_template_directory_uri().'/js/custom.js',false, null , true);
		wp_enqueue_script('custom-js',array('jquery'));

	
	} 
}
add_action('wp_enqueue_scripts', 'my_scripts_method');



function get_related_posts($post_id, $tags = array()) {
	$query = new WP_Query();
	
	$post_types = get_post_types();
	unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
	
	if($tags) {
		foreach($tags as $tag) {
			$tagsA[] = $tag->term_id;
		}
	}
	$query = new WP_Query( array('showposts' => 4,'post_type' => $post_types,'post__not_in' => array($post_id),'tag__in' => $tagsA,'ignore_sticky_posts' => 1,
	));
  	return $query;
}


function wp_corenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = ($wp_rewrite->using_permalinks()) ? user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' ) : @add_query_arg('paged','%#%');
  if( !empty($wp_query->query_vars['s']) ) $a['add_args'] = array( 's' => get_query_var( 's' ) );
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 1; 
  $a['mid_size'] = '3'; 
  $a['end_size'] = '1'; 
  $a['prev_text'] = 'Back'; 
  $a['next_text'] = 'Next'; 
  $a['total'] = $wp_query->max_num_pages;

  if ($max > 1) echo '<div class="pagination">';
  echo  paginate_links($a);
  if ($max > 1) echo '</div>';
}


function paginate() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => true,
		'type' => 'plain'
	);
	if( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	if( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	echo paginate_links( $pagination );
}



function upload_scripts_post() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/js/custom_uploader.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');

	wp_register_script('project-scripts', get_template_directory_uri().'/admin/js/project_scripts.js', false);
	wp_enqueue_script('project-scripts');
		
}


function upload_styles_post() {
	wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'upload_scripts_post'); 
add_action('admin_print_styles', 'upload_styles_post'); 






include("functions/crumble-widget-twitter.php");
include("functions/crumble-tabs-widget.php");
include("functions/crumble-recent-posts-thumbs-widget.php");
include("functions/crumble-recent-reviews-widget.php");
include("functions/crumble-author-profile-widget.php");
include("functions/crumble-related-posts-widget.php");
include("functions/crumble-fblikebox-widget.php");

include("functions/crumble-fbcomments-widget.php");
include("functions/crumble-fbsubscribe-widget.php");
include("functions/crumble-sharethis-widget.php");
include("functions/crumble-1-column-magazine-widget-reviews.php");
include("functions/crumble-2-columns-magazine-widget-reviews.php");
include("functions/crumble-flickr-widget.php");
include("functions/crumble-recent-comments-widget.php");
include("functions/crumble-popular-post-widget.php");
include("functions/crumble-4ads125x125-widget.php");
include("functions/crumble-ads300x250-widget.php");
include("functions/crumble-ads630x90-widget.php");
include("functions/crumble-1-column-magazine-widget-horizontal.php");
include("functions/crumble-2-columns-magazine-widget-vertical.php");
include("functions/crumble-2-columns-magazine-widget-thumbs.php");
include("functions/crumble-video-widget.php");
include("functions/social-counter/social-counter-widget.php");
include("functions/crumble-recent-posts-widget.php");



function custom_active_item_class($link) {
  return str_replace('current_page_item', 'crumble_current_page_item', $link);
}
 
add_filter('wp_nav_menu', 'custom_active_item_class');
add_filter('wp_list_pages', 'custom_active_item_class');


include("functions/reviews/crumble_create_review.php");


include("includes/post_views.php");



include("includes/author_social.php");


include("includes/shortcodes.php");


include("includes/soundcloud-shortcode.php");


function dp_get_author($comment) {
    $author = "";
    if ( empty($comment->comment_author) )
        $author = __('Anonymous', 'CrumbleMagazine');
    else
        $author = $comment->comment_author;
    return $author;
} 



function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>

   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
  
	  <div id="comment-<?php comment_ID(); ?>" class="first-comment">
   
   		   <?php if ($comment->comment_approved == '0') : ?>
   		      <em><?php _e( 'Your comment is awaiting moderation.' , 'crumble' ); ?></em>
   		   <?php endif; ?>
	

	    	<?php 
	    	
	    		echo get_avatar($comment,$size='50',$default='<path_to_url>' ); 
	    	?>

		
		<div class="comment-author-link">
			<?php 
			
				comment_author_link(); 
			?>
		</div>





	<div class="comment-date-link">
		<?php echo get_comment_date('F d, Y g:i:s a'); ?>
	</div>
		
         <?php comment_text() ?>

	       <div class="replay-buttton">	
		       	<?php comment_reply_link(array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>	
	       </div>


	<div class="clear"></div>	
	
</div> 


<?php
    }