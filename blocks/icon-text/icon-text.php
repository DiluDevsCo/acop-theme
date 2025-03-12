<?php
$title = get_field('title');
$icons_text = get_field('icon_and_text');
?>
<section class="block md:hidden">
    <div class="">
        <div class="mb-10">
            <h3 class="text-3xl text-white leading-tight font-bold tracking-tighter"><?php echo $title ?></h3>
        </div>
        <div class="flex flex-col md:flex-row">
            <?php foreach ($icons_text as $icons) : ?>
                <div class="w-full px-4">
                    <div class="text-center max-w-xs mx-auto">
                        <img class="w-28 h-28 mx-auto mb-6" src="<?php echo $icons['icon'] ?>" alt="">
                        <h3 class="text-white mb-1 text-xl text-coolGray-800 font-semibold"><?php echo $icons['title_icon'] ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>