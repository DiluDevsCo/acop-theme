<?php 
$cards = get_field('cards');

// Definir los gradientes predeterminados (estado normal)
$default_gradients = [
    // Naranja - para la primera tarjeta y cada cuarta (4, 7, 10...)
    'background: linear-gradient(90deg, rgba(235, 94, 11, 0.65) 0%, rgba(242, 140, 87, 0) 100%);',
    
    // Azul - para la segunda tarjeta y cada quinta (5, 8, 11...)
    'background: linear-gradient(270deg, rgba(73, 191, 237, 0) 0%, #01A3DE 100%);',
    
    // Rosa - para la tercera tarjeta y cada sexta (6, 9, 12...)
    'background: linear-gradient(270deg, rgba(218, 66, 144, 0) 0%, rgba(236, 47, 140, 0.9) 80%);'
];

// Definir los gradientes para hover
$hover_gradients = [
    // Naranja hover
    'background: linear-gradient(90deg, #EB5E0B 0%, rgba(242, 140, 87, 0.71) 100%);',
    
    // Azul hover
    'background: linear-gradient(270deg, rgba(73, 191, 237, 0.71) 0%, #01A3DE 100%);',
    
    // Rosa hover
    'background: linear-gradient(270deg, rgba(218, 66, 144, 0.71) 0%, rgba(236, 47, 140, 0.9) 100%);'
];
?>

<div class="container mx-auto px-4 py-12">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php 
    if($cards): 
      foreach ($cards as $index => $card): 
        // Determinar qué gradiente usar basado en la posición (0-indexed)
        $gradient_index = $index % 3; // Esto dará 0, 1, o 2
        $gradient = $default_gradients[$gradient_index];
        $hover_gradient = $hover_gradients[$gradient_index];
        
        // Get image URL directly
        $image_url = isset($card['background_image']) ? $card['background_image'] : '';
    ?>
      <a
        href="<?php echo esc_url($card['link']); ?>"
        class="card-link group relative overflow-hidden rounded-2xl aspect-[1.6/1] hover:shadow-lg transition-shadow duration-300"
      >
        <!-- Background Image -->
        <?php if($image_url): ?>
          <div class="absolute inset-0 w-full h-full">
            <img 
              src="<?php echo esc_url($image_url); ?>" 
              alt="<?php echo esc_attr($card['title_card']); ?>"
              class="w-full h-full object-cover"
            />
          </div>
        <?php endif; ?>
        
        <!-- Gradient Overlay normal -->
        <div 
          class="card-gradient absolute inset-0 mix-blend-multiply"
          style="<?php echo $gradient; ?>"
        ></div>
        
        <!-- Gradient Overlay hover -->
        <div 
          class="card-gradient-hover absolute inset-0 mix-blend-multiply"
          style="<?php echo $hover_gradient; ?>"
        ></div>

        <!-- Text Container -->
        <div class="absolute inset-0 p-6 flex flex-col items-center justify-center">
          <h2 class="text-white text-2xl md:text-3xl font-bold text-center whitespace-pre-line mb-2">
            <?php echo esc_html($card['title_card']); ?>
          </h2>
          
          <!-- Texto "ver" que aparece en hover -->
          <span class="view-text text-white text-lg font-medium mt-2 flex items-center">
            Ver
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </span>
        </div>
      </a>
    <?php 
      endforeach;
    endif; 
    ?>
  </div>
</div>