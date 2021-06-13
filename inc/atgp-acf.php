<?php

add_action('acf/init', 'atgp_acf_form_init');
function atgp_acf_form_init() {

    // Check function exists.
    if( function_exists('acf_register_form') ) {

		// Register form.
        acf_register_form(array(
            'id'       => 'new-member',
            'post_id'  => 'new_post',
            'new_post' => array(
                'post_type'   => 'atgp-member',
                'post_status' => 'publish'
            ),
            'post_title'  => true,
            'post_content'=> true,
        ));
	}
}

/************************************************************
 * Options page
 */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Réglages inscriptions',
		'menu_title'	=> 'ATGP membres',
		'menu_slug' 	=> 'atgp-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Textes d\'informations',
		'menu_title'	=> 'Informations',
		'parent_slug'	=> 'atgp-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Config',
		'menu_title'	=> 'Configuration',
		'parent_slug'	=> 'atgp-general-settings',
	));
	
}

//Auto add and update Title field:
function atgp_title_saver( $post_id ) {

    if ( get_post_status ( $post_id ) ) {
        // do stuff
    }

    $my_post = array();
    $my_post['ID'] = $post_id;

    if (( get_post_type() == 'atgp-member' ) && (get_post_field( 'post_name', $post_id ) !== "atgp-inscription")){
      $etat_civil=  get_field('atgp_group_etat_civil', $post_id);
      $my_post['post_title'] = $etat_civil['atgp_nom']." ".$etat_civil['atgp_prenom'];
      $my_post['post_name'] = $my_post['post_title'];
    //   $my_post['post_status'] = 'private';
      $my_post['post_password'] = $etat_civil['atgp_code_postal'];
    
    // Update the post into the database
    wp_update_post( $my_post );
    }
    
}
// run after ACF saves the $_POST['fields'] data
add_action('acf/save_post', 'atgp_title_saver', 20);

/**
 * set private with password
 */

add_action( 'save_post', 'check_type_values', 10, 2 );

function check_type_values( $post_id, $post ) {
    $passwd=get_field('atgp_date_de_naissance', $post_id);

    if( $post->post_type )
        switch( $post->post_type ) {
            case 'atgp-member':
                $post->post_status = 'private';
                $post->post_password = ( '' == $post->post_password ) ? 'toto' : $post->post_password;
            break;
        }   
    return;
}

add_filter( 'default_content', 'set_default_values', 10, 2 );

function set_default_values( $post_content, $post ) {
    $passwd=get_field('atgp_date_de_naissance', $post_id);
    if( $post->post_type )
        switch( $post->post_type ) {
            case 'atgp-member':
                $post->post_status = 'private';
                $post->post_password = 'toto';
            break;
        }
    return $post_content;
}

/**
 * Send email
 */
function atgp_create_member_sendmail() {
    if ( get_post_type() == 'atgp-member' ) {
        // send email with url access to informations
        $email="pierr65@gmail.com";
        $to=get_field('atgp_courriel', $post_id);
        $subject="[Autan Grimper] Vos données d'inscription en ligne ";
        $headers = 'From: '. $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n";
        $message="Message automatique, ne pas répondre..."."\r\n";
        $message.="Merci de télécharger et imprimer votre dossier d'inscription à l'adresse suivante :"."\r\n";
        $message.="<a href=\"https://".site_url()."/membre/".$my_post['post_name']."\">https://".site_url()."/membre/".$my_post['post_name']."</a>"."\r\n";
        $message.="Votre dossier est à retourner par courrier ou à amener à la salle, avec certificat médical, et chéque(s)"."\r\n";

        // wp_mail( $to, $subject, $message, $headers, $attachments );
        wp_mail( $to, $subject, $message );
    }
}
// add_filter('wp_insert_post_data','atgp_create_member_sendmail');

?>