<?php
setlocale(LC_TIME, "spanish");
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'numberposts' => 4,
    'order' => 'DESC'
);

$margin_top = get_field('margin-top_spacing') ?: 'xl';
$margin_bottom = get_field('margin-bottom_spacing') ?: 'xl';

$margin_classes = almus_get_block_margin_classes($margin_top, $margin_bottom);

$posts = get_posts($args);

$button = get_field('button');

?>

<section class="flex flex-col justify-center items-center gap-5 <?php echo $margin_classes; ?>" style="background-color: #001C30; color: #fff;">

    <h2 class="text-white">Blog</h2>

    <div class="blog-cards gap-[30px] grid grid-rows-1 md:grid-cols-4">

        <?php foreach ($posts as $post) { ?>

            <?php
            $post_id = $post->ID;
            $post_title = $post->post_title;
            $post_date = date("F j, Y", strtotime($post->post_date));
            $post_thumbnail = get_the_post_thumbnail_url($post_id);
            $post_url = get_permalink($post_id);
            ?>

            <a href="<?php echo $post_url; ?>" class="w-[340px] md:w-auto h-[400px] md:h-[250px] lg:h-[400px] flex-shrink-0 overflow-hidden" style="border-radius: 20px">

                <div class="w-full h-1/2 overflow-hidden">
                    <img class="w-full h-full object-cover" src="<?php echo $post_thumbnail; ?>" alt="<?php echo get_the_title(); ?>">
                </div>
                <div class="flex flex-col justify-between p-2 text-left h-1/2 bg-white">
                    <h3 class="mt-2 line-clamp-2 text-blog text-base lg:text-lg p-0" style="color: #0b2f4e;"><?php echo $post_title; ?></h3>
                    <p class="text-sm" style="color: #666;"><?php echo strftime("%B %e, %Y", strtotime($post_date));  ?></p>
                </div>
            </a>
        <?php } ?>

    </div>
    
    <?php fr_render_button($button); ?>
    

</section>