<?php
use Showplace\Config;

$pathToResource = home_url() . Config::DEFAULT_TEMPLATE_PATH;
?>
<!DOCTYPE html>
<html>
<head lang="ru">
	<meta charset="UTF-8">
	<title><?= bloginfo('name') ?></title>
	<meta name="robots" content="index, follow" />
	<meta name="keywords" content="Достопримечательности Удмуртии, примечательности Удмуртии, памятники, история, attractions Udmurtia" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:url" content="<?= (home_url() . $_SERVER['REQUEST_URI']) ?>">
	<meta property="og:title" content="<?= $titlePage; ?><?= bloginfo('name') ?>"/>
	<meta property="og:type" content="website">
	<meta name="description" content="<?= bloginfo('description'); ?>" />
	<meta property="og:description" content="<?= bloginfo('description'); ?>">
	<meta property="og:image" content="<?= $pathToResource ?>img/ogimage200.png">
	<meta property="og:site_name" content="<?= get_bloginfo('name'); ?>">
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@Urbanab_ru" />
	<meta name="twitter:title" content="<?= $titlePage; ?><?= bloginfo('name') ?>" />
	<meta name="twitter:image" content="<?= $pathToResource ?>img/ogimage200.png" />
	<!--link rel="stylesheet" type="text/css" href="<?= $pathToResource ?>css/style.css"-->
</head>
<body><?php
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
	));?>
