<?php

//---------------------------------------------------------------------------------------------------------------------------------------------------------
/*
* REGISTER TPL SINGLE ATGP MEMBER
*/

add_filter ( 'single_template', 'atgp_member_single' );
function atgp_member_single($single_template) {
    global $post;
    
    if ($post->post_type == 'atgp-member') {
        $single_template = plugin_dir_path( __FILE__ ) . 'single-atgp-member.php';
    }
    return $single_template;
}

add_filter ( 'single_template', 'atgp_form_single' );
function atgp_form_single($single_template) {
    global $post;
    
    if (($post->post_type == 'atgp-member') && ($post->post_name == 'atgp-inscription')) {
        $single_template = plugin_dir_path( __FILE__ ) . 'register-form.php';
    }
    return $single_template;
}

?>