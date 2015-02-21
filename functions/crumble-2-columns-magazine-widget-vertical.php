<?php

add_action('widgets_init', 'CrumbleMagazine_load_vertical_widgets');

function CrumbleMagazine_load_vertical_widgets()
{
	register_widget('CrumbleMagazine_Vertical_Widget');
}


class CrumbleMagazine_Vertical_Widget extends WP_Widget {

	
	function CrumbleMagazine_Vertical_Widget()
	{
		
		$widget_ops = array('classname' => 'crumblemagazine', 'description' => __( '2 Columns Vertical Magazine Widget (show recent posts).' , 'crumble' ) );
		
		
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumblemagazine-vertical-widget' );
		
	
		$this->WP_Widget( 'crumblemagazine-vertical-widget', __( 'TNA : 2 Columns Magazine Widget' , 'crumble' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$show_image = isset($instance['show_image']) ? 'true' : 'false';
		$show_icons = isset($instance['show_icons']) ? 'true' : 'false';		
		$show_big_icons = isset($instance['show_big_icons']) ? 'true' : 'false';				

		$title2 = $instance['title2'];
		$post_type2 = 'all';
		$categories2 = $instance['categories2'];
		$posts2 = $instance['posts2'];
		$show_image2 = isset($instance['show_image2']) ? 'true' : 'false';
		$show_icons2 = isset($instance['show_icons2']) ? 'true' : 'false';				
		$show_big_icons2 = isset($instance['show_big_icons2']) ? 'true' : 'false';						
		
		
		echo $before_widget;
		?>
		
	
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => 1,
				'post_type' => 'post',
				'cat' => $categories,
			));
			?>

			<div class="one-col-horiz-left">
			<?php
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			?>
			
<?php			while($recent_posts->have_posts()): $recent_posts->the_post();  ?>


				<div class="widget-post-big-thumb">
				<?php if ( has_post_format('audio') ) $post_format = 'class="format-audio-icon"'; ?>
				<?php if ( has_post_format('video') ) $post_format = 'class="format-video-icon"'; ?>
				<?php if ( has_post_format('gallery') ) $post_format = 'class="format-gallery-icon"'; ?>
				<?php if ( has_post_format('image') ) $post_format = 'class="format-image-icon"'; ?>

				<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image')) $post_format = 'class="format-standard-icon"'; ?>				

				<?php if(has_post_thumbnail()): ?>
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'big-post-thumb'); ?>	
						<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' <?php echo $post_format; ?>><img class="fadeover" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
				<?php endif; ?>
				</div>
					<h3><a href='<?php the_permalink(); ?>' class="bg-link" title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>
					<div class="small-meta margin-5b">
						<?php if($show_big_icons == 'true') : ?>
							<span class="date-ico">
						<?php endif; ?>
							<?php the_time('M j, Y'); ?>	
						<?php if($show_big_icons == 'true') : ?>
							</span>
						<?php endif; ?> | 
						<?php if($show_big_icons == 'true') : ?>
							<span class="comments-ico">
						<?php endif; ?>
							<?php comments_popup_link(); ?>
						<?php if($show_big_icons == 'true') : ?>
							</span>
						<?php endif; ?>						
					 </div>

					<p><?php echo get_the_excerpt(); ?></p>			

<?php
			endwhile; ?>

<div class="clear"></div>
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'post_type' => 'post',
				'cat' => $categories,
			));
			
			$counter = 0;
			?>


			<ul class="widget-one-column-horizontal">
<?php			while($recent_posts->have_posts()): $recent_posts->the_post(); 
			if($counter >= 1 ) {
			
			?>

				<li>
				<div class="widget-post-small-thumb">
				<?php if ( has_post_format('audio') ) $post_format = 'class="format-audio-icon"'; ?>
				<?php if ( has_post_format('video') ) $post_format = 'class="format-video-icon"'; ?>
				<?php if ( has_post_format('gallery') ) $post_format = 'class="format-gallery-icon"'; ?>
				<?php if ( has_post_format('image') ) $post_format = 'class="format-image-icon"'; ?>

				<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image')) $post_format = 'class="format-standard-icon"'; ?>				
						
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-post-thumb'); ?>

					<?php if( $show_image == 'true' ): ?>
						<?php if(has_post_thumbnail()): ?>
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' <?php echo $post_format; ?>><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
						<?php endif; ?>		
					<?php endif; ?>						
					
				</div>	
					<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="bg-link"><?php the_title(); ?></a>
					
					<div class="small-meta">
						<?php if($show_icons == 'true') { ?>
							<span class="date-ico">
						<?php } ?>
							<?php the_time('M j, Y'); ?>	
						<?php if($show_icons == 'true') { ?>
							</span>
						<?php } ?> | 
						<?php if($show_icons == 'true') { ?>
							<span class="comments-ico">
						<?php } ?>
							<?php comments_popup_link(); ?>
						<?php if($show_icons == 'true') { ?>
							</span>
						<?php } ?>						
					 </div> <!-- /small-meta -->

					<div class="clear"></div>	
				</li>	

			<?php
			}
			$counter++;

			endwhile; ?>
						</ul>			
			</div>

		<?php
			$recent_posts = new WP_Query(array(
				'showposts' => 1,
				'post_type' => 'post',
				'cat' => $categories2,
			));
			?>

			<div class="one-col-horiz-right">
			<?php
			if ($title2) {
				echo $before_title.$title2.$after_title;
			}
			?>
			
<?php			while($recent_posts->have_posts()): $recent_posts->the_post(); 
?>
				<div class="widget-post-big-thumb">
				<?php if ( has_post_format('audio') ) $post_format = 'class="format-audio-icon"'; ?>
				<?php if ( has_post_format('video') ) $post_format = 'class="format-video-icon"'; ?>
				<?php if ( has_post_format('gallery') ) $post_format = 'class="format-gallery-icon"'; ?>
				<?php if ( has_post_format('image') ) $post_format = 'class="format-image-icon"'; ?>
				<?php if ( has_post_format('review') ) $post_format = 'class="format-review-icon"'; ?>
				<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image') ) $post_format = 'class="format-standard-icon"'; ?>				
				
				<?php if(has_post_thumbnail()): ?>
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'big-post-thumb'); ?>	
						<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' <?php echo $post_format; ?>><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
				<?php endif; ?>
				</div>
					<h3><a href='<?php the_permalink(); ?>' class="bg-link" title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>
					<div class="small-meta margin-5b">
						<?php if($show_big_icons2 == 'true') : ?>
							<span class="date-ico">
						<?php endif; ?>
							<?php the_time('M j, Y'); ?>	
						<?php if($show_big_icons2 == 'true') : ?>
							</span>
						<?php endif; ?> | 
						<?php if($show_big_icons2 == 'true') : ?>
							<span class="comments-ico">
						<?php endif; ?>
							<?php comments_popup_link(); ?>
						<?php if($show_big_icons2 == 'true') : ?>
							</span>
						<?php endif; ?>						
					 </div>

					<p><?php echo get_the_excerpt(); ?></p>			

<?php
			endwhile; ?>

<div class="clear"></div>
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts2,
				'post_type' => 'post',
				'cat' => $categories2,
			));
			
			$counter = 0;
			?>


			<ul class="widget-one-column-horizontal">
<?php			while($recent_posts->have_posts()): $recent_posts->the_post(); 
			if($counter >= 1 ) {
			
			?>

				<li>
				<div class="widget-post-small-thumb">
				<?php if ( has_post_format('audio') ) $post_format = 'class="format-audio-icon"'; ?>
				<?php if ( has_post_format('video') ) $post_format = 'class="format-video-icon"'; ?>
				<?php if ( has_post_format('gallery') ) $post_format = 'class="format-gallery-icon"'; ?>
				<?php if ( has_post_format('image') ) $post_format = 'class="format-image-icon"'; ?>

				<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image') ) $post_format = 'class="format-standard-icon"'; ?>				
								
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-post-thumb'); ?>

					<?php if( $show_image2 == 'true' ): ?>
						<?php if(has_post_thumbnail()): ?>		
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' <?php echo $post_format; ?>><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
						<?php endif; ?>		
					<?php endif; ?>	
				</div>	
					<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="bg-link"><?php the_title(); ?></a>
					
					<div class="small-meta">
						<?php if($show_icons2 == 'true') { ?>
							<span class="date-ico">
						<?php } ?>
							<?php the_time('M j, Y'); ?>	
						<?php if($show_icons2 == 'true') { ?>
							</span>
						<?php } ?> | 
						<?php if($show_icons2 == 'true') { ?>
							<span class="comments-ico">
						<?php } ?>
							<?php comments_popup_link(); ?>
						<?php if($show_icons2 == 'true') { ?>
							</span>
						<?php } ?>						
					 </div>

					<div class="clear"></div>	
				</li>	

			<?php
			}
			$counter++;

			endwhile; ?>
						</ul>			
			</div>


		<?php
		echo $after_widget;
	}
		
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['post_type'] = 'all';
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_icons'] = $new_instance['show_icons'];		
		$instance['show_big_icons'] = $new_instance['show_big_icons'];				

		$instance['title2'] = $new_instance['title2'];
		$instance['post_type2'] = 'all';
		$instance['categories2'] = $new_instance['categories2'];
		$instance['posts2'] = $new_instance['posts2'];
		$instance['show_image2'] = $new_instance['show_image2'];
		$instance['show_icons2'] = $new_instance['show_icons2'];		
		$instance['show_big_icons2'] = $new_instance['show_big_icons2'];				

		return $instance;
	}

	function form($instance)
	{
		$defaults = array( 'title' => __( 'First Column' , 'crumble' ) , 'post_type' => 'all', 'categories' => 'all', 'posts' => 4, 'show_image'=> 'on', 'show_icons' => 'on' );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title (1st column):' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category (1st column):' , 'crumble' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Number of posts (1st column):' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
			
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e( 'Show thumbnail image' , 'crumble' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_big_icons'], 'on'); ?> id="<?php echo $this->get_field_id('show_big_icons'); ?>" name="<?php echo $this->get_field_name('show_big_icons'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_big_icons'); ?>"><?php _e( 'Show icons in meta information (for Big Image)' , 'crumble' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_icons'], 'on'); ?> id="<?php echo $this->get_field_id('show_icons'); ?>" name="<?php echo $this->get_field_name('show_icons'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_icons'); ?>"><?php _e( 'Show icons in meta information' , 'crumble' ); ?></label>
		</p>

<?php
		$defaults2 = array( 'title2' => __( 'Second Column' , 'crumble' ) , 'post_type2' => 'all', 'categories2' => 'all', 'posts2' => 4, 'show_image2'=> 'on', 'show_icons2' => 'on');
		$instance = wp_parse_args((array) $instance, $defaults2); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title2'); ?>"><?php _e( 'Title (2nd column):' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" value="<?php echo $instance['title2']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories2'); ?>"><?php _e( 'Filter by Category (2nd column):' , 'crumble' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories2'); ?>" name="<?php echo $this->get_field_name('categories2'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories2']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories2']) echo 'selected="selected2"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts2'); ?>"><?php _e( 'Number of posts (2nd column):' , 'crumble' ); ?> </label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts2'); ?>" name="<?php echo $this->get_field_name('posts2'); ?>" value="<?php echo $instance['posts2']; ?>" />
			
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image2'], 'on'); ?> id="<?php echo $this->get_field_id('show_image2'); ?>" name="<?php echo $this->get_field_name('show_image2'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image2'); ?>"><?php _e( 'Show thumbnail image' , 'crumble' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_big_icons2'], 'on'); ?> id="<?php echo $this->get_field_id('show_big_icons2'); ?>" name="<?php echo $this->get_field_name('show_big_icons2'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_big_icons2'); ?>"><?php _e( 'Show icons in meta information (for Big Image)' , 'crumble' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_icons2'], 'on'); ?> id="<?php echo $this->get_field_id('show_icons2'); ?>" name="<?php echo $this->get_field_name('show_icons2'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_icons2'); ?>"><?php _e( 'Show icons in meta information' , 'crumble' ); ?></label>
		</p>
		
	<?php }
}
?>