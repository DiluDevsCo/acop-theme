<?php
$image = get_field('image');
$image_title = get_field('image_title');
$add_text = get_field('add_text');
$button_slider_fr = get_field('button_slider_fr');
?>

<section class="flex flex-col gap-4 place-items-center full-width">
    <div class="w-full bg-[#25A0D6] flex flex-col md:flex-row">
        <div class="grid place-content-end w-full md:w-1/2">
            <img class=" w-full md:w-4/5" src="<?php echo $image; ?>" alt="">
        </div>
        <div class="w-full md:w-1/2 h-auto">
            <div class="flex flex-col text-center place-items-center p-6">
                <img class="w-full md:w-1/2 " src="<?php echo $image_title; ?>" alt="">
                <div class="array_text p-5 md:p-0 flex flex-col gap-5">
                    <?php foreach ($add_text as $text) {
                        echo $text['creat_text'];
                    } ?>
                    <div class="whitespace-nowrap">
                        <?php
                        fr_render_button(
                            array(
                                "label" => $button_slider_fr["label"],
                                "url" => $button_slider_fr["url"],
                                "style" => $button_slider_fr["style"]
                            )
                        ); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>