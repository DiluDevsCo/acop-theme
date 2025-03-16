<?php
if (et_theme_builder_overrides_layout(ET_THEME_BUILDER_HEADER_LAYOUT_POST_TYPE) || et_theme_builder_overrides_layout(ET_THEME_BUILDER_FOOTER_LAYOUT_POST_TYPE)) {
 // Skip rendering anything as this partial is being buffered anyway.
 // In addition, avoids get_sidebar() issues since that uses
 // locate_template() with require_once.
 return;
}

/**
 * Fires after the main content, before the footer is output.
 *
 * @since 3.10
 */
do_action('et_after_main_content');
if (!is_page_template('page-template-blank.php')) : ?>

 <footer class="bg-transparent border-t-8 border-[#01A3DE]">
  <div class="">
   <div class="container-fluid p-4 justify-between footer-top flex flex-col flex-grow md:flex-row  py-8 text-black gap-x-14 gap-y-8 bg-red w-full">
    <!--  Div de SOMOS ACOP  -->
    <div class="flex flex-col w-1/4 justify-between">
     <div>
      <h3 class="text-black pb-[2px] text-2xl font-bold">Somos ACOP:</h3>
      <p>La academia colombiana de odontología pediátrica, ACOP es una asociación de personas sin ánimo de lucro, y cuyo interés social radica en las áreas del ejercicio profesional, la educación y/o la investigación, relacionadas con la especialidad de la odontología pediátrica para el beneficio de la salud oral de la población a través de los esfuerzos de la profesión odontológica</p>
     </div>
     <div class="flex flex-row"> 
      <!--  TODO: Verificar tamaño de los logos  -->
      <div class="w-1/3"><img src="https://www.acop.com.co/wp-content/uploads/2019/11/Logo-ACOPs.svg" alt=""></div>
      <div class="w-full"><img src="https://www.alopodontopediatria.org/wp-content/uploads/Logo-ALOP.png" alt=""></div>
     </div>
    </div>
    <!--  Div de Información de contacto  -->
    <div class="flex flex-col md:flex-wrap w-1/4">
     <h3 class="text-black pb-[2px] text-2xl font-bold">Información de contacto</h3>
     <ul class="flex flex-col gap-x-12 mt-2 p-0">
      <a href="/">info@www.acop.com.co</a>
      <p>(57) 317 6654728</p>
      <p>Calle 112 # 14 - 65 Oficina 205 Bogotá, Colombia</p>
     </ul>
     <h3 class="text-black pb-[2px]">Hacemos parte de:</h3>
    </div>
    <!--  Div de accesos rápidos  -->
    <div class="flex flex-col justify-between w-1/4">
      <h3 class="text-black pb-[2px] text-2xl font-bold">Accesos rápidos</h3>
      <ul role="menu" class="flex flex-col gap-2 items-start list-none p-0 m-0 mb-3">
       <a id="menu-item-8960" href="#" class="text-black underline underline-offset-2" role="menu-item">Salud bucal</a>
       <a id="menu-item-8961" href="#" class="text-black underline underline-offset-2" role="menu-item">Miembros</a>
       <a id="menu-item-8961" href="#" class="text-black underline underline-offset-2" role="menu-item">Eventos</a>
       <a id="menu-item-8961" href="#" class="text-black underline underline-offset-2" role="menu-item">Blog</a>
      </ul>
      <div class="mt-4 flex flex-row">
      <span class="dashicons dashicons-facebook"></span>
      <span class="dashicons dashicons-instagram"></span>
      <span class="dashicons dashicons-youtube"></span>
      </div>
    </div>

   </div>
  </div>
  
  <!--  Div de rectangulo de colores  -->
  <div class="w-full flex flex-row h-5">
   <div class="!bg-[#49BFED] w-1/4 h-5"></div>
   <div class="!bg-[#01A3DE] w-full h-5"></div>
  </div>
 </footer>
 </div>

<?php endif; // ! is_page_template( 'page-template-blank.php' ) 
?>

</div>

<?php wp_footer(); ?>
</body>

</html>