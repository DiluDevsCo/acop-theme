<?php
setlocale(LC_TIME, "spanish");
$args = array(
 'post_type' => 'post',
 'post_status' => 'publish',
 'numberposts' => 3,
 'order' => 'DESC'
);

$margin_top = get_field('margin-top_spacing') ?: 'xl';
$margin_bottom = get_field('margin-bottom_spacing') ?: 'xl';

$margin_classes = almus_get_block_margin_classes($margin_top, $margin_bottom);

$posts = get_posts($args);

$button = get_field('button');

?>

<section class="flex flex-col justify-center items-center gap-5 <?php echo $margin_classes; ?>">

 <p class="text-black text-xl md:text-3xl font-bold">Blog</p>

 <div class="blog-cards gap-[30px] grid grid-rows-1 md:grid-cols-3">

  <?php foreach ($posts as $post) { ?>

   <?php
   $post_id = $post->ID;
   $post_title = $post->post_title;
   $autor = $post->post_author;
   $post_date = date("F j, Y", strtotime($post->post_date));
   $post_thumbnail = get_the_post_thumbnail_url($post_id);
   $post_url = get_permalink($post_id);
   $description = wp_strip_all_tags(get_the_excerpt($post_id), true);
   ?>

   <div class="w-[340px] shadow-lg p-4 md:w-auto h-[400px] md:h-[250px] lg:h-[400px] flex-shrink-0 overflow-hidden" style="border-radius: 20px">

    <div class="w-full h-1/2 overflow-hidden">
     <h3 class="mt-2 line-clamp-2 text-blog font-extrabold lg:text-lg p-0 text-[#5A3D82]"><?php echo $post_title; ?></h3>
     <img class="w-full h-full object-cover" src="<?php echo $post_thumbnail; ?>" alt="<?php echo get_the_title(); ?>">
    </div>
    <div class="flex flex-col p-2 text-center h-1/2 bg-white justify-between">
     <p class="text-sm font-extrabold text-black truncate line-clamp-1"><?= $description ?></p>
     <p class="text-sm font-extrabold text-[#7D669B]"><?php echo get_the_author_meta('display_name', $autor); ?></p>
     <div>
      <?php acop_render_button(
       array(
        'label' => 'Leer',
        'url' => $post_url,
        'style' => 'blue',
        'size' => 'md'
       )
      ); ?>
     </div>
    </div>
   </div>
  <?php } ?>

 </div>

 <?php acop_render_button($button); ?>


</section>