					<div class="slider-block">
					<?php
						global $data;
						$post_types = get_post_types();

						$post_count = stripslashes( $data['crumble_slider_items'] );
						$post_tags = stripslashes( $data['crumble_slider_tags'] );
				
						$featured_posts = new WP_Query(array('post_type' => 'post', 'showposts' => $post_count, 'tag' => $post_tags ));
					?>
						<!-- Begin Nivo Slider Featured -->
						<div id="slider" class="nivoSlider">
							<?php while($featured_posts->have_posts()): $featured_posts->the_post(); ?>
								<?php if(has_post_thumbnail()): ?>
									<?php $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'mag-slider'); ?>
									<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" title="#htmlcaption_<?php the_ID(); ?>" /></a>
								<?php endif; ?>
							<?php endwhile; ?>
						</div>

						<?php while($featured_posts->have_posts()): $featured_posts->the_post(); ?>
						<div class="nivo-html-caption" id="htmlcaption_<?php the_ID(); ?>">
							<h2><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h2>
							<?php echo the_excerpt(); ?>
						</div>
						<?php endwhile; ?>
						<!-- End Nivo Slider Featured -->

					</div> <!-- /slider-block -->
