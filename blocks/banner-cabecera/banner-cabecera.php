<?php 
$titulo_banner = get_field('titulo_banner');
$descripcion_banner = get_field('descripcion_banner');
$imagen_fondo = get_field('imagen_fondo');
?>

<!-- Cabecera con imagen de fondo difuminada -->
<div class="relative full-width py-4" style="background-image: url('<?php echo esc_url($imagen_fondo); ?>'); background-size: cover; background-position: center;">
    <!-- Overlay para el efecto difuminado -->
    <div class="absolute inset-0 bg-[#856da2] bg-opacity-80"></div>
    
    <div class="text-center relative z-10 text-white">
        <h1 class="text-3xl font-bold mb-2 text-white"><?php echo $titulo_banner; ?></h1>
        <p class="text-base max-w-3xl mx-auto"><?php echo $descripcion_banner; ?></p>
    </div>
</div>
