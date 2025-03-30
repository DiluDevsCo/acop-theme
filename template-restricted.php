<?php /* Template Name: Acceso restringido */

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );
$hide_title = get_field('hide_title');
?>

<div id="main-content">

  <?php if ( ! $is_page_builder_used ) : ?>

  <div id="content-area" class="clearfix">
    <div id="left-area">

      <?php endif; ?>

      <?php
            if ( ! is_user_logged_in() ) {
            $args = array (
                'redirect' => site_url('/'), // redirect to admin dashboard.
                'form_id' => 'custom_loginform',
                'label_username' => __( 'Username:' ),
                'label_password' => __( 'Password:' ),
                'label_remember' => __( 'Remember Me' ),
                'label_log_in' => __( 'Log In' ),
                'remember' => true
            );?>
      <?php
             if (isset($_GET['login'])) {
              $message = '';
              if ($_GET['login'] === 'failed') {
                  $message = 'Nombre de usuario o contraseña incorrectos.';
              } elseif ($_GET['login'] === 'pirata') {
                  $message = 'Detectamos un comportamiento sospechoso en tu cuenta. 
                  Por seguridad, hemos bloqueado temporalmente tu acceso al contenido. 
                  Si crees que esto es un error, escríbenos y lo solucionaremos juntos.';
              } elseif ($_GET['login'] === 'congelado') {
                  $message = 'Actualmente, tu cuenta está en un periodo de congelamiento activo. 
                  Si ya estás listo para retomar tu preparación, ¡escríbenos! Estaremos felices 
                  de ayudarte a reactivarla.';
              } elseif ($_GET['login'] === 'moroso') {
                  $message = 'Hemos notado que tienes algunos pagos pendientes. 
                  Por esta razón, tu acceso a la plataforma está inhabilitado temporalmente. 
                  Escríbenos para ayudarte a ponerte al día, y retomar la preparación que te
                  ayudará a cumplir tu sueño de ser especialista.';
              }
              elseif ($_GET['login'] === 'egresado') {
               $message = 'Tu tiempo de acceso a la plataforma ha finalizado, ¡gracias por 
               haberte preparado con nosotros! Si quieres continuar con tu preparación, escríbenos 
               y te daremos todas las opciones para que puedas retomar.';
              }
      
              if ($message) {
                  $args['error'] = '<div class="bg-red-100 rounded-md text-red-700 py-2 px-4 text-center text-sm">' . esc_html($message) . '</div>';
              }
          }
            acop_wp_login_form( $args );
            ?>
      <?php
          } else { ?>
      <?php while ( have_posts() ) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class("pt-16 md:pt-0 border-t border-solid border-gray-100"); ?>>
        <?php if ( ! $is_page_builder_used ) : ?>
        <?php if ($hide_title != true) { ?>
        <h1 class="entry-title main_title"><?php the_title(); ?></h1>
        <?php }?>
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

        <div class="entry-content container-fluid">
          <?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
        </div>

        <?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

      </article>

      <?php endwhile;
      } ?>

      <?php if ( ! $is_page_builder_used ) : ?>

    </div>

    <?php get_sidebar(); ?>
  </div>


  <?php endif; ?>

</div>

<?php

get_footer();