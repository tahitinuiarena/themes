<?php global $data; ?>
	<div class="pat-block"></div>
	<div class="inner-pat">
	
		<div class="container">
			<div class="sixteen columns">
				<?php 
					$carousel_title = stripslashes( $data['crumble_carousel_title'] ); 
					if ( $carousel_title != '' ) {
				?>
				<h2 class="featured-carousel-title"><?php echo $carousel_title; ?></h2>
				<?php } ?>

				<div class="clear"></div>
			</div> <!-- /sixteen columns -->
		</div> <!-- /container -->		
	</div> <!-- /inner-pat -->

	<div class="pat-block-after"></div>

	<div id="carousel-wrap">
		<div class="container">
				
				<ul id="crumble_carousel" class="jcarousel-skin-tango">
			<?php
					$args = array( 'numberposts' => 999, 'category' => $id );
					$myposts = get_posts( $args );
					
				// The Loop
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
				<li><div class="carousel-thumb four columns">
				
				<?php if ( has_post_format('audio') ) { ?>
				<a href="<?php the_permalink(); ?>"><div class="mask audio"></div></a>
				<?php } ?>
				<?php if ( has_post_format('video') ) { ?>
					<a href="<?php the_permalink(); ?>"><div class="mask video"></div></a>
				<?php } ?>

				<?php if ( has_post_format('gallery') ) { ?>
					<a href="<?php the_permalink(); ?>"><div class="mask gallery"></div></a>
				<?php } ?>
					
				<?php if ( has_post_format('image') ) { ?>
					<a href="<?php the_permalink(); ?>"><div class="mask image"></div></a>
				<?php } ?>


				<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image') ) { ?>
					<a href="<?php the_permalink(); ?>"><div class="mask standard"></div></a>
				<?php } ?>				
				
				
				<div class="post-comments">
				<?php 
					comments_number('0','1','%');
					?>
					</div>
					<?php
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'mag-carousel'); 
				?>
				<img src="<?php echo $image_url[0]; ?>" alt="" />
				<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
	<?php			
			echo "</div></li>";
			endforeach;
	
	
			wp_reset_query();					
	?>

			</ul>
		</div>
		<div class="pat-block"></div>

	</div> 
