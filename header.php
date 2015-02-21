<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="description" content="<?php bloginfo('description'); ?>" />  
	<meta name="keywords" content="<?php bloginfo('name'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 
	
	<title><?php bloginfo('name'); ?> <?php wp_title(' | ', true, 'left'); ?></title>

	<!-- Meta pour mobile  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php global $data; ?>

	<!-- Favicons ================================================== -->
	<link rel="shortcut icon" href="<?php echo stripslashes( $data['crumble_custom_favicon'] ); ?>">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png">


	
	<?php	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	
	

	<?php wp_enqueue_style('reset',get_template_directory_uri().'/css/reset.css','','','all'); ?>


	<?php wp_enqueue_style('flexslider',get_template_directory_uri().'/css/flexslider.css','','','all'); ?>	
	
	<?php 
		$theme_style = stripslashes( $data['crumble_theme_style'] );
		
		
		if ( $theme_style == 'dark.css' ) {
			wp_enqueue_style( 'style',get_template_directory_uri().'/style.css','','','all'); 
		} else if ( $theme_style == 'light.css' ) {
			wp_enqueue_style( 'style',get_template_directory_uri().'/light.css','','','all'); 
		} else {
			wp_enqueue_style( 'style',get_template_directory_uri().'/style.css','','','all'); 		
		}
	?>

	<?php 
		$enable_slider = stripslashes( $data['crumble_slider_visible'] ); 
		if( $enable_slider == 'Enable' ) {
	?>
		<?php wp_enqueue_style('nivo-slider',get_template_directory_uri().'/css/nivo-slider.css','','','all'); ?>	
	<?php } ?>
	
	<?php wp_enqueue_style('css-skeleton',get_template_directory_uri().'/css/skeleton.css','','','all'); ?>
	<?php wp_enqueue_style('css-skeleton-layout',get_template_directory_uri().'/css/layout.css','','','all'); ?>
	


	<?php wp_enqueue_style('prettyPhoto-css',get_template_directory_uri().'/css/prettyphoto.css','','','all'); ?>		
	<?php wp_enqueue_style('custom-options',get_template_directory_uri().'/css/options.css','','','all'); ?>

	<?php wp_head(); ?>
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
	<?php 
		$google_stylesheet = stripslashes( $data['crumble_google_stylesheet'] );
		$font_family = stripslashes( $data['crumble_google_fontfamily'] );
		
		if ( $google_stylesheet != '' ) echo $google_stylesheet; 
		
		if ( ( $font_family != '' ) &&  ( $google_stylesheet != '' ) ) {
			echo '<style type="text/css">h1, h2, h3, h4, h5, h6, .widget .tabs li, .tabs li { ' . $font_family . ' }</style>';
		}	
	?>
	
</head>

<body <?php body_class('body-class'); ?>>


<!-- Début Wrapper Content -->
<div id="wrapper">
		
		<!-- DATE ET RECHERCHE -->	
		<div class="top-line">
			<div class="container">
				
				<?php if( stripslashes( $data['crumble_show_second_menu'] ) == 'Show' ) { ?>					
					<?php 
						echo '<div class="eleven columns">';
							if ( has_nav_menu('secondary_menu') ) wp_nav_menu( array('theme_location' => 'secondary_menu', 'menu_class' => 'sf-menu add-nav')); 
						echo '</div>'; 						
					?>
				<?php } else if( stripslashes( $data['crumble_show_date'] ) == 'Show' ) : ?>				

				<div class="eleven columns date">
						<img src="<?php echo get_template_directory_uri(); ?>/images/date-circle.png" alt="" />
						<div class="floatLeft"><?php echo date('l dS F Y, '); ?></div>											
						 <div id="timeNow"></div>
				</div>
				<?php endif; ?> 
				
				<?php if( stripslashes( $data['crumble_show_search'] ) == 'Show' ) : ?>				
				
				<div class="five columns search search-block">
					<form method="get" id="search" action="<?php echo home_url(); ?>/">
						<input type="text" name="s" id="s" value="<?php _e('Recherche ...','crumble'); ?>" onfocus='if (this.value == "<?php _e('Recherche ...', 'crumble'); ?>") { this.value = ""; }' onblur='if (this.value == "") { this.value = "<?php _e('Recherche ...', 'crumble'); ?>"; }' />
					</form>				
				</div>
				<?php endif; ?>	
								
			</div> <!-- /container -->
		</div> <!-- /top-line -->	
		
		
	<!-- LOGO -->
	<div class="container">
		
		<!-- D&eacute;but logo -->
		<div id="logo" class="seven columns">
		
			<?php $logo_type = stripslashes( $data['crumble_type_logo'] );  			
				if ( $logo_type == "image" ) { ?>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes( $data['crumble_logo_upload'] ) ?>" alt="" /></a>
			<?php }	?>
			
			<?php
				if ( $logo_type == "text" ) { ?>
					<div class="margin-10b"></div>
					<h1><a href="<?php echo home_url(); ?>"><?php echo stripslashes( $data['crumble_logo_text'] ); ?></a></h1><span><?php echo stripslashes( $data['crumble_logo_slogan'] ); ?></span>
			<?php }	?>
		
		</div>
		<!-- Banniere MANA -->
                <div class="nine columns banner border">
                        <div id="ox_9f2ce02e2e0b2048fbdf4e0766cb38b3" style="display: inline;">
                                <embed type="application/x-shockwave-flash" src="http://www.mana.pf/banpub/bandeaux/pubexterne/banner-ManaBOX-468x60px.swf" width="468" height="60" style="undefined" id="Advertisement" name="Advertisement" quality="high" allowscriptaccess="always" flashvars="alink1=http%3A%2F%2Fads.tna.pf%2Fwww%2Fdelivery%2Fck.php%3Foaparams%3D2__bannerid%3D4__zoneid%3D1__cb%3Db2b51f281f__oadest%3Dhttp%253A%252F%252Fwww.mana.pf%252F_par%252Fparticuliers.php%253Fr3%253D50&amp;atar1=_blank">
                        </div>
                </div>
		
		<div class="clear"></div>

		<div class="sixteen columns">
			<div class="divider-1px-top"></div>			

			<div class="navigation">
			    <div id="menu">
					<?php 
						if ( has_nav_menu('main_menu') ) wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'sf-menu')); 					
					?>             
		        </div> <!-- /menu -->
			</div>  <!-- /navigation -->
		</div>
	</div> <!-- /container -->		

	<div class="clear"></div>
