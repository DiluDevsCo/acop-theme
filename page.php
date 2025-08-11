<?php

get_header();



$is_page_builder_used = et_pb_is_pagebuilder_used(get_the_ID());
$hide_title = get_field('hide_title');

if (!$hide_title) get_template_part('template-parts/header', 'banner');

$bool_color = get_field('bool_color');
$bg_color = get_field("bg_color");

?>

<div id="main-content" class="<?php echo is_single() ? "bg-entry" : "bg-page"; ?>" <?php  echo $bool_color ? "style='background: $bg_color !important'": ""; ?> >
  <?php if (!$is_page_builder_used) : ?>

    <div id="content-area" class="clearfix <?php echo is_single() ? "bg-entry" : "bg-page"; ?>" <?php  echo $bool_color ? "style='background: $bg_color !important'": ""; ?>>
      <div id="left-area">

      <?php endif; ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class("border-solid border-gray-100"); ?>>
        <?php if (!$is_page_builder_used) : ?>
          
          <?php
          $thumb = '';

          $width = (int) apply_filters('et_pb_index_blog_image_width', 1080);

          $height = (int) apply_filters('et_pb_index_blog_image_height', 675);
          $classtext = 'et_featured_image';
          $titletext = get_the_title();
          $alttext = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
          $thumbnail = get_thumbnail($width, $height, $classtext, $alttext, $titletext, false, 'Blogimage');
          $thumb = $thumbnail["thumb"];

          if ('on' === et_get_option('divi_page_thumbnails', 'false') && '' !== $thumb)
            print_thumbnail($thumb, $thumbnail["use_timthumb"], $alttext, $width, $height);
          ?>

        <?php endif; ?>

        <div class="entry-content container-fluid">
          <?php
          the_content();

          if (!$is_page_builder_used)
            wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'Divi'), 'after' => '</div>'));
          ?>
        </div>

        <?php
        if (!$is_page_builder_used && comments_open() && 'on' === et_get_option('divi_show_pagescomments', 'false')) comments_template('', true);
        ?>

      </article>

      <?php if (!$is_page_builder_used) : ?>

      </div>

      <?php get_sidebar(); ?>
    </div>


  <?php endif; ?>

</div>

<?php

get_footer();
