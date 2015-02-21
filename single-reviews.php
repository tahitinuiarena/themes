<?php get_header(); ?>

	<div class="pat-block"></div>

<?php
	/*
		------------------------------------------
			Début Content
		------------------------------------------				
	*/
?>
<div id="content-bg-wrapper">
	<div class="container">

		<?php 
			$sidebar = stripslashes( $data['crumble_sidebar_position'] );

			if ( $sidebar == 'Left' ) get_sidebar();
		 ?>	
			
		<div class="eleven columns standard-link">		
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
				
				<div id="post-<?php the_ID(); ?>">	
					<h2 class="single-title"><?php the_title(); ?></h2>
				
					<div class="single-meta-information">
					
						<ul class="single-post-meta">
							<li class="date-icon"><?php the_time('F d, Y'); ?></li>
							<li class="user-icon"><?php echo the_author_link(); ?></li>
							<li class="category-icon"><?php the_category(', '); ?></li>
							<li class="comments-icon"><?php comments_number('0 Commentaire','1 Commentaire','% Commentaires'); ?></li>
						</ul> <!-- /single-post-meta -->
					
						<div class="clear"></div>

						<?php echo '<div class="single-post-format-icon format-review-icon"></div>'; ?>
					</div> <!-- /single-meta-information -->	
				
			
<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Image ou Standard  
-----------------------------------------------------------------------------------------------------------------							
*/
?>

	                   	<?php 
							if ( has_post_format( 'image' ) || ( !has_post_format( 'image' ) &&  !has_post_format( 'video' ) && !has_post_format( 'audio' ) && !has_post_format( 'gallery' ) )  ) {	                   	?>
								<div class="single-media-thumb"> 							
									<?php
										if ( has_post_thumbnail() ) { 
		                        			$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb'); 
											$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 	                        	
				                        ?>  
				
				                    	<a href="<?php echo $large_image_url[0]; ?>" class="zoom" data-rel="prettyPhoto"><img src="<?php echo $small_image_url[0]; ?>" alt="" /></a>				

								<?php } ?>
								</div> <!-- /single-media-thumb -->									
						<?php } ?>
						
						<?php
							$use_review = get_post_meta( $post->ID, 'crumble_mb_use_review', true );
							
							if( $use_review == 'true' ) {
						?>
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
			
			<div id="overscore-block">
							<div class="overall-head">
							
								<div class="wrapper-overall-name">

										<span class="overall-name">
											<?php echo $overall_name; ?>
										</span>
										
										<div class="clear"></div>

								<?php $theme_style = stripslashes( $data['crumble_theme_style'] ); ?>
								<?php if ( $theme_style == 'dark.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo $score; ?>.png" alt="" />
								<?php } else if ( $theme_style == 'light.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/light/<?php echo $score; ?>.png" alt="" />
								<?php } ?>
												
										
								</div> <!-- wrapper-overall-name -->
								
								<div class="wrapper-overall-score">
										<span class="overall-score"><?php echo $score; ?></span>								
								</div> <!-- /wrapper-overall-score -->		
								
								<div class="clear"></div>						
							</div>
					

						<?php $theme_style = stripslashes( $data['crumble_theme_style'] ); ?>							
						
						<div class="wrapper-criteria">	
							<ul class="criteria-list">
								
								<?php if( get_post_meta(get_the_ID(), 'crumble_mb_criteria1_name', true) != '' ) : ?>
								<li>
									<span>
										<?php echo $criteria1_name; ?>
									</span>


								<?php if ( $theme_style == 'dark.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta(get_the_ID(), 'crumble_mb_criteria1', true); ?>.png" alt="" />
								<?php } else if ( $theme_style == 'light.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/light/<?php echo get_post_meta(get_the_ID(), 'crumble_mb_criteria1', true); ?>.png" alt="" />
								<?php } ?>
									
								</li>
								<?php endif; ?>
								
								<?php if( get_post_meta(get_the_ID(), 'crumble_mb_criteria2_name', true) != '' ) : ?>
								<li>
									<span>
										<?php echo $criteria2_name; ?>
									</span>
								<?php if ( $theme_style == 'dark.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta(get_the_ID(), 'crumble_mb_criteria2', true); ?>.png" alt="" />
								<?php } else if ( $theme_style == 'light.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/light/<?php echo get_post_meta(get_the_ID(), 'crumble_mb_criteria2', true); ?>.png" alt="" />
								<?php } ?>

								</li>
								<?php endif; ?>								
								
								<?php if( get_post_meta(get_the_ID(), 'crumble_mb_criteria3_name', true) != '' ) : ?>
								<li>
									<span>
										<?php echo $criteria3_name; ?>
									</span>
								<?php if ( $theme_style == 'dark.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta(get_the_ID(), 'crumble_mb_criteria3', true); ?>.png" alt="" />
								<?php } else if ( $theme_style == 'light.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/light/<?php echo get_post_meta(get_the_ID(), 'crumble_mb_criteria3', true); ?>.png" alt="" />
								<?php } ?>
													
								</li>
								<?php endif; ?>								
								
								<?php if( get_post_meta(get_the_ID(), 'crumble_mb_criteria4_name', true) != '' ) : ?>
								<li>
									<span>
										<?php echo $criteria4_name; ?>
									</span>
								<?php if ( $theme_style == 'dark.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta(get_the_ID(), 'crumble_mb_criteria4', true); ?>.png" alt="" />
								<?php } else if ( $theme_style == 'light.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/light/<?php echo get_post_meta(get_the_ID(), 'crumble_mb_criteria4', true); ?>.png" alt="" />
								<?php } ?>
													
								</li>
								<?php endif; ?>								
								
								<?php if( get_post_meta(get_the_ID(), 'crumble_mb_criteria5_name', true) != '' ) : ?>
								<li>
									<span>
										<?php echo $criteria5_name; ?>
									</span>
								<?php if ( $theme_style == 'dark.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo get_post_meta(get_the_ID(), 'crumble_mb_criteria5', true); ?>.png" alt="" />
								<?php } else if ( $theme_style == 'light.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/light/<?php echo get_post_meta(get_the_ID(), 'crumble_mb_criteria5', true); ?>.png" alt="" />
								<?php } ?>
													
								</li>
								<?php endif; ?>								
								
							</ul>
							
					</div> <!-- /wrapper-criteria -->
			</div> <!-- /overscore-block -->
		<?php } ?>
						<?php						
						/*
						-----------------------------------------------------------------------------------------------------------------						
								CONTENT
						-----------------------------------------------------------------------------------------------------------------							
						*/	
							the_content();
						?>			

					<div class="clear"></div>
					
				</div>

		<div class="margin-15t"></div>

		<?php		
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Reviews") ) : ?>                
		<?php endif; ?> 
							
		<div class="clear"></div>

				<?php
			  			endwhile;  
					endif;  
				?>		

				<div class="clear"></div>



		<?php wp_link_pages(); ?>
<?php comments_template(); ?>
					<!-- D&eacute;but Navigation -->
					<div class="before-nav"></div>
					<div class="single-post-navigation">
						
						<div class="prev-left" >
							<?php if( get_previous_post() ) : ?>
								<?php previous_post_link('<div class="prev-arrow">%link</div>') ?>
							<?php endif; ?>					
						</div> <!-- /prev-left -->
						
						<div class="next-right" >
							<?php if( get_next_post() ) : ?>
								<?php next_post_link('<div class="next-arrow">%link</div>') ?>
							<?php endif; ?>					
						</div> <!-- /next-right -->
						<div class="clear"></div>
					</div> <!-- /single-post-navigation -->

					<div class="after-nav"></div>
					
		</div> <!-- eleven columns -->
		
		<?php 
			$sidebar = stripslashes( $data['crumble_sidebar_position'] );

			if ( $sidebar == 'Right' ) get_sidebar();
		 ?>			

		<div class="clear"></div>
	
	</div> <!-- /container -->
	
</div> <!-- content-wrapper -->

<?php get_footer(); ?>