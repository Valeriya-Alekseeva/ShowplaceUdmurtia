<?php
/**
 * Главная страница
 */
get_header();?>
<h1>Удмуртия</h1>
<p>На самом-то деле вся планета Земля — это Удмуртия и Неудмуртии…</p><?php
wp_nav_menu(array(
	'theme_location' => '',
	'menu' => '',
	'container' => 'nav',
	'container_class' => 'header-nav',
	'container_id' => '',
	'menu_class' => 'header-nav-list',
	'menu_id' => '',
	'echo' => true,
	'fallback_cb' => 'wp_page_menu',
	'before' => '',
	'after' => '',
	'link_before' => '',
	'link_after' => '',
	'items_wrap' => '<ul class="header-nav-list">%3$s</ul>',
	'depth' => 0,
	'walker' => new \Showplace\Menu()
));?><?php
get_footer();
