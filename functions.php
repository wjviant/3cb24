<?php


	

function threecb_theme_setup() {
	// Support Featured Images
	add_theme_support( 'post-thumbnails' ); 
	// New way of registering page title
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'threecb_theme_setup' );	



// Disable theme editing
define( 'DISALLOW_FILE_EDIT', true );


// Remove admin bar
show_admin_bar(false);



// Remove emoji stuff
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 



// Add ACF options page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page('Global Settings');
}



// Register Main Menu 
function register_my_menu() {
  register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'register_my_menu' );



// Register sidebars
function sidebar_widgets_init() {
	register_sidebar( array(
		'name' => 'Blog Sidebar',
		'id' => 'blog-sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
}
add_action( 'widgets_init', 'sidebar_widgets_init' );



// Remove CSS files - find the handle in the plugin file and add here
function remove_unwanted_css(){
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'global-styles' );
	wp_deregister_style( 'classic-theme-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action('wp_enqueue_scripts','remove_unwanted_css', 100);


// Custom read more function - use echo excerpt(25); to output in theme
function custom_read_more() {
    return '... <a class="read-more" href="'.get_permalink(get_the_ID()).'">Read more</a>';
}
function excerpt($limit) {
    return wp_trim_words(get_the_excerpt(), $limit, custom_read_more());
}


// Admin login page css
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );


// Custom admin CSS to remove plugin ads
function registerCustomAdminCss(){
	$src = "/wp-content/themes/intention/style-admin.css";
	$handle = "customAdminCss";
	wp_register_script($handle, $src);
	wp_enqueue_style($handle, $src, array(), false, false);
    }
add_action('admin_head', 'registerCustomAdminCss');


// Add button class to blog pagination links
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
function posts_link_attributes() {
    return 'class="btn"';
}





// remove jquery migrate
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );
function remove_jquery_migrate( &$scripts )
{
    if(!is_admin())
    {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
    }
}




// Move Yoast to bottom
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom' );







// Load Scripts Properly
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method() {
	// Add toast
	wp_register_script( 'toast-script', get_template_directory_uri() . '/js/toaster.js', array( 'jquery' ) );
	wp_enqueue_script( 'toast-script' );

	// Add fcs javascript
	wp_register_script( 'fcs-script', get_template_directory_uri() . '/js/fcs.js', array( 'jquery' ) );
	wp_enqueue_script( 'fcs-script' );
}



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
			'title'    => __( 'Positive', 'ARCHETYPE' ),
			'selector' => 'p',
			'classes'  => 'positive',
		),
		array(
			'title'    => __( 'Error', 'ARCHETYPE' ),
			'selector' => 'p',
			'classes'  => 'negative',
		),
		array(
			'title'    => __( 'Warning', 'ARCHETYPE' ),
			'selector' => 'p',
			'classes'  => 'warning',
		),
		array(
			'title'    => __( 'Smaller text', 'ARCHETYPE' ),
			'selector' => 'p',
			'classes'  => 'has-small-font-size',
		),
		array(
			'title'    => __( 'Larger text', 'ARCHETYPE' ),
			'selector' => 'p',
			'classes'  => 'has-large-font-size',
		),
		array(
			'title'    => __( 'Button', 'ARCHETYPE' ),
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



// Remove WPCF7 stylesheet
add_filter( 'wpcf7_load_css', '__return_false' );



// Stop WPCF7 adding P tags to forms
add_filter('wpcf7_autop_or_not', '__return_false');



