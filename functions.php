<?php 
require get_stylesheet_directory() . '/functions/functions-acf-actions.php';
require get_stylesheet_directory() . '/functions/functions-acf-json.php';
require get_stylesheet_directory() . '/functions/functions-acf-blocks.php';
require get_stylesheet_directory() . '/functions/functions-acf-options.php';
require get_stylesheet_directory() . '/functions/functions-actions.php';
require get_stylesheet_directory() . '/functions/functions-filters.php';
require get_stylesheet_directory() . '/functions/functions-helpers.php';
require get_stylesheet_directory() . '/functions/functions-shortcodes.php';
require get_stylesheet_directory() . '/functions/functions-walkers.php';
require get_stylesheet_directory() . '/functions/functions-most-popular-post.php';

// AJAX Login Handler
function ajax_login_handler() {
    $username = sanitize_user($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) && $_POST['remember'] === '1';
    $redirect_to = esc_url_raw($_POST['redirect_to'] ?? home_url());
    
    if (empty($username) || empty($password)) {
        wp_send_json_error(array('message' => 'Por favor, completa todos los campos.'));
    }
    
    $creds = array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => $remember,
    );
    
    $user = wp_signon($creds, false);
    
    if (is_wp_error($user)) {
        wp_send_json_error(array('message' => 'Usuario o contraseña incorrectos.'));
    } else {
        // Verificar si el usuario tiene el rol de miembros_inactivos
        if (user_can($user, 'miembros_inactivos') || in_array('miembros_inactivos', $user->roles)) {
            // Cerrar la sesión que se acaba de crear
            wp_logout();
            
            wp_send_json_error(array(
                'message' => 'Tu cuenta se encuentra temporalmente inactiva. Para reactivar tu membresía, por favor contacta con nuestro equipo de soporte.',
                'error_type' => 'inactive_member'
            ));
        }
        
        wp_send_json_success(array(
            'message' => '¡Inicio de sesión exitoso!',
            'redirect' => $redirect_to
        ));
    }
}
add_action('wp_ajax_nopriv_ajax_login', 'ajax_login_handler');
add_action('wp_ajax_ajax_login', 'ajax_login_handler');