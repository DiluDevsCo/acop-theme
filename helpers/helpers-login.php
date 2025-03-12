<?php
function almus_wp_login_form( $args = array() ) {
	$defaults = array(
		'echo'           => true,
		// Default 'redirect' value takes the user back to the request URI.
		'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
		'form_id'        => 'loginform',
		'label_username' => __( 'Username or Email Address' ),
		'label_password' => __( 'Password' ),
		'label_remember' => __( 'Remember Me' ),
		'label_log_in'   => __( 'Log In' ),
		'id_username'    => 'user_login',
		'id_password'    => 'user_pass',
		'id_remember'    => 'rememberme',
		'id_submit'      => 'wp-submit',
		'remember'       => true,
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
	$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );

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
	$login_form_top = apply_filters( 'login_form_top', '', $args );

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
	$login_form_middle = apply_filters( 'login_form_middle', '', $args );

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
	$login_form_bottom = apply_filters( 'login_form_bottom', '', $args );

	$form =
		sprintf(
			'<form class="mt-8 space-y-6" name="%1$s" id="%1$s" action="%2$s" method="post">',
			esc_attr( $args['form_id'] ),
			esc_url( site_url( 'wp-login.php', 'login_post' ) )
		) .
		$login_form_top .
    '<div class="-space-y-px rounded-md shadow-sm">'.
		sprintf(
			' <div>
        <label for="%1$s" class="sr-only">%2$s</label>
        <input type="text" name="log" id="%1$s" autocomplete="username" required class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" value="%3$s" size="20" placeholder="%2$s" />
      </div>'
      ,
			esc_attr( $args['id_username'] ),
			esc_html( $args['label_username'] ),
			esc_attr( $args['value_username'] )
		) .
		sprintf(
      '<div>
        <label for="%1$s" class="sr-only">%2$s</label>
        <input type="password" name="pwd" id="%1$s" autocomplete="current-password" required
          class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
          placeholder="%2$s" value="" size="20">
      </div>',
			esc_attr( $args['id_password'] ),
			esc_html( $args['label_password'] )
		) .
    '</div>'.
		$login_form_middle .
		( $args['remember'] ?
			sprintf(
				'<div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="%1$s" name="rememberme" type="checkbox" value="forever"%2$s
            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
          <label for="%1$s" class="ml-2 block text-sm text-gray-900">%3$s</label>
        </div>

        <div class="text-sm">
          <a href="'.wp_lostpassword_url().'" class="font-medium text-blue-600 hover:text-blue-500">'.__('Lost your password?').'</a>
        </div>
      </div>',
				esc_attr( $args['id_remember'] ),
				( $args['value_remember'] ? ' checked="checked"' : '' ),
				esc_html( $args['label_remember'] )
			) : ''
		) .
		sprintf(
			'<div><button id="%1$s" type="submit" name="wp-submit"
      class="group relative flex w-full justify-center rounded-md bg-blue-600 py-2 px-3 text-sm font-semibold text-white hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
      <span class="absolute inset-y-0 left-0 flex items-center pl-3">
        <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" viewBox="0 0 20 20" fill="currentColor"
          aria-hidden="true">
          <path fill-rule="evenodd"
            d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
            clip-rule="evenodd" />
        </svg>
      </span>
      %2$s
    </button><input type="hidden" name="redirect_to" value="%3$s" /></div>',
			esc_attr( $args['id_submit'] ),
			esc_attr( $args['label_log_in'] ),
			esc_url( $args['redirect'] )
		) .
		$login_form_bottom .
		'</form>';

	if ( $args['echo'] ) {
		echo $form;
	} else {
		return $form;
	}
}