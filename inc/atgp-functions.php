<?php

/***
 * SUPPORTS
 * excerpt pour les pages
 * thumbnails
 */

add_post_type_support( 'page', 'excerpt' );

/***
 * Ajout du support des thumbnails
 */
add_theme_support( 'post-thumbnails' );

/******************************************************************
 * Afficher les archives des custom taxonomies
 * $categories = get_the_terms( $post->ID, 'category');  
 */

function atgp_show_categories($categories, $slugRewrite) {
 
    if( $categories ) {
    ?>
    <div class="tag">
    <?php
        foreach( $categories as $categorie ) { 
            if ($categorie->slug !== "non-classe") {
                // if ( "en" == pll_current_language()) {
                //     echo '<a href="'.site_url().'/'.pll_current_language().'/'.$slugRewrite.'/'.$categorie->slug.'" class="'.$categorie->slug.'">';
                // } else {
                    if(pll_default_language() == pll_current_language()) {
                        echo '<a href="'.site_url().'/'.$slugRewrite.'/'.$categorie->slug.'" class="'.$categorie->slug.'">';
                    } else {
                        echo '<a href="'.site_url().'/'.pll_current_language().'/'.$slugRewrite.'/'.$categorie->slug.'" class="'.$categorie->slug.'">';
                    }
                // }
                echo $categorie->name; 
                ?>                    
            </a>
    <?php 
            }
        }
    ?>
    </div>
  <?php
      } 
  }

  /* ------------------------------------------------------------------------------------------------- */
/**
 * AJOUT DES FILTRES DES CUSTOM TAXONOMIES DANS LES LISTES DE POST / CUSTOM POST
 */

function atgp_filter_by_custom_taxonomies( $post_type, $which ) {

	// Apply this only on a specific post type
	// if ( 'products' !== $post_type )
	// 	return;

    // A list of taxonomy slugs to filter by
    if ( 'atgp-member' == $post_type) {
        $taxonomies = array( 'atgp-ctx-group', 'atgp-ctx-status', 'atgp-ctx-type' );
    } 

	foreach ( $taxonomies as $taxonomy_slug ) {

		// Retrieve taxonomy data
		$taxonomy_obj = get_taxonomy( $taxonomy_slug );
		$taxonomy_name = $taxonomy_obj->labels->name;

		// Retrieve taxonomy terms
		$terms = get_terms( $taxonomy_slug );

		// Display filter HTML
		echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
		echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
		foreach ( $terms as $term ) {
			printf(
				'<option value="%1$s" %2$s>%3$s</option>',
				$term->slug,
				( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
				$term->name
            );
            /* Avec le compteur, mais qui est faux car il prend en compte tous les types de post
             printf(
				'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
				$term->slug,
				( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
				$term->name,
				$term->count
            );
            */
		}
		echo '</select>';
    }
}
add_action( 'restrict_manage_posts', 'atgp_filter_by_custom_taxonomies' , 10, 2);
