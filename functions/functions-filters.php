<?php
add_filter('et_html_main_header','sculapp_remove_divi_header',10,1);

// Elimina cualquier header inyectado por Divi cuando el header de Sculapp esta activo
function sculapp_remove_divi_header($html) {
  $header_enabled = sculapp_is_header_enabled();
  if ($header_enabled) {
    $html = '';
  }
  return $html;
}

// Agrega clase sculapp-header para poder eliminar el padding en #page-container agregado por Divi cuando usamos el nuevo header
add_filter('body_class','sculapp_add_custom_body_classes',10,1);

function sculapp_add_custom_body_classes($classes) {
  $header_enabled = sculapp_is_header_enabled();
  if ($header_enabled) {
    $classes[] = 'sculapp-header';
  }
  $classes[] = 'acop';
  return $classes;
}

// Actualiza el carrito de compras en el header cada vez que se actualize el carrito con Ajax
add_filter( 'woocommerce_add_to_cart_fragments', 'sculapp_cart_count_fragments', 10, 1 );


add_filter('admin_body_class', 'sculapp_add_admin_body_class', 10,1); 

function sculapp_add_admin_body_class($classes) {
  $classes .= ' acop';
  return $classes;
}