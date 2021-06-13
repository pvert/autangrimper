<?php

function atgp_ctx_group_init() {
	register_taxonomy( 'atgp-ctx-group', array( 'page', 'post', 'atgp-member'), array(
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
			'name'                       => __( 'groupes', 'atgp' ),
			'singular_name'              => _x( 'groupe', 'taxonomy general name', 'atgp' ),
			'search_items'               => __( 'Search groupes', 'atgp' ),
			'popular_items'              => __( 'Popular groupes', 'atgp' ),
			'all_items'                  => __( 'All groupes', 'atgp' ),
			'parent_item'                => __( 'Parent groupe', 'atgp' ),
			'parent_item_colon'          => __( 'Parent groupe:', 'atgp' ),
			'edit_item'                  => __( 'Edit groupe', 'atgp' ),
			'update_item'                => __( 'Update groupe', 'atgp' ),
			'view_item'                  => __( 'View groupe', 'atgp' ),
			'add_new_item'               => __( 'Add New groupe', 'atgp' ),
			'new_item_name'              => __( 'New groupe', 'atgp' ),
			'separate_items_with_commas' => __( 'Separate groupes with commas', 'atgp' ),
			'add_or_remove_items'        => __( 'Add or remove groupes', 'atgp' ),
			'choose_from_most_used'      => __( 'Choose from the most used groupes', 'atgp' ),
			'not_found'                  => __( 'No groupes found.', 'atgp' ),
			'no_terms'                   => __( 'No groupes', 'atgp' ),
			'menu_name'                  => __( 'groupes', 'atgp' ),
			'items_list_navigation'      => __( 'groupes list navigation', 'atgp' ),
			'items_list'                 => __( 'groupes list', 'atgp' ),
			'most_used'                  => _x( 'Most Used', 'atgp-ctx-group', 'atgp' ),
			'back_to_items'              => __( '&larr; Back to groupes', 'atgp' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'atgp-group',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'atgp_ctx_group_init' );

/**
 * Sets the post updated messages for the `atgp_ctx_group` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `atgp_ctx_group` taxonomy.
 */
function atgp_ctx_group_updated_messages( $messages ) {

	$messages['atgp-ctx-group'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'groupe added.', 'atgp' ),
		2 => __( 'groupe deleted.', 'atgp' ),
		3 => __( 'groupe updated.', 'atgp' ),
		4 => __( 'groupe not added.', 'atgp' ),
		5 => __( 'groupe not updated.', 'atgp' ),
		6 => __( 'groupes deleted.', 'atgp' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'atgp_ctx_group_updated_messages' );
