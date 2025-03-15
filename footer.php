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

  <footer class="bg-[#001c30]">
    <div class="">
      <div class="container-fluid p-4 justify-between footer-top flex flex-col flex-wrap md:flex-row  py-8 text-white gap-x-14 gap-y-8 bg-[#001c30]">
        <div class="">
          <div class="footer-top__logo pb-5">
            <?php
            include get_stylesheet_directory() . '/components/global/logo.php';
            ?>
          </div>
          <h3 class="text-white pb-[2px]">Encuéntranos</h3>
          <ul role="menu" class="flex flex-col gap-2 items-start list-none p-0 m-0 mb-3">
            <a id="menu-item-8962" href="https://cursofuturosresidentes.com/contactanos" class="text-white underline underline-offset-2" role="menu-item">Contáctanos</a>
          </ul>
          <div>
            <p>WhatsApp +57 301 255 55 16<br>
              info@cursofuturosresidentes.com</p>
          </div>
          <ul class="flex mt-2 p-0 gap-4 items-center flex-wrap">
            <li><a href="https://www.facebook.com/Cursofuturosresidentes/" target="_blank" title="facebook">
                <?php
                acop_render_icon('facebook');
                ?>
              </a></li>
            <li><a href="https://www.tiktok.com/@cursofuturosresidentes" target="_blank" title="tiktok">
                <?php
                acop_render_icon('tiktok');
                ?>
              </a></li>
            <li><a href="https://instagram.com/cursofuturosresidentes" target="_blank" title="instagram">
                <?php
                acop_render_icon('instagram');
                ?>
              </a></li>
            <li><a href="https://web.whatsapp.com/send?phone=573012555516" target="_blank" title="whatsapp">
                <?php
                acop_render_icon('whatsapp');
                ?>
              </a></li>
            <li><a href="https://youtube.com/channel/UCrdM1faIVWia5GzwNB0_y9w" target="_blank" title="youtube">
                <?php
                acop_render_icon('youtube');
                ?>
              </a></li>
            <li><a href="https://www.linkedin.com/company/cursofuturosresidentes" target="_blank" title="linkedin">
                <?php
                acop_render_icon('linkedin');
                ?>
              </a></li>
            <li><a href="https://x.com/CursoACOPFR" target="_blank" title="x">
                <?php
                acop_render_icon('x');
                ?>
              </a></li>
            <li><a href="https://t.me/ComunidadFR" target="_blank" title="telegram">
                <?php
                  acop_render_icon('telegram');
                ?>
              </a></li>
          </ul>
        </div>

        <div class="flex flex-col md:flex-wrap">
          <h3 class="text-white pb-[2px]">Reconocidos y premiados por:</h3>
            <ul class="flex flex-col gap-x-12 md:flex-row mt-2 p-0 items-c">
              <div class="p-2">
              <li class="bg-white rounded-full p-1 w-[50px] h-[50px]">
                  <a href="https://cursofuturosresidentes.com/wp-content/uploads/2024/02/web_reconocidos_002.webp" target="_blank" title="Hechos de Talentos">
                    <img class="w-ful h-full object-fill" src="https://stagingfr.cursofuturosresidentes.com/wp-content/uploads/2024/02/web_icon_fr.webp" alt="Hechos de talentos">
                  </a>
                </li>
              </div>
              <div class="p-2">
                <li class="bg-white rounded-2xl p-1 w-[65px] h-[45px]">
                  <a href="https://cursofuturosresidentes.com/wp-content/uploads/2024/02/web_reconocidos_001.webp" target="_blank" title="Alcaldía de Medellin">
                    <img class="w-full h-full object-fill" src="https://stagingfr.cursofuturosresidentes.com/wp-content/uploads/2024/02/web_icon_fr_003.webp" alt="Alcaldía de Medellin">
                  </a>
                </li>
              </div>
              <div class="p-2">
                <li class="w-[35px] h-[60px]">
                  <a href="https://cursofuturosresidentes.com/wp-content/uploads/2024/02/web_reconocidos_004-scaled.webp" target="_blank" title="Certification badge">
                    <img class="w-full h-full object-fill" src="https://cursofuturosresidentes.com/wp-content/uploads/2024/02/web_reconocidos_004-scaled.webp" alt="Great place to work">
                  </a>
                </li>
              </div>
            </ul>
          <h3 class="text-white pb-[2px]">Hacemos parte de:</h3>
          <ul class="flex mt-2 p-0 gap- items-c">
            <li class="bg-white rounded-2xl p-1 w-[150px] h-[55px]"><a href="https://healthtechcolombia.co/miembros/futuros-residentes/" target="_blank" title="healthteach">
                <img class="w-full h-full object-fill" src="https://healthtechcolombia.co/wp-content/uploads/2022/11/logo-horizontal.png" alt="HealtTech">
              </a>
            </li>
          </ul>
        </div>

        <div class="flex flex-col justify-between">
          <div>
            <h3 class="text-white pb-[2px]">Recursos</h3>
            <ul role="menu" class="flex flex-col gap-2 items-start list-none p-0 m-0 mb-3">
              <a id="menu-item-8960" href="https://cursofuturosresidentes.com/blog/" class="text-white underline underline-offset-2" role="menu-item">Blog</a>
              <a id="menu-item-8961" href="https://t.me/ComunidadFR" class="text-white underline underline-offset-2" role="menu-item">Comunidad FR</a>
            </ul>
          </div>
          <div>
            <h3 class="text-white pb-[2px]">Aliado:</h3>
            <ul class="flex mt-2 p-0 gap- items-c">
              <li><a href="https://sculapp.com/" target="_blank" title="sculapp">
                  <?php
                  include get_stylesheet_directory() . '/components/global/logo_sculapp.php';
                  ?>
                </a>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>

    <div class="bg-white text-sm text-primary-blue-fr">
      <div class="container-fluid py-6"> <a class="underline" href="https://cursofuturosresidentes.com/terminos-y-condiciones/">Aviso legal - Términos y Condiciones </a> | Todos los derechos reservados a Sentire Taller SAS</div>
    </div>
  </footer>
  </div>

<?php endif; // ! is_page_template( 'page-template-blank.php' ) 
?>

</div>

<?php wp_footer(); ?>
</body>

</html>