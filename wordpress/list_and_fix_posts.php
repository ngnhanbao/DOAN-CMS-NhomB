<?php
require_once(__DIR__ . '/wp-load.php');

header('Content-Type: text/plain; charset=utf-8');

$posts = get_posts(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'numberposts' => -1,
    'orderby' => 'ID',
    'order' => 'ASC'
));

echo "FOUND " . count($posts) . " POSTS:\n\n";

foreach ($posts as $p) {
    $thumb_id = get_post_thumbnail_id($p->ID);
    $thumb_url = $thumb_id ? wp_get_attachment_url($thumb_id) : 'NONE';
    $has_img_in_content = preg_match('/<img[^>]+>/i', $p->post_content) ? 'YES' : 'NO';
    echo "ID: {$p->ID} | Title: {$p->post_title}\n";
    echo "   Thumbnail ID: {$thumb_id} | URL: {$thumb_url}\n";
    echo "   Has Content Image: {$has_img_in_content}\n\n";
}
