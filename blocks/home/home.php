<?php 
$logo_image = get_field('logo');
$title = get_field('title');
$description = get_field('description');
$button = get_field('buttons');
$background_image = get_field('background_image');
?>

<div class="hero-section min-h-[500px] py-8 md:py-12">
    <div class="container-fluid">
        <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">
            <div class="hero-content">
                <?php if($logo_image): ?>
                    <img
                        src="<?php echo esc_url($logo_image); ?>"
                        alt="ACOP Logo"
                        width="120"
                        height="80"
                        class="mb-8"
                    />
                <?php endif; ?>

                <?php if($title): ?>
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 text-[#5B2C8A] leading-tight">
                        <?php echo esc_html($title); ?>
                    </h1>
                <?php endif; ?>

                <?php if($description): ?>
                    <div class="text-gray-700 text-lg mb-6 max-w-lg leading-normal"> 
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>

                <?php if($button): ?>
                    <div class="flex flex-wrap gap-4">
                        <?php 
                        foreach ($button as $btn) {
                            acop_render_button(array(
                                'label' => $btn['button_label'],
                                'url' => $btn['button_url'],
                                'style' => $btn['button_style'],
                                'size' => $btn['button_size']
                            ));
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="hero-image-container">
                <?php if($background_image): ?>
                    <img
                        src="<?php echo esc_url($background_image); ?>"
                        alt="Dentista pediátrico atendiendo a paciente"
                        class="hero-image"
                    />
                    <div class="hero-edge-overlay"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>