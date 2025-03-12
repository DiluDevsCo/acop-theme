<?php
$link_vimeo = get_field('link_vimeo');
$testimonials = get_field('testimonials');
$button_view = get_field('button_view');

$margin_top = get_field('margin-top_spacing') ?: 'xl';
$margin_bottom = get_field('margin-bottom_spacing') ?: 'xl';

$margin_classes = almus_get_block_margin_classes($margin_top, $margin_bottom);
?>
<section data-video-carrousel class="flex flex-col items-center justify-between text-white p-4 <?php echo $margin_classes; ?>">
    <h2 class="text-white text-3xl p-2 text-center">Conoce nuestros testimonios</h2>
    <div class="flex flex-col w-full md:flex-row items-center justify-around max-w-screen-xl text-white p-4">
        <div class="md:w-1/2">
            <?php if (!empty($link_vimeo)) { ?>
                <div class="p-4 rounded">
                    <iframe class="rounded-lg w-full h-[250px] md:w-[640px] md:h-[500px] " src='<?php echo $link_vimeo ?>' frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                </div>
            <?php } ?>
        </div>
        <div class="w-[20rem] text-center">
            <div data-testimonials-swiper class="swiper rounded-lg">
                <div class="swiper-wrapper items-center rounded">
                    <?php if (!empty($testimonials)) { ?>
                        <?php foreach ($testimonials as $testimonial) : ?>
                            <div class="swiper-slide">
                                <img class="h-full w-full object-fill" src="<?php echo $testimonial['testimonial_image'] ?>" alt="">
                            </div>
                        <?php endforeach; ?>
                </div>
            <?php } ?>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev left-0">
                <svg width="40" height="80" viewBox="0 0 29 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.19893 37.0005L28.8709 0.762804L28.5263 73.5081L0.19893 37.0005Z" fill="#D9D9D9" />
                </svg>
            </div>
            <div class="swiper-button-next right-0">
                <svg width="40" height="80" viewBox="0 0 30 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M29.1978 36.9979L1.06336 73.6544L0.335103 0.911962L29.1978 36.9979Z" fill="#D9D9D9" />
                </svg>
            </div>
            </div>
        </div>

    </div>
    <div class="flex items-center justify-center">
        <?php
        fr_render_button($button_view);
        ?>
    </div>
</section>