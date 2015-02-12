<?php
/**
 * This is child themes functions.php file. All modifications should be made in this file.
 *
 * All style changes should be in child themes style.css file.
 *
 * @package ErricLiveWire
 * @subpackage Functions
 */

/* Adds the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'live_wire_child_theme_setup', 11 );

/**
 * Setup function.  All child themes should run their setup within this function.  The idea is to add/remove 
 * filters and actions after the parent theme has been set up.  This function provides you that opportunity.
 *
 * @since 0.1.0
 */
function live_wire_child_theme_setup() {

	/* Get the theme prefix ("live-wire"). */
	$prefix = hybrid_get_prefix();

	/* Example action. */
	// add_action( "{$prefix}_header", 'live_wire_child_example_action' );

	/* Example filter. */
	// add_filter( "{$prefix}_site_title", 'live_wire_child_example_filter' );


}

/**
 * show only one sticky post in reguler loop query
 * http://wordpress.stackexchange.com/questions/74620/exclude-sticky-post-from-main-query
 * https://codex.wordpress.org/Class_Reference/WP_Query#Sticky_Post_Parameters
 */
function erric_filter_sticky_post( $query ) {

	if ( $query->is_home() && $query->is_main_query() ) {

		$sticky = get_option( 'sticky_posts' );

		if ( count($sticky) > 1 ) {
			rsort( $sticky );
			unset( $sticky[0] );
		} else {
			$sticky = NULL;
		}

		// $query->set( 'ignore_sticky_posts', true );
		$query->set( 'post__not_in', $sticky );

	}

}
add_action( 'pre_get_posts', 'erric_filter_sticky_post' );

/**
 * Show favicon
 */
function erric_favicon() {
	?>
	<link rel="shortcut icon" type="image/x-icon" href="http://erricgunawan.com/blog/wp-content/uploads/2012/01/favicon.png" />
<?php
}
add_action( 'wp_head', 'erric_favicon' );


/**
 * Load Google Fonts
 */
function erric_enqueue() {
	wp_enqueue_style( 'erric-fonts', 'http://fonts.googleapis.com/css?family=Istok+Web', array(), '1.0', 'all' );
	wp_enqueue_style( 'erric-fonts-1', 'http://fonts.googleapis.com/css?family=Ubuntu', array(), '1.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'erric_enqueue' );
