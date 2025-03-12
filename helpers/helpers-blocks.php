<?php
function get_block_version($block_handle) {
  $block_file = get_stylesheet_directory() . '/blocks/' . $block_handle . '/block.json';
  $block = json_decode(file_get_contents($block_file));
  return "$block->version";
}

function almus_get_block_margin($margin,$position = 't') {
  $class = '';
  // Estos comentarios son para forsar tailwind a crear estas clases
  // Classes to render top "mt-0 mt-5 mt-8 mt-16 mt-32 text-3xl"
  // Classes to render bottom "mb-0 mb-5 mb-8 mb-16 mb-32"
  switch ($margin):
    case 'none':
      $class = 'm'.$position.'-0';
      break;
    case 'sm':
      $class = 'm'.$position.'-5';
      break;
    case 'md':
      $class = 'm'.$position.'-8';
      break;
    case 'lg':
      $class = 'm'.$position.'-16';
      break;
    case 'xl':
      $class = 'm'.$position.'-32';
      break;
  endswitch;
  return $class;
}


function almus_get_block_margin_classes($margin_top, $margin_bottom) {
  return almus_get_block_margin($margin_top,'t').' '.almus_get_block_margin($margin_bottom, 'b');
}