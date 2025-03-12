<?php
$current_user = wp_get_current_user();
$current_header = sculapp_get_header($current_user);  

if (is_array($current_header)) {
  $logo_link = $current_header['logo_link'];
  $menu = $current_header['menu'];
  $user_menu = $current_header['user_menu'];
  $show_search = $current_header['show_search'];
  $show_cart = $current_header['show_cart'];
}else{
  $logo_link = null;
  $menu = null;
  $user_menu = null;
  $show_search = null;
  $show_cart = null;
}

$login_data = get_field('login_url','option');
if ($login_data) {
  $login_url = $login_data;
} else {
  $login_url = array(
    'url' => wp_login_url('/'),
    'title' => 'Ingresar'
  );
}

$register_data = get_field('register_url','option');

if ($register_data) {
  $register_url = $register_data;
} else {
  $register_url = array(
    'url' => wp_registration_url('/'),
    'title' => 'Regístrate'
  );
}

$logo_image = get_field('image', 'option') ? get_field('image', 'option') : null;
$show_enter = get_field('show_enter', 'option');
$show_register = get_field('show_register', 'option');

if (is_user_logged_in()):
  $avatar_url = get_avatar_url($current_user->ID, array('default'=> '404','size'=>80));
  $handle = curl_init($avatar_url);
curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

/* Get the HTML or whatever is linked in $url. */
$response = curl_exec($handle);
/* Check for 404 (file not found). */
$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
if($httpCode == 404) {
  /* Handle 404 here. */
  $avatar = '<div class="block rounded-full h-8 w-8 border-white border-2 border-solid outline outline-1 outline-black bg-purple text-white flex items-center justify-center font-bold text-xs">
                '.$current_user->user_firstname[0].$current_user->user_lastname[0].'
              </div>';
} else {
if ($avatar_url != "") {
  $avatar = '<img alt="'.$current_user->user_firstname.' '.$current_user->user_lastname.'"
  src="'.$avatar_url.'" class="h-8 w-8 rounded-full object-cover" />';
  }
}

curl_close($handle);

  
endif;
  
$menu_html = "";
if ($menu):
  ob_start();
 
  wp_nav_menu(
    array(
      'theme_location' => '',
      'container' => '',
      'menu'        => $menu,
      'menu_class'        => 'flex flex-col gap-2 items-start md:group-[.mobile]:hidden lg:group-[.mobile]:flex md:flex-row md:ml-10 md:items-center',
      'items_wrap'           => '<div role="menu" class="%2$s">%3$s</div>',
      'before'     => '<div data-header-submenu class="relative w-full md:w-auto {groupClass}">',
      'after' => '</div>',
      'link_current_class' => 'inline-block md:block whitespace-nowrap text-white border border-white border-solid rounded-3xl px-3 py-2 text-lg md:text-sm font-medium',
      'link_class' => 'block whitespace-nowrap text-white rounded-3xl border border-white/0 border-solid bg-white/0 hover:bg-blue-50/20 transition-colors hover:text-white px-3 py-2 text-lg md:text-base font-medium',
      'walker' => new Sculapp_Menu_Walker
    )
  );
  $menu_html = ob_get_clean();
endif;

$user_menu_html = "";
if ($user_menu):
  ob_start();
  wp_nav_menu(
    array(
      'theme_location' => '',
      'container' => '',
      'menu'        => $user_menu,
      'menu_class'        => '',
      'items_wrap'           => '%3$s',
      'before'     => '<li class="rounded-full lg:rounded-none group/item bg-white/0 hover:bg-purple-50/20 transition-colors duration-300">',
      'before_current'     => '<li class="rounded-full lg:rounded-none group/item bg-purple-50/20 bg-white/0 hover:bg-purple-50/20 transition-colors duration-300">',
      'after' => '</li>',
      'link_current_class' => 'block px-4 py-2 text-sm text-gray-700 font-bold transition-transform group-hover/item:text-purple-700 group-hover/item:translate-x-2',
      'link_class' => 'block px-4 py-2 text-sm text-gray-700 transition-transform group-hover/item:text-purple-700 group-hover/item:translate-x-2',
      'walker' => new Sculapp_Menu_Walker
    )
  );
  $user_menu_html = ob_get_clean();
  $logout_url = esc_url(wp_logout_url('/'));
  $loggout = '<li class="rounded-full lg:rounded-none group/item bg-white/0 hover:bg-purple-50/20 transition-colors duration-300"><a href="'.$logout_url.'" class="block px-4 py-2 text-sm text-gray-700 transition-transform group-hover/item:text-purple-700 group-hover/item:translate-x-2" role="menuitem"
  tabindex="-1">Salir</a></li>';
  $user_menu_html .= $loggout;
endif;
?>
<nav data-sculapp-header
  class="main-header sticky duration-300 inset-0 z-50 block h-max w-full max-w-full rounded-none bg-[#001c30] transition-shadow backdrop-blur-2xl backdrop-saturate-200">
  <div class="container-fluid">
    <div class="flex h-16 justify-between">
      <div class="flex items-center gap-x-12">
        <div class="flex-shrink-0">
          <a href="<?php echo $logo_link['url']; ?>">
            <?php
            if ($logo_image != null) {
              echo wp_get_attachment_image($logo_image, array(1412, 400), false, array('class' => 'cover block h-12 sm:h-20 w-auto'));
            } else {
              include get_stylesheet_directory() . '/components/global/logo.php';
            }
            ?>
          </a>
        </div>
        <div class="hidden md:block">
          <?php echo $menu_html; ?>
        </div>
      </div>
      <div class="flex items-center">
        <?php  // Mostrar buscador
        if ($show_search && shortcode_exists('wpdreams_ajaxsearchlite')) :
        ?>
        <div class="relative hidden md:flex justify-end flex-grow">
          <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
        </div>
        <?php
        endif;
        // Mostrar carrito
        if ($show_cart) :
          echo $cart_html;
        endif;
        ?>

        <?php if (is_user_logged_in()) : ?>
        <!-- Profile dropdown -->
        <div class="lg:relative ml-3 h-full flex items-center">
          <div class="my-2">
            <button type="button"
              class="hidden md:flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
              id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="sr-only">Abrir menu de usuario</span>
              <!-- aqui iba el Avatar -->
              <?php fr_render_button(array(
                'label' => 'Iniciar sesión',
                'url' => 'https://app.cursofuturosresidentes.com',
                'style' => 'btn_login',
                'icon' => 'icon_login',
                'size' => 'xl-login',
              ))?>
            </button>
          </div>
          <ul data-header-user-menu role="menu" aria-labelledby="user-menu-button"
            class="block bg-gray-50 py-4 px-5 lg:py-0 lg:px-0 top-full left-0 lg:left-auto w-full invisible list-none absolute lg:right-0 z-10 lg:w-48 lg:origin-top-right rounded-md rounded-t-none lg:bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
            <li class="block px-4 py-2 lg:bg-gray-100">
              <div class="text-base font-medium leading-none">
                <?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?></div>
              <div class="text-sm font-medium leading-none text-gray-400">
                <?php echo $current_user->user_email; ?>
              </div>
            </li>
            <?php echo $user_menu_html; ?>
          </ul>
        </div>
        <?php else : 
        if ($show_enter && $login_url['title']!='') {?>
        <!-- Profile dropdown -->
        <div class="lg:relative ml-3 h-full flex items-center">
          <div class="my-2">
            <button type="button"
              class="hidden md:flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
              id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="sr-only">Abrir menu de usuario</span>
              <!-- aqui iba el Avatar -->
              <?php fr_render_button(array(
                'label' => 'Iniciar sesión',
                'url' => 'https://app.cursofuturosresidentes.com',
                'style' => 'btn_login',
                'icon' => 'icon_login',
                'size' => 'xl-login',
              ))?>
            </button>
          </div>
          <ul data-header-user-menu role="menu" aria-labelledby="user-menu-button"
            class="block bg-gray-50 py-4 px-5 lg:py-0 lg:px-0 top-full left-0 lg:left-auto w-full invisible list-none absolute lg:right-0 z-10 lg:w-48 lg:origin-top-right rounded-md rounded-t-none lg:bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
            <li class="block px-4 py-2 lg:bg-gray-100">
              <div class="text-base font-medium leading-none">
                <?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?></div>
              <div class="text-sm font-medium leading-none text-gray-400">
                <?php echo $current_user->user_email; ?>
              </div>
            </li>
            <?php echo $user_menu_html; ?>
          </ul>
        </div>
        <?php }?>
        <?php endif; ?>
        <div class="ml-4 -mr-2 flex md:hidden">
          <!-- Mobile toggle menu button -->
          <button data-header-toggle-menu type="button"
            class="inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-black hover:text-white focus:outline-none focus:ring-1 focus:ring-white focus:ring-offset-1 focus:ring-offset-black"
            aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Abrir menú principal</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div data-header-mobile-menu class="hidden lg:hidden">
    <div class="group mobile space-y-1 px-2 pb-3 pt-2 sm:px-3">
      <?php echo $menu_html; ?>
    </div>
    <?php if (!is_user_logged_in()) : ?>
    <?php if (($show_enter && $login_url['title']!='')) {?>
    <div class="grid gap-2 mt-3 pb-10 px-2">
      <?php if ($show_enter && $login_url['title']!='') {?>
      <a href="<?php echo $login_url['url'];?>"
        class="border border-solid border-white flex items-center justify-center middle none center rounded-full py-3 px-6 font-sans font-bold text-white transition-all bg-white/0 hover:bg-purple-50/20 transition-colors duration-3000/10 active:bg-violet-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        data-ripple-dark="true">
        <span><?php echo $login_url['title'];?></span>
      </a>
      <?php }?>
    </div>
    <?php } ?>
    <?php endif; ?>
  </div>
</nav>