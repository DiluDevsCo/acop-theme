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

// Cambiar las clases del body para forzar full width
function modify_body_class($classes) {
    // Remover clases de sidebar
    $classes = array_diff($classes, array('et_right_sidebar', 'et_left_sidebar'));
    
    // Agregar clase de full width
    $classes[] = 'et_full_width_page';
    
    return $classes;
}
add_filter('body_class', 'modify_body_class');

// 1. Hook que se ejecuta en cada carga de página para usuarios logueados
add_action('init', 'check_inactive_user_status');

function check_inactive_user_status() {
    // Solo ejecutar si el usuario está logueado
    if (!is_user_logged_in()) {
        return;
    }
    
    // No ejecutar en admin-ajax para evitar conflictos
    if (wp_doing_ajax()) {
        return;
    }
    
    // No ejecutar en el admin para permitir que administradores gestionen usuarios
    if (is_admin() && !wp_doing_ajax()) {
        return;
    }
    
    $current_user = wp_get_current_user();
    
    // Verificar si el usuario tiene el rol de miembros_inactivos
    if (user_can($current_user, 'miembros_inactivos') || in_array('miembros_inactivos', $current_user->roles)) {
        // Desloguear al usuario
        wp_logout();
        
        // Agregar mensaje de sesión cerrada
        add_action('wp_footer', function() {
            ?>
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                    // Crear overlay de notificación
                    const overlay = document.createElement('div');
                    overlay.style.cssText = `
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0, 0, 0, 0.8);
                        z-index: 999999;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    `;
                    
                    const modal = document.createElement('div');
                    modal.style.cssText = `
                        background: white;
                        padding: 2rem;
                        border-radius: 1rem;
                        max-width: 500px;
                        margin: 1rem;
                        text-align: center;
                        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                    `;
                    
                    modal.innerHTML = `
                        <div style="color: #f59e0b; font-size: 3rem; margin-bottom: 1rem;">⚠</div>
                        <h3 style="color: #1f2937; font-size: 1.25rem; font-weight: bold; margin-bottom: 1rem;">
                            Sesión Cerrada
                        </h3>
                        <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.5;">
                            Tu cuenta ha sido marcada como inactiva. Para reactivar tu membresía, 
                            por favor contacta con nuestro equipo de soporte.
                        </p>
                        <button onclick="window.location.reload()" 
                                style="background: #7c3aed; color: white; padding: 0.75rem 1.5rem; 
                                       border: none; border-radius: 0.5rem; font-weight: 500; 
                                       cursor: pointer; transition: all 0.2s;">
                            Continuar
                        </button>
                    `;
                    
                    overlay.appendChild(modal);
                    document.body.appendChild(overlay);
                    
                    // Agregar hover effect al botón
                    const button = modal.querySelector('button');
                    button.addEventListener('mouseenter', () => {
                        button.style.background = '#6d28d9';
                        button.style.transform = 'translateY(-1px)';
                    });
                    button.addEventListener('mouseleave', () => {
                        button.style.background = '#7c3aed';
                        button.style.transform = 'translateY(0)';
                    });
                });
            </script>
            <?php
        });
        
        // Limpiar cookies y redirección
        wp_clear_auth_cookie();
        
        // Log del evento (opcional)
        error_log("Usuario inactivo deslogueado automáticamente: " . $current_user->user_login);
        
        return;
    }
}