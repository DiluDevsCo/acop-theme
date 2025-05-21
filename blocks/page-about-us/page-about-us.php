<?php
/**
 * Bloque: Tabs ACOP
 * 
 * Este bloque muestra los tabs de Quiénes Somos, Miembros, Comité Ejecutivo e Información Legal
 */

// Obtenemos los repetidores principales
$quienes_somos = get_field('quienes_somos');
$miembros = get_field('miembros');
$comite_ejecutivo = get_field('comite_ejecutivo');
$informacion_legal = get_field('informacion_legal');

// Inicialmente, el primer tab estará activo
$tab_activo = 'comite-ejecutivo';
?>

<!-- Navegación con separadores -->
<div class="container mx-auto py-8 px-6">
  <ul class="flex justify-center items-center flex-wrap text-slate-800">
    <li data-tab="comite-ejecutivo" class="tab-link font-semibold text-blue-600 cursor-pointer list-none">Comité ejecutivo</li>
    <li class="mx-4 text-slate-400 separator list-none">/</li>
    <li data-tab="quienes-somos" class="tab-link font-medium hover:text-blue-600 transition-colors duration-300 cursor-pointer list-none">Quiénes somos</li>
    <li class="mx-4 text-slate-400 separator list-none">/</li>
    <li data-tab="miembros" class="tab-link font-medium hover:text-blue-600 transition-colors duration-300 cursor-pointer list-none">Miembros</li>
    <li class="mx-4 text-slate-400 separator list-none">/</li>
    <li data-tab="informacion-legal" class="tab-link font-medium hover:text-blue-600 transition-colors duration-300 cursor-pointer list-none">Información legal</li>
  </ul>
</div>

<!-- Contenido de los tabs -->
<div class="tab-content">
  <!-- Tab: Comité Ejecutivo -->
  <div id="comite-ejecutivo" class="tab-pane">
    <div class="py-8">
      <h1 class="text-3xl font-bold text-center mb-16">Comité ejecutivo</h1>
      
      <?php if ($comite_ejecutivo && count($comite_ejecutivo) > 0): ?>
        <!-- Destacado principal (presidente) -->
        <?php 
        // Asumimos que el primer miembro del comité es el/la presidente/a
        $presidente = $comite_ejecutivo[0]; 
        ?>
        <div class="text-center mb-16">
          <div class="rounded-full border-[12px] border-solid border-[#5A3D82] bg-white w-52 h-52 mx-auto mb-4 flex items-center justify-center overflow-hidden">
            <?php if($presidente['imagen']): ?>
              <img src="<?php echo $presidente['imagen']; ?>" alt="<?php echo esc_attr($presidente['nombre_del_ejecutivo']); ?>" class="w-full h-full object-cover rounded-full">
            <?php endif; ?>
          </div>
          <p class="font-bold text-center text-black mb-1"><?php echo $presidente['titulo_ejecutivo']; ?></p>
          <p class="font-semibold text-black text-center text-xl"><?php echo $presidente['nombre_del_ejecutivo']; ?></p>
        </div>
        
        <!-- Otros miembros del comité -->
        <?php if (count($comite_ejecutivo) > 1): ?>
          <div class="flex flex-wrap justify-center gap-12 max-w-5xl mx-auto">
            <?php 
            // Empezamos desde el índice 1 para omitir al presidente
            for ($i = 1; $i < count($comite_ejecutivo); $i++): 
              $miembro = $comite_ejecutivo[$i];
            ?>
              <div class="text-center">
                <div class="rounded-full border-[12px] border-solid border-[#5A3D82] bg-white w-48 h-48 mx-auto mb-3 flex items-center justify-center overflow-hidden">
                  <?php if($miembro['imagen']): ?>
                    <img src="<?php echo $miembro['imagen']; ?>" alt="<?php echo esc_attr($miembro['nombre_del_ejecutivo']); ?>" class="w-full h-full object-cover rounded-full">
                  <?php endif; ?>
                </div>
                <p class="font-bold text-center text-black mb-1"><?php echo $miembro['titulo_ejecutivo']; ?></p>
                <p class="font-semibold text-black text-center"><?php echo $miembro['nombre_del_ejecutivo']; ?></p>
              </div>
            <?php endfor; ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
  
  <!-- Tab: Quiénes Somos -->
  <div id="quienes-somos" class="tab-pane hidden">
    <?php if ($quienes_somos && count($quienes_somos) > 0): ?>
      <?php 
      // Tomamos el primer elemento del repetidor (normalmente solo habrá uno)
      $quienes_datos = $quienes_somos[0]; 
      ?>
      <section class="relative overflow-hidden">
        <!-- Imagen decorativa izquierda con gradiente -->
        <!-- <div class="hidden lg:block absolute left-0 top-0 h-full w-1/5 opacity-20 pointer-events-none overflow-hidden">
          <div class="absolute inset-0 bg-gradient-to-r from-white via-white to-transparent z-10"></div>
          <img src="<?php echo $quienes_datos['imagen_vision']['url']; ?>" alt="" class="h-full w-full object-cover object-center max-h-screen" aria-hidden="true" />
        </div> -->
        
        <!-- Imagen decorativa derecha con gradiente -->
        <!-- <div class="hidden lg:block absolute right-0 top-0 h-full w-1/5 opacity-20 pointer-events-none overflow-hidden">
          <div class="absolute inset-0 bg-gradient-to-l from-white via-white to-transparent z-10"></div>
          <img src="<?php echo $quienes_datos['imagen_mision']['url']; ?>" alt="" class="h-full w-full object-cover object-center max-h-screen" aria-hidden="true" />
        </div> -->
        
        <!-- Contenedor de contenido -->
        <div class="py-8 relative z-20">
          <!-- Título de la sección -->
          <h1 class="text-3xl font-bold text-center mb-8"><?php echo $quienes_datos['titulo_quienes_somos']; ?>:</h1>
          
          <!-- Descripción de ACOP -->
          <div class="max-w-3xl mx-auto text-center mb-16">
            <div class="mb-8 leading-relaxed text-base">
              <?php echo $quienes_datos['descripcion_quienes_somos']; ?>
            </div>
          </div>
          
          <!-- Sección Visión -->
          <div class="flex flex-col md:flex-row items-start justify-between mb-20 max-w-5xl mx-auto">
            <div class="md:w-3/5 mb-8 md:mb-0 md:pr-12">
              <h2 class="text-2xl font-bold mb-4"><?php echo $quienes_datos['titulo_vision']; ?></h2>
              <div class="leading-relaxed text-base">
                <?php echo $quienes_datos['descripcion_vision']; ?>
              </div>
            </div>
            <div class="md:w-2/5">
              <img src="<?php echo $quienes_datos['imagen_vision']['url']; ?>" alt="Equipo de profesionales" class="w-full rounded-lg" />
            </div>
          </div>
          
          <!-- Sección Misión -->
          <div class="flex flex-col md:flex-row items-start justify-between max-w-5xl mx-auto">
            <div class="md:w-2/5 order-2 md:order-1">
              <img src="<?php echo $quienes_datos['imagen_mision']['url']; ?>" alt="Dentistas profesionales" class="w-full rounded-lg" />
            </div>
            <div class="md:w-3/5 mb-8 md:mb-0 md:pl-12 order-1 md:order-2">
              <h2 class="text-2xl font-bold mb-4"><?php echo $quienes_datos['titulo_mision']; ?></h2>
              <div class="leading-relaxed text-base">
                <?php echo $quienes_datos['descripcion_mision']; ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>
  </div>
  
  <!-- Tab: Miembros -->
  <div id="miembros" class="tab-pane hidden">
    <?php if ($miembros && count($miembros) > 0): ?>
      <?php 
      // Tomamos el primer elemento del repetidor de miembros
      $miembros_datos = $miembros[0]; 
      ?>
      <div class="py-8">
        <!-- Descripción de Miembros ACOP -->
        <div class="max-w-4xl mx-auto text-center mb-12">
          <h1 class="text-3xl font-bold text-center mb-6">Miembros Acop</h1>
          
          <div class="text-base leading-relaxed mb-10">
            <?php echo $miembros_datos['descripcion']; ?>
          </div>
        </div>
        
        <!-- Sección Miembros Activos -->
        <?php if ($miembros_datos['miembros_activos'] && count($miembros_datos['miembros_activos']) > 0): ?>
        <div class="mb-16">
          <!-- Barra de título con fondo morado -->
          <div class="bg-purple-100 mb-10 full-width w-auto -mx-4 sm:-mx-6 lg:-mx-12">
            <h2 class="text-2xl font-bold text-center p-0">Miembros Activos</h2>
          </div>
          
          <div class="flex flex-wrap justify-center gap-y-10 max-w-6xl mx-auto">
            <?php foreach($miembros_datos['miembros_activos'] as $miembro): ?>
              <div class="text-center w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                <div class="rounded-full bg-white p-2 w-36 h-36 mx-auto mb-4 flex items-center justify-center overflow-hidden">
                  <?php if($miembro['imagen']): ?>
                    <img src="<?php echo $miembro['imagen']; ?>" alt="<?php echo esc_attr($miembro['titulo']); ?>" class="w-full h-full object-cover rounded-full">
                  <?php endif; ?>
                </div>
                <p class="font-medium text-center"><?php echo $miembro['titulo']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
        
        <!-- Sección Miembros Estudiantes -->
        <?php if ($miembros_datos['miembros_estudiantes'] && count($miembros_datos['miembros_estudiantes']) > 0): ?>
        <div class="mb-16">
          <!-- Barra de título con fondo morado -->
          <div class="bg-purple-100 mb-10 full-width w-auto -mx-4 sm:-mx-6 lg:-mx-12">
            <h2 class="text-2xl font-bold text-center">Miembros Estudiantes</h2>
          </div>
          
          <div class="flex flex-wrap justify-center gap-y-10 max-w-6xl mx-auto">
            <?php foreach($miembros_datos['miembros_estudiantes'] as $estudiante): ?>
              <div class="text-center w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                <div class="rounded-full bg-white p-2 w-36 h-36 mx-auto mb-4 flex items-center justify-center overflow-hidden">
                  <?php if($estudiante['imagen']): ?>
                    <img src="<?php echo $estudiante['imagen']; ?>" alt="<?php echo esc_attr($estudiante['titulo']); ?>" class="w-full h-full object-cover rounded-full">
                  <?php endif; ?>
                </div>
                <p class="font-medium text-center"><?php echo $estudiante['titulo']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
        
        <!-- Sección Cómo ser miembro -->
        <div class="max-w-4xl mx-auto py-6">
          <h2 class="text-2xl font-bold mb-6">¿CÓMO SER MIEMBRO DE ACOP?</h2>
          
          <p class="mb-6">Presentar al momento de su solicitud, los siguientes documentos:</p>
          
          <ol class="list-decimal pl-8">
            <li class="mb-3">Copia del diploma de grado que lo acredita como odontólogo, expedido por la Universidad aprobada por las autoridades competentes del país o del exterior.</li>
          </ol>
        </div>
      </div>
    <?php endif; ?>
  </div>
  
  <!-- Tab: Información Legal -->
  <div id="informacion-legal" class="tab-pane hidden">
    <?php if ($informacion_legal && count($informacion_legal) > 0): ?>
      <?php 
      // Tomamos el primer elemento del repetidor
      $legal_datos = $informacion_legal[0]; 
      ?>
      <div class="px-4 py-8">
        <!-- Sección Principal con Imagen -->
        <div class="max-w-6xl mx-auto mb-12">
          <div class="flex flex-col md:flex-row items-start  rounded-lg overflow-hidden">
            <!-- Contenido de texto -->
            <div class="md:w-3/5 p-8">
              <h1 class="text-3xl font-bold mb-6">Información Régimen Tributario Especial ESAL</h1>
              
              <div class="prose max-w-none mb-6">
                <?php echo $legal_datos['descripcion']; ?>
              </div>
            </div>
            
            <!-- Imagen -->
            <div class="md:w-2/5 p-4 flex items-center justify-center">
              <?php if($legal_datos['imagen_en_descripcion']): ?>
                <img src="<?php echo $legal_datos['imagen_en_descripcion']['url']; ?>" alt="Balanza de justicia" class="max-h-64 object-contain">
              <?php else: ?>
                <!-- Imagen predeterminada si no hay imagen cargada -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/legal-balance.png" alt="Balanza de justicia" class="max-h-64 object-contain">
              <?php endif; ?>
            </div>
          </div>
        </div>
        
        <!-- Documentos Descargables -->
        <div class="max-w-6xl mx-auto">
          <h2 class="text-2xl font-bold mb-6 text-center">Documentos Descargables</h2>
          
          <!-- Separador decorativo -->
          <div class="flex items-center justify-center mb-10">
            <div class="h-px bg-blue-300 w-1/3"></div>
            <div class="mx-4 text-blue-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            </div>
            <div class="h-px bg-blue-300 w-1/3"></div>
          </div>
          
          <!-- Listas de documentos -->
          <div class="flex flex-col md:flex-row gap-12">
            <!-- Informes -->
            <div class="md:w-1/2">
              <h3 class="text-xl font-bold mb-6">Informes</h3>
              
              <ul class="space-y-4">
                <?php if($legal_datos['informes'] && count($legal_datos['informes']) > 0): ?>
                  <?php foreach($legal_datos['informes'] as $informe): ?>
                    <li class="flex items-start">
                      <div class="flex-shrink-0 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                      </div>
                      <a href="<?php echo $informe['archivo']; ?>" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline">
                        <?php echo $informe['titulo_del_informe']; ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                <?php endif; ?>
              </ul>
            </div>
            
            <!-- Formularios -->
            <div class="md:w-1/2">
              <h3 class="text-xl font-bold mb-6">Formularios</h3>
              
              <ul class="space-y-4">
                <?php if($legal_datos['formularios'] && count($legal_datos['formularios']) > 0): ?>
                  <?php foreach($legal_datos['formularios'] as $formulario): ?>
                    <li class="flex items-start">
                      <div class="flex-shrink-0 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                      </div>
                      <a href="<?php echo $formulario['archivo']; ?>" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline">
                        <?php echo $formulario['titulo_del_formulario']; ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
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