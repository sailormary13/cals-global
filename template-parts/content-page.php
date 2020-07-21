<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package calsv4
 */

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<!-- Display page title if *not* the front page -->
			<?php 
			if (!is_front_page()) {
				the_title( '<h1 class="entry-title">', '</h1>' ); 
			}
			?>
		</header><!-- .entry-header -->

		<?php calsv4_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'calsv4' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->


	</article><!-- #post-<?php the_ID(); ?> -->
