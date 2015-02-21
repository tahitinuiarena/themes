<?php

add_action('widgets_init', 'CrumbleMagazine_load_flickr_widgets');

function CrumbleMagazine_load_flickr_widgets()
{
	register_widget('CrumbleMagazine_Flickr_Widget');
}



	class CrumbleMagazine_Flickr_Widget extends WP_Widget {

	
	function CrumbleMagazine_Flickr_Widget() {
		
		
		$widget_ops = array('classname' => 'crumble_flickr_widget', 'description' => __( 'TNA: Flickr Widget', 'crumble' ) );

		
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumblemagazine_flickr_widget' );

				
		$this->WP_Widget( 'crumble_flickr_widget', 'TNA: Flickr Widget ', $widget_ops);
	}


function widget( $args, $instance ) {
	extract( $args );

	
	$title = apply_filters('widget_title', $instance['title'] );
	$user_id = $instance['user_id'];

	
	echo $before_widget;

	
	if ( $title )
		echo $before_title . $title . $after_title;

	
	?>

<script type="text/javascript">

jQuery.noConflict()(function($){
$(document).ready(function() {
	
	$('#cbox').jflickrfeed({
		limit: <?php echo $instance['num_images']; ?>,
		qstrings: {
			id: "<?php echo $instance['user_id']; ?>"
		},
		itemTemplate: '<li>'+
						'<a rel="prettyPhoto[flickr]" href="{{image_b}}" title="{{title}}">' +
							'<img src="{{image_s}}" alt="{{title}}" />' +
						'</a>' +
					  '</li>'
	}, function(data) {
		$('#cbox a').prettyPhoto({
			animationSpeed: 'normal', /* fast/slow/normal */
			opacity: 0.80, /* Value between 0 and 1 */
			showTitle: true, /* true/false */
			theme:'dark_square'
		});
	});


});
});
</script>		

			<ul id="cbox" class="thumbs"></ul>

	
	<?php


	echo $after_widget;
	
}



	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	
	$instance['user_id'] = stripslashes( $new_instance['user_id']);
	$instance['num_images'] = stripslashes( $new_instance['num_images']);	



	return $instance;
}



	 
function form( $instance ) {

	
	$defaults = array( 'title' => __( 'From Flickr' , 'crumble' ) , 'user_id' => '47257185@N03', 'num_images' => '8' );
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'crumble') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	
	
	<p>
		<label for="<?php echo $this->get_field_id( 'user_id' ); ?>"><?php _e('User ID:', 'crumble') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'user_id' ); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['user_id'] ), ENT_QUOTES)); ?>" />
	</p>


	<p>
		<label for="<?php echo $this->get_field_id( 'num_images' ); ?>"><?php _e('The Number of Displayed Images:', 'crumble') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'num_images' ); ?>" name="<?php echo $this->get_field_name( 'num_images' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['num_images'] ), ENT_QUOTES)); ?>" />
	</p>
		
	<?php
	}
}
?>