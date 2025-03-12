<?php
add_shortcode('sculapp_username', 'get_username');

function get_username() {
  $user = wp_get_current_user();
  return $user->display_name;
}