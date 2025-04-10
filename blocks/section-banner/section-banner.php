<?php 
$title = get_field('title');
$description = get_field('description');
$action = get_field('action');
$action_url = get_field('action_url');
$image = get_field('image');
?>

<div class="overflow-hidden full-width">
  <!-- Banner container con gradiente -->
  <div class="relative flex items-center justify-center bg-gradient-to-r from-[#c3d500] to-[#b8ca00] min-h-[250px] w-full">
    <!-- Efecto de iluminación -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxyYWRpYWxHcmFkaWVudCBpZD0iZ3JhZGllbnQiIGN4PSI1MCUiIGN5PSI1MCUiIHI9IjUwJSIgZng9IjUwJSIgZnk9IjUwJSI+PHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIwLjIiLz48c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNjM2Q1MDAiIHN0b3Atb3BhY2l0eT0iMCIvPjwvcmFkaWFsR3JhZGllbnQ+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZGllbnQpIi8+PC9zdmc+')]"></div>
    
    <!-- Contenedor principal para centrar contenido -->
    <div class="container-fluid flex flex-col md:flex-row items-center justify-center relative z-10">
      <!-- Área de contenido - ahora centrada -->
      <div class="text-center md:text-left py-8 md:pr-8">
        <div class="w-[60%] mx-auto mb-4">
          <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">
            <?php echo $title; ?>
          </h2>
          <h3 class="text-black text-xl font-bold">
            <?php echo $description; ?>
          </h3>
          <div class="flex items-center justify-center md:justify-start">
            <a href="<?php echo esc_url($action_url); ?>" class="text-xl font-bold text-black hover:underline flex items-center">
              <?php echo $action; ?>
              <!-- Icono de cursor/mano -->
              <img 
                src="https://v0.blob.com/qgIkf.png" 
                alt="Cursor" 
                class="ml-2 w-8 h-8 inline-block"
              />
            </a>
          </div>
        </div>
      </div>
      
      <!-- Área de imagen - ahora más pequeña y centrada -->
      <div class="hidden md:flex md:justify-end md:flex-col md:w-[40%] lg:w-[35%] h-[220px] relative">
        <img
          src="<?php echo esc_url($image); ?>"
          alt="Dentista con niño"
          class="w-full h-full object-cover rounded-lg shadow-md"
        />
      </div>
    </div>
  </div>
  
  <!-- Borde inferior azul -->
  <div class="h-2 w-full bg-[#00a0d2]"></div>
</div>