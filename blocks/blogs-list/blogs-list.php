<!-- Listado de blogs con paginacion -->

<?php
$paged = max(1, get_query_var('paged') ? get_query_var('paged') : get_query_var('page'));

$args = [
 'post_type'      => 'post',
 'posts_per_page' => 6,
 'paged'          => $paged,
];

$query = new WP_Query($args);
?>

<?php if ($query->have_posts()) : ?>
 <div class="w-full max-w-4xl mx-auto px-4 py-8 grid">
  <?php while ($query->have_posts()) : $query->the_post(); ?>
   <div class="blog-card flex gap-6 items-center justify-start border-b pb-6 mb-6">
    <div class="w-1/4 shrink-0">
     <?php the_post_thumbnail('medium', ['class' => 'rounded-lg w-full h-auto object-cover']); ?>
    </div>
    <div class="content">
     <span class="text-sm text-gray-500"><?php echo get_the_date(); ?></span>
     <h2 class="text-xl font-extrabold mt-1 mb-2"><?php the_title(); ?></h2>
     <p class="text-gray-700 mb-4"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
     <div>
      <?php acop_render_button(
       array(
        'label' => 'Leer',
        'url' => the_permalink(),
        'style' => 'blue',
        'size' => 'md'
       )
      ); ?>
     </div>
    </div>
   </div>
  <?php endwhile; ?>
 </div>
<?php endif; ?>

<div class="pagination flex justify-center my-8 flex-wrap gap-2">
 <?php
 $links = paginate_links([
  'total'        => $query->max_num_pages,
  'current'      => $paged,
  'prev_text'    => '«',
  'next_text'    => '»',
  'type'         => 'array',
 ]);

 if ($links) {
  foreach ($links as $link) {
   echo '<div class="pagination-link">' . str_replace(
    ['page-numbers', 'current'],
    ['px-4 py-2 border border-[#1976D2] rounded-full text-sm text-black hover:bg-[#1976D2] hover:text-white hover:bg-opacity-50 transition', 'bg-[#1976D2] bg-opacity-50 text-[#1976D2]'],
    $link
   ) . '</div>';
  }
 }
 ?>
</div>

<?php wp_reset_postdata(); ?>