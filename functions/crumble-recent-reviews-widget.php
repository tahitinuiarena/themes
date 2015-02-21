<?php

add_action( 'widgets_init', 'crumblemagazine_reviews_load_widgets' );

function crumblemagazine_reviews_load_widgets()
{
	register_widget('CrumbleMagazine_Recent_Reviews_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrumbleMagazine_Recent_Reviews_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function CrumbleMagazine_Recent_Reviews_Widget()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'crumblemagazine_recentreviews_widget', 'description' => __( 'Display Recent Reviews in Sidebar' , 'crumble' ) );
		
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumblemagazine_recentreviews_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crumblemagazine_recentreviews_widget', __( 'TNA : Recent Reviews' , 'crumble' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$num_posts = $instance['num_posts'];
		
		echo $before_widget;
		?>
		<!-- BEGIN WIDGET -->
		<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}
		?>
		
		<?php 
			global $post; global $data; 
			$recent_posts = new WP_Query( array('showposts' => $num_posts, 'post_type' => 'reviews') ); 
		?>
	
		<ul class="recent-post-widget">
			<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
			<li>
				<div class="widget-thumb">
				<?php $post_format = 'class="format-review-icon"'; ?>
				

						<?php if(has_post_thumbnail()): ?>
							<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-post-thumb'); ?>
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' <?php echo $post_format; ?> ><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
						<?php endif; ?>		
				</div>					
				
					<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="bg-link"><?php the_title(); ?></a>
					
							<div class="margin-5t"></div>	
							<?php 

							$criteria1 = get_post_meta( $post->ID, 'crumble_mb_criteria1', true ); 					
							$criteria1_name = get_post_meta( $post->ID, 'crumble_mb_criteria1_name', true ); 												
							$criteria2 = get_post_meta( $post->ID, 'crumble_mb_criteria2', true ); 												
							$criteria2_name = get_post_meta( $post->ID, 'crumble_mb_criteria2_name', true ); 																			
							$criteria3 = get_post_meta( $post->ID, 'crumble_mb_criteria3', true ); 												
							$criteria3_name = get_post_meta( $post->ID, 'crumble_mb_criteria3_name', true ); 																			
							$criteria4 = get_post_meta( $post->ID, 'crumble_mb_criteria4', true ); 												
							$criteria4_name = get_post_meta( $post->ID, 'crumble_mb_criteria4_name', true ); 																			
							$criteria5 = get_post_meta( $post->ID, 'crumble_mb_criteria5', true ); 												
							$criteria5_name = get_post_meta( $post->ID, 'crumble_mb_criteria5_name', true ); 																			
						
							$score = 0;
							$count_criteria = 0;
							
							$overall_name = get_post_meta( $post->ID, 'crumble_mb_overall_name', true ); 																			

							
							if( $criteria1_name != '' ) {
								$score = $score + $criteria1;
								$count_criteria++;
							}	
							if( $criteria2_name != '' ) {
								$score = $score + $criteria2;
								$count_criteria++;
							}	

							if( $criteria3_name != '' ) {
								$score = $score + $criteria3;
								$count_criteria++;
							}	

							if( $criteria4_name != '' ) {
								$score = $score + $criteria4;
								$count_criteria++;
							}	

							if( $criteria5_name != '' ) {
								$score = $score + $criteria5;
								$count_criteria++;
							}	
				
							if( $count_criteria > 0 ) {
								$score = round( $score/$count_criteria, 2 );
							}

							if( ($score < 0.3) && ($score > 0 ) ) $score = 0;														
							if( ($score >= 0.3) && ($score < 0.7) ) $score = 0.5;
							if( ($score >= 0.7) && ($score < 1.3) ) $score = 1;							
							if( ($score >= 1.3) && ($score < 1.7) ) $score = 1.5;														
							if( ($score >= 1.7) && ($score < 2.3) ) $score = 2;																					
							if( ($score >= 2.3) && ($score < 2.7) ) $score = 2.5;																												
							if( ($score >= 2.7) && ($score < 3.3) ) $score = 3;
							if( ($score >= 3.3) && ($score < 3.7) ) $score = 3.5;
							if( ($score >= 3.7) && ($score < 4.3) ) $score = 4;
							if( ($score >= 4.3) && ($score < 4.7) ) $score = 4.5;
							if( ($score >= 4.7) ) $score = 5;
							
 ?>
							<div class="review">
								<?php 
									
									$theme_style = stripslashes( $data['crumble_theme_style'] ); 
								?>
								<?php if ( $theme_style == 'dark.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo $score; ?>.png" alt="" />
								<?php } else if ( $theme_style == 'light.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/light/<?php echo $score; ?>.png" alt="" />
								<?php } ?>

							</div>

					<div class="clear"></div>	
				</li>	
		<?php endwhile; ?>
</ul>					
		
		<!-- END WIDGET -->
		<?php
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_posts'] = $new_instance['num_posts'];
		
		return $instance;
	}


	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array('title' => __( 'Recent Reviews' , 'crumble' ) , 'num_posts' => 4);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'crumble' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
		</p>
		
	<?php 
	}
}
?>