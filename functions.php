<?php

/**
 * Functions
 *
 * Core functionality and initial theme setup
 *
 */

function wpds_theme_setup() {

	// Language Translations
	load_theme_textdomain( 'wpds', get_template_directory() . '/languages' );
	load_theme_textdomain( 'tgmpa', get_template_directory() . '/languages' );

	// Custom Editor Style Support
	add_editor_style();

	// Support for Featured Images
	add_theme_support( 'post-thumbnails' );

	// Automatic Feed Links & Post Formats
	add_theme_support( 'automatic-feed-links' );

	// Load post details extension
	locate_template( array( 'inc/post-details.php' ), true, true );

}
add_action( 'after_setup_theme', 'wpds_theme_setup' );



//***********************
//
// SIMPLIFY UI
//
//***********************

	add_action('admin_menu', 'my_remove_menu_pages');
	if (!current_user_can('manage_options')) {
		add_action( 'admin_menu', 'my_remove_menu_pages' );
	}
function my_remove_menu_pages() {
	//remove_menu_page( 'edit.php' ); // Posts
	//remove_menu_page( 'upload.php' ); // Media
	remove_menu_page( 'link-manager.php' ); // Links
	remove_menu_page( 'edit-comments.php' ); // Comments
	remove_menu_page( 'edit.php?post_type=page' ); // Pages
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');

	//remove_menu_page( 'plugins.php' ); // Plugins
	//remove_menu_page( 'themes.php' ); // Appearance
	//remove_menu_page( 'users.php' ); // Users
	remove_menu_page( 'tools.php' ); // Tools
	//remove_menu_page( 'profile.php' ); // Tools
	//remove_menu_page('options-general.php'); // Settings

	//remove_submenu_page ( 'index.php', 'update-core.php' );    //Dashboard->Updates
	//remove_submenu_page ( 'themes.php', 'themes.php' ); // Appearance-->Themes
	//remove_submenu_page ( 'themes.php', 'widgets.php' ); // Appearance-->Widgets
	remove_submenu_page ( 'themes.php', 'nav-menus.php' ); // Appearance-->Menus
	//remove_submenu_page ( 'themes.php', 'theme-editor.php' ); // Appearance-->Editor
	//remove_submenu_page ( 'options-general.php', 'options-general.php' ); // Settings->General
	//remove_submenu_page ( 'options-general.php', 'options-writing.php' ); // Settings->writing
	//remove_submenu_page ( 'options-general.php', 'options-reading.php' ); // Settings->Reading
	//remove_submenu_page ( 'options-general.php', 'options-discussion.php' ); // Settings->Discussion
	//remove_submenu_page ( 'options-general.php', 'options-media.php' ); // Settings->Media
	//remove_submenu_page ( 'options-general.php', 'options-privacy.php' ); // Settings->Privacy
	}


//***********************
//
// CUSTOMIZE UI
//
//***********************
	// remove some metaboxes
	function remove_post_custom_fields() {
		remove_meta_box('postexcerpt', 'post', 'normal'); // removes excerpt metabox
		remove_meta_box('trackbacksdiv', 'post', 'normal'); // removes trackbacks metabox
		remove_meta_box('commentstatusdiv', 'post', 'normal'); // removes discussion metabox
		remove_meta_box('postcustom', 'post', 'normal'); // removes custom metaboxes (other than defined here)
		remove_meta_box('commentsdiv', 'post', 'normal'); // removes comments metabox
		//remove_meta_box('revisionsdiv', 'post', 'normal'); // removes revision metabox
		remove_meta_box('authordiv', 'post', 'normal'); // removes author metabox
		remove_meta_box('sqpt-meta-tags', 'post', 'normal'); // removes  metabox
		remove_meta_box('categorydiv', 'post', 'normal'); // removes categories metabox
		remove_meta_box('slugdiv', 'post', 'normal'); // removes slugs metabox
		remove_meta_box('formatdiv', 'post', 'normal'); // removes formats metabox
		remove_meta_box('tagsdiv-post_tag', 'post', 'normal'); // removes tags metabox
		remove_meta_box('pageparentdiv', 'post', 'normal'); // removes attributes metabox
	}
	add_action( 'admin_menu' , 'remove_post_custom_fields' );


	// remove some customization options for admins
	if (current_user_can('manage_options')) {
		add_action( 'admin_menu', 'admin_remove_menu_pages' );
	}
	function admin_remove_menu_pages() {
	//
	//remove_menu_page( 'edit.php' ); // Posts
	//remove_menu_page( 'upload.php' ); // Media
	remove_menu_page( 'link-manager.php' ); // Links
	remove_menu_page( 'edit-comments.php' ); // Comments
	//remove_menu_page( 'edit.php?post_type=page' ); // Pages
	//remove_menu_page( 'plugins.php' ); // Plugins
	//remove_menu_page( 'themes.php' ); // Appearance
	//remove_menu_page( 'users.php' ); // Users
	//remove_menu_page( 'tools.php' ); // Tools
	//remove_menu_page('options-general.php'); // Settings
	}



	// disable default dashboard widgets
	function disable_default_dashboard_widgets() {

		remove_meta_box('dashboard_right_now', 'dashboard', 'core');
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
		remove_meta_box('dashboard_plugins', 'dashboard', 'core');

		remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
		remove_meta_box('dashboard_primary', 'dashboard', 'core');
		remove_meta_box('dashboard_secondary', 'dashboard', 'core');
	}
	add_action('admin_menu', 'disable_default_dashboard_widgets');

	// create custom dashboard widget
	/*
	function custom_dashboard_widget() {
			echo "<p>Please keep the title to no more than 22 characters.</p>",
				"<p>Please keep the body copy to no more than 27-30 words.</p>",
				"<p>If using a background image, a 16:9 ratio will do best to fill the screen (for example, 1920px wide x 1080px high). Remember that the information dock will cover approximately 200px of the bottom of the image.";
	}
	function add_custom_dashboard_widget() {
		wp_add_dashboard_widget('custom_dashboard_widget', 'Content Guidelines', 'custom_dashboard_widget');
	}
	add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');
	*/


//***********************
//
// CUSTOMIZE WYSIWYG
//
//***********************
	if( !function_exists('base_extended_editor_mce_buttons') ){
		function base_extended_editor_mce_buttons($buttons) {
			// The settings are returned in this array. Customize to suite your needs.
			return array(
				'bold', 'italic', 'charmap', 'removeformat'
			);
			/* WordPress Default
			return array(
				'bold', 'italic', 'strikethrough', 'separator',
				'bullist', 'numlist', 'blockquote', 'separator',
				'justifyleft', 'justifycenter', 'justifyright', 'separator',
				'link', 'unlink', 'wp_more', 'separator',
				'spellchecker', 'fullscreen', 'wp_adv'
			); */
		}
		add_filter("mce_buttons", "base_extended_editor_mce_buttons", 0);
	}


	// hide slugs
	function hide_all_slugs() {
	global $post;
	$hide_slugs = "<style type=\"text/css\"> #slugdiv, #edit-slug-box { display: none; }</style>";
	print($hide_slugs);
	}
	add_action( 'admin_head', 'hide_all_slugs'  );


	// customize backend footer
	function remove_footer_admin ($text) {
		return $text . ' &#x272D;&nbsp; ' . sprintf(__('Developed by <a href="%s" target="_blank">%s</a> based on work by <a href="%s" target="_blank">%s</a>.', 'wpds'), 'https://nicu.ch', 'Nicolas Perrenoud', 'http://pixelydo.com/', 'Nate Jones');
	}
	add_filter('admin_footer_text', 'remove_footer_admin');


//***********************
//
// REMOVE SOME WIDGETS
//
//***********************

function wpds_remove_some_wp_widgets () {
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
}

add_action('widgets_init','wpds_remove_some_wp_widgets', 1);



//***********************
//
// COUNT THE WIDGETS
//
//***********************

function count_sidebar_widgets( $sidebar_id) {
    $the_sidebars = wp_get_sidebars_widgets();
    if( !isset( $the_sidebars[$sidebar_id] ) )
        return __( 'Invalid sidebar ID', 'wpds' );
    if( $echo )
        echo count( $the_sidebars[$sidebar_id] );
    else
        return count( $the_sidebars[$sidebar_id] );
}

function get_grid_number_from_widgets( $sidebar_id ) {
	if (count_sidebar_widgets( $sidebar_id ) > 0){
		return (int) (12 / count_sidebar_widgets( $sidebar_id ));
	}
	else {
		return 12;
	}
}


//***********************
//
// CREATE DOCK WIDGET AREA
//
//***********************
function wpds_widgets_init() {
	$widget_count = get_grid_number_from_widgets( 'dock' );
	register_sidebar(array(
		'id' => 'dock',
		'name'=> __('Dock', 'wpds'),
		'description' => __('Widget area at the bottom of the page.', 'wpds'),
		'before_widget' => '<div class="col-md-' . $widget_count . ' col-sm-' . $widget_count . ' col-xs-' . $widget_count . '  vertical-align"><div>',
		'after_widget' => '</div></div>'."\n",
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}
add_action( 'widgets_init', 'wpds_widgets_init' );


//***********************
//
// CUSTOM LOGIN LOGO
//
//***********************

function wpds_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_url').'/login_page_logo.png) !important; }
    </style>';
}
add_action('login_head', 'wpds_custom_login_logo');


// Disable the Admin Bar.
add_filter( 'show_admin_bar', '__return_false' );

function wpds_remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('new-content');
	$wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'wpds_remove_admin_bar_links' );


//***********************
//
// REQUIRE PLUGINS
//
//***********************

require_once dirname( __FILE__ ) . '/lib/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'wpds_register_required_plugins' );
function wpds_register_required_plugins() {

    $plugins = array(

        array(
            'name'               => 'WPDS Clock Widget', // The plugin name.
            'slug'               => 'wpds-clock', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/lib/wpds-clock.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'               => 'WPDS Weather Widget', // The plugin name.
            'slug'               => 'wpds-weather', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/lib/wpds-weather.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'               => 'WPDS Image Widget', // The plugin name.
            'slug'               => 'wpds-image', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/lib/wpds-image.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'      => 'Post Expirator',
            'slug'      => 'post-expirator',
            'required'  => false,
        ),
    );

    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

//***********************
//
// Customizer
//
//***********************

function wpds_theme_customizer( $wp_customize ) {

	require_once( dirname( __FILE__ ) . '/admin/customizer/alpha-color-picker/alpha-color-picker.php' );

	// Remove existing non-required stuff
	$wp_customize->remove_control('blogdescription');
	$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_panel('nav_menus');

	//
	// Slider (Digital Signage) section
	//
	$wp_customize->add_section( 'signage', array(
        	'title' => __('Slider', 'wpds'),
	) );

	// Timer speed
	$wp_customize->add_setting( 'signage[timer_speed]', array(
	    	'default' => '3000',
	) );
	$wp_customize->add_control( 'signage[timer_speed]', array(
    		'label' => __('Timer speed (ms)', 'wpds'),
		'section' => 'signage',
		'type' => 'number',
	) );
	
	// Animation speed
	$wp_customize->add_setting( 'signage[animation_speed]', array(
	    	'default' => '300',
	) );
	$wp_customize->add_control( 'signage[animation_speed]', array(
    		'label' => __('Animation speed (ms)', 'wpds'),
		'section' => 'signage',
		'type' => 'number',
	) );

	// Page reload interval
	$wp_customize->add_setting( 'signage[reload_interval]', array(
	    	'default' => '5',
	) );
	$wp_customize->add_control( 'signage[reload_interval]', array(
    		'label' => __('Reload interval (min)', 'wpds'),
		'section' => 'signage',
		'type' => 'number',
	) );

	//
	// Layout section
	//
	$wp_customize->add_section( 'layout', array(
        	'title' => __('Layout', 'wpds'),
	) );
	
	// Show dock
	$wp_customize->add_setting( 'layout[show-dock]', array(
    		'default' => true,
	) );
	$wp_customize->add_control( 'layout[show-dock]', array(
		'label'   => __('Show dock', 'wpds'),
		'section' => 'layout',
		'type' => 'checkbox',
	) );
	
	// Dock height
	/*
	$wp_customize->add_setting( 'layout[dock-height]', array(
    		'default' => 200,
	) );
	$wp_customize->add_control( 'layout[dock-height]', array(
		'label'   => __('Dock height', 'wpds'),
		'section' => 'layout',
		'type' => 'number',
	) );
	*/

	//
	// Colors section
	//
	$wp_customize->add_section( 'colors', array(
        	'title' => __('Colors', 'wpds'),
	) );

	// Background color
	$wp_customize->add_setting( 'colors[background-color]', array(
    		'default' => '#ffffff',
		'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		'sanitize_js_callback' => 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colors[background-color]', array(
		'label'   => __('Background Color', 'wpds'),
		'section' => 'colors',
	) ) );

	// Headline color
	$wp_customize->add_setting( 'colors[headline-color]', array(
    		'default' => '#000000',
		'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		'sanitize_js_callback' => 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colors[headline-color]', array(
		'label'   => __('Headline Color', 'wpds'),
		'section' => 'colors',
	) ) );

	// Subhead color
	$wp_customize->add_setting( 'colors[subhead-color]', array(
    		'default' => '#000000',
		'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		'sanitize_js_callback' => 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colors[subhead-color]', array(
		'label'   => __('Sub-headline Color', 'wpds'),
		'section' => 'colors',
	) ) );

	// Copy color
	$wp_customize->add_setting( 'colors[copy-color]', array(
    		'default' => '#000000',
		'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		'sanitize_js_callback' => 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colors[copy-color]', array(
		'label'   => __('Copy Color', 'wpds'),
		'section' => 'colors',
	) ) );

	// Dock background color
	$wp_customize->add_setting( 'colors[dock-background-color]', array(
		'default' => 'rgba(79, 75, 75, 0.43)',
	) );
	$wp_customize->add_control( new Customize_Alpha_Color_Control( $wp_customize, 'colors[dock-background-color]', array(
		'label'   => __('Dock Background Color', 'wpds'),
		'section' => 'colors',
	) ) );

	// Dock foreground color
	$wp_customize->add_setting( 'colors[dock-foreground-color]', array(
    		'default' => '#ffffff',
		'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		'sanitize_js_callback' => 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colors[dock-foreground-color]', array(
		'label'   => __('Dock Foreground Color', 'wpds'),
		'section' => 'colors',
	) ) );

}
add_action( 'customize_register', 'wpds_theme_customizer', 11 );

/**
* Load style
*/
function wpds_theme_enqueue_styles() {
    wp_enqueue_style( 'wpds-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpds_theme_enqueue_styles' );

/**
* Load scripts
*/
function wpds_load_scripts() {
	wp_register_style( 'slick-css', get_template_directory_uri() . '/slick/slick.css' );
	wp_enqueue_style( 'slick-css' );

	wp_register_script( 'modernizr', get_template_directory_uri() . '/javascripts/vendor/custom.modernizr.js' );
	wp_enqueue_script( 'modernizr' );
	
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/javascripts/vendor/bootstrap.min.js' );
	wp_enqueue_script( 'bootstrap', false, array('jquery'), false, true );

	wp_register_script( 'slick-js', get_template_directory_uri() . '/slick/slick.min.js' );
	wp_enqueue_script( 'slick-js', false, array('jquery'), false, true );

	wp_register_script( 'app-js', get_template_directory_uri() . '/javascripts/app.js' );
	wp_enqueue_script( 'app-js', false, array('jquery'), false, true );
}
add_action( 'wp_enqueue_scripts', 'wpds_load_scripts' );

//***********************
//
// Theme helper functions
//
//***********************

/**
* Get a color option, either from post meta data or from theme options
*/
function get_color_option($post_id, $key) {
	$colors = get_theme_mod( 'colors', [] );
	$page_color = get_post_meta($post_id, $key, true);
	if (!empty($page_color)) {
		return $page_color;
	}
	if (!empty($colors[$key])) {
		return $colors[$key];
	}
	return '';
}

function print_style($args) {
	if (count($args) > 0) {
		$style = [];
		foreach ($args as $k => $v) {
			$style[] = $k . ':' . $v;
		}
		return ' style="' . implode(';', $style) . '"';
	}
	return '';
}

?>
