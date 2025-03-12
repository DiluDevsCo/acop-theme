<?php
$block_id = $block['id'];
$new_tag = get_field('new_tag');
$button = get_field('button');
$button_popup = get_field('button_popup');

$show_popup = get_field('show_popup');
$wait_time = (get_field('wait_time') ?: 0) * 1000;
$stop_view_popup = get_field('stop_view_popup');

$text_button_popup = get_field('text_button_popup');
$image_only = get_field('image_only');
$url_image_only = get_field('url_image_only');
$image = get_field('image');
$position_image = get_field('position_image');
//$flexClass = $position_image == 'align_left' ? '' : 'md:flex-row-reverse';
$title = get_field('title');
$description = get_field('description');
$component_heading = get_field('component_heading');

$bg_color = get_field('bg_color');
$text_color = get_field('text_color');
$open_in_new_tab = get_field('open_in_new_tab');

$url_imagen= get_field('url_imagen');

if ($position_image == 'align_left') { $flexClass = 'align_left'; }
else if($position_image == 'align_rigth'){ $flexClass = 'md:flex-row-reverse'; }
else{ $flexClass = 'w-full-center'; }

?>

  <!-- Botón activador de popup -->
  <?php if ($show_popup == 'show_with_click') : ?>
    <div class="flex items-center justify-center">
      <button data-show-button class="m-8 flex inline-flex select-none items-center gap-3 rounded-full text-center align-middle font-sans font-bold shadow-md transition-all hover:shadow-lg focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none py-3 px-6 text-sm text-white text-sm font-bold bg-black rounded-full px-5 py-[10px]"><?php echo $text_button_popup; ?></button>
    </div>
  <?php endif; ?>
  
  <popup-block id="<?php echo $block_id; ?>" data-block-popup="<?php echo $show_popup; ?>" data-block-popup-video="<?php echo $stop_view_popup; ?>" data-wait-time="<?php echo $wait_time; ?>" class="hidden fixed inset-0 overflow-auto bg-opacity-75 bg-white z-50 flex justify-center items-center filter backdrop-blur-sm">
    <?php if (!$image_only) : ?>

    <!-- Contenedor popup -->
    <?php
    $classDefault = "";
    if ($flexClass !== 'w-full-center') {
      $classDefault = 'items-center md:flex md:flex-row w-[343px] h-[606px] md:w-[908.89px] md:min-h-[439px] relative rounded-[20px] overflow-hidden border-box';
    }
    else{
      $classDefault = 'w-full ';
    }
    ?>
    <div class="contenedor_popup <?php echo $flexClass; echo $classDefault; ?>" style="background:<?php echo $bg_color; ?>">
      <!-- Imagen popup -->
      <?php if (!empty($image)) : ?>
        <div class="<?php echo !$image_only ? 'grid md:max-w-[575px]' : ''; ?> place-items-end w-full h-[343px] md:h-full">
          <?php
          if ($flexClass !== 'w-full-center') {
            $img_attrs = array(
              'class' => 'h-full max-w-full object-cover',
              'alt' => get_post_meta($image, '_wp_attachment_image_alt', true),
              'style' => '', // Establecer estilos para la posición de la imagen
            );
            echo wp_get_attachment_image($image, 'full', false, $img_attrs);
          }
          else {
            ?>
            <a href="<?php echo $url_imagen; ?>">
              <?php
              $img_attrs = array(
                'class' => 'h-full max-w-full object-cover',
                'alt' => get_post_meta($image, '_wp_attachment_image_alt', true),
                'style' => '', // Establecer estilos para la posición de la imagen
              );
              echo wp_get_attachment_image($image, 'full', false, $img_attrs);
          }
          
          ?>
            </a>
        </div>
      <?php endif; ?>
      
        <!-- Texto y botón popup -->
        <?php 
        if ($flexClass !== 'w-full-center') {      
        if (!empty($title) || !empty($description) || !empty($button)) : ?>
          <div style="background:<?php echo $bg_color; ?>" class="w-full md:w-1/2 p-5 md:p-[30px] flex flex-col justify-center">
            <!-- Textos -->
            <?php echo almus_applyAlignment($new_tag, 'text-sm font-bold pb-2 tracking-widest') ?>
            <?php echo almus_applyAlignment($component_heading, 'text-3xl font-bold pb-3') ?>
            <?php echo almus_applyAlignment($description, 'text-base mb-6 md:mb-10 font-normal') ?>

            <!-- Botón dentro del popup -->
            <div data-block-popup-button class="flex flex-col items-start mb-10">
              <?php
              $button_configuration = array(
                'label' => $button['label'],
                'url' => $button['url'],
                'style' => $button['style'],
              );
              // Agregar el atributo target solo si $open_in_new_tab es igual a 'si'
              if ($open_in_new_tab === 'si') {
                $button_configuration['target'] = '_blank';
              }
              // Renderizar el botón con la configuración
              fr_render_button($button_configuration);
              ?>
            </div>
          </div>
          <?php endif;
          }
        ?>  


      <!-- Botón para cerrar popup -->
      <button data-close-button class="absolute z-50 top-0 right-0 w-[44px] h-[44px] bg-white rounded-bl-[10px] flex justify-center items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 44 44" fill="none" class="hover:scale-125 transition ease-in-out duration-700">
          <path d="M15.0891 30C14.8115 30 14.5659 29.9252 14.3523 29.7756C14.1388 29.6259 14.0214 29.4295 14 29.1864C14 28.9245 14.1388 28.6533 14.4164 28.3727L20.0218 22.2004V23.3788L14.7687 17.6273C14.4911 17.328 14.3523 17.0568 14.3523 16.8136C14.3737 16.5705 14.4911 16.3741 14.7047 16.2244C14.9182 16.0748 15.1638 16 15.4414 16C15.7617 16 16.0286 16.0561 16.2422 16.1683C16.4771 16.2619 16.6906 16.4208 16.8828 16.6453L21.4632 21.7234H20.5663L25.1788 16.6453C25.371 16.4208 25.5739 16.2619 25.7874 16.1683C26.0009 16.0561 26.2679 16 26.5882 16C26.8871 16 27.1327 16.0748 27.3249 16.2244C27.5384 16.3741 27.6452 16.5798 27.6452 16.8417C27.6665 17.0848 27.5384 17.356 27.2608 17.6553L22.0398 23.3226V22.2846L27.6452 28.3727C27.9014 28.6533 28.0189 28.9245 27.9975 29.1864C27.9975 29.4295 27.8908 29.6259 27.6772 29.7756C27.4637 29.9252 27.2074 30 26.9085 30C26.6095 30 26.3426 29.9439 26.1077 29.8317C25.8942 29.7381 25.6806 29.5792 25.4671 29.3547L20.5343 23.9118H21.4632L16.5304 29.3547C16.3383 29.5605 16.1247 29.7194 15.8898 29.8317C15.6763 29.9439 15.4094 30 15.0891 30Z" fill="black" />
        </svg>
      </button>
    </div>
    <!-- Solo  la iamgen -->
<?php else : ?>

        <div class="relative grid md:max-w-[575px] place-items-center w-full cursor-pointer">
          <!-- Botón para cerrar popup -->
          <button data-close-button class="absolute z-50 top-0 right-0 w-[44px] h-[44px] bg-white rounded-bl-[10px] flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 44 44" fill="none" class="hover:scale-125 transition ease-in-out duration-700">
              <path d="M15.0891 30C14.8115 30 14.5659 29.9252 14.3523 29.7756C14.1388 29.6259 14.0214 29.4295 14 29.1864C14 28.9245 14.1388 28.6533 14.4164 28.3727L20.0218 22.2004V23.3788L14.7687 17.6273C14.4911 17.328 14.3523 17.0568 14.3523 16.8136C14.3737 16.5705 14.4911 16.3741 14.7047 16.2244C14.9182 16.0748 15.1638 16 15.4414 16C15.7617 16 16.0286 16.0561 16.2422 16.1683C16.4771 16.2619 16.6906 16.4208 16.8828 16.6453L21.4632 21.7234H20.5663L25.1788 16.6453C25.371 16.4208 25.5739 16.2619 25.7874 16.1683C26.0009 16.0561 26.2679 16 26.5882 16C26.8871 16 27.1327 16.0748 27.3249 16.2244C27.5384 16.3741 27.6452 16.5798 27.6452 16.8417C27.6665 17.0848 27.5384 17.356 27.2608 17.6553L22.0398 23.3226V22.2846L27.6452 28.3727C27.9014 28.6533 28.0189 28.9245 27.9975 29.1864C27.9975 29.4295 27.8908 29.6259 27.6772 29.7756C27.4637 29.9252 27.2074 30 26.9085 30C26.6095 30 26.3426 29.9439 26.1077 29.8317C25.8942 29.7381 25.6806 29.5792 25.4671 29.3547L20.5343 23.9118H21.4632L16.5304 29.3547C16.3383 29.5605 16.1247 29.7194 15.8898 29.8317C15.6763 29.9439 15.4094 30 15.0891 30Z" fill="black" />
            </svg>
          </button>
          <a target="_blank" href="<?php echo $url_image_only; ?>">
                <?php
                  $img_attrs = array(
                    'class' => 'max-w-full object-contain',
                    'alt' => get_post_meta($image, '_wp_attachment_image_alt', true),
                    'style' => '', // Establecer estilos para la posición de la imagen
                  );
                  echo wp_get_attachment_image($image, 'full', false, $img_attrs);
            ?>
            </a>
          
        </div>
<?php endif; ?>
  </popup-block>