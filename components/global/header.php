<?php
/* 
 * Header personalizado para ACOP
 */

// Configuración básica
$current_user = wp_get_current_user();

// Inicializar $current_header para evitar el error
$current_header = function_exists('sculapp_get_header') ? sculapp_get_header($current_user) : null;

if (is_array($current_header)) {
  $logo_link = $current_header['logo_link'];
  $menu = $current_header['menu'];
  $user_menu = $current_header['user_menu'];
  $show_search = $current_header['show_search'];
  $show_cart = $current_header['show_cart'];
} else {
  $logo_link = null;
  $menu = null;
  $user_menu = null;
  $show_search = null;
  $show_cart = null;
}

$logo_image = get_field('image', 'option') ? get_field('image', 'option') : null;

// Configuración del login
$login_data = get_field('login_url','option');
if ($login_data) {
  $login_url = $login_data;
} else {
  $login_url = array(
    'url' => wp_login_url('/'),
    'title' => 'Ingresar'
  );
}
$show_enter = get_field('show_enter', 'option');

// Avatar para usuarios logueados
$avatar = '';
if (is_user_logged_in()) {
  $avatar_url = get_avatar_url($current_user->ID, array('default'=> '404','size'=>80));
  $handle = curl_init($avatar_url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
  $response = curl_exec($handle);
  $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
  
  if ($httpCode == 404 || empty($avatar_url)) {
    $first_initial = !empty($current_user->user_firstname) ? $current_user->user_firstname[0] : '';
    $last_initial = !empty($current_user->user_lastname) ? $current_user->user_lastname[0] : '';
    
    $avatar = '<div class="block rounded-full h-8 w-8 border-white border-2 border-solid outline outline-1 outline-black bg-purple text-white flex items-center justify-center font-bold text-xs">
                  '.$first_initial.$last_initial.'
                </div>';
  } else {
    if ($avatar_url != "") {
      $avatar = '<img alt="'.$current_user->user_firstname.' '.$current_user->user_lastname.'"
      src="'.$avatar_url.'" class="h-8 w-8 rounded-full object-cover" />';
    }
  }
  curl_close($handle);
}
?>

<!-- Header principal -->
<nav class="sticky top-0 z-50 w-full bg-[#5D3A8E] header-principal">
  <div class="container mx-auto px-4">
    <div class="flex items-center justify-between h-16">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="<?php echo $logo_link ? $logo_link['url'] : home_url('/'); ?>" class="block">
          <?php if ($logo_image != null): ?>
            <?php echo wp_get_attachment_image($logo_image, array(120, 40), false, array('class' => 'h-10 w-auto')); ?>
          <?php else: ?>
            <!-- Logo texto alternativo -->
            <div class="text-white font-bold text-xl">ACOP</div>
          <?php endif; ?>
        </a>
      </div>
      
      <!-- Menú principal (versión desktop) -->
      <div class="hidden md:flex items-center justify-center flex-1">
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'primary', // Asegúrate de que esta ubicación del menú esté registrada en tu tema
            'container' => '',
            'menu' => $menu,
            'menu_class' => 'flex space-x-8 text-white text-base font-medium',
            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            'link_before' => '',
            'link_after' => '',
            'link_class' => 'text-white text-base font-medium hover:text-white/80 transition-colors',
            'current_class' => 'border-b-2 border-white pb-1'
          )
        );
        ?>
      </div>
      
      <!-- Elementos a la derecha -->
      <div class="flex items-center">
        <!-- Botón de búsqueda -->
        <?php if ($show_search): ?>
        <div>
          <button type="button" class="text-white p-2 hover:text-white/80 focus:outline-none" aria-label="Buscar">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </button>
        </div>
        <?php endif; ?>

        <!-- Botón de login (si no está logueado) -->
        <?php if (!is_user_logged_in()): ?>
        <div class="ml-4">
          <a href="<?php echo $login_url['url']; ?>" 
             class="inline-flex items-center justify-center rounded-full border border-transparent px-4 py-1 text-sm font-medium text-[#5D3A8E] bg-white hover:bg-gray-100 focus:outline-none">
            <?php echo $login_url['title']; ?>
          </a>
        </div>
        <?php endif; ?>
        
        <!-- Avatar de usuario (si está logueado) -->
        <?php if (is_user_logged_in()): ?>
        <div class="ml-4 relative">
          <button type="button" 
            class="flex items-center rounded-full bg-[#6B48A1] p-1 text-sm focus:outline-none focus:ring-2 focus:ring-white"
            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
            <span class="sr-only">Abrir menu de usuario</span>
            <?php echo $avatar; ?>
          </button>
          <!-- Menú desplegable de usuario -->
          <div id="user-dropdown" class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="px-4 py-2 bg-gray-100">
              <div class="text-sm font-medium text-gray-900">
                <?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?>
              </div>
              <div class="text-xs text-gray-500 truncate">
                <?php echo $current_user->user_email; ?>
              </div>
            </div>
            <!-- <a href="/perfil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mi perfil</a> -->
            <a href="<?php echo wp_logout_url('/'); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar sesión</a>
          </div>
        </div>
        <?php endif; ?>
        
        <!-- Botón menú móvil -->
        <div class="ml-4 md:hidden">
          <button id="mobile-menu-button" type="button"
            class="inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-[#6B48A1] hover:text-white focus:outline-none"
            aria-expanded="false">
            <span class="sr-only">Abrir menú principal</span>
            <!-- Icono de hamburguesa -->
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Menú móvil -->
  <div id="mobile-menu" class="hidden md:hidden">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'primary', // Asegúrate de que esta ubicación del menú esté registrada en tu tema
          'container' => '',
          'menu' => $menu,
          'menu_class' => 'space-y-1',
          'items_wrap' => '<div class="%2$s">%3$s</div>',
          'link_before' => '',
          'link_after' => '',
          'link_class' => 'block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-[#6B48A1]',
          'current_class' => 'bg-[#6B48A1]'
        )
      );
      ?>
    </div>
    
    <?php if (!is_user_logged_in()): ?>
    <div class="border-t border-[#6B48A8] pt-4 pb-3">
      <div class="px-5">
        <a href="<?php echo $login_url['url']; ?>" 
           class="block w-full text-center rounded-md bg-white px-3 py-2 text-sm font-medium text-[#5D3A8E]">
          <?php echo $login_url['title']; ?>
        </a>
      </div>
    </div>
    <?php endif; ?>
  </div>
</nav>

<script>
  // Script para manejar los menús
  document.addEventListener('DOMContentLoaded', function() {
    // Menú móvil
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
      mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
      });
    }
    
    // Menú de usuario
    const userButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');
    
    if (userButton && userDropdown) {
      userButton.addEventListener('click', function() {
        userDropdown.classList.toggle('hidden');
      });
    }
  });
</script>