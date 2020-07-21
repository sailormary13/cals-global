<?php
/**
 * Block for Featured Stories Feed
**/

$args = array( 
	'orderby' => 'title',
	'order' => 'asc',
    'post_type' => 'featured-stories',
    'posts_per_page' => 6
  );
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) : ?>
	<div class="featured-stories-feed">
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
	
			  // Create id attribute
			  $id = 'featured-story-' . get_the_ID();

			// Create class attribute allowing for custom "className" and "align" values.
			$className = 'featured-story';
			if( !empty($block['className']) ) {
				$className .= ' ' . $block['className'];
			}
			if( !empty($block['align']) ) {
				$className .= ' align' . $block['align'];
			}

			$cals_priority_theme = get_field( 'cals_priority_theme', get_the_ID());
			$story_photo = get_field( 'story_photo', get_the_ID());
			$faculty_photo = get_field( 'faculty_photo', get_the_ID());
			$project_title = get_field( 'project_title', get_the_ID());
			$faculty_name = get_field( 'faculty_name', get_the_ID());
			$faculty_department = get_field( 'faculty_department', get_the_ID());
			$post_link = get_post_permalink( get_the_ID() );
			?>

			<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
				<a class="featured-story-feed-card-link" href="<?php echo $post_link?>">
					<div class="featured-story-photo">
						<?php echo wp_get_attachment_image( $story_photo['ID'], 'full' ); ?>
					</div>
					<div class="featured-story-faculty-photo">
						<?php echo wp_get_attachment_image( $faculty_photo['ID'], 'thumbnail' ); ?>
					</div>
					<div class="featured-story-details">
						<h3><?php echo $cals_priority_theme->name; ?></h3>
						<span class="featured-story-project-title"><?php echo $project_title; ?></span>
						<span class="featured-story-faculty-details"><?php echo $faculty_name; ?>, <?php echo $faculty_department; ?></span>
						<div class="featured-story-overlay"></div>
					</div>
				</a>
			</div>
	
		<?php endwhile; ?>
	</div>
<?php else: __( 'Sorry, there are no featured stories to display', 'wprig' );  endif; 
	wp_reset_query();
	wp_reset_postdata();
?>
