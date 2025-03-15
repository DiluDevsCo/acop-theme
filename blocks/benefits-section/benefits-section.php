<?php
$title = get_field('benefits_title');
$description = get_field('benefits_description');
$main_image = get_field('benefits_image');
$bg_image = get_field('benefits_bg');
$button = get_field('button');

?>

<div class="benefits-outer-wrapper full-width">
    <section class="benefits-section">
        <?php if($bg_image): ?>
            <img 
                src="<?php echo esc_url($bg_image['url']); ?>"
                alt="<?php echo esc_attr($bg_image['alt']); ?>"
                class="absolute inset-0 w-full h-full object-cover"
            />
        <?php endif; ?>

        <div class="benefits-container relative z-10">
            <div class="benefits-grid">
                <!-- Imagen Principal -->
                <div class="benefits-image-container">
                    <?php if($main_image): ?>
                        <img 
                            src="<?php echo esc_url($main_image); ?>" 
                            alt="Profesionales ACOP"
                        />
                    <?php endif; ?>
                </div>

                <!-- Contenido -->
                <div class="benefits-content text-white">
                    <?php if($title): ?>
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">
                            <?php echo esc_html($title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if($description): ?>
                        <div class="text-lg mb-6">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php endif; ?>

                    <?php 
                    // Check if button exists and has required fields
                    if ($button && isset($button['label']) && isset($button['url'])) {
                        // Call the function with the button array directly
                        acop_render_button($button);
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </section>
</div>