<?php /* Template Name: Calendario */
global $wpdb;
global $post;
if (is_user_logged_in()) {
  $current_user = wp_get_current_user();
  $current_user_roles = (array) $current_user->roles;
  $calendars = get_field('calendars');
  
  $profile_with_calendar = false;
  $original_id = null;
  if ($calendars) {
    foreach($calendars as $calendar):
      
      $intersect = array_intersect($current_user_roles, $calendar['profiles']);
      if (count($intersect) > 0) {
        $original_id = get_the_ID();
        $post = $calendar['page'];
        $profile_with_calendar = true;
        break;      
      }
    endforeach;
  }
  if ( !$profile_with_calendar ) {
    $redirect = get_field('calendar_other_users_redirect');
    $link = get_permalink($redirect->ID);
    if ($redirect) {
      if ($post->ID != $redirect->ID) {
      wp_redirect($link);
      }
    } else {
      wp_redirect('/');
    }
  }
} else {
  wp_redirect('/');
}
$post_id = $post->ID;
$is_page_builder_used = et_pb_is_pagebuilder_used( $post_id );
get_header();

?>

<div id="main-content">

  <div class="container">
    <div id="content-area" class="clearfix">
      <div id="left-area">

        <?php //while ( have_posts() ) : 
       // the_post();
          if ( $original_id != $post->ID ) {
           setup_postdata($post);
          }
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <?php if ( ! $is_page_builder_used ) : ?>

          <?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$alttext = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
					$thumbnail = get_thumbnail( $width, $height, $classtext, $alttext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $alttext, $width, $height );
				?>

          <?php endif; ?>

          <div class="entry-content">
            <?php
						the_content();

            wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
          </div>

          <?php
					if ( comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

        </article>

        <?php //endwhile; ?>

      </div>

      <?php get_sidebar(); ?>
    </div>
  </div>

</div>

<?php

get_footer();