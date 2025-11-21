<?php
/**
 * Basic WordPress Theme functions and definitions
 *
 * @package Basic_WordPress_Theme
 */

if ( ! function_exists( 'basic_wp_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function basic_wp_theme_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register navigation menus.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'basic-wordpress-theme' ),
				'footer'  => esc_html__( 'Footer Menu', 'basic-wordpress-theme' ),
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'basic_wp_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function basic_wp_theme_scripts() {
	wp_enqueue_style( 'basic-wp-theme-style', get_stylesheet_uri(), array(), '1.0.0' );
    
    // Enqueue main.css
    wp_enqueue_style( 'basic-wp-theme-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0' );

	wp_enqueue_script( 'basic-wp-theme-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'basic_wp_theme_scripts' );

/**
 * Register widget area.
 */
function basic_wp_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'basic-wordpress-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'basic-wordpress-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'basic_wp_theme_widgets_init' );