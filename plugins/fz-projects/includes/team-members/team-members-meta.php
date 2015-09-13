<?php
/**
 * Meta Functions for the Team Members component.
 */

namespace FZ_Projects\Team_Members;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueues the FZ Project meta styles.
 */
function enqueue_team_member_styles() {
	$screen = get_current_screen();

	if ( get_team_members_post_type_name() !== $screen->post_type ) {
		return;
	}

	if ( 'post' !== $screen->base ) {
		return;
	}

	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '.min' : '';

	wp_enqueue_style(
		'fz-project-meta',
		FZP_URL . "/assets/css/fz-project-meta{$min}.css",
		array(),
		FZP_VERSION
	);
}

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_team_member_styles' );

/**
 * Returns the Team Member Title meta key.
 *
 * @return string The Team Member Title meta key.
 */
function get_team_member_title_meta_key() {
	return 'fz_team_member_title';
}

/**
 * Returns the Team Member Twitter meta key.
 *
 * @return string The Team Member Twitter meta key.
 */
function get_team_member_twitter_meta_key() {
	return 'fz_team_member_twitter';
}

/**
 * Registers the team member meta with their sanitization functions
 */
function register_team_member_meta() {
	register_meta( 'post', get_team_member_title_meta_key(),   'sanitize_text_field', '__return_true' );
	register_meta( 'post', get_team_member_twitter_meta_key(), 'sanitize_text_field', '__return_true' );
}

add_action( 'fzp_init', __NAMESPACE__ . '\register_team_member_meta' );

/**
 * Adds the resource meta boxes.
 */
function add_team_member_meta_boxes() {
	if ( ! is_admin() ) {
		return;
	}

	add_meta_box(
		'fz_team_member_meta_box',
		esc_html__( 'Team Member Profile Info', 'fzp' ),
		__NAMESPACE__ . '\display_team_member_meta_box',
		get_team_members_post_type_name(),
		'normal',
		'default'
	);
}

add_action( 'add_meta_boxes', __NAMESPACE__ . '\add_team_member_meta_boxes' );

/**
 * Displays the Team Members Profile Info Meta Box.
 *
 * @param \WP_Post $post The post currently being edited.
 */
function display_team_member_meta_box( $post ) {
	wp_nonce_field( 'fz_team_member_meta', 'fz_team_member_nonce' );

	display_text_meta_field( get_team_member_title_meta_key(), __( 'Job Title', 'fzp' ), $post->ID );

	display_text_meta_field( get_team_member_twitter_meta_key(), __( 'Twitter Handle', 'fzp' ), $post->ID );
}

/**
 * Generic function for displaying a text meta field.
 *
 * @param string $meta_key   The meta key.
 * @param string $meta_label The Label for the meta field.
 * @param int    $post_id    The current post id.
 */
function display_text_meta_field( $meta_key, $meta_label, $post_id ) {
	if ( empty( $meta_key ) || empty( $meta_label ) || empty( $post_id ) ) {
		return;
	}

	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( empty( $meta_value ) ) {
		$meta_value = '';
	}

	printf(
		'<div class="fz-meta-field"><label for="%1$s_id">%2$s</label><input type="text" class="regular-text" id="%1$s_id" name="%1$s" value="%3$s" /></div>',
		esc_attr( $meta_key ),
		esc_html( $meta_label ),
		esc_attr( $meta_value )
	);
}

/**
 * Save the Team Member Meta Fields
 *
 * @param int $post_id The ID of the post we're saving meta for.
 */
function save_team_member_meta( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( get_team_members_post_type_name() !== get_post_type( $post_id ) ) {
		return;
	}

	if ( ! isset( $_POST['fz_team_member_nonce' ] ) || ! wp_verify_nonce( $_POST['fz_team_member_nonce'], 'fz_team_member_meta' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$title_key = get_team_member_title_meta_key();

	if ( ! empty( $_POST[ $title_key ] ) ) {
		update_post_meta( $post_id, $title_key, $_POST[ $title_key ] );
	} else {
		delete_post_meta( $post_id, $title_key );
	}

	$twitter_key = get_team_member_twitter_meta_key();

	if ( ! empty( $_POST[ $twitter_key ] ) ) {
		update_post_meta( $post_id, $twitter_key, $_POST[ $twitter_key ] );
	} else {
		delete_post_meta( $post_id, $twitter_key );
	}
}

add_action( 'save_post', __NAMESPACE__ . '\save_team_member_meta' );
