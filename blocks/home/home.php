<?php 
$logo_image = get_field('logo');
$title = get_field('title');
$description = get_field('description');
$button = get_field('buttons');
$background_image = get_field('background_image');

?>

<div class="relative min-h-[500px] bg-white">
      <div class="container-fluid">
        <div class="grid md:grid-cols-2 gap-8 items-center">
         
          <div class="mb-6 md:mb-0">
            <Image
              src="<?php echo $logo_image; ?>"
              alt="ACOP Logo"
              width={120}
              height={80}
              class="mb-6"
            />

           
            <h1 class="text-4xl md:text-5xl font-bold mb-6 text-[#5B2C8A]"><?php echo $title; ?></h1>

            <p class="text-gray-700 mb-6 max-w-lg">
              <?php echo $description; ?>
            </p>

            <div class="flex flex-wrap gap-4">
              
              <?php 
              foreach ($button as $button) {
                /* acop_render_button($button); */
                acop_render_button(
                    array(
                        'label' => $button['button_label'],
                        'url' => $button['button_url'],
                        'style' => $button['button_style'],
                        'size' => $button['button_size']
                    )
                );
              }
              ?>
            </div>
          </div>

          <div class="relative h-[400px] md:h-[500px] bg-radial-[at_25%_25%] from-white to-zinc-900 to-75%">
            <Image
              src="<?php echo $background_image; ?>"
              alt="Dentista pediatrico atendiendo a paciente"
              fill
              class="object-cover rounded-lg"
              priority
            />
          </div>
        </div>
      </div>
    </div>