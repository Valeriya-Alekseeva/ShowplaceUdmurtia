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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= $pathToResource ?>css/style.css">
	<script src="svg/js-sprite.js"></script>
</head>
<body>
	<!-- include svg sprite-->
	<div id="svg-icon-placeholder"></div>
	<script>if (window.svgsprite) { document.getElementById('svg-icon-placeholder').innerHTML = svgsprite; }</script>
	<button id="show-menu-js" class="button-logo main-menu__button">
		<svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 100 100">
			<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo"></use>
		</svg>
	</button>
	<?php wp_nav_menu(array(
		'theme_location' => '',
		'menu' => '',
		'container' => '',
		'container_class' => '',
		'container_id' => '',
		'menu_class' => 'main-menu__item',
		'menu_id' => '',
		'echo' => true,
		'fallback_cb' => 'wp_page_menu',
		'before' => '',
		'after' => '',
		'link_before' => '',
		'link_after' => '',
		'items_wrap' => '<div id="main-menu-js" class="main-menu__container"><ul class="main-menu__list">%3$s</ul></div>',
		'depth' => 0,
		'walker' => new \Showplace\Menu()
	));?>
	<div class="scroll-container">
		<div class="general-container">
			<div class="page page--about">
				<div class="page__content">
					<h1>О проекте</h1>