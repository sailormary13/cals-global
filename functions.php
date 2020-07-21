<?php
/**
 * calsv4 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package calsv4
 */

if ( ! function_exists( 'calsv4_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function calsv4_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on calsv4, use a find and replace
		 * to change 'calsv4' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'calsv4', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Register menus
		 * Primary = main nav, Secondary = in top UW bar
		 */
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'cals-global' ),
		) );

		// register_nav_menus( array(
		// 	'menu-2' => esc_html__( 'Secondary', 'cals-global' ),
		// ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'calsv4_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'calsv4_setup' );


/**
 * Enqueue scripts and styles.
 */

function wp4wp_scripts() {
	wp_enqueue_style('main_css', get_template_directory_uri() . '/assets/styles/main.css', array(), '1.0', false);
	wp_enqueue_script('main_js', get_template_directory_uri() . '/assets/scripts/main.js', array(), '1.0', true);
  }
  add_action('wp_enqueue_scripts', 'wp4wp_scripts');

function calsv4_scripts() {
	wp_enqueue_style( 'calsv4-style', get_stylesheet_uri() );
	// wp_enqueue_style( 'calsv4-style', '/main.css' );

	wp_enqueue_script( 'calsv4-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'calsv4-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'calsv4_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * 
 * ************************** ADD SVG SUPPORT *****************************
 *
 * Note: svg files seem to require <?xml version="1.0" encoding="utf-8"?> as the very first line
 */
function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

/**
 * 
 * ************************** ACF REGISTER BLOCKS *****************************
 *
 */
function acf_register_blocks() {
	
	if( ! function_exists( 'acf_register_block_type' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'featured-stories-feed',
		'title'			=> __( 'Featured Stories Feed' ),
		'render_template'	=> 'block-featured-stories-feed.php',
		'category'		=> 'formatting',
		'icon'			=> 'admin-site',
		'mode'			=> 'preview',
		'keywords'		=> array( 'project', 'feed', 'story' ),
		// 'enqueue_style'     => get_template_directory_uri() . '/assets/styles/main.css'
		// above line is causing everything in WP dashboard to get those styles instead of just the block
	));

}
add_action('acf/init', 'acf_register_blocks' );


/**
 * 
 * *********************** REGISTER CUSTOM POST TYPES *****************************
 *
 */

// Create "Featured Stories" Custom Post Type
function featured_stories_init() {
    $args = array(
      'label' => 'Featured Stories',
        'public' => true,
		'show_ui' => true,
		'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
		'rewrite' => array('slug' => 'featured-stories'),
		// 'show_in_rest' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-site',
        'supports' => array(
            'title',)
        );
	register_post_type( 'featured-stories', $args );
	
	$labels = array(
		'name'                       => _x( 'CALS Priority Themes', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'CALS Priority Theme', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Priority Themes', 'textdomain' ),
		'popular_items'              => __( 'Popular Priority Themes', 'textdomain' ),
		'all_items'                  => __( 'All Priority Themes', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Priority Theme', 'textdomain' ),
		'update_item'                => __( 'Update Priority Theme', 'textdomain' ),
		'add_new_item'               => __( 'Add New Priority Theme', 'textdomain' ),
		'new_item_name'              => __( 'New Priority Theme', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate Priority Themes with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove Priority Themes', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used Priority Themes', 'textdomain' ),
		'not_found'                  => __( 'No Priority Themes found.', 'textdomain' ),
		'menu_name'                  => __( 'CALS Priority Themes', 'textdomain' ),
	);
	
	register_taxonomy( 'priority-themes', 'featured-stories', array(
		'public' => true,
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'priority-themes' ),
	) );

	$labels2 = array(
		'name'                       => _x( 'Tags', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Tags', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Tags', 'textdomain' ),
		'popular_items'              => __( 'Popular Tags', 'textdomain' ),
		'all_items'                  => __( 'All Tags', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Tag', 'textdomain' ),
		'update_item'                => __( 'Update Tag', 'textdomain' ),
		'add_new_item'               => __( 'Add New Tag', 'textdomain' ),
		'new_item_name'              => __( 'New Tag Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used tags', 'textdomain' ),
		'not_found'                  => __( 'No tags found.', 'textdomain' ),
		'menu_name'                  => __( 'Tags', 'textdomain' ),
	);
	
	register_taxonomy( 'tags', 'featured-stories', array(
		'public' => true,
		'hierarchical'      => true,
		'labels'            => $labels2,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tags' ),
	) );
}
add_action( 'init', 'featured_stories_init' );

// Create "Collaborators" Custom Post Type
function collaborators_init() {
    $args = array(
      'label' => 'Collaborators',
        'public' => true,
		'show_ui' => true,
		'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
		'rewrite' => array('slug' => 'collaborators'),
		// 'show_in_rest' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array(
            'title',)
        );
	register_post_type( 'collaborators', $args );

	$labels = array(
		'name'                       => _x( 'Countries', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Countries', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Countries', 'textdomain' ),
		'popular_items'              => __( 'Popular Countries', 'textdomain' ),
		'all_items'                  => __( 'All Countries', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Country', 'textdomain' ),
		'update_item'                => __( 'Update Country', 'textdomain' ),
		'add_new_item'               => __( 'Add New Country', 'textdomain' ),
		'new_item_name'              => __( 'New Country Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate countries with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove countries', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used countries', 'textdomain' ),
		'not_found'                  => __( 'No countries found.', 'textdomain' ),
		'menu_name'                  => __( 'Countries', 'textdomain' ),
	);
	
	register_taxonomy( 'countries', 'collaborators', array(
		'public' => true,
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'countries' ),
	) );

	$labels2 = array(
		'name'                       => _x( 'Keywords', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Keywords', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Keywords', 'textdomain' ),
		'popular_items'              => __( 'Popular Keywords', 'textdomain' ),
		'all_items'                  => __( 'All Keywords', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Keyword', 'textdomain' ),
		'update_item'                => __( 'Update Keyword', 'textdomain' ),
		'add_new_item'               => __( 'Add New Keyword', 'textdomain' ),
		'new_item_name'              => __( 'New Keyword Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate keywords with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove keywords', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used keywords', 'textdomain' ),
		'not_found'                  => __( 'No keywords found.', 'textdomain' ),
		'menu_name'                  => __( 'Keywords', 'textdomain' ),
	);
	
	register_taxonomy( 'keywords', 'collaborators', array(
		'public' => true,
		'hierarchical'      => true,
		'labels'            => $labels2,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'keywords' ),
	) );
}
add_action( 'init', 'collaborators_init' );

/**
 * 
 * ****************** ADD EDITOR STYLES (example: increase max-width of gutenberg editor) **********************
 *
 */
add_theme_support( 'editor-styles');
add_editor_style( 'style-editor.css' );



/**
 * 
 ********************** REGISTER FOOTER AREAS ********************************************
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function cals_global_footer_widget_init() {

	register_sidebar( array(
		'name'          => __( 'Footer Column 1', 'cals-global' ),
		'id'            => 'footer-col-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 2', 'cals-global' ),
		'id'            => 'footer-col-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 3', 'cals-global' ),
		'id'            => 'footer-col-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 4', 'cals-global' ),
		'id'            => 'footer-col-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'cals_global_footer_widget_init' );

/**
 * 
 ********************** REGISTER ARCHIVES SIDEBAR ********************************************
 * on the news (posts) page, which is index.php for cals-global
 * 
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function cals_global_archives_sidebar_widget_init() {

	register_sidebar( array(
		'name'          => __( 'Archives Sidebar', 'cals-global' ),
		'id'            => 'archives-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'cals_global_archives_sidebar_widget_init' );

/**
 * 
 ******************* Order posts alphabetically on Collaborators archives *****************************
 *
 */
add_action( 'pre_get_posts', 'collaborators_query'); 
    function collaborators_query($query){
        if(is_post_type_archive( 'collaborators' )):
           // Set the order ASC or DESC
           $query->set( 'order', 'ASC' );
           // Set the orderby
		   $query->set( 'orderby', 'last_name' );
		   // Show all collaborators
		   $query->set( 'posts_per_page', '-1' );
        endif;    
	};
	

/**
 * 
 ******************* Put template with a section block on Posts *****************************
 * ensures all content gets proper spacing (padding/margin)
 */
function post_block_template() {

	$post_type_object = get_post_type_object( 'post' );
	$post_type_object->template = array(
		array( 'cals-global-blocks/section-general' ),
	);
}

add_action( 'init', 'post_block_template' );


/**
 * 
 ******************* Put template with a section block on Pages *****************************
 * ensures all content gets proper spacing (padding/margin)
 */
function page_block_template() {

	$post_type_object = get_post_type_object( 'page' );
	$post_type_object->template = array(
		array( 'cals-global-blocks/section-general' ),
	);
}

add_action( 'init', 'page_block_template' );


/**
 * 
 ******************* Add social fields to Customizer *****************************
 * 
 */

add_action( 'customize_register', 'cals_global_customize_register' );

function cals_global_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'cals-global-social-options' , array(
		'title'      => __( 'Social', 'cals-global' ),
		'priority'   => 70,
	) );

	/*** Twitter ***/
	$wp_customize->add_setting('cals-global_twitter_id', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'		 => '',
		'sanitize_callback' => 'sanitize_twitter_options'

	));


	$wp_customize->add_control('cals-global-twitter', array(
		'label'      => __('Twitter', 'cals-global'),
		'description'=> 'Enter your twitter username.',
		'section'    => 'cals-global-social-options',
		'type'    => 'text',
		'settings'   => 'cals-global_twitter_id',
	));


	/*** Flickr ***/
	$wp_customize->add_setting('cals-global_flickr_id', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'		 => '',
		'sanitize_callback' => 'sanitize_flickr_options'

	));


	$wp_customize->add_control('cals-global-flickr', array(
		'label'      => __('Flickr', 'cals-global'),
		'description'=> 'Enter your flickr URL.',
		'section'    => 'cals-global-social-options',
		'type'    => 'text',
		'settings'   => 'cals-global_flickr_id',
	));


	/*** Facebook ***/
	$wp_customize->add_setting('cals-global_facebook_id', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'		 => '',
		'sanitize_callback' => 'sanitize_facebook_options'

	));


	$wp_customize->add_control('cals-global-facebook', array(
		'label'      => __('Facebook', 'cals-global'),
		'description'=> 'Enter your facebook username.',
		'section'    => 'cals-global-social-options',
		'type'    => 'text',
		'settings'   => 'cals-global_facebook_id',
	));

	/*** LinkedIn ***/
	$wp_customize->add_setting('cals-global_linkedin_id', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'		 => '',
		'sanitize_callback' => 'sanitize_linkedin_options'

	));


	$wp_customize->add_control('cals-global-linkedin', array(
		'label'      => __('LinkedIn', 'cals-global'),
		'description'=> 'Enter your linkedin URL.',
		'section'    => 'cals-global-social-options',
		'type'    => 'text',
		'settings'   => 'cals-global_linkedin_id',
	));


	/*** Instagram ***/
	$wp_customize->add_setting('cals-global_instagram_id', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'		 => '',
		'sanitize_callback' => 'sanitize_instagram_options'

	));


	$wp_customize->add_control('cals-global-instagram', array(
		'label'      => __('Instagram', 'cals-global'),
		'description'=> 'Enter your instagram username.',
		'section'    => 'cals-global-social-options',
		'type'    => 'text',
		'settings'   => 'cals-global_instagram_id',
	));

	/*** Youtube ***/
	$wp_customize->add_setting('cals-global_youtube_id', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'		 => '',
		'sanitize_callback' => 'sanitize_youtube_options'

	));


	$wp_customize->add_control('cals-global-youtube', array(
		'label'      => __('Youtube', 'cals-global'),
		'description'=> 'Enter your youtube username.',
		'section'    => 'cals-global-social-options',
		'type'    => 'text',
		'settings'   => 'cals-global_youtube_id',
	));

	/*** Google Analytics ***/
	$wp_customize->add_section( 'cals-global-analytics' , array(
		'title'      => __( 'Analytics', 'cals-global' ),
		'priority'   => 71,
	) );

	$wp_customize->add_setting('uw-madison-wp-2015_ga_id', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'		 => '',
		'sanitize_callback' => 'sanitize_ga_options'

	));

	$wp_customize->add_control('uw-madison-wp-2015-ga', array(
		'label'      => __('Google Analytics', 'uw-madison-wp-2015'),
		'description'=> 'Enter your Tracking ID.',
		'section'    => 'cals-global-analytics',
		'type'    => 'text',
		'settings'   => 'uw-madison-wp-2015_ga_id',
	));
}

function sanitize_facebook_options( $value ) {
    if ( !$value )
        $value = '';

    return $value;
}

function sanitize_linkedin_options( $value ) {
    if ( !$value )
        $value = '';

    return $value;
}

function sanitize_youtube_options( $value ) {
    if ( !$value )
        $value = '';

    return $value;
}

function sanitize_twitter_options( $value ) {
    if ( !$value )
        $value = '';

    return $value;
}

function sanitize_instagram_options( $value ) {
    if ( !$value )
        $value = '';

    return $value;
}

function sanitize_flickr_options( $value ) {
    if ( !$value )
        $value = '';

    return $value;
}

function sanitize_ga_options( $value ) {
    if ( !$value )
        $value = '';

    return $value;
}

/**
 * 
 ******************* DISABLE DEFAULT COLOR PALETTES *****************************
 * gutenberg comes with a rainbow color palette that we don't want to hand out
 */

function gutenberg_disable_all_colors() {
	add_theme_support( 'editor-color-palette' );
	add_theme_support( 'disable-custom-colors' );
}
add_action( 'after_setup_theme', 'gutenberg_disable_all_colors' );


/**
 * 
 ******************* ALPHABETIZE COLLABORATORS ARCHIVE *****************************
 * Displays collaborators in alphabetical order by last name (ACF field last_name).
 * (WP default had collaborators displayed in descending date order.)
 */
function alpha_order_collaborators( $query ) {
    if ( $query->is_post_type_archive('collaborators') && $query->is_main_query() ) {
		$query->set('orderby', 'meta_value');
		$query->set('meta_key', 'last_name');	
        $query->set('order', 'ASC');
    }
}

add_action( 'pre_get_posts', 'alpha_order_collaborators' );