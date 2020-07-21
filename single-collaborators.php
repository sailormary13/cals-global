<?php
/**
 * The template for displaying a collaborator (custom post type)
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
					<div class="">
						<header class="entry-header">
							<!-- Display page title if *not* the front page -->
							<?php 
							if (!is_front_page()) {
								the_title( '<h1 class="post-title">', '</h1>' ); 
							}
							?>
						</header><!-- .entry-header -->

						<!-- Get post data -->
						<?php 
							$first_name = get_field('first_name');
							$last_name = get_field( 'last_name', get_the_ID());
							$role = get_field( 'role', get_the_ID());
							$department_unit = get_field( 'department_unit', get_the_ID());
							$email_address = get_field( 'email_address', get_the_ID());
							$phone_number = get_field( 'phone_number', get_the_ID());
							$website = get_field( 'website', get_the_ID());
							$picture = get_field( 'picture', get_the_ID());
							$keywords = get_field( 'keywords', get_the_ID());
							$countries = get_field( 'countries', get_the_ID());
							$international_activity = get_field( 'international_activity', get_the_ID());
							$cals_priority_themes = get_field( 'cals_priority_themes', get_the_ID());
							$un_sustainable_development_goals = get_field( 'un_sustainable_development_goals', get_the_ID());
						?>


						<div class="principal-investigator-details">
							<div class="featured-story-post-faculty-photo">
								<?php 
								if (!$picture['ID']) {
								?>
									<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user-circle" class="svg-inline--fa fa-user-circle fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" height="150px"><path fill="#adadad" d="M248 104c-53 0-96 43-96 96s43 96 96 96 96-43 96-96-43-96-96-96zm0 144c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm0-240C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-49.7 0-95.1-18.3-130.1-48.4 14.9-23 40.4-38.6 69.6-39.5 20.8 6.4 40.6 9.6 60.5 9.6s39.7-3.1 60.5-9.6c29.2 1 54.7 16.5 69.6 39.5-35 30.1-80.4 48.4-130.1 48.4zm162.7-84.1c-24.4-31.4-62.1-51.9-105.1-51.9-10.2 0-26 9.6-57.6 9.6-31.5 0-47.4-9.6-57.6-9.6-42.9 0-80.6 20.5-105.1 51.9C61.9 339.2 48 299.2 48 256c0-110.3 89.7-200 200-200s200 89.7 200 200c0 43.2-13.9 83.2-37.3 115.9z"></path></svg>
									<?php } else {
							
								echo wp_get_attachment_image( $picture['ID'], 'thumbnail' ); 
								} ?>
							</div>	
							<div class="featured-story-post-faculty-details">
								<p><?php echo $department_unit; ?></p>
								<p><?php echo $role; ?></p>
								<p>
									<a href="mailto:<?php echo $email_address; ?>"><?php echo $email_address; ?></a>
								</p>
								<p>
									<a href="<?php echo $website; ?>">website</a>
								</p>
							</div>
						</div>

						<div class="grid-2-column" style="margin-top: 2em;">
							<div>
								<h5>Professional Interests</h5>
								<ul>
									<?php foreach( $keywords as $keyword ): ?>

										<li>
											<a href="<?php echo get_term_link( $keyword ); ?>"><?php echo $keyword->name; ?></a>
										</li>

									<?php endforeach; ?>
								</ul>
							</div>

							<div>
								<h5>Countries</h5>
								<ul>
									<?php foreach( $countries as $country ): ?>

										<li>
											<a href="<?php echo get_term_link( $country ); ?>"><?php echo $country->name; ?></a>
										</li>

									<?php endforeach; ?>
								</ul>
							</div>
						</div>

						<div style="max-width: 900px;">
							<h5>International Activity</h5>
							<p><?php echo $international_activity; ?></p>
						</div>

						<div class="grid-2-column" style="margin-top: 2em;">
							<div>
								<h5>CALS Priority Themes</h5>
								<ul>
									<?php foreach( $cals_priority_themes as $cals_priority_theme ): ?>
										<li><?php echo $cals_priority_theme['value']; ?></span></li>
									<?php endforeach; ?>
								</ul>
							</div>
							<div>
								<h5>United Nations Sustainable Development Goals</h5>
								<ul>
									<?php foreach( $un_sustainable_development_goals as $un_sustainable_development_goal ): ?>
										<li><?php echo $un_sustainable_development_goal['value']; ?></span></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>

					</div><!-- .entry-content -->


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
