<?php
function acop_render_button($options)
{
  $settings = array(
    'label' => isset($options['label']) ? $options['label'] : '',
    'url' => isset($options['url']) ? $options['url'] : '',
    'classes' => isset($options['classes']) ? $options['classes'] : '',
    'style' => isset($options['style']) ? $options['style'] : 'blue',
    'target' => isset($options['target']) ? $options['target'] : '',
    'icon' => isset($options['icon']) ? $options['icon'] : '',
    'size' => isset($options['size']) ? $options['size'] : '',
  );
  $classes = array();

  $classes[] = 'flex inline-flex select-none items-center place-content-center gap-3 text-center align-middle font-sans shadow-md transition-all hover:shadow-lg focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none';

  switch ($settings['size']) {
    case 'sm':
      $classes[] = 'px-4 text-sm';
      break;
    case 'md':
      $classes[] = 'px-6 text-base';
      break;
    case 'lg':
      $classes[] = 'px-10 text-lg';
      break;
    case 'xl':
      $classes[] = 'px-5 text-xl';
    case '2xl':
      $classes[] = 'text-2xl';
      break;
    case 'xl-login':
      $classes[] = 'py-[0.22rem] pl-[1rem] md:pl-[1.5rem] text-xs md:text-base';
      break;
  }

  // 'middle none center rounded-lg bg-pink-500 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'

  switch ($settings['style']):
    case 'blue':
      $classes[] = 'text-white py-1 font-normal bg-[#01A3DE] hover:bg-[#49BFED] border-gray-900 rounded-[50px]';
      break;
    case 'green':
      $classes[] = 'text-white py-1 font-normal bg-[#B7C805] hover:bg-[#CDD954] border-gray-900 rounded-[50px]';
      break;
    
  endswitch;
  $classes[] = $settings['classes'];
?>
  <a href="<?php echo $settings['url']; ?>" <?php if ($settings['target']) {
                                              echo 'target="' . $settings['target'] . '"';
                                            } ?> class="<?php echo join(' ', $classes); ?>">
    <?php echo $settings['label']; ?>
    <?php if ($settings['icon'] != '') {
      acop_render_icon($settings['icon']);
    } ?>
  </a>
<?php
}
