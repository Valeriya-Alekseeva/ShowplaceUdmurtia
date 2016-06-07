<?php get_template_part('head'); ?>
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
		'after' => '<p class="main-menu__desc">%s</p>',
		'link_before' => '',
		'link_after' => '',
		'items_wrap' => '<div id="main-menu-js" class="main-menu__container"><ul class="main-menu__list">%3$s</ul></div>',
		'depth' => 0,
		'walker' => new \Showplace\Menu()
	));?>
	<div class="scroll-container">
		<div class="general-container general-container--content">
			<div class="page <?php
				if (is_page('about')){
					echo 'page--about';
				} elseif (is_page('udmurtia')){
					echo 'page--udm';
				} elseif (is_page('landmarks')){
					echo 'page--our-all';
				} elseif (is_page('test')){
					echo 'page--test';
				}?>">
				<div class="page__content">
					<h1><?php
						if (is_404()) {
							echo ($_COOKIE['qtrans_front_language'] == 'en') ? '404 Page Not Found' : '404 страница не найдена';
						} else {
							echo $post->post_title;
						}?>
					</h1>