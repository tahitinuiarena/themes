<?php


add_action('widgets_init', 'CrumbleMagazine_load_review_widgets');

function CrumbleMagazine_load_review_widgets()
{
	register_widget('CrumbleMagazine_Review_Widget');
}


class CrumbleMagazine_Review_Widget extends WP_Widget {

	
	function CrumbleMagazine_Review_Widget()
	{
	
		$widget_ops = array('classname' => 'crumblemagazine_review', 'description' => __( '1 Column Review Magazine Widget (show recent reviews).' , 'crumble' ) );


		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumblemagazine_review' );


		$this->WP_Widget('crumblemagazine_review', __( 'TNA : 1 Column Review Magazine Widget' , 'crumble' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$images = true;
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
				global $data;
				$recent_reviews = new WP_Query(array('showposts' => 1,'post_type' => 'reviews','review_category' => $categories,)); 
			?>			

			<div class="one-col-horiz-left">
			<?php
				global $post;
				while($recent_reviews->have_posts()): $recent_reviews->the_post(); 						
			?>				
				<div class="widget-post-big-thumb">
				<?php $post_format = 'class="format-review-icon"'; ?>

						<?php if(has_post_thumbnail()): ?>
							<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'big-post-thumb'); ?>	
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' <?php echo $post_format; ?>><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
						<?php endif; ?>
				</div>	
					<h3><a href='<?php the_permalink(); ?>' class="bg-link" title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>

					<div class="small-meta">
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
								<?php $theme_style = stripslashes( $data['crumble_theme_style'] ); ?>
								<?php if ( $theme_style == 'dark.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo $score; ?>.png" alt="" />
								<?php } else if ( $theme_style == 'light.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/light/<?php echo $score; ?>.png" alt="" />
								<?php } ?>

							</div>



					<p><?php echo get_the_excerpt(); ?></p>			

<?php
			endwhile; ?>
			</div>

			<?php
				$recent_reviews = new WP_Query(array('showposts' => $posts,'post_type' => 'reviews','review_category' => $categories,)); 			
				$counter = 0;
			?>

			<div class="one-col-horiz-right">
			
			<ul class="widget-one-column-horizontal one-column-widget">
<?php	
		global $post;
		while($recent_reviews->have_posts()): $recent_reviews->the_post(); 
			if($counter >= 1 ) {		
			?>
				<li>
				<div class="widget-post-small-thumb">
				<?php $post_format = 'class="format-review-icon"'; ?>						
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
						</div>

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
								<?php $theme_style = stripslashes( $data['crumble_theme_style'] ); ?>
								<?php if ( $theme_style == 'dark.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo $score; ?>.png" alt="" />
								<?php } else if ( $theme_style == 'light.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/light/<?php echo $score; ?>.png" alt="" />
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
		
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['post_type'] = 'all';
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_big_icons'] = $new_instance['show_big_icons'];		
		$instance['show_icons'] = $new_instance['show_icons'];	
					
		return $instance;
	}


	function form($instance)
	{
		$defaults = array( 'title' => __( 'Latest Reviews' , 'crumble' ) , 'posts' => 4, 'categories'=>'', 'show_image'=> 'on', 'show_big_icons'=> 'on', 'show_icons'=> 'on', );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Select Category:' , 'crumble' ); ?></label> 
			<?php $tax_terms = get_terms('review_category'); ?>
			<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories" style="width:100%;">
				<option selected="selected"><?php echo $instance['categories']; ?></option>
			<?php foreach ($tax_terms as $tax_term) { ?>
				<option><?php echo $tax_term->name; ?></option>
			<?php } ?>
			</select>

		</p> 


		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Number of reviews:' , 'crumble' ); ?></label>
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