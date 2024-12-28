<?php
/**
 * Custom functions for 3cb24 theme
 *
 * @package 3cb24
 */

/**
 * Theme support elements.
 */
function threecb_theme_setup() {
	// Support Featured Images.
	add_theme_support( 'post-thumbnails' );
	// New way of registering page title.
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'threecb_theme_setup' );



/**
 * Add theme's CSS file.
 */
function threecb_css() {
	wp_enqueue_style( 'threecb-style', get_stylesheet_uri(), array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'threecb_css', 200 );



/**
 * Remove unwanted CSS files from plugins etc - find the handle in the plugin file and add here.
 */
function remove_unwanted_css() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'global-styles' );
	wp_deregister_style( 'classic-theme-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'tcb-roster' ); // Roster plugin styles are in main CSS file.
}
add_action( 'wp_enqueue_scripts', 'remove_unwanted_css', 100 );


/**
 * Disable theme editing.
 */
define( 'DISALLOW_FILE_EDIT', true );

/**
 * Remove admin bar.
 */
show_admin_bar(false);



/**
 * Remove emoji junk.
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 



/**
 * Remove jQuery migrate.
 *
 * @param array $scripts List of scripts loaded by WP.
 */
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );
function remove_jquery_migrate( &$scripts ) {
	if( !is_admin() )
	{
		$scripts->remove( 'jquery' );
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
	}
}



/**
 * Add button class to blog pagination links.
 */
add_filter( 'next_posts_link_attributes', 'posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'posts_link_attributes' );
function posts_link_attributes() {
	return 'class="btn"';
}



/**
 * Custom read more function.
 */
function custom_read_more() {
	return '... <a class="read-more" href="'.get_permalink(get_the_ID()).'">Read more</a>';
}

/**
 * Custom excerpt - use echo excerpt(25); to output in theme.
 *
 * @param integer $limit Length of excerpt passed from get_the template tag.
 */
function excerpt($limit) {
	return wp_trim_words(get_the_excerpt(), $limit, custom_read_more());
}



/**
 * Register Main Menu.
 */
function register_my_menu() {
	register_nav_menu( 'main-menu', __( 'Main Menu' ) );
}
add_action( 'init', 'register_my_menu' );



/**
 * Register sidebars.
 */
function sidebar_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', '3cb24' ),
			'id'            => 'blog-sidebar',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		),
	);
}
add_action( 'widgets_init', 'sidebar_widgets_init' );



/**
 * Load Scripts Properly.
 */
function my_scripts_method() {
	// Add toast.
	wp_register_script( 'toast-script', get_template_directory_uri() . '/js/toaster.js', array( 'jquery' ) );
	wp_enqueue_script( 'toast-script' );

	// Add fcs javascript.
	wp_register_script( 'fcs-script', get_template_directory_uri() . '/js/fcs.js', array( 'jquery' ) );
	wp_enqueue_script( 'fcs-script' );
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );





// Add ACF options page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page('Global Settings');
}



/**
 * Admin login page CSS.
 */
function my_login_stylesheet() {
	wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/style-login.css', 1.0, true );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );



/**
 * Custom admin CSS to remove plugin ads etc.
 */
function register_custom_admin_css() {
	wp_enqueue_style( 'custom_admin_css', get_template_directory_uri() . '/style-admin.css', array(), 1.0, true );
}
add_action( 'admin_head', 'register_custom_admin_css' );


/**
 * Move Yoast to bottom of edit screen.
 */
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom' );



/**
 * Callback function to insert styleselect into the buttons array.
 *
 * @param array $buttons List of buttons loaded by WP editor.
 */
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

/**
 * Set up additional styles for editor button
 *
 * @param array $settings List of settings loaded by WP editor.
 */
function tuts_mce_before_init( $settings ) {
	$style_formats                           = array(
		array(
			'title'    => __( 'Positive', '3cb24' ),
			'selector' => 'p',
			'classes'  => 'positive',
		),
		array(
			'title'    => __( 'Error', '3cb24' ),
			'selector' => 'p',
			'classes'  => 'negative',
		),
		array(
			'title'    => __( 'Warning', '3cb24' ),
			'selector' => 'p',
			'classes'  => 'warning',
		),
		array(
			'title'    => __( 'Smaller text', '3cb24' ),
			'selector' => 'p',
			'classes'  => 'has-small-font-size',
		),
		array(
			'title'    => __( 'Larger text', '3cb24' ),
			'selector' => 'p',
			'classes'  => 'has-large-font-size',
		),
		array(
			'title'    => __( 'Button', '3cb24' ),
			'selector' => 'a',
			'classes'  => 'btn',
		),
	);
	$settings['style_formats']               = wp_json_encode( $style_formats );
	$settings['theme_advanced_blockformats'] = 'p,h3,h4';
	$settings['theme_advanced_disable']      = 'forecolor';

	return $settings;
}
add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );

/**
 * Add editor fonts/styles.
 */
function my_theme_add_editor_styles() {
	add_editor_style( 'style-editor.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );


/**
 * Remove WPCF7 stylesheet - we use our own styles in main CSS.
 */
add_filter( 'wpcf7_load_css', '__return_false' );



/**
 * Stop WPCF7 adding P tags to forms.
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );
