<?php


add_action('widgets_init','CrumbleMagazine_relpost_load_widgets');


function CrumbleMagazine_relpost_load_widgets(){
		register_widget("CrumbleMagazine_RelatedPosts_Widget");
}

/*
==========================================================================
  Widget class.
  This class handles everything that needs to be handled with the widget:
  the settings, form, display, and update. 
==========================================================================
*/
class CrumbleMagazine_RelatedPosts_Widget extends WP_widget{

	/* Widget setup. */
	function CrumbleMagazine_RelatedPosts_Widget(){
		
		/* Widget settings. */		
		$widget_ops = array( 'classname' => 'crumble_relposts_widget', 'description' => __( 'Related Posts Widget For Single Post' , 'crumble' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_relposts_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crumble_relposts_widget' , __( 'TNA: Related Posts' , 'crumble' ) , $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$page_url = $instance['page_url'];
		$lang = $instance['lang'];		
		$theme_color = isset($instance['theme_color']) ? 'true' : 'false';
		$show_faces = isset($instance['show_faces']) ? 'true' : 'false';
		$stream = isset($instance['stream']) ? 'true' : 'false';		
		$header = isset($instance['header']) ? 'true' : 'false';				
		
		echo $before_widget;
		?>
			<?php
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			?>


				<?php 
					global $post;
					$tags = get_the_tags(); 
					if( $tags):
				?>
					
				<?php 
					$posts_found = get_related_posts( $post->ID, $tags);
				

				?>


						<ul class="related-posts-single">
							<?php while($posts_found->have_posts()): $posts_found->the_post(); ?>

				<?php if ( has_post_format('audio') ) $post_format = 'class="format-audio-icon"'; ?>
				<?php if ( has_post_format('video') ) $post_format = 'class="format-video-icon"'; ?>
				<?php if ( has_post_format('gallery') ) $post_format = 'class="format-gallery-icon"'; ?>
				<?php if ( has_post_format('image') ) $post_format = 'class="format-image-icon"'; ?>

				<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image') ) $post_format = 'class="format-standard-icon"'; ?>				

								<li>
								<?php if(has_post_thumbnail()): ?>
									<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'related-post-thumb'); ?>

										<a <?php echo $post_format; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='137' height='85' /></a>
										<span><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></span>

								<?php else: ?>

										<a <?php echo $post_format; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/137x85_notfound.png" alt="<?php the_title(); ?>" width='137' height='85' /></a>
										<span><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></span>

								<?php endif; ?>

								</li>
								
							<?php endwhile; ?>

							</ul>
								<div class="clear"></div>


				<?php endif; ?>
				<?php wp_reset_query(); ?>

			<?php
			echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );

		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		?>
		<?php
			$defaults = array('title'=> __( 'Related Posts' , 'crumble' ) );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 210px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		
		<?php

	}
}
?>