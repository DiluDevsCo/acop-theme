<?php get_header(); ?>

<div class="container mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-12 gap-8">

 <!-- Contenido principal -->

 <div class="md:col-span-8">
 <div>
  <a href="/blog" class="inline-block px-4 py-2 text-black">← Anterior</a>
 </div>
  <h1 class="text-4xl font-bold mb-6"><?php the_title(); ?></h1>
  <div class="prose max-w-none">
   <?php
   if (have_posts()) :
    while (have_posts()) : the_post();
     the_content();
    endwhile;
   endif;
   ?>
   <a href="/blog" class="inline-block px-4 py-2 text-black">← Anterior</a>
  </div>

  <!-- Comentarios -->
  <?php if (comments_open()) : ?>
   <div id="respond" class="mt-12">
    <h2 class="text-2xl font-semibold mb-4">Enviar comentario</h2>
    <p class="text-sm text-gray-500 mb-6">Tu dirección de correo electrónico no será publicada. Los campos obligatorios están marcados con *</p>

    <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" class="space-y-4">
     <!-- Comentario -->
     <textarea name="comment" id="comment" rows="4" required
      class="w-full border border-gray-300 rounded-md p-4 focus:outline-none focus:ring-2 focus:ring-purple-500"
      placeholder="Comentario *"></textarea>

     <!-- Inputs en 3 columnas -->
     <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <input type="text" name="author" id="author" required
       class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-purple-500"
       placeholder="Nombre *">

      <input type="email" name="email" id="email" required
       class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-purple-500"
       placeholder="Correo electrónico *">

      <input type="url" name="url" id="url"
       class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-purple-500"
       placeholder="Web">
     </div>

     <!-- Campos ocultos obligatorios -->
     <?php comment_id_fields(); ?>
     <?php do_action('comment_form', get_the_ID()); ?>

     <!-- Botón -->
     <button type="submit"
      class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded shadow-md transition">
      Enviar
     </button>
    </form>
   </div>
  <?php endif; ?>
 </div>

 <!-- Sidebar -->
 <div class="md:col-span-4 space-y-8">


  <div>
   <h3 class="text-xl font-semibold mb-4">Más populares</h3>
   <?php
   // Popular posts (top 3 by meta_key "post_views_count")
   $popular_args = [
    'post_type' => 'post',
    'posts_per_page' => 3,
    'meta_key' => 'post_views_count',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
   ];
   $popular = new WP_Query($popular_args);
   if ($popular->have_posts()) :
    while ($popular->have_posts()) : $popular->the_post();
   ?>
     <div class="mb-4 flex gap-4 items-start">
      <div class="w-20">
       <?php the_post_thumbnail('thumbnail', ['class' => 'rounded w-full']); ?>
      </div>
      <div>
       <h4 class="text-sm font-semibold leading-snug"><?php the_title(); ?></h4>
       <a href="<?php the_permalink(); ?>" class="text-blue-600 text-sm hover:underline">Leer</a>
      </div>
     </div>
   <?php endwhile;
    wp_reset_postdata();
   endif;
   ?>
  </div>

  
 </div>
</div>

<?php get_footer(); ?>