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
	
		<div class="sixteen columns standard-link">	
			<div class="post-title">
				<h2>Error 404</h2>
			</div>
			<div style="font-size: 26px; line-height: 32px; font-weight: bold; color: #ebe8df; font-family: 'Oswald', sans-serif">
										<p><?php _e('Sorry, the page you are looking for could not be found.' , 'crumble' ); ?></p>
						<?php get_search_form(); ?>

			</div>				
		 </div> <!-- /eleven columns -->		
		
		</div> <!-- /container -->			
		
	</div> <!-- /content-bg-wrapper -->	
	<!-- fin Content -->
	
<?php get_footer(); ?>