<?php
$titulo_quienes_somos = get_field('titulo_quienes_somos');
$descripcion_quienes_somos = get_field('descripcion_quienes_somos');
$texto_especialidad = get_field('texto_especialidad');
$titulo_vision = get_field('titulo_vision');
$descripcion_vision = get_field('descripcion_vision');
$imagen_vision = get_field('imagen_vision');
$titulo_mision = get_field('titulo_mision');
$descripcion_mision = get_field('descripcion_mision');
$imagen_mision = get_field('imagen_mision');
?>

<!-- Navegación con separadores -->
<nav class="container mx-auto py-8 px-6">
  <ul class="flex justify-center items-center flex-wrap text-slate-800">
    <li class="font-medium hover:text-blue-600 transition-colors duration-300 cursor-pointer">Comité ejecutivo</li>
    <li class="mx-4 text-slate-400">/</li>
    <li class="font-semibold text-blue-600">Quiénes somos</li>
    <li class="mx-4 text-slate-400">/</li>
    <li class="font-medium hover:text-blue-600 transition-colors duration-300 cursor-pointer">Miembros</li>
    <li class="mx-4 text-slate-400">/</li>
    <li class="font-medium hover:text-blue-600 transition-colors duration-300 cursor-pointer">biblioteca</li>
    <li class="mx-4 text-slate-400">/</li>
    <li class="font-medium hover:text-blue-600 transition-colors duration-300 cursor-pointer">Información legal</li>
  </ul>
</nav>

<!-- Sección Principal - Quiénes Somos -->
<section class="relative overflow-hidden">
  <!-- Imagen decorativa izquierda con gradiente -->
  <div class="hidden lg:block absolute left-0 top-0 h-full w-1/5 opacity-20 pointer-events-none overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white to-transparent z-10"></div>
    <img src="<?php echo ($imagen_vision['url']); ?>" alt="" class="h-full w-full object-cover object-center max-h-screen" aria-hidden="true" />
  </div>
  
  <!-- Imagen decorativa derecha con gradiente -->
  <div class="hidden lg:block absolute right-0 top-0 h-full w-1/5 opacity-20 pointer-events-none overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-l from-white via-white to-transparent z-10"></div>
    <img src="<?php echo ($imagen_mision['url']); ?>" alt="" class="h-full w-full object-cover object-center max-h-screen" aria-hidden="true" />
  </div>
  
  <!-- Contenedor de contenido -->
  <div class="container mx-auto px-4 py-8 relative z-20">
    <!-- Título de la sección -->
    <h1 class="text-3xl font-bold text-center mb-8"><?php echo $titulo_quienes_somos; ?>:</h1>
    
    <!-- Descripción de ACOP -->
    <div class="max-w-3xl mx-auto text-center mb-16">
      <p class="mb-8 leading-relaxed text-base">
        <?php echo $descripcion_quienes_somos; ?>
      </p>
      
      <p class="leading-relaxed text-base">
        <?php echo $texto_especialidad; ?>
      </p>
    </div>
    
    <!-- Sección Visión -->
    <div class="flex flex-col md:flex-row items-start justify-between mb-20 max-w-5xl mx-auto">
      <div class="md:w-3/5 mb-8 md:mb-0 md:pr-12">
        <h2 class="text-2xl font-bold mb-4"><?php echo $titulo_vision; ?></h2>
        <p class="leading-relaxed text-base">
          <?php echo $descripcion_vision; ?>
        </p>
      </div>
      <div class="md:w-2/5">
        <img src="<?php echo ($imagen_vision['url']); ?>" alt="Equipo de profesionales" class="w-full rounded-lg" />
      </div>
    </div>
    
    <!-- Sección Misión -->
    <div class="flex flex-col md:flex-row items-start justify-between max-w-5xl mx-auto">
      <div class="md:w-2/5 order-2 md:order-1">
        <img src="<?php echo $imagen_mision['url']; ?>" alt="Dentistas profesionales" class="w-full rounded-lg" />
      </div>
      <div class="md:w-3/5 mb-8 md:mb-0 md:pl-12 order-1 md:order-2">
        <h2 class="text-2xl font-bold mb-4"><?php echo $titulo_mision; ?></h2>
        <p class="leading-relaxed text-base">
          <?php echo $descripcion_mision; ?>
        </p>
      </div>
    </div>
  </div>
</section>