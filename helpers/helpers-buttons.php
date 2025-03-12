<?php
function fr_render_button($options)
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
      $classes[] = 'py-2 px-4 text-sm';
      break;
    case 'md':
      $classes[] = 'py-1 px-6 text-base';
      break;
    case 'lg':
      $classes[] = 'py-3.5 px-7 text-lg';
      break;
    case 'xl':
      $classes[] = 'py-3 px-5 text-xl';
    case '2xl':
      $classes[] = 'py-2 text-2xl';
      break;
    case 'xl-login':
      $classes[] = 'py-[0.22rem] pl-[1rem] md:pl-[1.5rem] text-xs md:text-base';
      break;
  }

  // 'middle none center rounded-lg bg-pink-500 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'

  switch ($settings['style']):
    case 'blue':
      $classes[] = 'bg-[#D7A5EB] text-black text-sm font-normal rounded-full px-5 py-[10px] hover:bg-[#F4DBFF]';
      break;
    case 'green':
      $classes[] = 'text-white font-bold bg-sculapp-blue-500 shadow-blue-500/20 hover:bg-sculapp-blue-700 border-gray-900 hover:shadow-blue-500/40 rounded-[15px]';
      break;
    case 'blue-outlined':
      $classes[] = 'text-white font-bold bg-sculapp-blue-500 shadow-blue-500/20 hover:bg-sculapp-blue-700 border-gray-900 hover:shadow-blue-500/40 rounded-[15px]';
      break;
    case 'green-outlined':
      $classes[] = 'text-white font-bold bg-sculapp-blue-500 shadow-blue-500/20 hover:bg-sculapp-blue-700 border-gray-900 hover:shadow-blue-500/40 rounded-[15px]';
      break;
    case 'primary':
      $classes[] = 'text-white font-bold from-btn_ver_cursos-400 to-btn_ver_cursos-200 bg-btn_ver_cursos-200 shadow-btn_ver_cursos-600/20 hover:shadow-btn_ver_cursos-600/40';
      break;
    case 'white':
      $classes[] = 'bg-white text-[#25A0D6]  hover:text-[#25A0D6] px-20 py-2 hover:bg-shadow-btn_ver_cursos-600/20 hover:shadow-btn_ver_cursos-600/40 rounded-[50px]';
      break;
    case 'purple':
      $classes[] = 'bg-[#9317C6] text-black font-bold hover:text-white hover:bg-[#985FAF] shadow-btn_ver_cursos-600/20 hover:shadow-btn_ver_cursos-600/40 rounded-[50px]';
      break;
    case 'purple-medium':
      $classes[] = 'bg-[#C046F2] text-black font-bold hover:text-white hover:bg-[#C580E1] shadow-btn_ver_cursos-600/20 hover:shadow-btn_ver_cursos-600/40 rounded-[50px]';
      break;
    case 'purple-light':
      $classes[] = 'bg-[#DCABF0] text-black font-bold hover:text-white hover:bg-[#985FAF] shadow-btn_ver_cursos-600/20 hover:shadow-btn_ver_cursos-600/40 rounded-[50px]';
      break;
    case 'purple-text-white':
      $classes[] = 'bg-[#9317C6] text-[#25F5A7] font-bold hover:text-black hover:bg-[#985FAF] shadow-btn_ver_cursos-600/20 hover:shadow-btn_ver_cursos-600/40 rounded-[50px]';
      break;
    case 'btn_login':
      $classes[] = 'pr-[0.3rem] bg-white text-[#014D81] font-bold hover:bg-black hover:text-white rounded-full';
      break;
    case 'purchase':
      $classes[] = 'justify-center w-[70%] text-center text-2xl text-black font-bold bg-[#9747FF] hover:bg-[#985FAF] hover:text-white rounded-full';
      break;
    case 'blue-text-white':
      $classes[] = 'bg-[#D7A5EB] text-white text-sm font-normal rounded-full px-5 py-[10px] hover:bg-[#F4DBFF]';
      break;
    case 'black-text-white':
      $classes[] = 'bg-black text-white text-sm font-extrabold rounded-full px-5 py-[10px] hover:bg-[#F4DBFF] border-4 border-[#E59AFD] border-solid';
      break;
    
  endswitch;
  $classes[] = $settings['classes'];
?>
  <a href="<?php echo $settings['url']; ?>" <?php if ($settings['target']) {
                                              echo 'target="' . $settings['target'] . '"';
                                            } ?> class="<?php echo join(' ', $classes); ?>">
    <?php echo $settings['label']; ?>
    <?php if ($settings['icon'] != '') {
      fr_render_icon($settings['icon']);
    } ?>
  </a>
<?php
}
