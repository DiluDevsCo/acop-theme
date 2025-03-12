<?php
setlocale(LC_TIME, "spanish");


$margin_top = get_field('margin-top_spacing') ?: 'xl';
$margin_bottom = get_field('margin-bottom_spacing') ?: 'xl';

$margin_classes = almus_get_block_margin_classes($margin_top, $margin_bottom);

$title_block = get_field('title_block');
$color_title = get_field('color_title');
$description = get_field('description');
$color_description = get_field('color_description');
$cards = get_field('cards');

?>

<section data-cards-carrousel class="flex flex-col justify-center items-center gap-5 <?php echo $margin_classes; ?>">

    <p class="text-5xl mb-4 p-0 font-extrabold" style="color: <?php echo $color_title; ?>;"><?php echo $title_block ?></p>
    <p class="text-xl w-2/3 text-center mb-3" style="color: <?php echo $color_description; ?>;"><?php echo $description ?></p>
    <div data-cards-swiper class="swiper w-full flex flex-wrap justify-center items-center gap-4 md:hidden">
        <div class="swiper-wrapper">
            <?php foreach ($cards as $card) { ?>
                <div class="swiper-slide">
                    <div class="w-auto h-auto flex flex-col justify-center items-center">
                        <img class="w-auto h-[451px]" src="<?php echo $card['card_image']; ?>" alt="image">
                        <p class="text-xl mt-5 font-bold" style="color: <?php echo $card['card_title_color']; ?>;"><?php echo $card['card_title']; ?></p>
                        <p class="text-lg mt-2" style="color: <?php echo $card['card_description_color']; ?>;"><?php echo $card['card_description']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev">
            <svg width="40" height="80" viewBox="0 0 29 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.19893 37.0005L28.8709 0.762804L28.5263 73.5081L0.19893 37.0005Z" fill="#D9D9D9" />
            </svg>
        </div>
        <div class="swiper-button-next">
            <svg width="40" height="80" viewBox="0 0 30 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.1978 36.9979L1.06336 73.6544L0.335103 0.911962L29.1978 36.9979Z" fill="#D9D9D9" />
            </svg>
        </div>

    </div>

    <div class="md:flex flex-wrap justify-center gap-4 hidden">

        <?php foreach ($cards as $card) { ?>
            <div class="w-[373px] h-auto">
                <img class="w-[373px] h-[451px]" src="<?php echo $card['card_image']; ?>" alt="image">
                <p class="text-xl mt-5 font-bold" style="color: <?php echo $card['card_title_color']; ?>;"><?php echo $card['card_title']; ?></p>
                <p class="text-lg mt-2" style="color: <?php echo $card['card_description_color']; ?>;"><?php echo $card['card_description']; ?></p>
            </div>
        <?php } ?>

    </div>

</section>