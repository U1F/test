<?php
/**
 * Plugin Name: My Plugin
 * Plugin URI: https://www.yourwebsite.com/test-plugin
 * Description: This is a brief description of my plugin
 * Version: 1.0
 * Author: Ulf Dellbrügge
 * Author URI: https://www.yourwebsite.com
 * License: GPL2
 *
 * @package Test
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 * Enqueue the minified script
 *
 * @return void
 */
function my_plugin_enqueue_scripts() {
	wp_enqueue_script( 'wp-element' );
	$asset_file = include plugin_dir_path( __FILE__ ) . 'build/hello.asset.php';
	wp_enqueue_script(
		'testing_esnext',
		plugins_url( 'build/hello.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version'],
		true
	);
}
add_action( 'admin_enqueue_scripts', 'my_plugin_enqueue_scripts' );


/**
 * Handle menu entries
 *
 * @return void
 */
function my_plugin_menu() {
	add_menu_page(
		'Test',
		'Test',
		'manage_options',
		'test-plugin',
		'my_plugin_options_page_html',
		'dashicons-admin-generic',
		20
	);
}
add_action( 'admin_menu', 'my_plugin_menu' );

/**
 * Callback for the root admin menu
 *
 * @return void
 */
function my_plugin_options_page_html() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<div id="test-plugin-root"></div>
	</div>
	<?php
}
