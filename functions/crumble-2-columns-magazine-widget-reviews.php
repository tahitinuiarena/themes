<?php


add_action('widgets_init', 'CrumbleMagazine_load_two_reviews_widgets');

function CrumbleMagazine_load_two_reviews_widgets()
{
	register_widget('CrumbleMagazine_TwoReviews_Widget');
}


class CrumbleMagazine_TwoReviews_Widget extends WP_Widget {


	function CrumbleMagazine_TwoReviews_Widget()
	{

		$widget_ops = array('classname' => 'crumblemagazine', 'description' => __( '2 Columns Reviews Magazine Widget (show recent reviews).' , 'crumble' ) );

		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumblemagazine-tworeviews-widget' );

		$this->WP_Widget('crumblemagazine-tworeviews-widget', __( 'TNA : 2 Columns Reviews Magazine Widget' , 'crumble' ), $widget_ops, $control_ops);
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

		$title2 = $instance['title2'];
		$post_type2 = 'all';
		$categories2 = $instance['categories2'];
		$posts2 = $instance['posts2'];
		$images2 = true;					
		$show_image2 = isset($instance['show_image2']) ? 'true' : 'false';
		$show_big_icons2 = isset($instance['show_big_icons2']) ? 'true' : 'false';		
		$show_icons2 = isset($instance['show_icons2']) ? 'true' : 'false';
		
		echo $before_widget;
		?>
		
	
			<?php
				global $data;
				$recent_reviews = new WP_Query(array('showposts' => 1,'post_type' => 'reviews','review_category' => $categories,)); 			
			?>

			<div class="one-col-horiz-left">
			<?php
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			?>
			
<?php		
			global $post;	
			while($recent_reviews->have_posts()): $recent_reviews->the_post();  ?>

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

<div class="clear"></div>
			<?php
				$recent_reviews = new WP_Query(array('showposts' => $posts,'post_type' => 'reviews','review_category' => $categories,)); 			
			$counter = 0;
			?>


			<ul class="widget-one-column-horizontal">
<?php			while($recent_reviews->have_posts()): $recent_reviews->the_post(); 
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
				$recent_reviews2 = new WP_Query(array('showposts' => 1,'post_type' => 'reviews','review_category' => $categories2,));			?>

			<div class="one-col-horiz-right">
			<?php
			if ($title2) {
				echo $before_title.$title2.$after_title;
			}
			?>
			
<?php			while($recent_reviews2->have_posts()): $recent_reviews2->the_post(); 
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
						<?php if($show_big_icons2 == 'true') { ?>
							<span class="date-ico">
						<?php } ?>
							<?php the_time('M j, Y'); ?>	
						<?php if($show_big_icons2 == 'true') { ?>
							</span>
						<?php } ?> | 
						<?php if($show_big_icons2 == 'true') { ?>
							<span class="comments-ico">
						<?php } ?>
							<?php comments_popup_link(); ?>
						<?php if($show_big_icons2 == 'true') { ?>
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

<div class="clear"></div>
			<?php
				$recent_reviews2 = new WP_Query(array('showposts' => $posts2,'post_type' => 'reviews','review_category' => $categories2,)); 						
			$counter = 0;
			?>


			<ul class="widget-one-column-horizontal">
<?php			while($recent_reviews2->have_posts()): $recent_reviews2->the_post(); 
			if($counter >= 1 ) {
			
			?>

				<li>
				<div class="widget-post-small-thumb">
				<?php $post_format = 'class="format-review-icon"'; ?>								
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
		
		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_big_icons'] = $new_instance['show_big_icons'];		
		$instance['show_icons'] = $new_instance['show_icons'];				

		$instance['title2'] = $new_instance['title2'];
		$instance['categories2'] = $new_instance['categories2'];
		$instance['posts2'] = $new_instance['posts2'];
		$instance['show_image2'] = $new_instance['show_image2'];
		$instance['show_big_icons2'] = $new_instance['show_big_icons2'];		
		$instance['show_icons2'] = $new_instance['show_icons2'];		
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array( 'title' => __( 'Latest Reviews' , 'crumble' ) , 'posts' => 4, 'categories'=>'', 'show_image'=> 'on', 'show_big_icons'=> 'on', 'show_icons'=> 'on', );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title (1st column):' , 'crumble' ); ?></label>
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
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Number of reviews (1st column):' , 'crumble' ); ?></label>
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
		$defaults2 = array( 'title2' => __( 'Latest Reviews' , 'crumble' ), 'posts2' => 4, 'categories2'=>'', 'show_image2'=> 'on', 'show_big_icons2'=> 'on', 'show_icons2'=> 'on', );
		$instance = wp_parse_args((array) $instance, $defaults2); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title2'); ?>"><?php _e( 'Title (2nd column):' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" value="<?php echo $instance['title2']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories2'); ?>"><?php _e( 'Select Category:' , 'crumble' ); ?></label> 
			<?php $tax_terms = get_terms('review_category'); ?>
			<select id="<?php echo $this->get_field_id( 'categories2' ); ?>" name="<?php echo $this->get_field_name( 'categories2' ); ?>" class="widefat categories" style="width:100%;">
				<option selected="selected"><?php echo $instance['categories2']; ?></option>
			<?php foreach ($tax_terms as $tax_term) { ?>
				<option><?php echo $tax_term->name; ?></option>
			<?php } ?>
			</select>

		</p> 
		
		<p>
			<label for="<?php echo $this->get_field_id('posts2'); ?>"><?php _e( 'Number of reviews (2nd column):' , 'crumble' ); ?> </label>
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