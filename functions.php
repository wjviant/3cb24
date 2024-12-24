<?php
	
// New way of registering page title
function seopress_theme_slug_setup() {
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'seopress_theme_slug_setup' );	
		




	



// Add ACF options page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page('Global Settings');
}



// Remove default widgets
function sort_dashboard_widgets() {
    // Global the $wp_meta_boxes variable (this will allow us to alter the array)
    global $wp_meta_boxes;

    // Then unset everything in the array
    unset($wp_meta_boxes['dashboard']['normal']['core']);
    unset($wp_meta_boxes['dashboard']['side']['core']);
}

//add_action('wp_dashboard_setup', 'sort_dashboard_widgets');


// Add new widgets
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Learn WordPress', 'custom_dashboard_help');
}

function custom_dashboard_help() {
echo '<p><a href="https://www.wp101.com/?ref=259" title="Easy WordPress tutorial videos for beginners." target="_blank"><img src="/wp-content/themes/intention/images/wp101-1.png" alt="Easy WordPress tutorial videos for beginners." /></a></p>
<a href="https://www.easywpguide.com" title="Easy WordPress guide PDF for beginners." target="_blank"><img src="/wp-content/themes/intention/images/easywpguide-1.png" alt="Easy WordPress guide PDF for beginners." /></a>';
}


// Remove admin bar
show_admin_bar(false);





// Remove CSS files - find the handle in the plugin file and add here
function remove_unwanted_css(){
	wp_dequeue_style('page-list-style');
	wp_dequeue_style('bfa-font-awesome');
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


// Remove emoji stuff
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 


// remove jquery migrate
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );
function remove_jquery_migrate( &$scripts)
{
    if(!is_admin())
    {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
    }
}

// Disable theme editing
define( 'DISALLOW_FILE_EDIT', true );


// Move Yoast to bottom
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


// Register Main Menu 
function register_my_menu() {
  register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'register_my_menu' );


// Add menu parent item classes
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item'; 
		}
	}
	return $items;    
}


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
	register_sidebar( array(
		'name' => 'Header cart',
		'id' => 'header-cart',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	register_sidebar( array(
		'name' => 'Shop sidebar',
		'id' => 'shop-sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
}
add_action( 'widgets_init', 'sidebar_widgets_init' );


// Support Featured Images
add_theme_support( 'post-thumbnails' ); 


// Load Scripts Properly
function my_scripts_method() {
	
	// Add match height script
	wp_register_script('match-script', get_template_directory_uri() . '/js/jquery.matchHeight.min.js', array('jquery'));
	wp_enqueue_script('match-script');
	
	// Add toast
	wp_register_script('toast-script', get_template_directory_uri() . '/js/toaster.js', array('jquery'));
	wp_enqueue_script('toast-script');
	
	// Add fcs javascript
	wp_register_script('fcs-script', get_template_directory_uri() . '/js/fcs.js', array('jquery'));
	wp_enqueue_script('fcs-script');
	
	// Add combined js file with all of the above
	//wp_register_script('combine-script', get_template_directory_uri() . '/js/combined.min.js', array('jquery'));
	//wp_enqueue_script('combine-script');
		
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );


// Change admin footer text
add_filter('admin_footer_text', 'remove_footer_admin'); //change admin footer text
function remove_footer_admin () {
	echo "Need some help? Please open a ticket at the <a href=\"http://www.fcswebsites.co.uk/client/index.php\">FCS support portal</a>";
} 


// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}


// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
function tuts_mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => 'Positive',
            'selector' => 'p',
            'classes' => 'positive',
        ),
        array(
            'title' => 'Error',
            'selector' => 'p',
            'classes' => 'negative',
        ),
        array(
            'title' => 'Warning',
            'selector' => 'p',
            'classes' => 'warning',
        ),
        array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'btn',
        )
    );
    $settings['style_formats'] = json_encode( $style_formats );
    
    $settings['theme_advanced_blockformats'] = 'p,h3,h4';
    $settings['theme_advanced_disable'] = 'forecolor';
    
    return $settings;
}


// Add editor fonts/styles
function my_theme_add_editor_styles() {
    add_editor_style( 'style-editor.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );


// Remove WPCF7 stylesheet
add_filter( 'wpcf7_load_css', '__return_false' );

// Stop WPCF7 adding P tags to forms
add_filter('wpcf7_autop_or_not', '__return_false');

// Move JavaScript from the Head to the Footer
 
function remove_head_scripts() { 
   remove_action('wp_head', 'wp_print_scripts'); 
   remove_action('wp_head', 'wp_print_head_scripts', 9); 
   remove_action('wp_head', 'wp_enqueue_scripts', 1);
   add_action('wp_footer', 'wp_print_scripts', 5);
   add_action('wp_footer', 'wp_enqueue_scripts', 5);
   add_action('wp_footer', 'wp_print_head_scripts', 5); 
} 
//add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );
 
// END Move JavaScript
