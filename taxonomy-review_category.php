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

							<div class="pages-titles">
									<h1><?php echo single_cat_title('', false); ?></h1>
									<div class="clear"></div>
							</div> <!-- /pages-titles -->
		
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
				
				<div id="post-<?php the_ID(); ?>" >	
					<a href="<?php the_permalink(); ?>" class="blog-link"><h2 class="single-title"><?php the_title(); ?></h2></a>
				
					<div class="single-meta-information">
					
						<ul class="single-post-meta">
							<li class="date-icon"><?php the_time('F d, Y'); ?></li>
							<li class="user-icon"><?php echo the_author_link(); ?></li>
							<li class="category-icon"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></li>
							<li class="comments-icon"><?php comments_popup_link('No Comments','1 Comment','% Comments'); ?></li>
						</ul> <!-- /single-post-meta -->

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
							<div class="right-review-block">
								<?php $theme_style = stripslashes( $data['crumble_theme_style'] ); ?>
								<?php if ( $theme_style == 'dark.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/<?php echo $score; ?>.png" alt="" />
								<?php } else if ( $theme_style == 'light.css' ) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/stars/light/<?php echo $score; ?>.png" alt="" />
								<?php } ?>

							</div>

					
						<div class="clear"></div>

					</div> <!-- /single-meta-information -->	
				
			

								<div class="single-media-thumb"> 							
									<?php
										if ( has_post_thumbnail() ) { 
		                        			$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb'); 
											$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 	                        	
				                        ?>  
				
				                    	<a data-rel="prettyPhoto" href="<?php echo $large_image_url[0]; ?>" class="zoom"><img src="<?php echo $small_image_url[0]; ?>" alt="" /></a>				

								<?php } ?>
								</div> <!-- /single-media-thumb -->									

						



						<?php						
						/*
						-----------------------------------------------------------------------------------------------------------------						
								CONTENT
						-----------------------------------------------------------------------------------------------------------------							
						*/	
							the_content('',TRUE,''); 
						?>			
				
					<div class="clear"></div>

		        	<div style="float: right">
			    	    <?php the_tags('', '  ', '<br />'); ?> 
		        	</div>
				
					<div class="clear"></div>
				</div>

		<div class="margin-30t"></div>

							
		<div class="clear"></div>

				<?php
			  			endwhile;  
					endif;  
				?>		

				<div class="clear"></div>



			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
					<!-- D&eacute;but Navigation -->
					<div class="before-nav"></div>
						<div class="single-post-navigation">
						<?php if(function_exists('wp_corenavi')) { wp_corenavi(); } ?>  					
						<div class="clear"></div>
					</div> <!-- /single-post-navigation -->	
					<div class="after-nav"></div>
			<?php endif; ?>					
			
		</div> <!-- eleven columns -->
		
		<?php 
			$sidebar = stripslashes( $data['crumble_sidebar_position'] );

			if ( $sidebar == 'Right' ) get_sidebar();
		 ?>			

		<div class="clear"></div>
	
	</div> <!-- /container -->
	
</div> <!-- content-wrapper -->

<?php get_footer(); ?>