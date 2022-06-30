<?php
function atgp_ctx_type_init() {
	register_taxonomy( 'atgp-ctx-type', array( 'atgp-member'), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
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
			'name'                       => __( 'types', 'atgp' ),
			'singular_name'              => _x( 'type', 'taxonomy general name', 'atgp' ),
			'search_items'               => __( 'Search types', 'atgp' ),
			'popular_items'              => __( 'Popular types', 'atgp' ),
			'all_items'                  => __( 'All types', 'atgp' ),
			'parent_item'                => __( 'Parent type', 'atgp' ),
			'parent_item_colon'          => __( 'Parent type:', 'atgp' ),
			'edit_item'                  => __( 'Edit type', 'atgp' ),
			'update_item'                => __( 'Update type', 'atgp' ),
			'view_item'                  => __( 'View type', 'atgp' ),
			'add_new_item'               => __( 'Add New type', 'atgp' ),
			'new_item_name'              => __( 'New type', 'atgp' ),
			'separate_items_with_commas' => __( 'Separate types with commas', 'atgp' ),
			'add_or_remove_items'        => __( 'Add or remove types', 'atgp' ),
			'choose_from_most_used'      => __( 'Choose from the most used types', 'atgp' ),
			'not_found'                  => __( 'No types found.', 'atgp' ),
			'no_terms'                   => __( 'No types', 'atgp' ),
			'menu_name'                  => __( 'types', 'atgp' ),
			'items_list_navigation'      => __( 'types list navigation', 'atgp' ),
			'items_list'                 => __( 'types list', 'atgp' ),
			'most_used'                  => _x( 'Most Used', 'atgp-ctx-type', 'atgp' ),
			'back_to_items'              => __( '&larr; Back to types', 'atgp' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'type',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'atgp_ctx_type_init' );

/**
 * Sets the post updated messages for the `atgp_ctx_type` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `atgp_ctx_type` taxonomy.
 */
function atgp_ctx_type_updated_messages( $messages ) {

	$messages['atgp-ctx-type'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'type added.', 'atgp' ),
		2 => __( 'type deleted.', 'atgp' ),
		3 => __( 'type updated.', 'atgp' ),
		4 => __( 'type not added.', 'atgp' ),
		5 => __( 'type not updated.', 'atgp' ),
		6 => __( 'types deleted.', 'atgp' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'atgp_ctx_type_updated_messages' );
