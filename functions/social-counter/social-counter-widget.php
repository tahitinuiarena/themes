<?php


require "scw_stats.class.php";

add_action('widgets_init', 'CrumbleMagazine_SocialCounter_load_widgets');

/*
=================================
	Load Widget
=================================	
*/
function CrumbleMagazine_SocialCounter_load_widgets()
{
	register_widget('SocialCounter_widget');
}


class SocialCounter_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function SocialCounter_widget() {
        parent::WP_Widget( false, $name = 'TNA: Social Counter Widget');
        $this->cacheFileName = WP_CONTENT_DIR."/sc_cache.txt";
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $facebook_id	= $instance['facebook_id'];
        $twitter_id	= $instance['twitter_id'];
        $feedburner_id = $instance['feedburner_id'];
        $cacheFileName = $this->cacheFileName;


        if(file_exists($cacheFileName) && time() - filemtime($cacheFileName) < 6*60*60)
        {
            $stats = unserialize(file_get_contents($cacheFileName));
        }

        if(!$stats)
        {
            // If no cache was found, fetch the subscriber stats and create a new cache:

            $stats = new SubscriberStats(array(
                'facebookFanPageURL'	=> $facebook_id,
                'feedBurnerURL'		=> $feedburner_id,
                'twitterName'		=> $twitter_id
            ));

            file_put_contents($cacheFileName,serialize($stats));
        }

        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<?php $stats->generate(); ?>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
        if($new_instance != $old_instance) unlink($this->cacheFileName);
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_id'] = strip_tags($new_instance['twitter_id']);
        $instance['facebook_id'] = strip_tags($new_instance['facebook_id']);
        $instance['feedburner_id'] = strip_tags($new_instance['feedburner_id']);
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {

        $title 		 = esc_attr($instance['title']);
        $twitter_id  = esc_attr($instance['twitter_id']);
        $facebook_id = esc_attr($instance['facebook_id']);
        $feedburner_id = esc_attr($instance['feedburner_id']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'crumble' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e( 'Twitter ID:' , 'crumble' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter_id; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('facebook_id'); ?>"><?php _e( 'Facebook page URL:' , 'crumble' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('facebook_id'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" type="text" value="<?php echo $facebook_id; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e( 'Feedburner URL:' , 'crumble' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo $feedburner_id; ?>" />
        </p>
        <?php
    }


} // end class example_widget

add_action('widgets_init', create_function('', 'return register_widget("SocialCounter_widget");'));


?>