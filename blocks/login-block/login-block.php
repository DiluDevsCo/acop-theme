<?php
// Obtener campos ACF
$titulo = get_field('titulo_login') ?: 'Iniciar Sesión';
$mostrar_registro = get_field('mostrar_registro') ?: false;
$redirect_url = get_field('redirect_url') ?: home_url();
$clase_personalizada = get_field('clase_css') ?: '';
$imagen_fondo = get_field('imagen_fondo');

// Si el usuario ya está logueado
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
?>
    <div class="login-block <?php echo esc_attr($clase_personalizada); ?> bg-[#7D669B] p-8 rounded-3xl shadow-2xl max-w-sm mx-auto text-white">
        <div class="text-center">
            <div class="bg-white bg-opacity-20 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-4">¡Hola, <?php echo esc_html($current_user->display_name); ?>!</h3>
            <div class="space-y-3">
                <a href="<?php echo esc_url(wc_get_account_endpoint_url('dashboard')); ?>"
                    class="block bg-white text-purple-600 font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition duration-300">
                    Mi Cuenta
                </a>
                <a href="<?php echo esc_url(wp_logout_url()); ?>"
                    class="block bg-white bg-opacity-20 text-white font-semibold px-6 py-3 rounded-full hover:bg-opacity-30 transition duration-300">
                    Cerrar Sesión
                </a>
            </div>
        </div>
    </div>
<?php
    return;
}
?>
<div class="block md:flex md:flex-row flex-col items-center justify-center py-4">
    <div class="login-block <?php echo esc_attr($clase_personalizada); ?> bg-[#7D669B] p-8 rounded-3xl shadow-2xl max-w-sm mx-auto">
        <!-- Icono de usuario -->
        <div class="text-center mb-6">
            <div class="bg-white bg-opacity-20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
        </div>

        <div id="login-messages" class="mb-6"></div>
        <form id="custom-login-form" class="space-y-4" data-redirect="<?php echo esc_url($redirect_url); ?>">
            <!-- Campo Email -->
            <div class="relative">
                <input type="text"
                    id="username"
                    name="username"
                    placeholder="E-mail"
                    class="w-full px-4 py-3 bg-white bg-opacity-90 border-0 rounded-full text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white focus:bg-white transition duration-300"
                    required>
            </div>

            <!-- Campo Password -->
            <div class="relative">
                <input type="password"
                    id="password"
                    name="password"
                    placeholder="Password"
                    class="w-full px-4 py-3 bg-white bg-opacity-90 border-0 rounded-full text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white focus:bg-white transition duration-300"
                    required>
            </div>

            <!-- Checkbox Recordarme -->
            <div class="flex items-center text-white text-sm mt-6 mb-6">
                <input type="checkbox" id="remember" name="remember" class="mr-3 w-4 h-4 text-purple-600 rounded focus:ring-white">
                <label for="remember" class="cursor-pointer">Recordar datos</label>
            </div>

            <!-- Botón de ingreso -->
            <button type="submit"
                id="login-submit-btn"
                class="w-full bg-white text-[#7D669B] font-bold py-3 px-6 rounded-full hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-lg">
                Ingresar
            </button>
        </form>


        <!-- Enlaces adicionales -->
        <div class="mt-6 text-center space-y-2">
            <!-- <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" 
               class="block text-white text-sm hover:text-gray-200 transition duration-300">
                ¿Olvidaste tu contraseña?
            </a> -->

            <?php if ($mostrar_registro && get_option('users_can_register')) : ?>
                <div>
                    <a href="<?php echo esc_url(wp_registration_url()); ?>"
                        class="text-white text-sm hover:text-gray-200 transition duration-300">
                        ¿No tienes cuenta? Regístrate
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="w-full md:w-1/2">
        <?php if ($imagen_fondo): ?>
            <img src="<?php echo esc_url($imagen_fondo); ?>"
                alt="<?php echo esc_attr($imagen_fondo); ?>"
                class="w-full h-full object-cover">
        <?php else: ?>
            <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                <span class="text-gray-500">Imagen de fondo</span>
            </div>
        <?php endif; ?>
    </div>
</div>