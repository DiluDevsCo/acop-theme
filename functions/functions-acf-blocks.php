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

    // START: interest-section
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/interest-section');
    $version = get_block_version('interest-section');
    /* wp_register_script('interest-section-js', get_stylesheet_directory_uri()  . '/assets/blocks/interest-section/index.js', $version, true); */
    wp_register_style('interest-section-css', get_stylesheet_directory_uri()  . '/assets/blocks/interest-section/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }

    // END: interest-section

    // START: form-news
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/form-news');
    $version = get_block_version('form-news');
    /* wp_register_script('interest-section-js', get_stylesheet_directory_uri()  . '/assets/blocks/interest-section/index.js', $version, true); */
    wp_register_style('form-news-css', get_stylesheet_directory_uri()  . '/assets/blocks/form-news/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }

    // END: form-news

    // START: blogs-block
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/blogs-block');
    $version = get_block_version('blogs-block');
    /* wp_register_script('interest-section-js', get_stylesheet_directory_uri()  . '/assets/blocks/interest-section/index.js', $version, true); */
    wp_register_style('blogs-block-css', get_stylesheet_directory_uri()  . '/assets/blocks/blogs-block/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }

    // END: blogs-block

    // START: eventos
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/eventos');
    $version = get_block_version('eventos');
    /* wp_register_script('interest-section-js', get_stylesheet_directory_uri()  . '/assets/blocks/interest-section/index.js', $version, true); */
    wp_register_style('eventos-css', get_stylesheet_directory_uri()  . '/assets/blocks/eventos/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }

    // END: eventos
    // START: section-banner
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/section-banner');
    $version = get_block_version('section-banner');
    /* wp_register_script('interest-section-js', get_stylesheet_directory_uri()  . '/assets/blocks/interest-section/index.js', $version, true); */
    /* wp_register_style('section-banner-css', get_stylesheet_directory_uri()  . '/assets/blocks/section-banner/index.css', array(), $version, 'all'); */

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }

    // END: section-banner
    // START: page-about-us
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/page-about-us');
    $version = get_block_version('page-about-us');
    /* wp_register_script('interest-section-js', get_stylesheet_directory_uri()  . '/assets/blocks/interest-section/index.js', $version, true); */
    /* wp_register_style('page-about-us-css', get_stylesheet_directory_uri()  . '/assets/blocks/page-about-us/index.css', array(), $version, 'all'); */

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }

    // END: page-about-us
    // START: banner-cabecera
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/banner-cabecera');
    $version = get_block_version('banner-cabecera');
    /* wp_register_script('interest-section-js', get_stylesheet_directory_uri()  . '/assets/blocks/interest-section/index.js', $version, true); */
    /* wp_register_style('banner-cabecera-css', get_stylesheet_directory_uri()  . '/assets/blocks/banner-cabecera/index.css', array(), $version, 'all'); */

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }

    // END: banner-cabecera

    
}
