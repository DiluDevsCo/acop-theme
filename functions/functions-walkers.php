<?php 
// Funcion para permitir usar el texto {sculapp_username} en los menus y que sera reemplazado por el display_name del usuario
function replace_sculapp_codes($item_output, $item) {
  if (is_user_logged_in()) {
    $user = wp_get_current_user();
    $item_output = str_replace('{sculapp_username}', $user->display_name,$item_output);
  }
  return $item_output;
}

add_filter('walker_nav_menu_start_el','replace_sculapp_codes', 10, 2);

if ( !class_exists('Sculapp_Menu_Walker') ) {
  class Sculapp_Menu_Walker extends Walker_Nav_Menu {
    // <div class="group group-hover group/depth-1 group-hover/depth-1:visible group/depth-2 group-hover/depth-2:visible">
    function start_lvl( &$output, $depth = 0, $args = array() ) {
      switch($depth):
        case 0:
          $groupClass = 'md:top-full md:left-0 md:group-hover:visible';
          break;
        case 1:
          $groupClass = 'md:top-0 md:left-full md:group-hover/depth-1:visible';
          break;
        case 2:
            $groupClass = 'md:top-0 md:left-full md:group-hover/depth-2:visible';
            break;
        endswitch;
      $indent = str_repeat("\t", $depth);
      $output .= "<div class=\"w-full md:absolute pl-10 md:w-auto md:p-2 md:shadow-md md:bg-white md:rounded-md hidden sm:block sm:invisible $groupClass\">\n$indent\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
      $indent = str_repeat("\t", $depth);
      $output .= "$indent\n</div>";
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
      switch($depth):
        case 0:
          $groupClass = 'group';
          break;
        case 1:
          $groupClass = 'group/depth-1';
          break;
        case 2:
            $groupClass = 'group/depth-2';
            break;
        endswitch;

      $class_names = $value = '';

      $classes = empty( $item->classes ) ? array() : (array) $item->classes;
      
      if ($item->current) {
        $class_names = 'class="'.$args->link_current_class.'"';
      } else {
        $class_names = 'class="'.$args->link_class.'"';
      }

      $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
      $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

      $output .= $indent . '';

      $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
      $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
      $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
      $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

      if ($item->current && isset($args->before_current)) {
        $item_output = $args->before_current;
      } else {
        $item_output = str_replace('{groupClass}',$groupClass,$args->before);
      }
      $item_output .= "<a". $id.' '.$attributes .$class_names.' role="menu-item">';
      $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
      $item_output .= '</a>';
      
      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }


    function end_el( &$output, $item, $depth = 0, $args = array() ) {
      $output .= "\n";
      $output .= $args->after;
    }
  }
}