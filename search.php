<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package calsv4
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="section-content search-results-content">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="entry-title">
							<?php
							/* translators: %s: search query. */
							printf( esc_html__( 'Search Results for: %s', 'calsv4' ), '<span>' . get_search_query() . '</span>' );
							?>
						</h1>
					</header><!-- .page-header -->

						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						the_posts_navigation();

						?>

						<section>
							<div class="section-content">
								<p>Not what you're looking for? Try another search or <a href="mailto:calsglobal@cals.wisc.edu">send us an email</a>.</p>
								<div style="padding-bottom: 2em;">
									<?php get_search_form( true ); ?>
								</div>
							</div>
						</section>
						
					<?php
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
