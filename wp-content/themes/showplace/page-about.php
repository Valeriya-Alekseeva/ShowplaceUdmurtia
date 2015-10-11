<?php
/**
 * Страница списка постов.
 */
get_header();

global $post, $wp_query;
echo $page->post_content;

echo do_shortcode('[contact-form-7 id="20" title="Обратная связь" html_class="form contact-form about__form form__container"]');

get_footer();
