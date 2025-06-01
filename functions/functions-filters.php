<?php
add_filter('et_html_main_header','sculapp_remove_divi_header',10,1);

// Elimina cualquier header inyectado por Divi cuando el header de Sculapp esta activo
function sculapp_remove_divi_header($html) {
  $header_enabled = sculapp_is_header_enabled();
  if ($header_enabled) {
    $html = '';
  }
  return $html;
}

// Agrega clase sculapp-header para poder eliminar el padding en #page-container agregado por Divi cuando usamos el nuevo header
add_filter('body_class','sculapp_add_custom_body_classes',10,1);

function sculapp_add_custom_body_classes($classes) {
  $header_enabled = sculapp_is_header_enabled();
  if ($header_enabled) {
    $classes[] = 'acop-header';
  }
  $classes[] = 'acop';
  return $classes;
}

// Actualiza el carrito de compras en el header cada vez que se actualize el carrito con Ajax
add_filter( 'woocommerce_add_to_cart_fragments', 'sculapp_cart_count_fragments', 10, 1 );


add_filter('admin_body_class', 'sculapp_add_admin_body_class', 10,1); 

function sculapp_add_admin_body_class($classes) {
  $classes .= ' acop';
  return $classes;
}

// Agregar campo de categoría a los attachments
function add_attachment_category_field($form_fields, $post) {
    $form_fields['document_category'] = array(
        'label' => 'Categoría de Documento',
        'input' => 'select',
        'options' => array(
            '' => 'Sin categoría',
            'documentos' => 'Documentos',
            'videos' => 'Videos',
            'imagenes' => 'Imágenes',
            'audios' => 'Audios'
        ),
        'value' => get_post_meta($post->ID, 'document_category', true),
        'helps' => 'Selecciona la categoría para este archivo'
    );
    
    return $form_fields;
}
add_filter('attachment_fields_to_edit', 'add_attachment_category_field', null, 2);

// Guardar el campo de categoría
function save_attachment_category_field($post, $attachment) {
    if (isset($attachment['document_category'])) {
        update_post_meta($post['ID'], 'document_category', $attachment['document_category']);
    }
    return $post;
}
add_filter('attachment_fields_to_save', 'save_attachment_category_field', null, 2);

// Agregar columna en la lista de medios
function add_media_category_column($columns) {
    $columns['document_category'] = 'Categoría';
    return $columns;
}
add_filter('manage_media_columns', 'add_media_category_column');

function show_media_category_column($column_name, $post_id) {
    if ($column_name === 'document_category') {
        $category = get_post_meta($post_id, 'document_category', true);
        echo $category ? esc_html(ucfirst($category)) : '—';
    }
}
add_action('manage_media_custom_column', 'show_media_category_column', 10, 2);

// Habilitar excerpt para tópicos de LearnDash
function add_excerpt_support_to_topics() {
    add_post_type_support('sfwd-topic', 'excerpt');
}
add_action('init', 'add_excerpt_support_to_topics');

// Agregar metabox de excerpt en la página de edición de tópicos
function add_topic_excerpt_metabox() {
    add_meta_box(
        'postexcerpt',
        __('Descripción del Tópico'),
        'post_excerpt_meta_box',
        'sfwd-topic',
        'normal',
        'core'
    );
}
add_action('add_meta_boxes', 'add_topic_excerpt_metabox');