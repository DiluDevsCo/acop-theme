<?php /* Template Name: Calendario */
if (is_user_logged_in()) {
  $current_user = wp_get_current_user();
  $current_user_roles = (array) $current_user->roles;
  $calendarios = get_field('calendarios');

  foreach($calendarios as $calendario):
    if ( !in_array( $calendario['profile'], $current_user_roles )) {  
      wp_redirect($calendario['redirect']);
      $post = get_post($calendario['redirect']['ID']);
      $content = apply_filters('the_content', $post->post_content); 
echo $content;  
    } else {
      wp_redirect('/');
    }
  endforeach;
  $allowed_profiles = get_field('allowed_profiles');
  if ( !in_array( 'elite', $current_user_roles ) && !in_array( 'elite-lite', $current_user_roles ) ) {
    $redirect = get_field('calendar_other_users_redirect');
    if ($redirect) {
      wp_redirect($redirect);
    } else {
      wp_redirect('/');
    }
  }
} else {
  wp_redirect('/');
}