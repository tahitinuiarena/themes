<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		
		$shortname = "crumble";
		
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
		    }

		$categories_tmp = array_unshift($of_categories, "all categories");    


		
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory() . '/images/bg/'; // change this to where you store your bg images
		$favico_urls = get_template_directory_uri().'/images/';
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 



/*
======================================================================================= 
*/

// Type of Logo ( image or text )
$crumble_logotype = array ( "image" , "text" );

$crumble_carousel_visible = array ( "Enable" , "Disable" );

$crumble_easing = array (
							"1" => "easeInQuad",
							"2" => "easeOutQuad",
							"3" => "easeInOutQuad",
							"4" => "easeInCubic",
							"5" => "easeOutCubic",
							"6" => "easeInOutCubic",
							"7" => "easeInQuart",
							"8" => "easeOutQuart",
							"9" => "easeInOutQuart",
							"10" => "easeInQuint",
							"11" => "easeOutQuint",
							"12" => "easeInOutQuint",
							"13" => "easeInSine",
							"14" => "easeOutSine",
							"15" => "easeInOutSine",
							"16" => "easeInExpo",
							"17" => "easeOutExpo",
							"18" => "easeInOutExpo",
							"19" => "easeInCirc",
							"20" => "easeOutCirc",
							"21" => "easeInOutCirc",
							"22" => "easeInElastic",
							"22" => "easeOutElastic",
							"23" => "easeInOutElastic",
							"24" => "easeInBack",
							"25" => "easeOutBack",
							"26" => "easeInOutBack",
							"27" => "easeInBounce",
							"28" => "easeOutBounce",
							"29" => "easeInOutBounce",
);

$crumble_slider_visible = array ( "Enable" , "Disable" );
$crumble_slider_effect = array ( 
							"1" => "random",
							"2" => "sliceDown",
							"3" => "sliceDownLeft",
							"4" => "sliceUp",
							"5" => "sliceUpLeft",
							"6" => "sliceUpDown",
							"7" => "sliceUpDownLeft",
							"8" => "fold",
							"9" => "fade",
							"10" => "slideInRight",
							"11" => "slideInLeft",
							"12" => "boxRandom",
							"13" => "boxRain",
							"14" => "boxRainReverse",
							"15" => "boxRainGrow",
							"16" => "boxRainGrowReverse",
							
);

$crumble_sidebar_position = array( "Left" , "Right" );

$crumble_show_hide = array( "Show" , "Hide" );

$crumble_bg_color = array ( "Background Image" , "Color", "Upload" );
/*
=======================================================================================
*/		
/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();


/*
=====================================================================================================================
					GENERAL SETTINGS
=====================================================================================================================	
*/

$of_options[] = array( "name" => __( "General Settings" , "crumble" ),
					"type" => "heading");

$of_options[] = array( "name" => __("Type Of Logo","crumble"),
					   "desc" => __("Select your logo type ( Image or Text )" , "crumble"),
					   "id" => $shortname . "_type_logo",
					   "std" => "image",
					   "type" => "select",
					   "options" => $crumble_logotype); 

									
$of_options[] = array( "name" => __( "Logo Upload" , "crumble" ),
					"desc" => __( "Upload images using the native media uploader, or define the URL directly" , "crumble" ),
					"id" => $shortname . "_logo_upload",
					"std" => "",
					"type" => "upload");

$of_options[] = array( "name" => __( "Logo Text" , "crumble" ),
					"desc" => __( "Enter text for logo" , "crumble" ),
					"id" => $shortname . "_logo_text",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __( "Logo Slogan" , "crumble" ),
					"desc" => __( "Enter text for logo slogan" , "crumble" ),
					"id" => $shortname . "_logo_slogan",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __( "Sidebar Position" , "crumble" ),
					"desc" => __( "Select a location sidebar" , "crumble" ),
					"id" => $shortname . "_sidebar_position",
					"std" => "Right",
					"type" => "select",
					"options" => $crumble_sidebar_position);

$of_options[] = array( "name" => __( "Show Date & Time In Top" , "crumble" ),
					"desc" => __( "Show/Hide date & Time" , "crumble" ),
					"id" => $shortname . "_show_date",
					"std" => "Show",
					"type" => "select",
					"options" => $crumble_show_hide );

$of_options[] = array( "name" => __( "Show Search Block In Top" , "crumble" ),
					"desc" => __( "Show/Hide Search block" , "crumble" ),
					"id" => $shortname . "_show_search",
					"std" => "Show",
					"type" => "select",
					"options" => $crumble_show_hide );

$of_options[] = array( "name" => __( "Show The Second Menu Instead Of The Date" , "crumble" ),
					"desc" => __( "Show/Hide additional navigation" , "crumble" ),
					"id" => $shortname . "_show_second_menu",
					"std" => "Hide",
					"type" => "select",
					"options" => $crumble_show_hide );
					

$of_options[] = array( "name" => __( "Banner Upload" , "crumble" ),
					"desc" => __( "Upload images using the native media uploader, or define the URL directly" , "crumble" ),
					"id" => $shortname . "_banner_upload",
					"std" => "",
					"type" => "upload");

$of_options[] = array( "name" => __( "Banner Link" , "crumble" ),
					"desc" => __( "Enter url for banner in top section" , "crumble" ),
					"id" => $shortname . "_banner_link",
					"std" => "",
					"type" => "text");
					

$of_options[] = array( "name" => __( "Custom Favicon" , "crumble" ),
					"desc" => __( "Upload a 16px x 16px Png/Gif image that will represent your website's favicon." , "crumble" ),
					"id" => $shortname . "_custom_favicon",
					"std" => $favico_urls . "/favicon.ico",
					"type" => "upload"); 


$of_options[] = array( "name" => __( "Google Fonts Link Stylesheet" , "crumble" ),
					"desc" => __( "Paste code for stylesheet from Google Fonts" , "crumble" ),
					"id" => $shortname . "_google_stylesheet",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => __( "Google Fonts Family" , "crumble" ),
					"desc" => __( "Paste code for Fonts from Google" , "crumble" ),
					"id" => $shortname . "_google_fontfamily",
					"std" => "",
					"type" => "text");

                                               
$of_options[] = array( "name" => __( "Tracking Code" , "crumble" ),
					"desc" => __( "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme." , "crumble" ),
					"id" => $shortname . "_google_analytics",
					"std" => "",
					"type" => "textarea");        


/*
=====================================================================================================================
					CAROUSEL SETTINGS
=====================================================================================================================	
*/

$of_options[] = array( "name" => __( "Carousel Settings" , "crumble" ),
					"type" => "heading");


$of_options[] = array( "name" => __( "Enable / Disable Carousel" , "crumble" ),
					"desc" => __( "Show or Hide carousel on the homepage" , "crumble" ),
					"id" => $shortname . "_carousel_visible",
					"std" => "Enable",
					"type" => "select",
					"options" => $crumble_carousel_visible);

$of_options[] = array( "name" => __( "Title for Carousel" , "crumble" ),
					"desc" => __( "Enter title for featured carousel" , "crumble" ),
					"id" => $shortname . "_carousel_title",
					"std" => 'News by Category',
					"type" => "text"); 

$of_options[] = array( "name" => __( "Select a Category" , "crumble" ),
					"desc" => __( "Pick category for the carousels on home page" , "crumble" ),
					"id" => $shortname . "_carousel_category",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $of_categories);

$of_options[] = array( "name" => __( "Select A Method Of Animation" , "crumble" ),
					"desc" => __( "Pick easing animation for carousel" , "crumble" ),
					"id" => $shortname . "_carousel_easing",
					"std" => 'easeInOutQuint',
					"type" => "select",
					"options" => $crumble_easing);

$of_options[] = array( "name" => __( "Speed Of Animation" , "crumble" ),
					"desc" => __( "Enter value for easing animation in milliseconds" , "crumble" ),
					"id" => $shortname . "_carousel_animation_speed",
					"std" => 800,
					"type" => "text"); 
					
/*
=====================================================================================================================
					SLIDER OPTIONS
=====================================================================================================================	
*/
$of_options[] = array( "name" => __( "Featured Slider" , "crumble" ),
					"type" => "heading");

$of_options[] = array( "name" => __( "Show Slider On The Homepage" , "crumble" ),
					"desc" => __( "Enable or Disable slider on the homepage" , "crumble" ),
					"id" => $shortname . "_slider_visible",
					"std" => 'Enable',
					"type" => "select",
					"options" => $crumble_slider_visible);

$of_options[] = array( "name" => __( "Slider Animation Effect" , "crumble" ),
					"desc" => __( "Select the type of animation" , "crumble" ),
					"id" => $shortname . "_slider_effect",
					"std" => 'random',
					"type" => "select",
					"options" => $crumble_slider_effect);

$of_options[] = array( "name" => __( "Number Of Slider Items" , "crumble" ),
					"desc" => __( "Enter the number for show slides" , "crumble" ),
					"id" => $shortname . "_slider_items",
					"std" => "5",
					"type" => "text"); 
					
$of_options[] = array( "name" => __( "The Post's Tags for slider" , "crumble" ),
					"desc" => __( "Enter the tags separated by comma" , "crumble" ),
					"id" => $shortname . "_slider_tags",
					"std" => "",
					"type" => "text"); 

$of_options[] = array( "name" => __( "Speed For Slider Animation" , "crumble" ),
					"desc" => __( "Enter value for slider animation in milliseconds" , "crumble" ),
					"id" => $shortname . "_slider_animation_speed",
					"std" => 800,
					"type" => "text"); 
					
$of_options[] = array( "name" => __( "Pause For Slides" , "crumble" ),
					"desc" => __( "Enter value for pause between slides animation in milliseconds" , "crumble" ),
					"id" => $shortname . "_slider_animation_pause",
					"std" => 5000,
					"type" => "text"); 

$of_options[] = array( "name" => __( "Caption Opacity" , "crumble" ),
					"desc" => __( "Enter value caption opacity. Value between 0..1 (0.1, 0.2, ... , 1)" , "crumble" ),
					"id" => $shortname . "_slider_caption_opacity",
					"std" => 0.8,
					"type" => "text"); 

$of_options[] = array( "name" =>  __( "Color For Control Circle" , "crumble"),
					"desc" => __("Pick a color for control circle in slider" , "crumble"),
					"id" => $shortname . "_slider_control_color",
					"std" => "#FFF",
					"type" => "color");
					
$of_options[] = array( "name" =>  __( "Color For Active Control Circle" , "crumble"),
					"desc" => __("Pick a color for active control circle in slider" , "crumble"),
					"id" => $shortname . "_slider_control_active_color",
					"std" => "#2a2a2a",
					"type" => "color");
					
$of_options[] = array( "name" => "Styling Options",
					"type" => "heading");

$of_options[] = array( "name" => __( "Theme Style (Dark or Light)" , "crumble" ),
					"desc" => __( "Select your themes alternative color scheme." , "crumble" ),
					"id" => $shortname . "_theme_style",
					"std" => "dark.css",
					"type" => "select",
					"options" => $alt_stylesheets);

$of_options[] = array( "name" =>  __( "Theme Color" , "crumble"),
					"desc" => __("Pick a color for the theme" , "crumble"),
					"id" => $shortname . "_theme_color",
					"std" => "#921529",
					"type" => "color");

$of_options[] = array( "name" => __( "Use Background Image / BG Color / Upload Your Image" , "crumble" ),
					"desc" => __( "Select the type of usage background" , "crumble" ),
					"id" => $shortname . "_bg_color",
					"std" => 'Background Image',
					"type" => "select",
					"options" => $crumble_bg_color);

$of_options[] = array( "name" => __( "Image Upload For background" , "crumble" ),
					"desc" => __( "Upload images for background using the native media uploader, or define the URL directly" , "crumble" ),
					"id" => $shortname . "_bg_upload",
					"std" => "",
					"type" => "upload");


$of_options[] = array( "name" => __( "Background Images" , "crumble" ),
					"desc" => __( "Select a background pattern." , "crumble" ),
					"id" => $shortname . "_custom_bg",
					"std" => $bg_images_url."bg3.png",
					"type" => "tiles",
					"options" => $bg_images,
					);		

					
$of_options[] = array( "name" =>  __( "Body Background Color" , "crumble" ),
					"desc" => __( "Pick a background color for the theme (default: #454545)." , "crumble" ), 
					"id" => $shortname . "_body_background",
					"std" => "#454545",
					"type" => "color");


/*
=====================================================================================================================
					Copyrights
=====================================================================================================================	
*/
$of_options[] = array( "name" => __( "Copyrights" , "crumble" ),
					"type" => "heading");

$of_options[] = array( "name" => __( "Copyrights" , "crumble" ), 
                    "desc" => __( "Enter your copyrights" , "crumble" ), 
                    "id" => $shortname . "_copyrights",
                    "std" => '&copy 2012. All Rights Reserved. Created by Zerge for <a href="http://themeforest.net">themeforest.net</a>',
                    "type" => "textarea");

                    

					
// Backup Options
$of_options[] = array( "name" => "Backup Options",
					"type" => "heading");
					
$of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);
					
	}
}
?>
