<?php
$title = get_field('title');
$subtitle = get_field('subtitle');
$images = get_field('banner');
$color = get_field('color');

?>

<div  class=" block-purpose-us grid gap-4 text-center place-items-center text-black px-8 py-6 full-width" style="background-color:<?php echo $color;?>">
    <h2 class="text-black text-[40px] m-0 p-0"><?php echo $title; ?></h2>
    <p class="text-[20px]"><b><?php echo $subtitle; ?></b></p>

    <div class=" slideshow-container relative inline-block">
        <?php
        foreach ($images as $image) {
        ?>
            <div class="mySlides fade ">
                <img class="max-w-3xl" src="<?php echo $image['image']; ?>" alt="">
            </div>
        <?php
        }
        ?>
        <a class="prev cursor-pointer duration-500 select-none text-white rounded-lg absolute p-2 -translate-y-1/2 left-0 " onclick="plusSlides(-1)">&#10094;</a>
        <a class="next cursor-pointer duration-500 select-none text-white rounded-lg absolute p-2 -translate-y-1/2 right-0 " onclick="plusSlides(1)">&#10095;</a>
    </div>
</div>