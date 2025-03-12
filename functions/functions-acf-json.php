<?php
/**
 * Este codigo es para generar una copia de las configuraciones creadas en ACF directamente en el tema
 */
/**
 * Use custom ACF save point
 */
function acf_json_save_point($path)
{
  $path = get_stylesheet_directory() . '/acf-json';
  return $path;
}
add_filter('acf/settings/save_json', 'acf_json_save_point');

/**
 * Use custom ACF load point
 */
function acf_json_load_point($paths)
{
  unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/acf-json';
  return $paths;
}
add_filter('acf/settings/load_json', 'acf_json_load_point');