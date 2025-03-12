<?php
// Agregar campo de seleccion de menus en ACF
add_action('acf/include_field_types', 'sculapp_include_custom_field_types');
function sculapp_include_custom_field_types() {
  include_once(get_stylesheet_directory() .'/classes/acf-menu-chooser.php');	
  include_once(get_stylesheet_directory() .'/classes/acf-roles-chooser.php');	
}