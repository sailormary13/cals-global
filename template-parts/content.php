<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package calsv4
 */

?>
<div class="section-content">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-header">
			<?php
				if ( is_singular() ) :
					the_title( '<h1 class="post-title">', '</h1>' );
				else :
					the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;


			if ( 'post' === get_post_type() ) :
				if ( is_singular() ) :
					?>
					<div class="entry-meta-single-post">
						<?php
						calsv4_posted_on();
						?>
					</div><!-- .entry-meta -->
				<?php
				else :
					?>
					<div class="entry-meta">
						<?php
						calsv4_posted_on();
						?>
					</div><!-- .entry-meta -->
				<?php
				endif;
				
				?>

				
			<?php endif;

			if ( 'featured-stories' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					calsv4_posted_on();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>

			</div><!-- .entry-header -->

		<div class="entry-content featured-story-post-story">
			<?php calsv4_post_thumbnail(); ?>


			<?php

			if ( is_singular() ) :
			?>
				<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'calsv4' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );
				endif;

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'calsv4' ),
					'after'  => '</div>',
				) );
				?>
		</div><!-- .entry-content -->

		<!-- <div class="entry-footer">
			<?php calsv4_entry_footer(); ?>
		</div> -->
		
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
