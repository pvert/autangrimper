<?php

function atgp_member_init() {
	register_post_type( 'atgp-member', array(
		'labels'                => array(
			'name'                  => __( 'membres', 'atgp' ),
			'singular_name'         => __( 'membre', 'atgp' ),
			'all_items'             => __( 'All membres', 'atgp' ),
			'archives'              => __( 'membre Archives', 'atgp' ),
			'attributes'            => __( 'membre Attributes', 'atgp' ),
			'insert_into_item'      => __( 'Insert into membre', 'atgp' ),
			'uploaded_to_this_item' => __( 'Uploaded to this membre', 'atgp' ),
			'featured_image'        => _x( 'Featured Image', 'sedoo-membre', 'atgp' ),
			'set_featured_image'    => _x( 'Set featured image', 'sedoo-membre', 'atgp' ),
			'remove_featured_image' => _x( 'Remove featured image', 'sedoo-membre', 'atgp' ),
			'use_featured_image'    => _x( 'Use as featured image', 'sedoo-membre', 'atgp' ),
			'filter_items_list'     => __( 'Filter membres list', 'atgp' ),
			'items_list_navigation' => __( 'membres list navigation', 'atgp' ),
			'items_list'            => __( 'membres list', 'atgp' ),
			'new_item'              => __( 'New membre', 'atgp' ),
			'add_new'               => __( 'Add New', 'atgp' ),
			'add_new_item'          => __( 'Add New membre', 'atgp' ),
			'edit_item'             => __( 'Edit membre', 'atgp' ),
			'view_item'             => __( 'View membre', 'atgp' ),
			'view_items'            => __( 'View membres', 'atgp' ),
			'search_items'          => __( 'Search membres', 'atgp' ),
			'not_found'             => __( 'No membres found', 'atgp' ),
			'not_found_in_trash'    => __( 'No membres found in trash', 'atgp' ),
			'parent_item_colon'     => __( 'Parent membre:', 'atgp' ),
			'menu_name'             => __( 'membres', 'atgp' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'menu_position'         => 30,
		'supports'              => array( 'title', 'editor', 'revisions' ),
		'has_archive'           => true,
		'rewrite'               => array('slug' => 'membre','with_front' => true),
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-groups',
		// 'show_in_rest'          => true,
		'rest_base'             => 'member',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'atgp_member_init' );

/**
 * Sets the post updated messages for the `atgp_membre` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `atgp_membre` post type.
 */
function atgp_membre_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['sedoo-membre'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'membre updated. <a target="_blank" href="%s">View membre</a>', 'atgp' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'atgp' ),
		3  => __( 'Custom field deleted.', 'atgp' ),
		4  => __( 'membre updated.', 'atgp' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'membre restored to revision from %s', 'atgp' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'membre published. <a href="%s">View membre</a>', 'atgp' ), esc_url( $permalink ) ),
		7  => __( 'membre saved.', 'atgp' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'membre submitted. <a target="_blank" href="%s">Preview membre</a>', 'atgp' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'membre scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview membre</a>', 'atgp' ),
		date_i18n( __( 'M j, Y @ G:i', 'atgp' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'membre draft updated. <a target="_blank" href="%s">Preview membre</a>', 'atgp' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'atgp_membre_updated_messages' );
