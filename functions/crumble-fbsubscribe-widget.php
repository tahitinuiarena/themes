<?php


add_action('widgets_init','CrumbleMagazine_fbsubscribe_load_widgets');


function CrumbleMagazine_fbsubscribe_load_widgets(){
		register_widget("CrumbleMagazine_fb_subscribe_Widget");
}


class CrumbleMagazine_fb_subscribe_Widget extends WP_widget{

	
	function CrumbleMagazine_fb_subscribe_Widget(){
		
		
		$widget_ops = array( 'classname' => 'crumble_subscribe_widget', 'description' => __( 'FB Subscribe Widget' , 'crumble' ) );

		
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_subscribe_widget' );
		
		
		$this->WP_Widget( 'crumble_subscribe_widget' , __( 'TNA: FB Subscribe' , 'crumble' ) , $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$profile_url = $instance['profile_url'];
		$layout = $instance['layout'];		
		$show_faces = isset($instance['show_faces']) ? 'true' : 'false';
		$theme_color = $instance['theme_color'];			
		$lang = $instance['lang'];		
		

		echo $before_widget;
		?>
			<?php
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			?>
			

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $lang; ?>/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
			

					<div class="fb-subscribe" <?php if($layout=='button_count') echo 'data-layout="button_count"'; if($layout=='box_count') echo 'data-layout="box_count"'; ?> data-href="<?php echo $profile_url; ?>" data-font="arial"  data-show-faces="<?php echo $show_faces; ?>" <?php if( $theme_color == 'dark' ) echo 'data-colorscheme="dark"'; ?> ></div>
					

			<?php
			echo $after_widget;
	}

	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );


		$instance['profile_url'] = $new_instance['profile_url'];
		$instance['layout'] = $new_instance['layout'];		
		$instance['show_faces'] = $new_instance['show_faces'];
		$instance['theme_color'] = $new_instance['theme_color'];			
		$instance['lang'] = $new_instance['lang'];		
		
		return $instance;
	}


	function form($instance){
		?>
		<?php
			$defaults = array( 'title'=> __( 'FB Subscribe' , 'crumble' ), 'profile_url' => 'https://facebook.com/zuck', 'lang' => 'en_US', 'theme_color' => 'dark', 'show_faces' => 'on', 'layout' => 'standard');
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 210px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('profile_url'); ?>"><?php _e( 'Profile URL:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 210px;" id="<?php echo $this->get_field_id('profile_url'); ?>" name="<?php echo $this->get_field_name('profile_url'); ?>" value="<?php echo $instance['profile_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php _e('Layout Style:', 'crumble'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'standard' == $instance['layout'] ) echo 'selected="selected"'; ?>>standard</option>
				<option <?php if ( 'button_count' == $instance['layout'] ) echo 'selected="selected"'; ?>>button_count</option>
				<option <?php if ( 'box_count' == $instance['layout'] ) echo 'selected="selected"'; ?>>box_count</option>				
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'theme_color' ); ?>"><?php _e('Theme Color:', 'crumble'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'theme_color' ); ?>" name="<?php echo $this->get_field_name( 'theme_color' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'dark' == $instance['theme_color'] ) echo 'selected="selected"'; ?>>dark</option>
				<option <?php if ( 'light' == $instance['theme_color'] ) echo 'selected="selected"'; ?>>light</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('lang'); ?>"><?php _e( 'Facebook Language:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 60px;" id="<?php echo $this->get_field_id('lang'); ?>" name="<?php echo $this->get_field_name('lang'); ?>" value="<?php echo $instance['lang']; ?>" />
		</p>


		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_faces'], 'on'); ?> id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_faces'); ?>"><?php _e( 'Show Faces' , 'crumble' ); ?></label>
		</p>


		
		
		<?php

	}
}
?>