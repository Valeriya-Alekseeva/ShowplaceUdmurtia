<?php
/**
 * Страница списка постов.
 */
get_header();

global $post;

echo $post->post_content;

get_footer();
