<?php

add_action('init', 'register_acf_blocks', 5);
function register_acf_blocks()
{
    // START: home
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/home');
    $version = get_block_version('home');
    /* wp_register_script('home-js', get_stylesheet_directory_uri()  . '/assets/blocks/home/index.js', $version, true); */
    wp_register_style('home-css', get_stylesheet_directory_uri()  . '/assets/blocks/home/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }

    // END: home
    
}
