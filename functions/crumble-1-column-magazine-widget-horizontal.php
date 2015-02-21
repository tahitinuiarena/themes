<?php


add_action('widgets_init', 'CrumbleMagazine_load_widgets');

function CrumbleMagazine_load_widgets()
{
	register_widget('CrumbleMagazine_Widget');
}

class CrumbleMagazine_Widget extends WP_Widget {


	function CrumbleMagazine_Widget()
	{
	
		$widget_ops = array('classname' => 'crumblemagazine', 'description' => __( '1 Column Horizontal Magazine Widget (show recent posts).' , 'crumble' ) );

	
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumblemagazine-widget' );

		
		$this->WP_Widget( 'crumblemagazine-widget', __( 'TNA : 1 Column Magazine Widget' , 'crumble' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$show_image = isset($instance['show_image']) ? 'true' : 'false';
		$show_big_icons = isset($instance['show_big_icons']) ? 'true' : 'false';		
		$show_icons = isset($instance['show_icons']) ? 'true' : 'false';
		echo $before_widget;
		?>
		

			<?php
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			?>
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => 1,
				'post_type' => 'post',
				'cat' => $categories,
			));
			?>

			<div class="one-col-horiz-left">
<?php			while($recent_posts->have_posts()): $recent_posts->the_post(); 
?>				
				<div class="widget-post-big-thumb">
				<?php if ( has_post_format('audio') ) $post_format = 'class="format-audio-icon"'; ?>
				<?php if ( has_post_format('video') ) $post_format = 'class="format-video-icon"'; ?>
				<?php if ( has_post_format('gallery') ) $post_format = 'class="format-gallery-icon"'; ?>
				<?php if ( has_post_format('image') ) $post_format = 'class="format-image-icon"'; ?>

				<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image') ) $post_format = 'class="format-standard-icon"'; ?>				
						<?php if(has_post_thumbnail()): ?>
							<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'big-post-thumb'); ?>	
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' <?php echo $post_format; ?>><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
						<?php endif; ?>
				</div>	
					<h3><a href='<?php the_permalink(); ?>' class="bg-link" title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>
					<div class="small-meta margin-5b">
						<?php if($show_big_icons == 'true') { ?>
							<span class="date-ico">
						<?php } ?>
							<?php the_time('M j, Y'); ?>	
						<?php if($show_big_icons == 'true') { ?>
							</span>
						<?php } ?> | 
						<?php if($show_big_icons == 'true') { ?>
							<span class="comments-ico">
						<?php } ?>
							<?php comments_popup_link(); ?>
						<?php if($show_big_icons == 'true') { ?>
							</span>
						<?php } ?>						
						</div>

					<p><?php echo get_the_excerpt(); ?></p>			

<?php
			endwhile; ?>
			</div>

			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'post_type' => 'post',
				'cat' => $categories,
			));
			
			$counter = 0;
			?>

			<div class="one-col-horiz-right">
			<ul class="widget-one-column-horizontal one-column-widget">
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

					<?php if( $show_image == 'true' ): ?>
						<?php if(has_post_thumbnail()): ?>
							<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-post-thumb'); ?>
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
		return $instance;
	}



	function form($instance)
	{
		$defaults = array('title' => __( 'Recent Posts' , 'crumble' ), 'post_type' => 'all', 'categories' => 'all', 'posts' => 4, 'show_image'=>'on', 'show_big_icons'=>'on', 'show_icons'=>'on' );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category:' , 'crumble' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Number of posts:' , 'crumble' ); ?></label>
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

		
	<?php }
}
?>