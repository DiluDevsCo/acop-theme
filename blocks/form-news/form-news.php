<?php
$title = get_field('title');
$form_update = get_field('form_update');
$principal_image = get_field('principal_image');
$background_image = get_field('background_image');
?>

<div class="form-news-wrapper">
  <section 
    class="form-news-section relative flex flex-col justify-center p-4 md:px-8 md:py-16 min-h-[500px] bg-cover bg-center bg-no-repeat"
    style="background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url('<?php echo esc_url($background_image); ?>');"
  >
    <!-- Contenedor principal -->
    <div class="max-w-7xl mx-auto w-full">
      <div class="flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-12">
        
        <!-- Columna del formulario -->
        <div class="flex flex-col gap-6 w-full lg:w-2/5 order-2 lg:order-1">
          <!-- Título -->
          <?php if ($title): ?>
            <div class="text-center lg:text-left">
              <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 leading-tight">
                <?php echo esc_html($title); ?>
              </h2>
            </div>
          <?php endif; ?>

          <!-- Formulario Contact Form 7 -->
          <div class="form-container">
            <?php if ($form_update): ?>
              <!-- Shortcode del formulario desde ACF -->
              <div class="newsletter-form-wrapper">
                <?php echo do_shortcode($form_update); ?>
              </div>
            <?php else: ?>
              <!-- Mensaje si no hay formulario configurado -->
              <div class="bg-[#5A3D82] p-6 rounded-2xl text-white text-center">
                <p>Por favor, configura el shortcode del formulario en el campo ACF.</p>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Columna de la imagen -->
        <div class="w-full lg:w-3/5 order-1 lg:order-2">
          <?php if ($principal_image): ?>
            <div class="relative">
              <img 
                src="<?php echo esc_url($principal_image); ?>" 
                alt="<?php echo esc_attr($title ?: 'Imagen principal'); ?>"
                class="w-full h-auto max-w-lg mx-auto lg:max-w-none lg:ml-auto rounded-2xl shadow-2xl object-cover"
                loading="lazy"
              >
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</div>