<?php
add_theme_support( 'editor-styles' );
// Agregar hoja de estilos css y js principal
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
  $version = '1.0.2';
  wp_enqueue_style( 'child-style',
		get_stylesheet_uri(),
		array( 'divi-style' ),
		wp_get_theme()->get( 'Version' ) // This only works if you have Version defined in the style header.
	);
  // wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  // wp_enqueue_style( 'app-fr-child', get_stylesheet_directory_uri() . '/style.css', array('divi-style'), $version );
  wp_enqueue_script( 'child-style', get_stylesheet_directory_uri() . '/assets/sculapp.js', array(),$version, true );
  
  wp_register_script('swiper', get_stylesheet_directory_uri()  . '/public/js/swiper-bundle.min.js', array(), '10.3.1');
  wp_register_style('swiper-css', get_stylesheet_directory_uri()  . '/public/css/swiper-bundle.min.css', array(), '10.3.1');
}

// Agregar hoja de estilos css para el editor
add_action('admin_init', 'sculapp_add_editor_styles');
function sculapp_add_editor_styles() {
  add_editor_style( get_stylesheet_directory_uri() . '/editor.css' );
  // add_editor_style( get_stylesheet_directory_uri() . '/style.css' );
}

// Inyecta el header de Sculapp cuando se ha activado en el admin
/* add_action('wp_body_open', 'sculapp_wp_body_open');
function sculapp_wp_body_open() {
  $header_enabled = sculapp_is_header_enabled();
  if ($header_enabled) {
    require_once(get_stylesheet_directory() . '/components/global/header.php');
  }
} */

/* function redirect_based_on_role() {
  if (is_user_logged_in() && is_front_page()) {
    $current_user = wp_get_current_user();
    $current_user_roles = (array) $current_user->roles;

    if (in_array('rumbo_udea', $current_user_roles) && count($current_user_roles) == 1) {
      wp_redirect('/intensivo-udea'); // Cambia esto a la URL de tu página
      exit;
    }
  }
}
add_action('template_redirect', 'redirect_based_on_role'); */

add_action('wp_body_open', 'almus_add_wrapper');

function almus_add_wrapper()
{

  $bool_color = get_field('bool_color');
  $bg_color = get_field("bg_color");
  $header_enabled = sculapp_is_header_enabled();

  $user_is_logged_in = is_user_logged_in();

  /* if ($user_is_logged_in) {  
    echo '<div id="almus-wrapper">';
  } */
  // TODO: verificar porque require_once no funciona en windows
  /* require(get_stylesheet_directory() . '/components/global/sidebar.php'); */
  echo '<div class="almus-container" ' . ($bool_color ? 'style="background: ' . $bg_color . ' !important;"' : '') . '>';
  if ($header_enabled) {

  // TODO: verificar porque require_once no funciona en windows
    require_once(get_stylesheet_directory() . '/components/global/header.php');
  }  
}

add_action('wp_footer', 'almus_close_wrapper');

function almus_close_wrapper()
{
  $user_is_logged_in = is_user_logged_in();
  echo '</div>'; // Close almus-container
 /*  if ($user_is_logged_in) {  
  echo '</div>'; // Close almus-wrapper
  } */
}

add_action('init', 'almus_init');

function almus_init()
{
  register_nav_menu('sidebar', 'Logged in sidebar');
}