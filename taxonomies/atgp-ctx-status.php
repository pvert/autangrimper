<?php
function atgp_ctx_status_init() {
	register_taxonomy( 'atgp-ctx-status', array( 'atgp-member'), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_tagcloud'     => true,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			// 'assign_terms'  => 'edit_posts',
			'assign_terms'  => 'read',    // Allow subscribers to add their team in their user profile
		),
		'labels'            => array(
			'name'                       => __( 'status', 'atgp' ),
			'singular_name'              => _x( 'status', 'taxonomy general name', 'atgp' ),
			'search_items'               => __( 'Search status', 'atgp' ),
			'popular_items'              => __( 'Popular status', 'atgp' ),
			'all_items'                  => __( 'All status', 'atgp' ),
			'parent_item'                => __( 'Parent status', 'atgp' ),
			'parent_item_colon'          => __( 'Parent status:', 'atgp' ),
			'edit_item'                  => __( 'Edit status', 'atgp' ),
			'update_item'                => __( 'Update status', 'atgp' ),
			'view_item'                  => __( 'View status', 'atgp' ),
			'add_new_item'               => __( 'Add New status', 'atgp' ),
			'new_item_name'              => __( 'New status', 'atgp' ),
			'separate_items_with_commas' => __( 'Separate status with commas', 'atgp' ),
			'add_or_remove_items'        => __( 'Add or remove status', 'atgp' ),
			'choose_from_most_used'      => __( 'Choose from the most used status', 'atgp' ),
			'not_found'                  => __( 'No status found.', 'atgp' ),
			'no_terms'                   => __( 'No status', 'atgp' ),
			'menu_name'                  => __( 'status', 'atgp' ),
			'items_list_navigation'      => __( 'status list navigation', 'atgp' ),
			'items_list'                 => __( 'status list', 'atgp' ),
			'most_used'                  => _x( 'Most Used', 'atgp-ctx-status', 'atgp' ),
			'back_to_items'              => __( '&larr; Back to status', 'atgp' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'status',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'atgp_ctx_status_init' );

/**
 * Sets the post updated messages for the `atgp_ctx_status` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `atgp_ctx_status` taxonomy.
 */
function atgp_ctx_status_updated_messages( $messages ) {

	$messages['atgp-ctx-status'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'status added.', 'atgp' ),
		2 => __( 'status deleted.', 'atgp' ),
		3 => __( 'status updated.', 'atgp' ),
		4 => __( 'status not added.', 'atgp' ),
		5 => __( 'status not updated.', 'atgp' ),
		6 => __( 'status deleted.', 'atgp' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'atgp_ctx_status_updated_messages' );
