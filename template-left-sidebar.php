<?php
	/*
		Template Name: Left Sidebar
	*/
?>
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
			get_sidebar();
		?>	
	
		<div class="eleven columns standard-link">	
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<div class="post-title"><h2><?php the_title(); ?></h2></div>
					
						<div class="clear"></div>

						<?php the_content(); ?>

				<?php endwhile; endif; ?>
				
		 </div> <!-- /eleven columns -->		
		
		</div> <!-- /container -->			
		
	</div> <!-- /content-bg-wrapper -->	
	<!-- Fin Content -->
	
<?php get_footer(); ?>