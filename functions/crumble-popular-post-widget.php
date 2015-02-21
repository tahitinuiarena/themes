<?php

add_action( 'widgets_init', 'CrumbleMagazine_popular_post_widget' );

function CrumbleMagazine_popular_post_widget() {
	register_widget( 'CrumbleMagazine_Popular_Post' );
}



class CrumbleMagazine_Popular_Post extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function  CrumbleMagazine_Popular_Post() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'crumble-popularpost-widget', 'description' => __( 'A widget that show popular posts' , 'crumble' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble-popularpost-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'crumble-popularpost-widget', __('TNA: Popular Posts', 'crumble'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('Popular Posts', $instance['title'] );
		$show_num = $instance['show_num'];
		$show_image = isset($instance['show_image']) ? 'true' : 'false';			

		/* Before widget (defined by themes). */
		echo $before_widget;
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}

		/* Display the widget title if one was input (before and after defined by themes). */

			$recent_posts = new WP_Query(array(
				'showposts' => $show_num,
				'orderby' => 'comment_count',
			));
			
			?>

			<div class="widget">
			<ul class="popular-posts">
<?php			
	while($recent_posts->have_posts()): $recent_posts->the_post(); 
			
			?>

				<li>
				<div class="popular-post-thumb">
				<?php if ( has_post_format('audio') ) $post_format = 'class="format-audio-icon"'; ?>
				<?php if ( has_post_format('video') ) $post_format = 'class="format-video-icon"'; ?>
				<?php if ( has_post_format('gallery') ) $post_format = 'class="format-gallery-icon"'; ?>
				<?php if ( has_post_format('image') ) $post_format = 'class="format-image-icon"'; ?>

				<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image') ) $post_format = 'class="format-standard-icon"'; ?>								
					<?php if( $show_image == 'true' ): ?>
						<?php if(has_post_thumbnail()): ?>
							<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-post-thumb'); ?>
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' <?php echo $post_format; ?>><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
						<?php endif; ?>		
					<?php endif; ?>		
				</div>					
					<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="bg-link"><?php the_title(); ?></a>
					
					<div class="small-meta">
							<?php the_time('M j, Y'); ?>	
							 | 
							<?php comments_popup_link(); ?>
					 </div> <!-- /small-meta -->
					<div class="clear"></div>	
				</li>	

			<?php

			endwhile; ?>
						</ul>			
			</div>
<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_num'] = strip_tags( $new_instance['show_num'] );
		$instance['show_image'] = $new_instance['show_image'];	
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Popular Posts Widget', 'crumble'), 'post_cat' => '0', 'show_num' => '4', 'show_image' => 'on' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'crumble'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="width100" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php _e('Show Count', 'crumble'); ?></label>
			<input id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" value="<?php echo $instance['show_num']; ?>" class="width100" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e( 'Show thumbnail images' , 'crumble' ); ?></label>
		</p>
	
		
	<?php
	}
}

?>