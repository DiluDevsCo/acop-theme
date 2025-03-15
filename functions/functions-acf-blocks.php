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
    // START: info-card
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/info-card');
    $version = get_block_version('info-card');
    /* wp_register_script('info-card-js', get_stylesheet_directory_uri()  . '/assets/blocks/info-card/index.js', $version, true); */
    wp_register_style('info-card-css', get_stylesheet_directory_uri()  . '/assets/blocks/info-card/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }

    // END: info-card
    // START: benefits-section
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/benefits-section');
    $version = get_block_version('benefits-section');
    /* wp_register_script('benefits-section-js', get_stylesheet_directory_uri()  . '/assets/blocks/benefits-section/index.js', $version, true); */
    wp_register_style('benefits-section-css', get_stylesheet_directory_uri()  . '/assets/blocks/benefits-section/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }

    // END: benefits-section
    
}
