<?php

// Obtener todos los eventos de una vez
$eventos = get_field('eventos');
$imagen_fondo = get_field('imagen_fondo');
$imagen_fondo_url = $imagen_fondo && isset($imagen_fondo['url']) ? $imagen_fondo['url'] : '';
?>

<!-- Cabecera con imagen de fondo difuminada -->
<div class="relative full-width py-4" style="background-image: url('<?php echo esc_url($imagen_fondo_url); ?>'); background-size: cover; background-position: center;">
    <!-- Overlay para el efecto difuminado -->
    <div class="absolute inset-0 bg-[#856da2] bg-opacity-80"></div>
    
    <div class="text-center relative z-10 text-white">
        <h1 class="text-3xl font-bold mb-2 text-white">Próximos Eventos ACOP</h1>
        <p class="text-base max-w-3xl mx-auto">Mantente actualizado con las mejores conferencias, congresos y encuentros especializados en odontología pediátrica.</p>
    </div>
</div>

<!-- Breadcrumbs -->
<div class="border-b py-3">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm">
            <a href="#" class="text-gray-700">Eventos ACOP</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-500">Responsabilidad social</span>
        </div>
    </div>
</div>

<!-- Contenido principal -->
<div class="container mx-auto px-4 py-6">
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
                <!-- Tarjeta de evento - estilo exacto como en la imagen -->
                <div class="mb-8 bg-white rounded-lg overflow-hidden shadow-sm border" style="box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                    <div class="grid md:grid-cols-2">
                        <div class="bg-gray-100">
                            <?php if($imagen_url): ?>
                                <img src="<?php echo esc_url($imagen_url); ?>" alt="<?php echo esc_attr($titulo); ?>" class="w-full h-full object-cover">
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
                            
                            <!-- Subtítulo (XII Encuentro de Residentes) -->
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
                            <a href="<?php echo esc_url($url_boton); ?>" class="inline-block bg-green-500 hover:bg-green-600 text-white px-5 py-1.5 rounded-full transition-colors duration-300 text-xs font-medium">
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
