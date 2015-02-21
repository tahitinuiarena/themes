<?php

	if ( isset( $data['crumble_theme_color'] ) ) $theme_color = stripslashes ( $data['crumble_theme_color'] );
	if ( isset( $data['crumble_custom_bg'] ) ) $custom_bg = stripslashes ( $data['crumble_custom_bg'] );	
	if ( isset( $data['crumble_bg_color'] ) ) $bg_color = stripslashes ( $data['crumble_bg_color'] );	
	if ( isset( $data['crumble_body_background'] ) ) $body_background = stripslashes ( $data['crumble_body_background'] );		
	if ( isset( $data['crumble_slider_control_color'] ) ) $slider_control_color = stripslashes ( $data['crumble_slider_control_color'] );
	if ( isset( $data['crumble_slider_control_active_color'] ) ) $slider_control_active_color = stripslashes ( $data['crumble_slider_control_active_color'] );	
	
	if ( isset( $data['crumble_bg_upload'] ) ) $bg_upload = stripslashes( $data['crumble_bg_upload'] );
?>

<?php 
	if ( $bg_color == 'Background Image' ) {
?>
body, .body-class {
	background: url(<?php echo $custom_bg; ?>) left top repeat;
}
<?php } else if( $bg_color == 'Color' ) { ?>
body, .body-class {
	background: none;
	background-color: <?php echo $body_background; ?>
}
<?php } else if ( $bg_color == 'Upload' ) { ?>
body, .body-class {
	background: url(<?php echo $bg_upload; ?>) left top repeat;
	background-color: <?php echo $body_background; ?>
}	
<?php } ?>

::selection { 	background-color: <?php echo $theme_color; ?> !important;	 }

::-moz-selection { 	background-color: <?php echo $theme_color; ?> !important;	 }


.one_fourth.underline:hover, .one_third.underline:hover {
	border-bottom: 1px solid <?php echo $theme_color; ?>;
}

#socialCounterWidget .icon { 
	background-color: <?php echo $theme_color; ?> !important;	
}

a.bg-link:hover, .footer a:hover {
	background-color: <?php echo $theme_color; ?> !important;	
}

span.dropcap.custom  {
	color: <?php echo $theme_color; ?>;	
}

.highlight.custom   {
	background: <?php echo $theme_color; ?>;	
}


h2.featured-carousel-title { 
	background-color: <?php echo $theme_color; ?> !important;	
}

.right-review-block {
	background-color: <?php echo $theme_color; ?>;	
}
span.page-numbers.current {
	background-color: <?php echo $theme_color; ?>;	
}
.tabs li.current {
	background-color: <?php echo $theme_color; ?>;	
}
.tabs li:hover, .vertical .tabs li:hover {
		background-color: <?php echo $theme_color; ?> !important;	
}
.widget .box .tagcloud a:hover { 
	background-color: <?php echo $theme_color; ?>;	
}
.widget a:hover {
	background-color: <?php echo $theme_color; ?>;	
}
.post-title h4, .widget-title h4, .post-title h2, .widget-title h2 { 
	background-color: <?php echo $theme_color; ?> !important;	
}

#wrapper .copyright a:hover {
	background-color: <?php echo $theme_color; ?>;	
}

.related-posts-single li span a:hover {
	background-color: <?php echo $theme_color; ?> !important;	
}
.single-post-format-icon, h2.single-title {
	background-color: <?php echo $theme_color; ?>;	
}
.overall-head, a[rel=prev]:hover, a[rel=next]:hover {
	background-color: <?php echo $theme_color; ?>;	
}

.single-post-meta li a:hover, .standard-link a:hover {
	background-color: <?php echo $theme_color; ?>;	
}

a.comment-reply-link:hover, input[type=submit] {
	background-color: <?php echo $theme_color; ?>;	
}
.nivo-controlNav a {
	background-color: <?php echo $slider_control_color; ?>;
}	

.nivo-controlNav a.active {
	background-color: <?php echo $slider_control_active_color; ?>;
}	

a.socialCounterBox:hover {
	background: none !important
}
