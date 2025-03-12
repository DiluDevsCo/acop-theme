<?php
$header_enabled = "not-loaded";
function sculapp_is_header_enabled() {
  global $header_enabled;
  global $post;
  $is_enabled = false;
  if ($header_enabled == "not-loaded") {
    $header_enabled = get_field('header_enabled','option');
    $enabled_only_in = get_field('enabled_only_in','option');

    if ($header_enabled) {
      if ($enabled_only_in) {
        foreach ($enabled_only_in as $post_id):
          if ($post_id == $post->ID):
            $is_enabled = true;
            break;
          endif;
        endforeach;
      } else {
        $is_enabled = true;
      }
    }
  }
  return $is_enabled;
}

// Obtiene los settings del header de ACF dependiendo del role de usuario
function sculapp_get_header($current_user) {
  $headers = get_field('user_header','option');
  $current_header = null;
  $logged_header = null;
  foreach ( $headers as $header):
    if (is_user_logged_in()) {
      $user_roles = ( array ) $current_user->roles;
      if (in_array('logged',$header['perfil'])) {
        $logged_header = $header;
      }
      $is_current_role = array_intersect($user_roles, $header['perfil']);
      if (count($is_current_role)> 0) {
        $current_header = $header;
        break;
      }
    } else {
      if (in_array('default',$header['perfil'])) {
        $current_header = $header;
        break;
      }
    }
  endforeach;
  if (!$current_header && $logged_header) {
    $current_header = $logged_header;
  }
  return $current_header;
}
