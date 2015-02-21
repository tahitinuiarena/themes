<?php

add_action('widgets_init','CrumbleMagazine_fb_load_widgets');


function CrumbleMagazine_fb_load_widgets(){
		register_widget("CrumbleMagazine_fbc_Widget");
}


class CrumbleMagazine_fbc_Widget extends WP_widget{

	
	function CrumbleMagazine_fbc_Widget(){
		
		
		$widget_ops = array( 'classname' => 'crumble_fbc_widget', 'description' => __( 'FB Comments Widget For Single Post / Reviews Widgets' , 'crumble' ) );

		
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_fbc_widget' );
		
		
		$this->WP_Widget( 'crumble_fbc_widget' , __( 'TNA: FB Comments' , 'crumble' ) , $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$num_posts = $instance['num_posts'];
		$theme_lang = $instance['theme_lang'];		
		$theme_color = $instance['theme_color'];
		
		echo $before_widget;
		?>
			<?php
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			?>
			<?php 
				$id = get_the_ID();
			?>

			<div id="fb-root"></div>
				<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/<?php echo $theme_lang; ?>/all.js#xfbml=1";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>

					<div class="fb-comments" data-href="<?php echo get_permalink( $id ); ?>" data-num-posts="<?php echo $num_posts; ?>" <?php echo 'data-colorscheme="' . $theme_color . '"'; ?>></div>

			<?php
			echo $after_widget;
	}

	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_posts'] = $new_instance['num_posts'];
		$instance['theme_lang'] = $new_instance['theme_lang'];		
		$instance['theme_color'] = $new_instance['theme_color'];
		
		return $instance;
	}


	function form($instance){
		?>
		<?php
			$defaults = array('title'=> __( 'FB Comments' , 'crumble' ), 'num_posts' => 4, 'theme_lang' => 'en_US', 'theme_color' => 'dark' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 210px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of comments:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('theme_lang'); ?>"><?php _e( 'FB Language:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 60px;" id="<?php echo $this->get_field_id('theme_lang'); ?>" name="<?php echo $this->get_field_name('theme_lang'); ?>" value="<?php echo $instance['theme_lang']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'theme_color' ); ?>"><?php _e( 'Theme Color:', 'crumble' ); ?></label> 
			<select id="<?php echo $this->get_field_id( 'theme_color' ); ?>" name="<?php echo $this->get_field_name( 'theme_color' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'dark' == $instance['theme_color'] ) echo 'selected="selected"'; ?>>dark</option>
				<option <?php if ( 'light' == $instance['theme_color'] ) echo 'selected="selected"'; ?>>light</option>
			</select>
		</p>
		
		<?php

	}
}
?>