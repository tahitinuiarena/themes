<?php
	/* 
		Template Name: Blog Style 2
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
						Récupérer Top Widget Area
				*/
				
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Top Blog") ) : ?>                
				<?php endif; ?> 
		
			<ul>
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
				
				<li class="custom-with-bg">
				
				<div id="post-<?php the_ID(); ?>" >	
	
					<a href="<?php the_permalink(); ?>" class="blog-link"><h2 class="single-title"><?php the_title(); ?></h2></a>

					<div class="single-meta-information">
					
						<ul class="single-post-meta">
							<li class="date-icon"><?php the_time('F d, Y'); ?></li>
							<li class="user-icon"><?php echo the_author_link(); ?></li>
							<li class="category-icon"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></li>
							<li class="comments-icon"><?php comments_popup_link('0 Commentaire','1 Commentaire','% Commentaires'); ?></li>
						</ul> <!-- /single-post-meta -->

				
						<div class="clear"></div>

					</div> <!-- /single-meta-information -->	

						<?php if ( has_post_format('audio') ) echo '<div class="single-post-format-icon format-audio-icon"></div>'; ?>
						<?php if ( has_post_format('video') ) echo '<div class="single-post-format-icon format-video-icon"></div>'; ?>
						<?php if ( has_post_format('gallery') ) echo '<div class="single-post-format-icon format-gallery-icon"></div>'; ?>
						<?php if ( has_post_format('image') ) echo '<div class="single-post-format-icon format-image-icon"></div>'; ?>

						<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image') ) echo '<div class="single-post-format-icon format-standard-icon"></div>'; ?>									

						<div class="clear"></div>


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
				
				                    	<a data-rel="prettyPhoto" href="<?php echo $large_image_url[0]; ?>" class="zoom"><img src="<?php echo $small_image_url[0]; ?>" alt="" /></a>				

								<?php } ?>
								</div> <!-- /single-media-thumb -->									
						<?php } ?>
						

<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Galerie
-----------------------------------------------------------------------------------------------------------------							
*/
?>

	                   	<?php 
					  		$image1 = get_post_meta( $post->ID, 'crumble_mb_image1_upload', true );	                   		
					  		$image2 = get_post_meta( $post->ID, 'crumble_mb_image2_upload', true ); 					  		
					  		$image3 = get_post_meta( $post->ID, 'crumble_mb_image3_upload', true ); 					  		
					  		
							if ( has_post_format( 'gallery' ) && ( ( $image1 != '') or ( $image2 != '') or ( $image3 != '' ) ) ) {	                   	
						?>

							<!-- D&eacute;but FlexSlider -->				
							<div class="flexslider">
								  <ul class="slides">
								  	<?php 
								  		if ( $image1 != ''  ) {	
								  	?>
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crumble_mb_image1_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crumble_mb_image1_upload', true ) ?>" alt=""></a>
								    </li>
								    <?php } ?>

								  	<?php 

								  		if ( $image2 != ''  ) {	
								  	?>							    
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crumble_mb_image2_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crumble_mb_image2_upload', true ) ?>" alt=""></a>
								    </li>
								    <?php } ?>
								    

								  	<?php 
								  		if ( $image3 != ''  ) {	
								  	?>							    						    
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crumble_mb_image3_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crumble_mb_image3_upload', true ) ?>" alt=""></a>																							
								    </li>
								    <?php } ?>
								    								    
								  </ul>
							</div> <!-- /flexSlider -->		

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
							the_excerpt('',TRUE,''); 
						?>			
				
					<div class="clear"></div>

		        	<div style="float: right">
			    	    <?php the_tags('', '  ', '<br />'); ?> 
		        	</div>



				
					<div class="clear"></div>
		</div>
		
		</li>				
		


				<?php
			  			endwhile;  
					endif;  
				?>		
</ul>
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
						Get Bottom Widget Area
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