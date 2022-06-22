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
// add_theme_support( 'post-thumbnails' );

/**
 * HOOK ON WP_INSERT_POST for members
 * 
 */

// set html content_type for wp_mail() 
add_filter( 'wp_mail_content_type', function( $content_type ) {
    return 'text/html';
} );

function atgp_sendmail( $post_id, $post) {
    // If this is a revision, don't send the email.
    if ( wp_is_post_revision( $post_id ) ){
        return;
    }
        
    // if ( get_post_type( $post_id ) == 'atgp-member' ){
        
        $etat_civil=  get_field('atgp_group_etat_civil', $post_id);
    
        $post_url = get_permalink( $post_id );
        $linkToPDF_generator="../pdf/printpdf.php?postID=".$post_id;

        // send email with url access to informations
        // $post->post_title
        //$email="inscriptions@autangrimper.fr"; // ajouter options backoff
        $email=the_field('atgp_option_config_mail', 'option');
        $to=$etat_civil['atgp_courriel'];
        // $to="pierr65@gmail.com";
        // $to=get_post_meta( $post_id, 'atgp_group_etat_civil_atgp_courriel', true );

        // SUBJECT
        $subject="[Autan Grimper] ".$post->post_title." , votre dossier de pré-inscription ";

        // HEADERS
        $headers = 'From: '. $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n";

        // MESSAGE
        // $message="post_id :".$post_id." | post->post_id :". $post->post_id ." | to :".$toTest."=". get_post_meta( $post_id, 'atgp_group_etat_civil_atgp_courriel', true ) ."\r\n";
        $message="<em>Message automatique, ne pas répondre...</em>"."\r\n";
        $message.="\r\n";
        $message="<h1>Pré-inscription en ligne Autan Grimper</h1>"."\r\n";
        $message.="<p>Vous pouvez à présent télécharger et imprimer votre dossier de pré-inscription à l'adresse suivante : </p>\r\n";
        //   $message.="<a href=\"https://".site_url()."/membre/".$my_post['post_name']."\">https://".site_url()."/membre/".$my_post['post_name']."</a>"."\r\n";
        // $message.= "<p>". $post_url."</p>\r\n";
        $message.= "<p>".plugins_url($linkToPDF_generator, __FILE__)."</p>\r\n";
        $message.= "<p>Votre mot de passe : <strong>".$etat_civil['atgp_code_postal']."</strong></p>\r\n";

        $message.="<p><strong><u>Votre dossier est à retourner par courrier ou à amener à la salle, avec certificat médical, et chéque(s)"."</u></strong></p>\r\n";
        $message.="<p>Autan Grimper</p>";
        // $message .= $post->post_title . ": " . $post_url;

      // wp_mail( $to, $subject, $message, $headers, $attachments );
      wp_mail( $to, $subject, $message, $headers );
    //   }
}
// add_action( 'wp_insert_post', 'atgp_sendmail', 10, 3 );
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
