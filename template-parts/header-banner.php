<?php
  $background_image = get_field('background_image', 'option');
  $background_color = get_field('background_color', 'option');
  $title_page = get_field('title_page') ?: get_the_title();
  $subtitle = get_field('subtitle', 'option');
?>

<section class="relative h-48 md:h-40  flex items-center justify-center text-center" style="background-color: <?= esc_attr($background_color) ?>;">
  <?php if ($background_image): ?>
    <img src="<?= esc_url($background_image) ?>" alt="" class="absolute inset-0 w-full h-full object-cover opacity-40">
  <?php endif; ?>

  <div class="relative z-10">
    <h1 class="text-2xl md:text-4xl font-bold text-white "><?= esc_html($title_page) ?></h1>
    <?php if ($subtitle): ?>
      <p class="text-sm md:text-base mt-2"><?= esc_html($title_page) ?></p>
    <?php endif; ?>
  </div>
</section>