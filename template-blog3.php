<?php
	/* 
		Template Name: Blog Style 3
	*/


	global $more;
	$more = 0;
	
?>

<?php get_header(); ?>

	<?php setPostViews(get_the_ID()); ?>
	
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

				<?php 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					query_posts("post_type=post&paged=".$paged); 
				?>	
							
		<div class="eleven columns standard-link">		

				<?php 
				/*
						Top Widget
				*/
				
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Top Blog") ) : ?>                
				<?php endif; ?> 
		
			<div id="content_masonry">
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
	
		<div class="masonry_box">
				<div id="post-<?php the_ID(); ?>" >	
					<a href="<?php the_permalink(); ?>" class="blog-link"><h2 class="single-title"><?php the_title(); ?></h2></a>
				
					<div class="single-meta-information">
					
						<ul class="single-post-meta" style="margin-bottom: 30px;">
							<li class="date-icon"><?php the_time('F d, Y'); ?></li>
							<li class="comments-icon"><?php comments_popup_link('No Comments','1 Comment','% Comments'); ?></li>
						</ul> <!-- /single-post-meta -->

					
						<div class="clear"></div>

					</div> <!-- /single-meta-information -->	

	
				  <div class="clear"></div>
<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Image ou Standard  
-----------------------------------------------------------------------------------------------------------------							
*/
?>

	                   	<?php 
							if ( has_post_format( 'image' ) || has_post_format( 'gallery' ) || ( !has_post_format( 'image' ) &&  !has_post_format( 'video' ) && !has_post_format( 'audio' ) )  ) {	                   	?>

									<?php
										if ( has_post_thumbnail() ) { 
																				
		                        			$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb'); 
											$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 	                        	
											
				                        ?>  
								 <div class="single-media-thumb">  							
				                    	<a data-rel="prettyPhoto" href="<?php echo $large_image_url[0]; ?>" class="zoom"><img src="<?php echo $small_image_url[0]; ?>" alt="" /></a>				

									 <div class="clear"></div>
								</div> <!-- /single-media-thumb -->		

								<?php } ?>
								<div class="clear"></div>							
						<?php } ?>
			


<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Video  
-----------------------------------------------------------------------------------------------------------------							
*/
?>
						
						<?php 
							if ( has_post_format ( 'video' ) ) {
						?>
				

						
								<?php	
									$video_type = get_post_meta( $post->ID, 'crumble_mb_post_video_type', true );							
									$videoid = get_post_meta( $post->ID, 'crumble_mb_post_video_file', true );
								if( $videoid != '' ) { ?>
									<div class="single-video-post">
							
									<?php								
		            					if ( $video_type == 'youtube' ) {
			            					echo '<iframe height="315" src="http://www.youtube.com/embed/' . $videoid . '?autohide=1&amp;showinfo=0"></iframe>';
			            				} else if ( $video_type == 'vimeo' ) {	            					
			            					echo '<iframe src="http://player.vimeo.com/video/' . $videoid . '" height="315"></iframe>';	            				
			            				}	
										elseif( $type == 'dialymotion' ) { 
											echo '<iframe height="220" src="http://www.dailymotion.com/embed/video/' . $videoid . '?logo=0"></iframe>';
										 } ?>
		            				
								</div> <!-- /single-video-post-->		
						<?php } } ?>

<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Audio  
-----------------------------------------------------------------------------------------------------------------							
*/
?>
						
						<?php 
							if ( has_post_format ( 'audio' ) ) {
						?>
				
							
						
								<?php	
									
									$soundcloud = get_post_meta( $post->ID, 'crumble_mb_post_soundcloud', true );

	            					if ( $soundcloud != '' ) { ?>
	            					<div class="single-audio-post">
		            			<?php	echo $soundcloud; ?>
									</div> <!-- /single-audio-post-->				            			
								<?php } ?>
		            				

						<?php } ?>



						<?php						
						/*
						-----------------------------------------------------------------------------------------------------------------						
								CONTENT
						-----------------------------------------------------------------------------------------------------------------							
						*/	
							the_excerpt(); 
						?>			
				
					<div class="clear"></div>

		        	<div class="blockright">
			    	    <?php the_tags('', '  ', '<br />'); ?> 
		        	</div>
				
					<div class="clear"></div>
				</div>
<div class="clear"></div>
</div>										
		<div class="clear"></div> 

				<?php
			  			endwhile;  
					endif;  
				?>		

</div>
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

				<?php 
				/*
						Top Widget
				*/
				
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Bottom Blog") ) : ?>                
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