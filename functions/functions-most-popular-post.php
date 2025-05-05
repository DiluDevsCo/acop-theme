<?php
function set_post_views($postID) {
 $count_key = 'post_views_count';
 $count = get_post_meta($postID, $count_key, true);
 if ($count == '') {
   $count = 1;
   delete_post_meta($postID, $count_key);
   add_post_meta($postID, $count_key, '1');
 } else {
   $count++;
   update_post_meta($postID, $count_key, $count);
 }
}
function track_post_views($post_id) {
 if (!is_single()) return;
 if (current_user_can('manage_options')) return;
 if (empty($post_id)) {
   global $post;
   $post_id = $post->ID;
 }
 set_post_views($post_id);
}
add_action('wp_head', 'track_post_views');

?>