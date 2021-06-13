<?php

function atgp_ctx_reduc_init() {
	register_taxonomy( 'atgp-ctx-reduc', array('atgp-member'), array(
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
			'name'                       => __( 'Réduction', 'atgp' ),
			'singular_name'              => _x( 'Réduction', 'taxonomy general name', 'atgp' ),
			'search_items'               => __( 'Search réduction', 'atgp' ),
			'popular_items'              => __( 'Popular réduction', 'atgp' ),
			'all_items'                  => __( 'All réduction', 'atgp' ),
			'parent_item'                => __( 'Parent reduce', 'atgp' ),
			'parent_item_colon'          => __( 'Parent reduce:', 'atgp' ),
			'edit_item'                  => __( 'Edit reduce', 'atgp' ),
			'update_item'                => __( 'Update reduce', 'atgp' ),
			'view_item'                  => __( 'View reduce', 'atgp' ),
			'add_new_item'               => __( 'Add New reduce', 'atgp' ),
			'new_item_name'              => __( 'New reduce', 'atgp' ),
			'separate_items_with_commas' => __( 'Separate réduction with commas', 'atgp' ),
			'add_or_remove_items'        => __( 'Add or remove réduction', 'atgp' ),
			'choose_from_most_used'      => __( 'Choose from the most used réduction', 'atgp' ),
			'not_found'                  => __( 'No réduction found.', 'atgp' ),
			'no_terms'                   => __( 'No réduction', 'atgp' ),
			'menu_name'                  => __( 'Réductions', 'atgp' ),
			'items_list_navigation'      => __( 'réduction list navigation', 'atgp' ),
			'items_list'                 => __( 'réduction list', 'atgp' ),
			'most_used'                  => _x( 'Most Used', 'atgp-ctx-reduc', 'atgp' ),
			'back_to_items'              => __( '&larr; Back to réduction', 'atgp' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'atgp-reduc',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'atgp_ctx_reduc_init' );

/**
 * Sets the post updated messages for the `atgp_ctx_reduc` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `atgp_ctx_reduc` taxonomy.
 */
function atgp_ctx_reduc_updated_messages( $messages ) {

	$messages['atgp-ctx-reduc'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'reduce added.', 'atgp' ),
		2 => __( 'reduce deleted.', 'atgp' ),
		3 => __( 'reduce updated.', 'atgp' ),
		4 => __( 'reduce not added.', 'atgp' ),
		5 => __( 'reduce not updated.', 'atgp' ),
		6 => __( 'réduction deleted.', 'atgp' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'atgp_ctx_reduc_updated_messages' );
