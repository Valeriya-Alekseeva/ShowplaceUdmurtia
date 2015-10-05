<?php
use Urbanabru\Config;

$pathToResource = home_url() . Config::DEFAULT_TEMPLATE_PATH;
?>
<!DOCTYPE html>
<html>
<head lang="ru">
	<meta charset="UTF-8">
	<title><?= bloginfo('name') ?></title>
	<meta name="robots" content="index, follow" />
	<meta name="keywords" content="ижевск удмуртия урбанфест urbanfest форум живых городов урбанистика город городские проекты практики россия опыт" />
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
	<link rel="alternate" type="application/rss+xml" title="Yandex.News" href="<?= home_url() ?>/yandex/news/" hreflang="ru">
	<link rel="alternate" type="application/rss+xml" title="RSS 0.92 feed" href="<?= home_url() ?>/feed/rss/" hreflang="ru">
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0 feed" href="<?= home_url() ?>/feed/rss2/" hreflang="ru">
	<link rel="alternate" type="application/rss+xml" title="RDF/RSS 1.0 feed" href="<?= home_url() ?>/feed/rdf/" hreflang="ru">
	<link rel="alternate" type="application/rss+xml" title="Atom feed" href="<?= home_url() ?>/feed/atom/" hreflang="ru">
	<link rel="shortcut icon" href="<?= $pathToResource ?>/img/favicon.png" />
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&amp;subset=cyrillic,latin" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700|Roboto+Condensed&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?= $pathToResource ?>css/style.css">
</head>
<body>
	<div class="page-wrapper">
		<header class="header">
			<div class="header-logo">
				<h1 class="logotype js-logo">UR<span class="logotype__colored">BANA<span class="logotype__reverse">B</span><span class="logotype__dot">.</span></span>RU</h1>
			</div>
			<div class="header-menu">
				<div class="social-box"><a href="#" class="social-box__fb"></a><a href="#" class="social-box__vk"></a><a href="#" class="social-box__twitter"></a><a href="#" class="social-box__ok"></a></div>
				<?php get_search_form(); ?>
			</div><?php
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
				'walker' => new \Urbanabru\Menu()
			));?>
		</header>
