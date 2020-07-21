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
					// removes the 'Archives: ' from Archives: Collaborators
					if (is_post_type_archive()) {
						echo post_type_archive_title( '', false );
					// keeps the 'Countries: ' in Countries: Indonesia
					} else {
						the_archive_title();
					}
					?>
				</h1>
				<p class="collab-subtext centered-p">The following persons are involved in international projects that address the CALS Priority Themes and/or the UN’s Sustainable Development Goals. To add or edit an entry, click the Add/Edit Entry button.</p>
			</header><!-- .page-header -->

			<div class="archives-content section-content collaborators-directory">
				<div class="collab-search-container">
					<label class="collab-search-label">Search:</label>
					<input type="text"class="collab-search-input filterinput" name="q" placeholder="Type in a name, topic, or country...">
	
				</div>
				<div class="collab-add-edit-button-container">
					<a class="wp-block-button__link" style="margin: 0 0 1em;" href="/add-edit-form-collaborators">Add/Edit Entry</a>
				</div>


				<div style="clear: both;">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</div>
			</div>

	</main><!-- #main -->
</div><!-- #primary -->

<script>

document.querySelector(".filterinput").addEventListener("keyup", function() {
    var filter = this.value;
	var searchinput = this;
	console.log(this.value);
   
    var searchelement = searchinput.closest(".collaborators-directory").querySelectorAll(".collaborator-container-plus");

	console.log(searchelement);

    Array.prototype.forEach.call(searchelement, function(element, index, array) {
        if (
          element
            .textContent
            .search(new RegExp(filter, "i")) < 0
        ) {
          element.classList.add("hidden");
        } else {
          element.classList.remove("hidden");
        }
    });
 });

</script>


<?php
get_sidebar();
get_footer();
