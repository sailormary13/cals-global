<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package calsv4
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="entry-title">
							<?php
							// removes the 'Archives: ' from Archives: Featured Stories
							if (is_post_type_archive()) {
								echo post_type_archive_title( '', false );
							// keeps the 'Countries: ' in Countries: Indonesia
							} else {
								the_archive_title();
							}
							?>
						</h1>
					</header><!-- .page-header -->

					<div class="archives-content section-content">

						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content-archive', get_post_type() );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
