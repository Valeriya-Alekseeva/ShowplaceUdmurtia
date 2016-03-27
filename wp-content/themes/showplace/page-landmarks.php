<?php
/**
 * Страница "наше все".
 */
get_header();

global $post;

echo $post->post_content;

get_footer();
