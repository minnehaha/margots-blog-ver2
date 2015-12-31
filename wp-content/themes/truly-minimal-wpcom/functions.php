<?php
/**
 * Truly-Minimal functions and definitions
 *
 * @package Truly_Minimal
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 630; /* pixels */

function truly_minimal_content_width() {
	global $content_width;

	$sidebar = get_theme_mod( 'truly_minimal_sidebar', 'right' );

	if ( 'none' == $sidebar || is_page_template( 'nosidebar-page.php' ) )
		$content_width = 955;
	else
		$content_width = 630;
}
add_action( 'template_redirect', 'truly_minimal_content_width' );

if ( ! function_exists( 'truly_minimal_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function truly_minimal_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Truly-Minimal, use a find and replace
	 * to change 'truly_minimal' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'truly_minimal', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'truly_minimal' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // truly_minimal_setup
add_action( 'after_setup_theme', 'truly_minimal_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Hooks into the after_setup_theme action.
 */
function truly_minimal_register_custom_background() {
	add_theme_support( 'custom-background', apply_filters( 'truly_minimal_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
add_action( 'after_setup_theme', 'truly_minimal_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function truly_minimal_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'truly_minimal' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'truly_minimal_widgets_init' );

/**
 * Register Google Fonts
 */
function truly_minimal_google_fonts() {

	$protocol = is_ssl() ? 'https' : 'http';

	/*	translators: If there are characters in your language that are not supported
		by Droid Serif, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Droid Serif font: on or off', 'truly-minimal' ) ) {

		wp_register_style( 'truly-minimal-droid-serif', "$protocol://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" );

	}

	/*	translators: If there are characters in your language that are not supported
		by Droid Sans, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Droid Sans font: on or off', 'truly-minimal' ) ) {

		wp_register_style( 'truly-minimal-droid-sans', "$protocol://fonts.googleapis.com/css?family=Droid+Sans:400,700" );

	}

}
add_action( 'init', 'truly_minimal_google_fonts' );

/**
 * Enqueue scripts and styles
 */
function truly_minimal_scripts() {
	wp_enqueue_style( 'truly-minimal-style', get_stylesheet_uri() );

	wp_enqueue_style( 'truly-minimal-droid-serif' );
	wp_enqueue_style( 'truly-minimal-droid-sans' );

	wp_enqueue_script( 'truly-minimal-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'truly-minimal-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'truly-minimal-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	/* Change table border color to match custom background color if set */
	$backgroundcolor = get_theme_mod( 'background_color', 'ffffff' );

	if ( 'ffffff' != $backgroundcolor ) { ?>
		<style type="text/css">
			#wp-calendar td {
				border-color: #<?php echo $backgroundcolor; ?> !important;
			}
		</style>
	<?php }
}
add_action( 'wp_enqueue_scripts', 'truly_minimal_scripts' );


/**
 * Enqueue Google Fonts for custom headers
 */
function truly_minimal_admin_scripts( $hook_suffix ) {

	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'truly-minimal-droid-serif' );
	wp_enqueue_style( 'truly-minimal-droid-sans' );

}
add_action( 'admin_enqueue_scripts', 'truly_minimal_admin_scripts' );

/**
 * Load Jetpack compatibility file.
 */
if ( file_exists( get_template_directory() . '/inc/jetpack.php' ) )
	require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


// updater for WordPress.com themes
if ( is_admin() )
	include dirname( __FILE__ ) . '/inc/updater.php';
