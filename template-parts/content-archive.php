<?php
/**
 * Template part for listing each post on the page that displays posts (index.php)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package calsv4
 */

?>
<div class="posts-archive-post-unit">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="thumbnail-title-wrapper">
			<div class="posts-thumbnail">
				<?php

				if ('featured-stories' === get_post_type()) {
					$story_photo = get_field('story_photo');
					?>

					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<img src="<?php echo esc_url($story_photo['url']); ?>" alt="<?php echo esc_attr($story_photo['alt']); ?>" />
					</a>

					<?php

				} else {

					if ( ! has_post_thumbnail()) {
					?>

					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<img src="/wp-content/themes/cals-global/resources/assets/images/CALS-logo1.svg" class="default-post-img">
					</a>

					<?php
					} else {
						calsv4_post_thumbnail(); 
					}
				}
				?>
			</div>
			
			<div>
				<?php
					the_title( '<h2 class="posts-archive-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

					// date displays for posts, and does not display for featured-stories
					if ( 'post' === get_post_type() ) {
						calsv4_posted_on();
					}

					?>
			</div>

		</div>

		
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
