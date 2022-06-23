<?php
/**
 * Plugin Name:     Autan Grimper: Inscription des membres 
 * Plugin URI:      https://github.com/pvert/atgp
 * Description:     Dossiers d'inscription
 * Author:          Pierre VERT, Autan Grimper
 * Author URI:      https://github.com/pvert/
 * Text Domain:     atgp
 * Domain Path:     /languages
 * Version:         1.4.1
 * @package         atgp
 */

// LOAD CSS & SCRIPTS 
function atgp_scripts() {
    wp_register_style( 'atgp-style', plugins_url('css/atgp.css', __FILE__) );
    wp_enqueue_style( 'atgp-style' );
    // autocomplete form member register form
    $post_id=get_the_id();
    if (( get_post_type() == 'atgp-member' ) && (get_post_field( 'post_name', $post_id ) == "atgp-inscription")){
        $atgp_src_script = plugins_url().'/autangrimper/js/atgp.js';    
        wp_enqueue_script( 'atgp-script', $atgp_src_script,  array ( 'jquery', 'wp-api' ));
    }

}
 add_action('wp_enqueue_scripts','atgp_scripts');

// Prepare activation for thumbnail support for CPT
// $thumbnailSupport=array();

include 'post-types/atgp-member.php';
// array_push($thumbnailSupport, 'atgp-member');


include 'taxonomies/atgp-ctx-groupe.php';
include 'taxonomies/atgp-ctx-type.php';
include 'taxonomies/atgp-ctx-status.php';
// include 'taxonomies/atgp-ctx-reductions.php';

// Active thumbnail support
// function atgp_thumbnail_support() {
//     add_theme_support( 'post-thumbnails', $thumbnailSupport );
// }

// add_action('after_setup_theme','atgp_thumbnail_support');

include 'atgp-display.php';
include 'inc/atgp-functions.php';
include 'inc/atgp-acf.php';
include 'inc/atgp-acf-fields.php';
