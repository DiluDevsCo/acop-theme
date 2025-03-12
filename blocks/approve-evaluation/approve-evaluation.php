<?php
$text_dream = get_field("text_dream");
$add_universities = get_field("add_universities");
$add_button = get_field("add_button");
$color_text = get_field("color_text");
$background_card = get_field("background_card");

$margin_top = get_field('margin-top_spacing') ?: 'xl';
$margin_bottom = get_field('margin-bottom_spacing') ?: 'xl';

$margin_classes = almus_get_block_margin_classes($margin_top, $margin_bottom);
?>

<div class="grid place-items-center py-5 text-center gap-5 rounded-2xl <?php echo $margin_classes; ?>"
style="background-color: <?php echo $background_card; ?>;">
  <div class="grid gap-4 w-full px-10">
    <?php
    if ($text_dream) {
      foreach ($text_dream as $text_field ) { ?>
        <<?php echo $text_field['tag_text']; ?> class="text-center leading-none"
        style="color:<? echo $color_text; ?>; 
        font-size:<? echo $text_field['text_size'] . "px"; ?>;
        font-weight: <? echo $text_field['number_bold']; ?>;">
        <?php echo $text_field['text_dream']; ?>
        </<?php echo $text_field['tag_text']; ?>>
      <?php } ?>
    <?php } ?>
  </div>
  <?php 
    if ($add_universities) { ?>
  <div class="flex flex-col gap-5 md:gap-0 md:flex-row justify-between flex-wrap px-[20px] md:px-[5px] lg:px-[100px] w-full">
    <?php 
      foreach ($add_universities as $university ) { ?>
      <div class="grid grid-rows-2 gap-3 place-items-center">
      <img class="w-20" src="<?php echo $university['add_image']; ?>" alt="">
        <div class="border-solid border rounded-2xl p-3">
          <p class="text-lg leading-none font-bold p-0"> <?php echo $university['add_title']; ?> </p>
          <p class="text-sm leading-none font-normal p-0"><?php echo $university['add_university']; ?></p>
        </div>
      </div>
    <?php } ?>
  </div>
  <?php } ?>
  <div class="grid place-items-center w-full">
    <?php
    fr_render_button(
      array(
        "label" => $add_button["label"],
        "url" => $add_button["url"],
        "style" => $add_button["style"]
        )
      ); ?>
  </div>
</div>