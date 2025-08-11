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

<footer class="bg-white border-t-4 border-[#01A3DE] mt-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Contenido principal del footer -->
    <div class="py-12 lg:py-16">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
        
        <!-- Sección: Somos ACOP -->
        <div class="space-y-6 lg:col-span-1">
          <div>
            <h3 class="text-gray-900 text-xl lg:text-2xl font-bold mb-4 leading-tight">
              Somos ACOP:
            </h3>
            <p class="text-gray-600 text-sm lg:text-base leading-relaxed">
              La academia colombiana de odontología pediátrica, ACOP es una asociación de personas sin ánimo de lucro, y cuyo interés social radica en las áreas del ejercicio profesional, la educación y/o la investigación, relacionadas con la especialidad de la odontología pediátrica para el beneficio de la salud oral de la población a través de los esfuerzos de la profesión odontológica.
            </p>
          </div>
          
          <!-- Logos -->
          <div class="flex items-center gap-4 pt-4">
            <div class="flex-shrink-0 w-20 h-20 lg:w-24 lg:h-24">
              <img 
                src="https://www.acop.com.co/wp-content/uploads/2019/11/Logo-ACOPs.svg" 
                alt="Logo ACOP" 
                class="w-full h-full object-contain transition-transform duration-200 hover:scale-105"
                loading="lazy"
              >
            </div>
            <div class="flex-shrink-0 w-24 h-20 lg:w-28 lg:h-24">
              <img 
                src="https://www.alopodontopediatria.org/wp-content/uploads/Logo-ALOP.png" 
                alt="Logo ALOP" 
                class="w-full h-full object-contain transition-transform duration-200 hover:scale-105"
                loading="lazy"
              >
            </div>
          </div>
        </div>
        
        <!-- Sección: Información de contacto -->
        <div class="space-y-6">
          <h3 class="text-gray-900 text-xl lg:text-2xl font-bold leading-tight">
            Información de contacto
          </h3>
          
          <div class="space-y-4">
            <!-- Email -->
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-[#01A3DE] mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
              </svg>
              <a 
                href="mailto:info@www.acop.com.co" 
                class="text-gray-600 hover:text-[#01A3DE] transition-colors duration-200 text-sm lg:text-base break-all"
              >
                info@www.acop.com.co
              </a>
            </div>
            
            <!-- Teléfono -->
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-[#01A3DE] mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
              </svg>
              <span class="text-gray-600 text-sm lg:text-base">(57) 317 6654728</span>
            </div>
            
            <!-- Dirección -->
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-[#01A3DE] mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
              </svg>
              <span class="text-gray-600 text-sm lg:text-base leading-relaxed">
                Calle 112 # 14 - 65 Oficina 205<br>
                Bogotá, Colombia
              </span>
            </div>
          </div>
          
          <div class="pt-2">
            <p class="text-gray-700 font-medium text-sm lg:text-base">Hacemos parte de:</p>
          </div>
        </div>
        
        <!-- Sección: Accesos rápidos -->
        <div class="space-y-6">
          <h3 class="text-gray-900 text-xl lg:text-2xl font-bold leading-tight">
            Accesos rápidos
          </h3>
          
          <nav>
            <ul class="space-y-3">
              <li>
                <a 
                  href="#" 
                  class="text-gray-600 hover:text-[#01A3DE] transition-colors duration-200 text-sm lg:text-base inline-flex items-center group"
                >
                  <span>Salud bucal</span>
                  <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                  </svg>
                </a>
              </li>
              <li>
                <a 
                  href="#" 
                  class="text-gray-600 hover:text-[#01A3DE] transition-colors duration-200 text-sm lg:text-base inline-flex items-center group"
                >
                  <span>Miembros</span>
                  <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                  </svg>
                </a>
              </li>
              <li>
                <a 
                  href="#" 
                  class="text-gray-600 hover:text-[#01A3DE] transition-colors duration-200 text-sm lg:text-base inline-flex items-center group"
                >
                  <span>Eventos</span>
                  <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                  </svg>
                </a>
              </li>
              <li>
                <a 
                  href="#" 
                  class="text-gray-600 hover:text-[#01A3DE] transition-colors duration-200 text-sm lg:text-base inline-flex items-center group"
                >
                  <span>Blog</span>
                  <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                  </svg>
                </a>
              </li>
            </ul>
          </nav>
          
          <!-- Redes sociales -->
          <div class="pt-4">
            <p class="text-gray-700 font-medium text-sm lg:text-base mb-3">Síguenos en:</p>
            <div class="flex gap-3">
              <a 
                href="#" 
                class="w-10 h-10 bg-[#01A3DE] hover:bg-[#0087BD] text-white rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-lg"
                aria-label="Facebook"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
              <a 
                href="#" 
                class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-lg"
                aria-label="Instagram"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
              </a>
              <a 
                href="#" 
                class="w-10 h-10 bg-red-600 hover:bg-red-700 text-white rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-lg"
                aria-label="YouTube"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Barra de colores decorativa -->
    <div class="flex h-2 overflow-hidden">
      <div class="bg-[#49BFED] w-1/4 transition-all duration-300"></div>
      <div class="bg-[#01A3DE] flex-1 transition-all duration-300"></div>
    </div>
    
    <!-- Copyright (opcional) -->
    <div class="py-6 border-t border-gray-200 mt-2">
      <div class="text-center">
        <p class="text-gray-500 text-sm">
          © <?php echo date('Y'); ?> ACOP - Academia Colombiana de Odontología Pediátrica. Todos los derechos reservados.
        </p>
      </div>
    </div>
  </div>
</footer>

<?php endif; // ! is_page_template( 'page-template-blank.php' ) 
?>

</div>

<?php wp_footer(); ?>
</body>

</html>