<?php
/**
 * Plugin Name: Woo Test Helper
 * Plugin URI: https://github.com/nielslange/woo-test-helper
 * Description: A helper plugin to control settings within Woo e2e tests.
 * Version: 0.0.1
 * Author: Automattic
 * Author URI: https://automattic.com
 * Text Domain: woo-test-helper
 * Requires at least: 5.9
 * Requires PHP: 7.3
 * WC requires at least: 6.0
 * WC tested up to: 6.1
 *
 * @category   Plugin
 * @package    WordPress
 * @subpackage Woo Test Helper
 */

defined( 'ABSPATH' ) || exit;

/**
 * Set up T&C and Privacy Policy pages.
 */
function woocommerce_setup_terms_and_privacy_page() {
	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['setup_terms_and_privacy'] ) ) {
		publish_privacy_page();
		publish_terms_page();
		exit( 'Terms & Privacy pages set up.' );
	}
}
add_action( 'init', 'woocommerce_setup_terms_and_privacy_page' );

/**
 * Tear down T&C and Privacy Policy pages.
 */
function woocommerce_teardown_terms_and_privacy_page() {
	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['teardown_terms_and_privacy'] ) ) {
		unpublish_privacy_page();
		delete_terms_page();
		exit( 'Terms & Privacy pages teared down.' );
	}
}
add_action( 'init', 'woocommerce_teardown_terms_and_privacy_page' );

/**
 * Publish Privacy Policy page.
 */
function publish_privacy_page() {
	global $wpdb;

	$table = $wpdb->prefix . 'posts';
	$data  = array( 'post_status' => 'publish' );
	$where = array(
		'post_title'  => 'Privacy Policy',
		'post_status' => 'draft',
	);
	$wpdb->update( $table, $data, $where );
}

/**
 * Publish and set Terms & Conditions page.
 */
function publish_terms_page() {
	global $wpdb;

	$table = $wpdb->prefix . 'posts';
	$data  = array(
		'post_title'  => 'Terms & Conditions',
		'post_status' => 'publish',
		'post_type'   => 'page',
		'post_author' => 1,
	);
	$wpdb->replace( $table, $data );
	update_option( 'woocommerce_terms_page_id', $wpdb->insert_id );
}

/**
 * Unpublish Privacy Policy page.
 */
function unpublish_privacy_page() {
	global $wpdb;

	$table = $wpdb->prefix . 'posts';
	$data  = array( 'post_status' => 'draft' );
	$where = array(
		'post_title'  => 'Privacy Policy',
		'post_status' => 'publish',
	);
	$wpdb->update( $table, $data, $where );
}

/**
 * Delete Terms & Conditions page.
 */
function delete_terms_page() {
	global $wpdb;

	$table = $wpdb->prefix . 'posts';
	$data  = array( 'post_title' => 'Terms & Conditions' );
	$wpdb->delete( $table, $data );
}

