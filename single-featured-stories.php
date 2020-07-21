<?php
/**
 * The template for displaying a featured story (custom post type)
 *
 *
 * @package calsv4
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="section-content">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="featured-story-post-content">
						<header class="entry-header">
							<!-- Display page title if *not* the front page -->
							<?php 
							if (!is_front_page()) {
								the_title( '<h1 class="featured-story-title">', '</h1>' ); 
							}
							?>
						</header><!-- .entry-header -->

						<!-- Get post data -->
						<?php 
							$story_photo = get_field('story_photo');
							$faculty_photo = get_field( 'faculty_photo', get_the_ID());
							$faculty_name = get_field( 'faculty_name', get_the_ID());
							$faculty_department = get_field( 'faculty_department', get_the_ID());
							$faculty_email = get_field( 'faculty_email', get_the_ID());
							$faculty_website = get_field( 'faculty_website', get_the_ID());
						?>

						<div class="featured-story-post-sidebar-wrapper">

							<div>
								<div class="featured-story-post-story">
									<img src="<?php echo esc_url($story_photo['url']); ?>" alt="<?php echo esc_attr($story_photo['alt']); ?>" class="featured-story-post-story-img" />	
									<?php the_field('story');?>
								</div>

								<h3 style="margin-top: 3em;">Principal Investigator</h3>
								<div class="principal-investigator-details">
									<div class="featured-story-post-faculty-photo">
										<?php echo wp_get_attachment_image( $faculty_photo['ID'], 'thumbnail' ); ?>
									</div>
									<div class="featured-story-post-faculty-details">
										<p><?php echo $faculty_name; ?></p>
										<p><?php echo $faculty_department; ?></p>
										<p>
											<a href="mailto:<?php echo $faculty_email; ?>"><?php echo $faculty_email; ?></a>
										</p>
										<p>
											<a href="<?php echo $faculty_website; ?>">website</a>
										</p>
									</div>
								</div>

							</div>

							<div>
								<h3>CALS Priority Theme</h3>
								<?php
									$terms = get_the_terms( $post->ID , 'priority-themes' );
									foreach ( $terms as $term ) {
									  ?>
									  <a href="<?php echo get_category_link( $term->term_id ) ?>">
										<?php echo $term->name; ?>
									  </a>
									  <?php
									}
								?>

								<h3>Tags</h3>
								<?php
									$terms = get_the_terms( $post->ID , 'tags' );
									foreach ( $terms as $term ) {
									  ?>
									  <span class="tag-link">
										  <a href="<?php echo get_category_link( $term->term_id ) ?>"><?php echo $term->name; ?></a>
									  </span>
									  <?php
									}
								?>

								<hr style="margin: 2.2em 0 1em;">
								<div>
									<a href="/featured-stories">View all Featured Stories</a>
								</div>

							</div>

					</div>


				</article><!-- #post-<?php the_ID(); ?> -->
				


				<div class="featured-story-next-post-nav">
					<?php
						the_post_navigation(array(
							'prev_text' => '<< %title',
							'next_text'  => '%title >>',
						));
					?>
				</div>


					
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
