<?php
$bg_color = get_field('bg_color');
$visibility_movil = get_field('visibility_movil');

$visibility_web = get_field('visibility_web');

$image = get_field('image');
$text = get_field('text');
$text_2 = get_field('text_2');

$visibility_class = '';
if (empty($visibility_movil) && empty($visibility_web)) {
    $visibility_class = '  hidden';
} elseif (!empty($visibility_movil) && empty($visibility_web)) {
    $visibility_class = '  block sm:hidden';
} elseif (empty($visibility_movil) && !empty($visibility_web)) {
    $visibility_class = '  hidden sm:block';
}

?>

<section data-imagen-texto-y-fondo class="w-screen px-5 pt-5 full-width <?php echo $visibility_class ?>" style="background-color: <?php echo $bg_color ?>">
    <div class="w-full">
        <?php if (!empty($text) || !empty($text_2)) { ?>
            <div class="flex flex-col items-center justify-center">
                <p class="font-bold text-base"><?php echo $text ?></p>
                <p class="text-base mb-5"><?php echo $text_2 ?></p>
            </div>
        <?php }
        if (!empty($image)) { ?>
            <div class="flex items-center justify-center">
                <img class="" src="<?php echo $image ?>" alt="">
            </div>
        <?php } ?>
    </div>
</section>