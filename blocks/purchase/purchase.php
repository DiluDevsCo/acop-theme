<?php
$buttons = get_field('call_to_action');
$margin_top = get_field('margin-top_spacing') ?: 'xl';
$margin_bottom = get_field('margin-bottom_spacing') ?: 'xl';

$margin_classes = almus_get_block_margin_classes($margin_top, $margin_bottom);

?>



<section class="flex flex-wrap items-center -mx-4 -mb-6 lg:mb-0 <?php echo $margin_classes; ?>">
    <div class="flex flex-col items-center md:flex-row justify-center w-full gap-4 px-4 mb-6 lg:mb-0">
        <?php foreach ($buttons as $button) : ?>
            <div class="p-6 rounded-[50px] w-full md:w-[497px] border-8 border-solid border-white lg:text-center">
                <div class="flex flex-col items-center justify-center">
                    <h3 class="text-2xl font-bold text-white"><?php echo $button['title']?></h3>
                    <?php if ($button['price_discount']) { ?>
                    <span class="inline-block mb-6 text-3xl line-through text-white font-bold font-heading" style="text-decoration-color: red;">$ <?php echo $button['price']?></span>
                    <span class="inline-block mb-6 text-3xl text-white font-bold font-heading">$ <?php echo $button['price_discount']?></span>
                    <?php } else { ?>
                        <span class="inline-block mb-6 text-3xl text-white font-bold font-heading">$ <?php echo $button['price']?></span>
                    <?php } ?>
                </div>
                <div class="flex items-center justify-center">
                <?php
                fr_render_button(array(
                    'label' => $button['buttons_label'],
                    'url' => $button['buttons_url'],
                    'style' => $button['buttons_style'],
                    'size' => '2xl',
                ));
                ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>