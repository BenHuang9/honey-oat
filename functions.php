<?php
/**
 * Honey Oat functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Honey_Oat
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function honey_oat_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Honey Oat, use a find and replace
		* to change 'honey-oat' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'honey-oat', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header' => esc_html__( 'Header Menu Location', 'honey-oat' ),
			'footer' => esc_html__( 'Footer Menu Location', 'honey-oat' ),
			'social' => esc_html__( 'Social Menu Location', 'honey-oat')
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'honey_oat_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'honey_oat_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function honey_oat_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'honey_oat_content_width', 640 );
}
add_action( 'after_setup_theme', 'honey_oat_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function honey_oat_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'honey-oat' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'honey-oat' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'honey_oat_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function honey_oat_scripts() {
	wp_enqueue_style( 'honey-oat-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'font-google', "https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap", array(), null );

	wp_style_add_data( 'honey-oat-style', 'rtl', 'replace' );

		// Only Copy Line 5 and 6 and paste it to Enqueue scripts and styles part
		wp_enqueue_script( 'google-map', get_template_directory_uri() . '/js/googlemap.js', array('jquery', 'google-map-api'), _S_VERSION, true );
		wp_enqueue_script( 'google-map-api', "https://maps.googleapis.com/maps/api/js?key=AIzaSyC3k7R3Go8cg-9G9zi6WmT6pf0zYj7xfLs", array(), _S_VERSION, true );

	wp_enqueue_script( 'honey-oat-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (is_singular('product')) {
		wp_enqueue_script( 'honey-oat-preselect', get_template_directory_uri() . '/js/preselect.js', array(), _S_VERSION, true );
	}
	wp_enqueue_script( 'fwd-scroll-up', get_template_directory_uri() . '/js/scroll-up.js', array(), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'honey_oat_scripts' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/logo-black.png);
			height:150px;
			width:150px;
			background-size: 150px 150px;
			background-repeat: no-repeat;
        }
		body.login {
			background-color: #577768;
		}
		body.login form#loginform {
			background-color: #F0F0F1;
		}
		body.login div#login p#nav a,
		body.login div#login p#backtoblog a {
    		color: black;
		}
		body.login div#login p.submit input {
			background-color: black;
			color: white;
			border-radius: 0;
			border: 1.5px solid black;
		}
		body.login div#login p.submit input:hover {
			background-color: white;
			color: black;
			border: 1.5px solid black;
		}
		body.login div#login input {
			color: black;
			border: none;
			border-radius: 0;
		} 

    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

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
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Remove block editor
function ho_post_filter( $use_block_editor, $post ) {
    // Change 112 to your Page ID
    $page_ids = array( 11, 27, 44, 46 );
    if ( in_array( $post->ID, $page_ids ) ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'ho_post_filter', 10, 2 );

function my_acf_google_map_api( $api ) {

    $api['key'] = 'AIzaSyC3k7R3Go8cg-9G9zi6WmT6pf0zYj7xfLs';

    return $api;

}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/**
 * Remove a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function wporg_remove_all_dashboard_metaboxes() {
    // Remove Welcome panel
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
    // Remove the rest of the dashboard widgets
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}
add_action( 'wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes' );

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function wporg_add_dashboard_widgets() {
    // Add widgets
    wp_add_dashboard_widget(
        'welcome_message',                          
        'Welcome Message',                          
        'welcome_message_function'                 
    ); 

    // Add widget to the right side
	add_meta_box( 
        'tutorial_one', 
        esc_html__( 'Tutorial - Add Content', 'wporg' ), 
        'tutorial_one_function', 
        'dashboard', 
        'side', 'high'
    );

    add_meta_box( 
        'tutorial_two', 
        esc_html__( 'Tutorial - Add Simple Product', 'wporg' ), 
        'tutorial_two_function', 
        'dashboard', 
        'side', 'high'
    );

	add_meta_box( 
        'tutorial_three', 
        esc_html__( 'Tutorial - Add Variable Product', 'wporg' ), 
        'tutorial_three_function', 
        'dashboard', 
        'side', 'high'
    );
}
add_action( 'wp_dashboard_setup', 'wporg_add_dashboard_widgets' );

function tutorial_one_function() {
    echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/ghxndbN2zXM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

function tutorial_two_function() {
    echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/SRmWO9z2i6w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

function tutorial_three_function() {
    echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/lDeWlAqQ0WE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

function welcome_message_function() {
    ?>
	<h1 style="text-align:center">Honey Oat Dashboard</h1>
	<h2 style="text-align:center">Welcome user!</h2>
	<p>Please find essential information on how to use the configured WordPress site on the right.</p>
	<?php
}

// Remove admin menu links for non-Administrator accounts
function fwd_remove_admin_links() {
	if ( !current_user_can( 'manage_options' ) ) {
		remove_menu_page( 'edit.php' );           // Remove Posts link
    		remove_menu_page( 'edit-comments.php' );  // Remove Comments link
	}
}
add_action( 'admin_menu', 'fwd_remove_admin_links' );

/**
 * Lower Yoast SEO Metabox location
 */
function yoast_to_bottom(){
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom' );
