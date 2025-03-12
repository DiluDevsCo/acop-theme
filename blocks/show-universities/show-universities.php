<?php
$title = get_field("title");
$tag_title = get_field("tag_title");
$size_text = get_field("size_text");
$weight_text = get_field("weight_text");
$color_text = get_field("color_text");
$show_universities = get_field("show_universities");
$animation_universities = get_field("animation_universities");
$array_universities = explode("\n", $show_universities);
$groupSize = 8;

$margin_top = get_field('margin-top_spacing') ?: 'xl';
$margin_bottom = get_field('margin-bottom_spacing') ?: 'xl';

$margin_classes = almus_get_block_margin_classes($margin_top, $margin_bottom);

?>

<div class="grid place-items-center text-center overflow-hidden gap-5 full-width <?php echo $margin_classes; ?>">
  <div class="grid container-fluid">
    <<?php echo $tag_title; ?> class="text-center leading-none" style="color:<? echo $color_text; ?>; 
        font-size:<? echo $size_text . "px"; ?>;
        font-weight: <? echo $weight_text; ?>;">
      <?php echo $title; ?>
    </<?php echo $tag_title; ?>>
  </div>
    
  <div
    class="grid overflow-hidden gap-2 w-full scroller <?php echo $animation_universities ? "animation-container" : "" ?>">
  <?php
  // Inicializa una variable de conteo para rastrear cuántos elementos se han mostrado
  $count = 0;
  $direction = 'right';
  foreach ($array_universities as $position => $university) {
    // Si el conteo alcanza el tamaño del grupo, crea un nuevo div scroller
    if ($count % $groupSize == 0) {
      if ($count !== 0) {
        echo '</ul></div>'; // Cerrar el div scroller anterior si no es el primero
      }
      $direction = ($direction == 'right') ? 'left' : 'right';
      echo '<div data-direction="'.$direction.'" data-speed="slow" class="grid overflow-hidden gap-2 w-full scroller">';
      echo '<ul class="flex flex-row overflow-hidden whitespace-nowrap gap-5 w-full relative no-underline list-none scroller__inner p-0 m-0">';
    }
    ?>
    <li class="bg-transparent rounded-full px-6 py-1 text-white font-semibold border-solid border-2 ">
      <p class="text-sm p-0"><?php echo $university ?></p>
    </li>
    <?php
    // Incrementa el contador
    $count++;
  }
  // Cerrar el último div scroller
  echo '</ul></div>';
  ?>
</div>
</div>