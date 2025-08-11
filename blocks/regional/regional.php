<?php
/**
 * Bloque: Tabs ACOP
 * 
 * Este bloque muestra los tabs de las regionales de ACOP
 */

// Obtenemos los repetidores principales (tu estructura original)
$regional_antioquia = get_field('regional_antioquia_y_choco');
$regional_cundinamarca = get_field('regional_cundinamarca_otras');
$regional_atlantico = get_field('regional_atlantico_otras');
$regional_valle = get_field('regional_valle_otras');

// Configuración de tabs
$tabs_data = [
    'antioquia' => [
        'titulo' => 'Regional Antioquia y Chocó',
        'data' => $regional_antioquia
    ],
    'cundinamarca' => [
        'titulo' => 'Cundinamarca, Tolima, Huila, Meta, Llanos orientales, Santander, Norte de Santander, Boyacá',
        'data' => $regional_cundinamarca
    ],
    'atlantico' => [
        'titulo' => 'Atlántico, Bolívar, Guajira, Cesar, Magdalena, Sucre, San Andres y Providencia',
        'data' => $regional_atlantico
    ],
    'valle' => [
        'titulo' => 'Valle, Nariño, Cauca, Caldas, Quindío y Risaralda',
        'data' => $regional_valle
    ]
];
?>

<div class="acop-tabs-container max-w-6xl mx-auto pb-4">
    <!-- Tabs Navigation -->
    <div class="tabs-navigation flex flex-wrap gap-2.5 mb-8 border-b-2 border-gray-300">
        <?php 
        $first_tab = true;
        foreach ($tabs_data as $key => $tab): 
        ?>
            <button class="tab-button bg-[#7D669B] text-white border-none px-6 py-4 rounded-t-lg cursor-pointer font-medium transition-all duration-300 min-h-15 flex items-center justify-center text-center flex-1 min-w-48 hover:bg-[#7A5F97] hover:-translate-y-0.5 <?php echo $first_tab ? 'active bg-[#7A5F97] shadow-lg' : 'bg-[#7D669B]'; ?>" 
                    onclick="showTab('<?php echo $key; ?>', this)">
                <?php echo esc_html($tab['titulo']); ?>
            </button>
        <?php 
        $first_tab = false;
        endforeach; 
        ?>
    </div>

    <!-- Tabs Content -->
    <div class="tabs-content">
        <?php 
        $first_content = true;
        foreach ($tabs_data as $key => $tab): 
        ?>
            <div class="tab-panel animate-fade-in <?php echo $first_content ? 'active block' : 'hidden'; ?>" 
                 id="panel-<?php echo $key; ?>">
                
                <?php if (!empty($tab['data'])): ?>
                    <!-- Regional Header -->
                    <div class="bg-[#7D669B] text-white text-center py-4 px-5 rounded-lg mb-5">
                        <h3 class="m-0 text-lg text-white font-semibold uppercase tracking-wide p-0">
                            <?php echo esc_html($tab['titulo']); ?>
                        </h3>
                    </div>
                    
                    <!-- Miembros Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-1 mt-5 max-h-96 overflow-y-auto pr-2">
                        <?php foreach ($tab['data'] as $miembro): 
                            // Manejar TODAS las estructuras posibles de imagen de ACF
                            $imagen = null;
                            
                            if (is_array($miembro['imagen'])) {
                                // Caso 1: Array completo - extraer el ID y generar URL
                                $imagen_id = $miembro['imagen']['ID'] ?? $miembro['imagen']['id'] ?? null;
                                $imagen = $imagen_id ? wp_get_attachment_image_url($imagen_id, 'thumbnail') : null;
                            } elseif (is_numeric($miembro['imagen'])) {
                                // Caso 2: Solo ID - generar URL desde el ID
                                $imagen = wp_get_attachment_image_url($miembro['imagen'], 'thumbnail');
                            } elseif (is_string($miembro['imagen']) && !empty($miembro['imagen'])) {
                                // Caso 3: URL directa - usar tal como viene
                                $imagen = $miembro['imagen'];
                            }
                            
                            $placeholder = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI2NjYyIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LXNpemU9IjE4IiBmaWxsPSIjOTk5IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+U2luIGZvdG88L3RleHQ+PC9zdmc+';
                        ?>
                            <div class="bg-[#BEB3CC] rounded-2xl p-5 flex gap-4 shadow-lg transition-all duration-300 min-h-30 items-center hover:-translate-y-1 hover:shadow-xl hover:bg-[#9b89b3]">
                                <!-- Imagen del miembro -->
                                <div class="flex-shrink-0 border-8 border-[#5A3D82] border-solid rounded-full">
                                    <img src="<?php echo $imagen ?: $placeholder; ?>" 
                                         alt="<?php echo esc_attr($miembro['nombres_completos']); ?>"
                                         class="w-32 h-32 rounded-full object-cover">
                                </div>
                                
                                <!-- Info del miembro -->
                                <div class="flex-1">
                                    <h4 class="m-0 mb-2 text-black text-base font-bold uppercase tracking-wide">
                                        <?php echo esc_html($miembro['nombres_completos']); ?>
                                    </h4>
                                    <p class="my-1 text-sm text-black font-medium">
                                        <span class="font-bold">Contacto:</span> <?php echo esc_html($miembro['contacto']); ?>
                                    </p>
                                    <p class="my-1 text-sm text-black font-medium">
                                        <span class="font-bold">Ciudad:</span> <?php echo esc_html($miembro['ciudad']); ?>
                                    </p>
                                    <p class="my-1 text-sm text-black font-medium">
                                        <span class="font-bold">Regional:</span> <?php echo esc_html($miembro['regional']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-10 text-gray-500">
                        <p>No hay miembros registrados en esta regional.</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php 
        $first_content = false;
        endforeach; 
        ?>
    </div>
</div>

<script>
function showTab(tabKey, buttonElement) {
    // Ocultar todos los paneles
    const allPanels = document.querySelectorAll('.tab-panel');
    allPanels.forEach(panel => {
        panel.classList.remove('active', 'block');
        panel.classList.add('hidden');
    });
    
    // Remover active de todos los botones
    const allButtons = document.querySelectorAll('.tab-button');
    allButtons.forEach(button => {
        button.classList.remove('active');
        button.classList.remove('bg-[#7D669B]', 'shadow-lg');
        button.classList.add('bg-[#7D669B]', 'shadow-lg');
    });
    
    // Mostrar el panel correspondiente
    const targetPanel = document.getElementById('panel-' + tabKey);
    if (targetPanel) {
        targetPanel.classList.remove('hidden');
        targetPanel.classList.add('active', 'block');
    }
    
    // Activar el botón clickeado
    buttonElement.classList.remove('bg-[#7D669B]');
    buttonElement.classList.add('active', 'bg-[#7D669B]', 'shadow-lg');
}

// Asegurar que el primer tab esté activo al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const firstButton = document.querySelector('.tab-button');
    const firstPanel = document.querySelector('.tab-panel');
    
    if (firstButton && firstPanel) {
        // Asegurar que el primer botón tenga el estilo activo
        firstButton.classList.add('active', 'bg-[#7D669B]', 'shadow-lg');
        firstButton.classList.remove('bg-[#7D669B]');
        
        // Asegurar que el primer panel esté visible
        firstPanel.classList.add('active', 'block');
        firstPanel.classList.remove('hidden');
    }
});
</script>