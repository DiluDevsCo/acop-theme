<?php
  $cards = get_field('cards');
  $tag_title = get_field('tag_title');
  $height_cards = get_field("height_cards");
  $texts_footer = get_field("texts_footer");


  $margin_top = get_field('margin-top_spacing') ?: 'xl';
  $margin_bottom = get_field('margin-bottom_spacing') ?: 'xl';

  $margin_classes = almus_get_block_margin_classes($margin_top, $margin_bottom);

?>

<section class="flex flex-col items-center justify-center gap-[20px] cards-cursos <?php echo $margin_classes; ?>">
  <div class="container-fluid flex flex-col md:flex-row gap-[20px] flex-grow w-full
  ">
  <?php foreach($cards as $card) { ?>
    <a href="<?php echo $card['url']; ?>" class="w-full rounded-lg text-center flex flex-col items-center justify-center p-0 md:p-10" 
      style="height: <?php echo $height_cards; ?>; 
      background-color: <?php echo $card['color_bg']; ?>; --color: <?php echo $card['color_text']; ?>" 
      <?php if (!empty($card['color_hover'])) { ?>
        onmouseover="this.style.backgroundColor='<?php echo $card['color_hover']; ?>'" 
        onmouseout="this.style.backgroundColor='<?php echo $card['color_bg']; ?>'"
      <?php } ?>>
      <<?php echo $tag_title; ?> class="font-bold text-[30px] lg:text-[40px] pb-0" style="color: <?php echo $card['color_text']; ?>;"><?php echo $card['title']; ?></<?php echo $tag_title; ?>>
      <p class="text-[24px] lg:text-[30px]"><?php echo $card['text']; ?></p>
      <p class="text-[24px] lg:text-[30px] font-bold"><?php echo $card['price']; ?></p>
    </a>
  <?php } ?>
  </div>

  <div class="grid place-items-center text-center">
  <p class="text-[24px] lg:text-[30px] font-bold"><?php echo $texts_footer; ?></p>
  </div>
</section>
