<?php


add_action('widgets_init','CrumbleMagazine_user_profile_load_widgets');


function CrumbleMagazine_user_profile_load_widgets(){
		register_widget("CrumbleMagazine_author_profile_Widget");
}


class CrumbleMagazine_author_profile_Widget extends WP_widget{

	
	function CrumbleMagazine_author_profile_Widget(){
		
			
		$widget_ops = array( 'classname' => 'crumble_author_profile_widget', 'description' => __( 'Author Profile Widget For Single Post/Reviews Widgets' , 'crumble' ) );

		
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_author_profile_widget' );
		
		
		$this->WP_Widget( 'crumble_author_profile_widget' , __( 'TNA: Author Profile Widget' , 'crumble' ) , $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$icons = isset($instance['icons']) ? 'true' : 'false';				
		$avatar = isset($instance['avatar']) ? 'true' : 'false';						
		
		echo $before_widget;
		?>
			
			<div class="author-profile-block">				
					
					
					<div class="post-title">						
						<h2><?php the_author_posts_link(); ?></h2>		
																		
						<?php if( $icons == 'true' ) { ?>			
						<div class="profile-title">
							<?php if(get_the_author_meta('twitter') || get_the_author_meta('facebook')|| get_the_author_meta('google_plus') || get_the_author_meta('flickr')): ?>
							
									<?php if(get_the_author_meta('twitter')): ?>
										<a class="author twitter-icon" href='http://twitter.com/<?php echo get_the_author_meta('twitter'); ?>'></a>
									<?php endif; ?>
						
									<?php if(get_the_author_meta('facebook')): ?>
										<a class="author facebook-icon" href='http://facebook.com/<?php echo get_the_author_meta('facebook'); ?>'></a>
									<?php endif; ?>

									<?php if(get_the_author_meta('google_plus')): ?>
										<a class="author google-icon" href='http://plus.google.com/<?php echo get_the_author_meta('google_plus'); ?>'></a>
									<?php endif; ?>

									<?php if(get_the_author_meta('flickr')): ?>
										<a class="author flickr-icon" href='http://www.flickr.com/photos/<?php echo get_the_author_meta('flickr'); ?>'></a>
									<?php endif; ?>

							<?php endif; ?>
						</div> 
						<?php } ?>
						
					</div> 
					
					<div class="clear"></div>
					
					<?php if( $avatar == 'true' ) { ?>					
					<div class="profile-avatar">
						<?php echo get_avatar(get_the_author_meta('email'), '40'); ?>
					</div>	
					<?php } ?>

					<p><?php the_author_meta("description"); ?></p>					

					<div class="clear"></div>
			</div> 
					

			<?php
			echo $after_widget;
	}

	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['icons'] = $new_instance['icons'];	
		$instance['avatar'] = $new_instance['avatar'];			
		
		
		return $instance;
	}


	function form($instance){
		?>
		<?php
			$defaults = array( 'avatar' => 'on' , 'icons' => 'on' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['avatar'], 'on'); ?> id="<?php echo $this->get_field_id('avatar'); ?>" name="<?php echo $this->get_field_name('avatar'); ?>" /> 
			<label for="<?php echo $this->get_field_id('avatar'); ?>"><?php _e( 'Show Avatar' , 'crumble' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['icons'], 'on'); ?> id="<?php echo $this->get_field_id('icons'); ?>" name="<?php echo $this->get_field_name('icons'); ?>" /> 
			<label for="<?php echo $this->get_field_id('icons'); ?>"><?php _e( 'Show Social Icons' , 'crumble' ); ?></label>
		</p>

		
		<?php

	}
}
?>