<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package calsv4
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="section-content">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

				?>

					<div class="featured-story-next-post-nav">
							<?php
								the_post_navigation(array(
									'prev_text' => '<< %title',
									'next_text'  => '%title >>',
								));
							?>
					</div>

				<?php

				endwhile; // End of the loop.
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->


<?php
get_sidebar();
get_footer();
