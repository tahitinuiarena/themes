<?php

add_action( 'widgets_init', 'crumblemagazine_tabs_load_widgets' );

function crumblemagazine_tabs_load_widgets()
{
	register_widget('CrumbleMagazine_TabsRecent_Widget');
}


class CrumbleMagazine_TabsRecent_Widget extends WP_Widget { 
	/**
	 * Widget setup.
	 */
	function CrumbleMagazine_TabsRecent_Widget()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'crumblemagazine_tabs_widget', 'description' => __( 'Display Tabs Widget in Sidebar and Magazine Widgets' , 'crumble' ) );
		
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumblemagazine_tabs_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crumblemagazine_tabs_widget', __( 'TNA : Tabs Widget' , 'crumble' ), $widget_ops, $control_ops);
	}

    function widget($args, $instance) { 
        extract( $args ); 

		/* For Recent Posts */
		$title = $instance['title'];
		$categories = $instance['categories'];
		$num_posts = $instance['num_posts'];

		/* For Recent Comments */        
		$title2 = $instance['title2'];
		$num_comments = $instance['num_comments'];
		$comment_len = $instance['comment_len'];		
		
		$title3 = $instance['title3'];        
        ?>
        
   <div class="widget">
   
                	<div class="section">
                        <ul class="tabs">
                            <li class="current"><?php echo $instance['title']; ?></li>
                            <li><?php echo $instance['title2']; ?></li>
                            <li><?php echo $instance['title3']; ?></li>
                        </ul>
        
		<!-- start Posts -->                
        <div class="box visible">

		<?php $recent_posts = new WP_Query(array('showposts' => $num_posts, 'post_type' => 'post', 'cat' => $categories)); ?>
	
		<ul class="recent-post-widget">
			<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
			<li>
				<div class="widget-thumb">
				<?php if ( has_post_format('audio') ) $post_format = 'class="format-audio-icon"'; ?>
				<?php if ( has_post_format('video') ) $post_format = 'class="format-video-icon"'; ?>
				<?php if ( has_post_format('gallery') ) $post_format = 'class="format-gallery-icon"'; ?>
				<?php if ( has_post_format('image') ) $post_format = 'class="format-image-icon"'; ?>
				
				<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image') ) $post_format = 'class="format-standard-icon"'; ?>								
						<?php if(has_post_thumbnail()): ?>
							<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-post-thumb'); ?>
							<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' <?php echo $post_format; ?> ><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
						<?php endif; ?>		
				</div>					
				
					<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="bg-link"><?php the_title(); ?></a>
					
					<div class="small-meta">
						<?php if($show_icons == 'true') { ?>
							<span class="date-ico">
						<?php } ?>
							<?php the_time('M j, Y'); ?>	
						<?php if($show_icons == 'true') { ?>
							</span>
						<?php } ?> | 
						<?php if($show_icons == 'true') { ?>
							<span class="comments-ico">
						<?php } ?>
							<?php comments_popup_link(); ?>
						<?php if($show_icons == 'true') { ?>
							</span>
						<?php } ?>						
					 </div> <!-- /small-meta -->
					<div class="clear"></div>	
				</li>	
				<?php endwhile; ?>
			</ul>					

            </div> <!-- /box -->
                        
                        <!-- start Comments -->
                        <div class="box">
						<?php

						$recent_comments = get_comments( array(
						    'number'    => $num_comments,
						    'status'    => 'approve'
						) );

						echo '<ul class="recent-comments-widget">';
	
						foreach( $recent_comments as $comment ) {
							echo '<li>';
						?>	

						<?php
								echo get_avatar( $comment, $size='50', $default='<path_to_url>' ); 

						?>
		
						<?php		 	
							echo '<strong>' . dp_get_author($comment) .' said: </strong>'; ?>
		 		
					 		<a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>">
		
							<?php		 
								echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len ) ) . ' ...'; 
								echo '</a>';?>
						
							<div class="small-meta rct-comments">
								<?php echo '['.human_time_diff(get_comment_date('U',$comment->comment_ID), current_time('timestamp')), __(' ago', 'crumble'); ?>]&nbsp;   
							</div> <!-- /small-meta rct-comments -->
						
						<?php			
							echo '<div class="clear"></div></li>'; 
						}			
					
						echo '</ul>';
	
						?>
                        </div> <!-- /box -->
                        
                        <!-- start Tags -->
                        <div class="box">
		                	<?php the_widget( 'WP_Widget_Tag_Cloud', 'title= ');  ?>
                        </div> <!-- /box -->
                        
                    </div>

				   </div> <!-- end span-8 -->
 <?php 
    }

    function update($new_instance, $old_instance) { 
        return $new_instance; 

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['num_posts'] = $new_instance['num_posts'];

		$instance['title2'] = strip_tags( $new_instance['title2'] );
		$instance['num_comments'] = $new_instance['num_comments'];
		$instance['comment_len'] = $new_instance['comment_len'];		
		$instance['show_avatar'] = $new_instance['show_avatar'];	        

		$instance['title3'] = strip_tags( $new_instance['title3'] );		
    }

    function form($instance) { 
       	        	    
       

	/* Set up some default widget settings. */
		$defaults = array('title' => __( 'Recent Posts' , 'crumble' ) , 'categories' => 'all', 'num_posts' => 4);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title for 1st tab:' , 'crumble' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category:' , 'crumble' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ( 'all' == $instance['categories'] ) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
				<?php foreach( $categories as $category ) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'The Number of posts:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
		</p>


		<!-- for comments -->
		<?php
		/* Set up some default widget settings. */
		$defaults2 = array('title2' => __( 'Comments' , 'crumble' ) , 'num_comments' => 4, 'comment_len' => 50, 'show_avatar' => 'on' );
		$instance = wp_parse_args((array) $instance, $defaults2); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title2'); ?>"><?php _e( 'Title for 2nd tab:' , 'crumble' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" value="<?php echo $instance['title2']; ?>" />
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id('num_comments'); ?>"><?php _e( 'The Number of comments:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('num_comments'); ?>" name="<?php echo $this->get_field_name('num_comments'); ?>" value="<?php echo $instance['num_comments']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('comment_len'); ?>"><?php _e( 'Length of comments: ( by default: 50 symbols )' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('comment_len'); ?>" name="<?php echo $this->get_field_name('comment_len'); ?>" value="<?php echo $instance['comment_len']; ?>" />
		</p>

	
	<?php
	/* Set up some default widget settings. */
		$defaults3 = array('title3' => __( 'Tags' , 'crumble' ) );
		$instance = wp_parse_args((array) $instance, $defaults3); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title3'); ?>"><?php _e( 'Title for 3rd tab:' , 'crumble' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" value="<?php echo $instance['title3']; ?>" />
		</p>
		
<?php 
    }

} 


?>
