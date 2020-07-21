<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package calsv4
 */

?>

<div class="no-results not-found section-content">
	<header class="page-header">
		<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'calsv4' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content" style="margin-bottom: 6em;">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'calsv4' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p>Sorry, but nothing matched your search terms. Try another search or <a href="mailto:calsglobal@cals.wisc.edu">send us an email</a>.</p>
			<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'calsv4' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</div><!-- .no-results -->
