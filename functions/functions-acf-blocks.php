<?php

add_action('init', 'register_acf_blocks', 5);
function register_acf_blocks()
{
    // START: Registrar calendario
    $registro_calendario = register_block_type(get_stylesheet_directory() . '/blocks/calendario');
    $version = '1.0.1';
    if (!$registro_calendario) {
        error_log('No se pudo registrar el bloque');
    }
    // Registrar estilos y scripts
    wp_register_style('calendario-block-css', get_stylesheet_directory_uri()  . '/assets/blocks/calendario/calendario.css', array(), $version, 'all');
    wp_register_style('calendario-block-editor-css', get_stylesheet_directory_uri()  . '/assets/blocks/calendario/calendario-editor.css', array(), $version, 'all');
    wp_register_script('calendario-block-js', get_stylesheet_directory_uri()  . '/assets/blocks/calendario/index.js', array(), $version, true);
    // END: Registrar calendario

    // Registrar estilos y scripts simulations
    /*  wp_register_style( 'simulations-block-css', get_stylesheet_directory_uri()  . '/assets/blocks/simulations/index.css', array(), $version,'all' ); */
    wp_register_style('simulations-block-editor-css', get_stylesheet_directory_uri()  . '/assets/blocks/simulations/simulations-editor.css', array(), $version, 'all');
    wp_register_script('simulations-block-js', get_stylesheet_directory_uri()  . '/assets/blocks/simulations/index.js', array(), $version, true);
    // END: Registrar calendario

    // START: Registrar image-text-and-buttons
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/image-text-and-buttons');
    $version = get_block_version('image-text-and-buttons');
    wp_register_script('image-text-and-buttons-js', get_stylesheet_directory_uri()  . '/assets/blocks/image-text-and-buttons/index.js', array(), $version);
    wp_register_style('image-text-and-buttons-css', get_stylesheet_directory_uri()  . '/assets/blocks/image-text-and-buttons/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }
    // END: Registrar image-text-and-buttons


    // START: Registrar cards-cursos
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/cards-cursos');
    $version = get_block_version('cards-cursos');
    wp_register_style('cards-cursos-css', get_stylesheet_directory_uri()  . '/assets/blocks/cards-cursos/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }
    // END: Registrar cards-cursos

    // START: Registrar blogs-blog
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/blogs-block');
    $version = get_block_version('blogs-block');
    wp_register_style('blogs-block-css', get_stylesheet_directory_uri()  . '/assets/blocks/blogs-block/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }
    // END: Registrar blogs-blog

    // START: approve-evaluation
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/approve-evaluation');
    $version = get_block_version('approve-evaluation');
    wp_register_script('approve-evaluation-js', get_stylesheet_directory_uri()  . '/assets/blocks/approve-evaluation/index.js', $version, true);
    wp_register_style('approve-evaluation-css', get_stylesheet_directory_uri()  . '/assets/blocks/approve-evaluation/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }

    // END: approve-evaluation

    // START: show-universities
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/show-universities');
    $version = get_block_version('show-universities');
    wp_register_script('show-universities-js', get_stylesheet_directory_uri()  . '/assets/blocks/show-universities/index.js', $version, true);
    wp_register_style('show-universities-css', get_stylesheet_directory_uri()  . '/assets/blocks/show-universities/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }
    // END: show-universities

    // START: Registrar testimonials
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/testimonials');
    $version = get_block_version('testimonials');
    wp_register_script('testimonials-js', get_stylesheet_directory_uri()  . '/assets/blocks/testimonials/index.js', array("swiper"), $version);
    wp_register_style('testimonials-css', get_stylesheet_directory_uri()  . '/assets/blocks/testimonials/index.css', array(), $version, 'all');
    // END: Registrar testimonials
    // START: Registrar purchase
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/purchase');
    $version = get_block_version('purchase');
    wp_register_script('purchase-js', get_stylesheet_directory_uri()  . '/assets/blocks/purchase/index.js', array("swiper"), $version);
    wp_register_style('purchase-css', get_stylesheet_directory_uri()  . '/assets/blocks/purchase/index.css', array(), $version, 'all');
    // END: Registrar purchase

    // START: Registrar icon-text
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/icon-text');
    $version = get_block_version('icon-text');
    wp_register_script('icon-text-js', get_stylesheet_directory_uri()  . '/assets/blocks/icon-text/index.js', $version, true);
    wp_register_style('icon-text-css', get_stylesheet_directory_uri()  . '/assets/blocks/icon-text/index.css', array(), $version, 'all');
    // END: Registrar icon-text


    // START: Registrar imagen-texto-y-fondo
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/imagen-texto-y-fondo');
    $version = get_block_version('imagen-texto-y-fondo');
    wp_register_script('imagen-texto-y-fondo-js', get_stylesheet_directory_uri()  . '/assets/blocks/imagen-texto-y-fondo/index.js', array("swiper"), $version);
    wp_register_style('imagen-texto-y-fondo-css', get_stylesheet_directory_uri()  . '/assets/blocks/imagen-texto-y-fondo/index.css', array(), $version, 'all');
    // END: Registrar imagen-texto-y-fondo

    // START: Registrar popup
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/popup');
    $version = get_block_version('popup');
    wp_register_script('popup-js', get_stylesheet_directory_uri()  . '/assets/blocks/popup/index.js', $version, true);
    wp_register_style('popup-css', get_stylesheet_directory_uri()  . '/assets/blocks/popup/index.css', array(), $version, 'all');
    
    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }
    // END: Registrar popup

    // START: Registrar purpose
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/purpose');
    $version = get_block_version('purpose');
    wp_register_script('purpose-js', get_stylesheet_directory_uri()  . '/assets/blocks/purpose/index.js', $version, true);
    wp_register_style('purpose-css', get_stylesheet_directory_uri()  . '/assets/blocks/purpose/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }
    // END: Registrar purpose

    // START: Registrar line-history
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/line-history');
    $version = get_block_version('line-history');
    wp_register_script('line-history-js', get_stylesheet_directory_uri()  . '/assets/blocks/line-history/index.js', array("swiper"), $version);
    wp_register_style('line-history-css', get_stylesheet_directory_uri()  . '/assets/blocks/line-history/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }
    // END: Registrar line-history

    // START: Registrar methodology-block
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/methodology-block');
    $version = get_block_version('methodology-block');
    wp_register_script('methodology-block-js', get_stylesheet_directory_uri()  . '/assets/blocks/methodology-block/index.js', array("swiper"), $version);
    wp_register_style('methodology-block-css', get_stylesheet_directory_uri()  . '/assets/blocks/methodology-block/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }
    // END: Registrar methodology-block

    // START: Registrar slider-fr
    $registro = register_block_type(get_stylesheet_directory() . '/blocks/slider-fr');
    $version = get_block_version('slider-fr');
    wp_register_script('slider-fr-js', get_stylesheet_directory_uri()  . '/assets/blocks/slider-fr/index.js', $version, true);
    wp_register_style('slider-fr-css', get_stylesheet_directory_uri()  . '/assets/blocks/slider-fr/index.css', array(), $version, 'all');

    if (!$registro) {
        error_log('No se pudo registrar el bloque');
    }
    // END: Registrar slider-fr

    
}
