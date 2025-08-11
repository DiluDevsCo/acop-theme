<?php

// Obtener todos los eventos de una vez
$eventos_responsabilidad = get_field('eventos_y_responsabilidad');
$imagen_fondo = get_field('imagen_fondo');

// Extraer eventos y responsabilidad social
$eventos = $eventos_responsabilidad[0]['eventos'] ?? array();
$responsabilidad_social = $eventos_responsabilidad[0]['responsabilidad_social'] ?? array();
?>

<!-- Breadcrumbs -->
<div class="container mx-auto py-8 px-6">
  <ul class="flex justify-center items-center flex-wrap text-slate-800">
    <li data-tab="eventos-acop" class="tab-link font-semibold text-blue-600 cursor-pointer list-none">Eventos ACOP</li>
    <li class="mx-4 text-slate-400 separator list-none">/</li>
    <li data-tab="responsabilidad-social" class="tab-link font-medium hover:text-blue-600 transition-colors duration-300 cursor-pointer list-none">Responsabilidad social</li>
  </ul>
</div>

<!-- Contenido principal -->
<div class="">
    <!-- Tab content para Eventos ACOP -->
    <div id="eventos-acop" class="tab-pane">
        <h2 class="text-2xl font-bold text-center mb-8">Eventos ACOP</h2>

        <div class="max-w-4xl mx-auto">
            <?php
            // Verifica si hay eventos
            if($eventos && is_array($eventos) && count($eventos) > 0):
                // Itera a través de cada evento
                foreach($eventos as $evento):
                    // Obtiene los valores
                    $titulo = $evento['titulo_evento'];
                    $subtitulo = isset($evento['subtitulo_evento']) ? $evento['subtitulo_evento'] : '';
                    $lugar = $evento['lugar_evento'];
                    $fecha = $evento['fecha_evento'];
                    $ano = $evento['ano_evento'];
                    $pais = $evento['pais_evento'];
                    $exclusivo = $evento['texto_exclusivo'];
                    $imagen_url = $evento['imagen_evento'];
                    $texto_boton = $evento['boton_label'] ?: 'Inscríbete';
                    $url_boton = $evento['boton_url'] ?: '#';
            ?>
                    <!-- Tarjeta de evento -->
                    <div class="mb-8 bg-white rounded-lg overflow-hidden shadow-md border">
                        <div class="grid md:grid-cols-2 p-4">
                            <div class="">
                                <?php if($imagen_url): ?>
                                    <img src="<?php echo esc_url($imagen_url); ?>" alt="<?php echo esc_attr($titulo); ?>" class="w-full rounded-lg h-full object-cover">
                                <?php endif; ?>
                            </div>
                            <div class="p-5">
                                <!-- Año y fecha -->
                                <div class="mb-3">
                                    <p class="text-gray-600 text-sm"><?php echo esc_html($ano); ?></p>
                                    <p class="text-gray-600 text-sm"><?php echo esc_html($fecha); ?></p>
                                </div>
                                
                                <!-- Título -->
                                <h3 class="text-base font-bold mb-2"><?php echo esc_html($titulo); ?></h3>
                                
                                <!-- Subtítulo -->
                                <?php if($subtitulo): ?>
                                    <p class="mb-3 text-sm"><?php echo esc_html($subtitulo); ?></p>
                                <?php endif; ?>
                                
                                <!-- Lugar -->
                                <?php if($lugar): ?>
                                    <p class="mb-3 text-sm">
                                        <strong>Lugar:</strong> <?php echo esc_html($lugar); ?>
                                        <?php if($pais): ?> - <?php echo esc_html($pais); ?><?php endif; ?>
                                    </p>
                                <?php endif; ?>
                                
                                <!-- Texto exclusivo -->
                                <?php if($exclusivo): ?>
                                    <p class="font-medium mb-3 text-sm"><?php echo esc_html($exclusivo); ?></p>
                                <?php endif; ?>
                                
                                <!-- Botón -->
                                <a href="<?php echo esc_url($url_boton); ?>" class="inline-block bg-[#B7C805] hover:bg-[#B7C805]/90 text-white px-8 py-1.5 rounded-full transition-colors duration-300 text-xs font-medium">
                                    <?php echo esc_html($texto_boton); ?>
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            else:
                echo '<p class="text-center">No hay eventos programados actualmente.</p>';
            endif;
            ?>
        </div>
    </div>

    <!-- Tab content para Responsabilidad Social -->
    <div id="responsabilidad-social" class="tab-pane hidden">
        <h2 class="text-2xl font-bold text-center mb-8">Responsabilidad Social</h2>

        <div class="max-w-4xl mx-auto">
            <?php
            // Verifica si hay eventos de responsabilidad social
            if($responsabilidad_social && is_array($responsabilidad_social) && count($responsabilidad_social) > 0):
                // Itera a través de cada evento de responsabilidad social
                foreach($responsabilidad_social as $evento):
                    // Obtiene los valores
                    $titulo = $evento['titulo_evento'];
                    $subtitulo = isset($evento['subtitulo_evento']) ? $evento['subtitulo_evento'] : '';
                    $lugar = $evento['lugar_evento'];
                    $fecha = $evento['fecha_evento'];
                    $ano = $evento['ano_evento'];
                    $pais = $evento['pais_evento'];
                    $exclusivo = $evento['texto_exclusivo'];
                    $imagen_url = $evento['imagen_evento'];
                    $texto_boton = $evento['boton_label'] ?: 'Inscríbete';
                    $url_boton = $evento['boton_url'] ?: '#';
            ?>
                    <!-- Tarjeta de evento -->
                    <div class="mb-8 bg-white rounded-lg overflow-hidden shadow-md border">
                        <div class="grid md:grid-cols-2 p-4">
                            <div class="">
                                <?php if($imagen_url): ?>
                                    <img src="<?php echo esc_url($imagen_url); ?>" alt="<?php echo esc_attr($titulo); ?>" class="w-full rounded-lg h-full object-cover">
                                <?php endif; ?>
                            </div>
                            <div class="p-5">
                                <!-- Año y fecha -->
                                <div class="mb-3">
                                    <p class="text-gray-600 text-sm"><?php echo esc_html($ano); ?></p>
                                    <p class="text-gray-600 text-sm"><?php echo esc_html($fecha); ?></p>
                                </div>
                                
                                <!-- Título -->
                                <h3 class="text-base font-bold mb-2"><?php echo esc_html($titulo); ?></h3>
                                
                                <!-- Subtítulo -->
                                <?php if($subtitulo): ?>
                                    <p class="mb-3 text-sm"><?php echo esc_html($subtitulo); ?></p>
                                <?php endif; ?>
                                
                                <!-- Lugar -->
                                <?php if($lugar): ?>
                                    <p class="mb-3 text-sm">
                                        <strong>Lugar:</strong> <?php echo esc_html($lugar); ?>
                                        <?php if($pais): ?> - <?php echo esc_html($pais); ?><?php endif; ?>
                                    </p>
                                <?php endif; ?>
                                
                                <!-- Texto exclusivo -->
                                <?php if($exclusivo): ?>
                                    <p class="font-medium mb-3 text-sm"><?php echo esc_html($exclusivo); ?></p>
                                <?php endif; ?>
                                
                                <!-- Botón -->
                                <a href="<?php echo esc_url($url_boton); ?>" class="inline-block bg-[#B7C805] hover:bg-[#B7C805]/90 text-white px-8 py-1.5 rounded-full transition-colors duration-300 text-xs font-medium">
                                    <?php echo esc_html($texto_boton); ?>
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            else:
                echo '<p class="text-center">No hay eventos de responsabilidad social programados actualmente.</p>';
            endif;
            ?>
        </div>
    </div>
</div>

<!-- JavaScript para tabs -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Seleccionar todos los enlaces de tabs
  const tabLinks = document.querySelectorAll('.tab-link');
  const tabPanes = document.querySelectorAll('.tab-pane');
  
  // Agregar event listener a cada enlace
  tabLinks.forEach(link => {
    link.addEventListener('click', function() {
      // Remover clase activa de todos los enlaces
      tabLinks.forEach(item => {
        item.classList.remove('text-blue-600', 'font-semibold');
        item.classList.add('font-medium', 'hover:text-blue-600', 'transition-colors', 'duration-300');
      });
      
      // Agregar clase activa al enlace clickeado
      this.classList.add('text-blue-600', 'font-semibold');
      this.classList.remove('font-medium', 'hover:text-blue-600', 'transition-colors', 'duration-300');
      
      // Ocultar todos los paneles
      tabPanes.forEach(pane => {
        pane.classList.add('hidden');
      });
      
      // Mostrar el panel correspondiente
      const tabId = this.getAttribute('data-tab');
      document.getElementById(tabId).classList.remove('hidden');
    });
  });
});
</script>