<?php
// Obtener campos ACF
$user_id = get_field('user_id') ?: get_current_user_id();
$videos_category = get_field('videos_category');
$documentos_category = get_field('documentos_category');
$items_per_page = get_field('items_per_page') ?: 6;
$clase_personalizada = get_field('clase_css') ?: '';

// Obtener página actual desde parámetros
$current_page_videos = isset($_GET['page_videos']) ? max(1, intval($_GET['page_videos'])) : 1;
$current_page_docs = isset($_GET['page_docs']) ? max(1, intval($_GET['page_docs'])) : 1;

// Obtener datos del usuario
if ($user_id) {
    $user = get_userdata($user_id);
    if (!$user) {
        echo '<p>Usuario no encontrado.</p>';
        return;
    }
} else {
    echo '<p>No hay usuario seleccionado.</p>';
    return;
}

// Datos del usuario
$first_name = get_user_meta($user_id, 'first_name', true);
$last_name = get_user_meta($user_id, 'last_name', true);
$full_name = trim($first_name . ' ' . $last_name) ?: $user->display_name;

// Obtener roles del usuario
$user_roles = $user->roles;
$role_names = array();
foreach ($user_roles as $role) {
    switch ($role) {
        case 'administrator':
            $role_names[] = 'Administrador';
            break;
        case 'editor':
            $role_names[] = 'Editor';
            break;
        case 'author':
            $role_names[] = 'Autor';
            break;
        case 'contributor':
            $role_names[] = 'Colaborador';
            break;
        case 'subscriber':
            $role_names[] = 'Suscriptor';
            break;
        default:
            $role_names[] = ucfirst(str_replace('_', ' ', $role));
            break;
    }
}
$job_title = !empty($role_names) ? implode(', ', $role_names) : 'Usuario';

// Solo mostrar website si existe y no está vacío
$user_website = get_user_meta($user_id, 'user_url', true);
$website = !empty($user_website) ? $user_website : null;

// Solo mostrar teléfono si existe y no está vacío
$user_phone = get_user_meta($user_id, 'phone', true);
$phone = !empty($user_phone) ? $user_phone : null;

$email = $user->user_email;

// Avatar del usuario
$avatar_url = get_avatar_url($user_id, array('size' => 120));

// Función para obtener tópicos de LearnDash por categoría con paginación
if (!function_exists('get_learndash_topics_by_category_paginated')) {
    function get_learndash_topics_by_category_paginated($category_id, $page = 1, $per_page = 6) {
        if (!$category_id) return array('posts' => array(), 'total_pages' => 0, 'total_posts' => 0);
        
        // Verificar si LearnDash está activo
        if (!class_exists('SFWD_LMS')) {
            return array('posts' => array(), 'total_pages' => 0, 'total_posts' => 0);
        }
        
        // Verificar si la taxonomía existe
        if (!taxonomy_exists('ld_topic_category')) {
            return array('posts' => array(), 'total_pages' => 0, 'total_posts' => 0);
        }
        
        // Determinar si es ID numérico o slug
        $field = is_numeric($category_id) ? 'term_id' : 'slug';
        
        // Calcular offset
        $offset = ($page - 1) * $per_page;
        
        // Primero obtener el total para calcular páginas
        $args_count = array(
            'post_type' => 'sfwd-topic',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'tax_query' => array(
                array(
                    'taxonomy' => 'ld_topic_category',
                    'field'    => $field,
                    'terms'    => $category_id,
                ),
            ),
        );
        
        $total_posts = count(get_posts($args_count));
        $total_pages = ceil($total_posts / $per_page);
        
        // Obtener posts de la página actual
        $args = array(
            'post_type' => 'sfwd-topic',
            'post_status' => 'publish',
            'posts_per_page' => $per_page,
            'offset' => $offset,
            'tax_query' => array(
                array(
                    'taxonomy' => 'ld_topic_category',
                    'field'    => $field,
                    'terms'    => $category_id,
                ),
            ),
        );
        
        $posts = get_posts($args);
        
        return array(
            'posts' => $posts,
            'total_pages' => $total_pages,
            'total_posts' => $total_posts,
            'current_page' => $page
        );
    }
}

// Función para obtener archivos por categoría personalizada
if (!function_exists('get_documents_by_category_paginated')) {
    function get_documents_by_category_paginated($category_slug, $page = 1, $per_page = 6) {
        if (!$category_slug) return array('posts' => array(), 'total_pages' => 0, 'total_posts' => 0);
        
        // Calcular offset
        $offset = ($page - 1) * $per_page;
        
        // Buscar attachments con meta personalizada para categoría
        $args_count = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'meta_query' => array(
                array(
                    'key' => 'document_category',
                    'value' => $category_slug,
                    'compare' => '='
                )
            )
        );
        
        $total_posts = count(get_posts($args_count));
        $total_pages = ceil($total_posts / $per_page);
        
        // Obtener posts de la página actual
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => $per_page,
            'offset' => $offset,
            'meta_query' => array(
                array(
                    'key' => 'document_category',
                    'value' => $category_slug,
                    'compare' => '='
                )
            )
        );
        
        $posts = get_posts($args);
        
        return array(
            'posts' => $posts,
            'total_pages' => $total_pages,
            'total_posts' => $total_posts,
            'current_page' => $page
        );
    }
}

// Obtener tópicos y documentos con paginación
$videos_data = get_learndash_topics_by_category_paginated($videos_category, $current_page_videos, $items_per_page);
$documentos_data = get_documents_by_category_paginated($documentos_category, $current_page_docs, $items_per_page);

// Función para generar paginación
function render_pagination($current_page, $total_pages, $tab_type) {
    if ($total_pages <= 1) return;
    
    $base_url = remove_query_arg(array('page_videos', 'page_docs'));
    echo '<div class="pagination-wrapper mt-6 flex justify-center">';
    echo '<nav class="flex items-center space-x-2">';
    
    // Botón anterior
    if ($current_page > 1) {
        $prev_url = add_query_arg("page_{$tab_type}", $current_page - 1, $base_url);
        echo '<a href="' . esc_url($prev_url) . '" class="px-3 py-2 text-sm bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">Anterior</a>';
    }
    
    // Números de página
    $start = max(1, $current_page - 2);
    $end = min($total_pages, $current_page + 2);
    
    if ($start > 1) {
        $page_url = add_query_arg("page_{$tab_type}", 1, $base_url);
        echo '<a href="' . esc_url($page_url) . '" class="px-3 py-2 text-sm bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">1</a>';
        if ($start > 2) {
            echo '<span class="px-3 py-2 text-sm text-gray-500">...</span>';
        }
    }
    
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $current_page) {
            echo '<span class="px-3 py-2 text-sm bg-[#8B71A8] text-white rounded-md">' . $i . '</span>';
        } else {
            $page_url = add_query_arg("page_{$tab_type}", $i, $base_url);
            echo '<a href="' . esc_url($page_url) . '" class="px-3 py-2 text-sm bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">' . $i . '</a>';
        }
    }
    
    if ($end < $total_pages) {
        if ($end < $total_pages - 1) {
            echo '<span class="px-3 py-2 text-sm text-gray-500">...</span>';
        }
        $page_url = add_query_arg("page_{$tab_type}", $total_pages, $base_url);
        echo '<a href="' . esc_url($page_url) . '" class="px-3 py-2 text-sm bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">' . $total_pages . '</a>';
    }
    
    // Botón siguiente
    if ($current_page < $total_pages) {
        $next_url = add_query_arg("page_{$tab_type}", $current_page + 1, $base_url);
        echo '<a href="' . esc_url($next_url) . '" class="px-3 py-2 text-sm bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">Siguiente</a>';
    }
    
    echo '</nav>';
    echo '</div>';
}
?>

<div class="user-profile-block <?php echo esc_attr($clase_personalizada); ?> max-w-4xl mx-auto bg-white">
    
    <!-- Header del perfil -->
    <div class="profile-header flex items-center md:items-start md:space-x-6 mb-8 p-6">
        <!-- Avatar -->
        <div class="md:flex-shrink-0">
            <div class="w-24 h-24 rounded-full bg-[#8B71A8] flex items-center justify-center overflow-hidden">
                <?php if ($avatar_url): ?>
                    <img src="<?php echo esc_url($avatar_url); ?>" 
                         alt="<?php echo esc_attr($full_name); ?>"
                         class="w-full h-full object-cover">
                <?php else: ?>
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Info del usuario -->
        <div class="md:flex-1">
            <h1 class="text-2xl font-bold text-gray-900 mb-1"><?php echo esc_html($full_name); ?></h1>
            <p class="text-gray-600 mb-4"><?php echo esc_html($job_title); ?></p>
            
            <div class="space-y-1 text-sm text-gray-600">
                <?php if ($website): ?>
                    <div><?php echo esc_html($website); ?></div>
                <?php endif; ?>
                <?php if ($phone): ?>
                    <div><?php echo esc_html($phone); ?></div>
                <?php endif; ?>
                <div><?php echo esc_html($email); ?></div>
            </div>
        </div>
    </div>
    
    <!-- Tabs -->
    <div class="profile-tabs">
        <!-- Tab headers -->
        <div class="flex bg-[#8B71A8] rounded-t-lg overflow-hidden">
            <button class="tab-button flex-1 py-3 px-6 text-white font-medium hover:bg-[#7A5F97] transition-colors active" 
                    data-tab="videos">
                Videos (<?php echo $videos_data['total_posts']; ?>)
            </button>
            <button class="tab-button flex-1 py-3 px-6 text-white font-medium hover:bg-[#7A5F97] transition-colors" 
                    data-tab="documentos">
                Documentos (<?php echo $documentos_data['total_posts']; ?>)
            </button>
        </div>
        
        <!-- Tab content Videos -->
        <div id="videos-tab" class="tab-content active bg-gray-50 p-6">
            <?php if (!empty($videos_data['posts'])): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($videos_data['posts'] as $topic): ?>
                        <?php
                        $topic_url = get_permalink($topic->ID);
                        $topic_date = get_the_date('j M Y', $topic->ID);
                        
                        // Obtener descripción del tópico (excerpt o contenido)
                        $topic_description = '';
                        if (!empty($topic->post_excerpt)) {
                            $topic_description = wp_trim_words($topic->post_excerpt, 20, '...');
                        } else {
                            $topic_description = wp_trim_words($topic->post_content, 20, '...');
                        }
                        
                        $topic_thumbnail = get_the_post_thumbnail_url($topic->ID, 'medium');
                        
                        // Obtener el autor del tópico
                        $topic_author_id = $topic->post_author;
                        $topic_author = get_userdata($topic_author_id);
                        $author_name = $topic_author ? trim($topic_author->first_name . ' ' . $topic_author->last_name) : '';
                        if (empty($author_name)) {
                            $author_name = $topic_author ? $topic_author->display_name : 'Autor desconocido';
                        }
                        ?>
                        <div class="course-card bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                            <!-- Thumbnail del tópico -->
                            <div class="course-thumbnail h-40 bg-[#8B71A8] flex items-center justify-center relative overflow-hidden">
                                <?php if ($topic_thumbnail): ?>
                                    <img src="<?php echo esc_url($topic_thumbnail); ?>" 
                                         alt="<?php echo esc_attr($topic->post_title); ?>"
                                         class="w-full h-full object-cover">
                                <?php else: ?>
                                    <svg class="w-12 h-12 text-white opacity-80" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-8 12.5v-9l6 4.5-6 4.5z"/>
                                    </svg>
                                <?php endif; ?>
                                <!-- Overlay para mejorar legibilidad -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                            
                            <!-- Info del tópico -->
                            <div class="p-4">
                                <div class="text-xs text-[#654690] mb-2 font-medium"><?php echo esc_html($author_name); ?> • <?php echo esc_html($topic_date); ?></div>
                                <h3 class="font-bold text-[#4A5568] mb-2 line-clamp-2 leading-tight">
                                    <a href="<?php echo esc_url($topic_url); ?>" class="hover:text-[#8B71A8] text-[#5A3D82] transition-colors">
                                        <?php echo esc_html($topic->post_title); ?>
                                    </a>
                                </h3>
                                <?php if ($topic_description): ?>
                                    <p class="text-sm text-[#38A3CE] line-clamp-3 leading-relaxed"><?php echo esc_html($topic_description); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Paginación para videos -->
                <?php render_pagination($videos_data['current_page'], $videos_data['total_pages'], 'videos'); ?>
                
            <?php else: ?>
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-8 12.5v-9l6 4.5-6 4.5z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500">No hay videos disponibles</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Tab content Documentos -->
        <div id="documentos-tab" class="tab-content bg-gray-50 p-6 hidden">
            <?php if (!empty($documentos_data['posts'])): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($documentos_data['posts'] as $document): ?>
                        <?php
                        $file_url = wp_get_attachment_url($document->ID);
                        $file_date = get_the_date('j M Y', $document->ID);
                        $file_size = size_format(filesize(get_attached_file($document->ID)));
                        $file_type = get_post_mime_type($document->ID);
                        $file_name = basename(get_attached_file($document->ID));
                        
                        // Obtener el autor del archivo
                        $file_author_id = $document->post_author;
                        $file_author = get_userdata($file_author_id);
                        $author_name = $file_author ? trim($file_author->first_name . ' ' . $file_author->last_name) : '';
                        if (empty($author_name)) {
                            $author_name = $file_author ? $file_author->display_name : 'Autor desconocido';
                        }
                        
                        // Determinar icono según tipo de archivo
                        $file_icon = 'document'; // por defecto
                        if (strpos($file_type, 'image') !== false) {
                            $file_icon = 'image';
                        } elseif (strpos($file_type, 'pdf') !== false) {
                            $file_icon = 'pdf';
                        } elseif (strpos($file_type, 'video') !== false) {
                            $file_icon = 'video';
                        } elseif (strpos($file_type, 'audio') !== false) {
                            $file_icon = 'audio';
                        }
                        ?>
                        <div class="course-card bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                            <!-- Thumbnail del documento -->
                            <div class="course-thumbnail h-40 bg-[#8B71A8] flex items-center justify-center">
                                <?php if ($file_icon === 'image'): ?>
                                    <img src="<?php echo esc_url($file_url); ?>" 
                                         alt="<?php echo esc_attr($document->post_title); ?>"
                                         class="w-full h-full object-cover">
                                <?php else: ?>
                                    <?php
                                    $svg_path = '';
                                    switch ($file_icon) {
                                        case 'pdf':
                                            $svg_path = 'M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z';
                                            break;
                                        case 'video':
                                            $svg_path = 'M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-8 12.5v-9l6 4.5-6 4.5z';
                                            break;
                                        case 'audio':
                                            $svg_path = 'M12,3V12.26C11.5,12.09 11,12 10.5,12C8.57,12 7,13.57 7,15.5C7,17.43 8.57,19 10.5,19C12.43,19 14,17.43 14,15.5V7H18V5H12V3Z';
                                            break;
                                        default:
                                            $svg_path = 'M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z';
                                    }
                                    ?>
                                    <svg class="w-12 h-12 text-white opacity-60" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="<?php echo $svg_path; ?>"/>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Info del documento -->
                            <div class="p-4">
                                <div class="text-xs text-gray-500 mb-2"><?php echo esc_html($author_name); ?> • <?php echo esc_html($file_date); ?></div>
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                    <a href="<?php echo esc_url($file_url); ?>" target="_blank" class="hover:text-[#8B71A8] transition-colors">
                                        <?php echo esc_html($document->post_title ?: $file_name); ?>
                                    </a>
                                </h3>
                                <div class="text-xs text-gray-500 space-y-1">
                                    <div>Tipo: <?php echo esc_html($file_type); ?></div>
                                    <div>Tamaño: <?php echo esc_html($file_size); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Paginación para documentos -->
                <?php render_pagination($documentos_data['current_page'], $documentos_data['total_pages'], 'docs'); ?>
                
            <?php else: ?>
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500">No hay documentos disponibles</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>