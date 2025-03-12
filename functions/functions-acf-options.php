<?php
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'FR Ajustes Generales',
        'menu_title'    => 'FR Ajustes',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'FR Ajustes de Encabezado',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));
}