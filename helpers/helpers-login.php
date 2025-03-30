<?php
function acop_wp_login_form($args = array())
{
	$defaults = array(
		'echo'           => true,
		// Default 'redirect' value takes the user back to the request URI.
		'redirect'       => (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
		'form_id'        => 'loginform',
		'label_username' => __('Username or Email Address'),
		'label_password' => __('Password'),
		'label_remember' => __('Remember Me'),
		'label_log_in'   => __('Log In'),
		'id_username'    => 'user_login',
		'id_password'    => 'user_pass',
		'id_remember'    => 'rememberme',
		'id_submit'      => 'wp-submit',
		'remember'       => true,
		'error' => '',
		'value_username' => '',
		// Set 'value_remember' to true to default the "Remember me" checkbox to checked.
		'value_remember' => false,
	);

	/**
	 * Filters the default login form output arguments.
	 *
	 * @since 3.0.0
	 *
	 * @see wp_login_form()
	 *
	 * @param array $defaults An array of default login form arguments.
	 */
	$args = wp_parse_args($args, apply_filters('login_form_defaults', $defaults));

	/**
	 * Filters content to display at the top of the login form.
	 *
	 * The filter evaluates just following the opening form tag element.
	 *
	 * @since 3.0.0
	 *
	 * @param string $content Content to display. Default empty.
	 * @param array  $args    Array of login form arguments.
	 */
	$login_form_top = apply_filters('login_form_top', '', $args);

	/**
	 * Filters content to display in the middle of the login form.
	 *
	 * The filter evaluates just following the location where the 'login-password'
	 * field is displayed.
	 *
	 * @since 3.0.0
	 *
	 * @param string $content Content to display. Default empty.
	 * @param array  $args    Array of login form arguments.
	 */
	$login_form_middle = apply_filters('login_form_middle', '', $args);

	/**
	 * Filters content to display at the bottom of the login form.
	 *
	 * The filter evaluates just preceding the closing form tag element.
	 *
	 * @since 3.0.0
	 *
	 * @param string $content Content to display. Default empty.
	 * @param array  $args    Array of login form arguments.
	 */
	$login_form_bottom = apply_filters('login_form_bottom', '', $args);

	$form =
		sprintf(
			'<form class="space-y-4 md:space-y-6" name="%1$s" id="%1$s" action="%2$s" method="post">',
			esc_attr($args['form_id']),
			esc_url(site_url('wp-login.php', 'login_post'))
		) .
		$login_form_top .
		sprintf(
			' <div>
      <label for="%1$s" class="block mb-2 text-sm font-medium text-gray-900">%2$s</label>
      <input type="text" name="log" id="%1$s" autocomplete="username" required
        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2"
        value="%3$s" size="20" placeholder="%2$s" />
    </div>',
			esc_attr($args['id_username']),
			esc_html($args['label_username']),
			esc_attr($args['value_username'])
		) .
		sprintf(
			'<div>
      <label for="%1$s" class="block mb-2 text-sm font-medium text-gray-900">%2$s</label>
      <input type="password" name="pwd" id="%1$s" autocomplete="current-password" required
        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2"
        placeholder="%2$s" value="" size="20">
    </div>',
			esc_attr($args['id_password']),
			esc_html($args['label_password'])
		) . $login_form_middle .
		($args['remember'] ?
			sprintf(
				'<div class="flex items-center justify-between">
    <div class="flex items-center">
      <input id="%1$s" name="rememberme" type="checkbox" value="forever" %2$s
        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
      <label for="%1$s" class="ml-2 block text-sm text-gray-900">%3$s</label>
    </div>

    <div class="text-sm">
      <a href="' . wp_lostpassword_url() . '" class="font-medium text-[#13bf81] hover:text-[#19b6c8]">' . __('¿Has olvidado tu contraseña?') . '</a>
    </div>
  </div>',
				esc_attr($args['id_remember']),
				($args['value_remember'] ? ' checked="checked"' : ''),
				esc_html($args['label_remember'])
			) : ''
		) .
		sprintf(
			'<div>'
				. acop_render_button(array(
					'element' => 'button', 'return' => true, 'attrs' => 'id="%1$s" name="wp-submit" type="submit"', 'label' => 'Ingresar',
					'style' => 'black'
				)) .
				'<input type="hidden" name="redirect_to" value="%3$s" /></div>',
			esc_attr($args['id_submit']),
			esc_attr($args['label_log_in']),
			esc_url($args['redirect'])
		) .
		$login_form_bottom .
		'</form>';
	ob_start();
	include get_stylesheet_directory() . "/components/global/logofr-white.php";
	$logo = ob_get_contents();
	ob_end_clean();
	$image = '<div class="self-end w-1/3 hidden md:block">
    <img src="https://staging.cursofuturosresidentes.com/wp-content/uploads/2024/01/web_login_fr_002.png" alt="Imagen descriptiva" class="w-[30rem] h-auto">
  </div>';
	$text = '
	<div class="text-center mx-auto w-1/4 flex flex-col items-center mt-5">
    <h2 class="text-4xl font-bold mb-2 leading-[4px] text-[#19b6c8] hidden md:block">El método</h2>
    <h2 class="text-3xl font-bold mb-2 text-white hidden md:block">más completo y efectivo para pasar a la residencia.</h2>
	<div class="flex justify-center p-5">'
	. $logo .
  '</div>
  </div>';
	$response = '<section class="bg-[#001C30] min-h-[100dvh] flex flex-col md:flex-row items-center justify-center mx-auto">
	' . $image . ' 
	' . $text . ' 
  <div class="w-auto md:w-1/2 flex justify-center items-center">
  <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
      <h1 class="text-xl font-bold text-gray-900 md:text-2xl">
        Ingresa a la plataforma FR
      </h1>
	  ' . $args['error'] . $form . '
	  </div>
	  </div>
	  </div>
	  </section>';
	if ($args['echo']) {
		echo $response;
	} else {
		return $response;
	}
}