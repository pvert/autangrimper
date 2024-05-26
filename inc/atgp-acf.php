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

    /********** */    
    // send email with url access to informations
    // $post->post_title
    //$email="inscriptions@autangrimper.fr"; // ajouter options backoff
    $email=get_field('atgp_option_config_mail', 'option');
    $tel=get_field('atgp-tel-contact', 'option');
    $to=$etat_civil['atgp_courriel'];
    // $to="pierr65@gmail.com";
    // $to=get_post_meta( $post_id, 'atgp_group_etat_civil_atgp_courriel', true );

    // SUBJECT
    // $subject="[Autan Grimper] ".$post->post_title." , votre dossier d'inscription ";
    $subject="[Autan Grimper] ".$my_post['post_title']." , votre dossier de pré-inscription ";  
    // HEADERS
    $headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

    // MESSAGE
    // $message="post_id :".$post_id." | post->post_id :". $post->post_id ." | to :".$toTest."=". get_post_meta( $post_id, 'atgp_group_etat_civil_atgp_courriel', true ) ."\r\n";
    $message="<em>Message automatique, ne pas répondre...</em>\r\n";
    $message.="\r\n";
    $message.="<h1>Pré-inscription en ligne Autan Grimper</h1>"."\r\n";
    $message.="<p>Vous pouvez à présent télécharger et imprimer votre dossier de pré-inscription à l'adresse suivante : </p>\r\n";

    //   $message.="<a href=\"https://".site_url()."/membre/".$my_post['post_name']."\">https://".site_url()."/membre/".$my_post['post_name']."</a>"."\r\n";
    // $message.= "<p>". $post_url."</p>\r\n";

    // LINK TO PDF
    // $post_url = get_permalink( $post_id );
    $linkToPDF_generator="../pdf/printpdf.php?postID=".$post_id;
    $message.= "<p>".plugins_url($linkToPDF_generator, __FILE__)."</p>\r\n";

    // QS-SANTE
    $linkToPDF_QS_SPORT="../files/questionnaire_medical.pdf";
    $linkToPDF_QS_SPORT_MINEUR="../files/questionnaire_medical_mineur.pdf";
    $linkToPDF_ASSUR_FFME="../files/2025-pack-assurance.pdf";
    $message.="<p>Pour les renouvellements de licence, vous devez joindre au dossier le questionnaire santé QS-SPORT à télécharger et imprimer à l'adresse suivante : </p>\r\n";
    $message.= "<p>Pour les adultes: ".plugins_url($linkToPDF_QS_SPORT, __FILE__)."</p>\r\n";
    $message.= "<p>Pour les mineurs: ".plugins_url($linkToPDF_QS_SPORT_MINEUR, __FILE__)."</p>\r\n";
    // $message.= "<p>Votre mot de passe : <strong>".$etat_civil['atgp_code_postal']."</strong></p>\r\n";
    $message.= "<h2>Assurance</h2><p><p>Assurance, remplissez et imprimez le bulletin suivant, en laissant les cases cochées par défaut (prix inclus dans l'adhésion au club) : ".plugins_url($linkToPDF_ASSUR_FFME, __FILE__)."</p>\r\n";
    $message.= "Ne rajoutez aucun chèque ni supplément d'assurance à l’adhésion. Pour toutes les autres options si vous en souhaitez , ski… il faudra accéder au site de la FFME pour y souscrire et régler en ligne les suppléments à partir du 1er Septembre.</p>\r\n";
    $message.= "<hr>\r\n";
    $message.="<p><strong><u>Votre dossier est à retourner par courrier ou à amener à la salle, avec certificat médical, questionnaire santé, le bulletin d'assurance rempli, et chéque(s)"."</u></strong></p>\r\n";
    $message.="<p>Autan Grimper<br>".$email."<br>".$tel."</p>";
    // $message .= $post->post_title . ": " . $post_url;

    // wp_mail( $to, $subject, $message, $headers, $attachments );
    wp_mail( $to, $subject, $message, $headers );
    /********** */

    }
    
}
// run after ACF saves the $_POST['fields'] data
add_action('acf/save_post', 'atgp_title_saver', 20);

?>