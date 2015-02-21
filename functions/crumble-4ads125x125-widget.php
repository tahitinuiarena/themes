<?php


add_action('widgets_init','CrumbleMagazine_4ads125x125_load_widgets');


function CrumbleMagazine_4ads125x125_load_widgets(){
		register_widget("CrumbleMagazine_4Ads125x125_Widget");
}

class CrumbleMagazine_4Ads125x125_Widget extends WP_widget{
	function CrumbleMagazine_4Ads125x125_Widget() {
		
	
		$widget_ops = array( 'classname' => 'crumble_4ads125x125_widget', 'description' => __( 'TNA: 4 Ads 125x125 for sidebar widget' , 'crumble' ) );
		
	
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_4ads125x125_widget' );

		$this->WP_Widget( 'crumble_4ads125x125_widget', __( 'TNA: 4 Ads 125x125' , 'crumble' ) , $widget_ops, $control_ops);
		
	}
	
	function widget($args,$instance) {
		extract($args);
		
		$title = $instance['title'];
		
		$link = $instance['link'];	
		$image = $instance['image'];
		
		$link2 = $instance['link2'];		
		$image2 = $instance['image2'];
		
		$link3 = $instance['link3'];		
		$image3 = $instance['image3'];
		
		$link4 = $instance['link4'];
		$image4 = $instance['image4'];
		
		?>
		<div class="widget ads125">
		<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}
			?>				

				<ul class="four-ads-blocks">
					<li class="first"><a href="<?php echo $link; ?>"><img src="<?php echo $image; ?>" alt="" /></a></li>
					<li><a href="<?php echo $link2; ?>"><img src="<?php echo $image2; ?>" alt="" /></a></li>
					<li class="first"><a href="<?php echo $link3; ?>"><img src="<?php echo $image3; ?>" alt="" /></a></li>
					<li><a href="<?php echo $link4; ?>"><img src="<?php echo $image4; ?>" alt="" /></a></li>															
				</ul> 
				<div class="clear"></div>
		</div> 
		<?php

	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];		
		$instance['link'] = $new_instance['link'];
		$instance['image'] = $new_instance['image'];

		$instance['link2'] = $new_instance['link2'];
		$instance['image2'] = $new_instance['image2'];
		
		$instance['link3'] = $new_instance['link3'];
		$instance['image3'] = $new_instance['image3'];
		
		$instance['link4'] = $new_instance['link4'];
		$instance['image4'] = $new_instance['image4'];
		
		
		return $instance;
	}


	function form($instance){
		?>
		<?php
			$defaults = array( 'title' => __( 'ADS125x125', 'crumble' ) );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e( 'Link Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo $instance['link']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e( 'Image Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $instance['image']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('link2'); ?>"><?php _e( 'Link2 Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link2'); ?>" name="<?php echo $this->get_field_name('link2'); ?>" value="<?php echo $instance['link2']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image2'); ?>"><?php _e( 'Image2 Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('image2'); ?>" name="<?php echo $this->get_field_name('image2'); ?>" value="<?php echo $instance['image2']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('link3'); ?>"><?php _e( 'Link3 Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link3'); ?>" name="<?php echo $this->get_field_name('link3'); ?>" value="<?php echo $instance['link3']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image3'); ?>"><?php _e( 'Image3 Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('image3'); ?>" name="<?php echo $this->get_field_name('image3'); ?>" value="<?php echo $instance['image3']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('link4'); ?>"><?php _e( 'Link4 Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link4'); ?>" name="<?php echo $this->get_field_name('link4'); ?>" value="<?php echo $instance['link4']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image4'); ?>"><?php _e( 'Image4 Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('image4'); ?>" name="<?php echo $this->get_field_name('image4'); ?>" value="<?php echo $instance['image4']; ?>" />
		</p>

		<?php

	}
}
?>