<?php
/**
 * Главная страница
 */
use Showplace\Config;

$pathToResource = home_url() . Config::DEFAULT_TEMPLATE_PATH;

get_template_part('head'); ?>
	<body>
		<!-- include svg sprite-->
		<div id="svg-icon-placeholder"></div>
		<script>if (window.svgsprite) { document.getElementById('svg-icon-placeholder').innerHTML = svgsprite; }</script>
		<div class="scroll-container">
			<div class="general-container general-container--main-page">
				<div id="main-page-cover" class="cover">
					<h1 class="cover__title">леса, поля и реки, кумышка, перепечи, человеки</h1>
					<div class="cover__image-block">
						<img src="<?= $pathToResource ?>img/cover/cover-mobile.png" title="Удмуртия" class="cover__image cover__image--mobile">
					</div>
					<?php get_template_part('social-block'); ?>
				</div>
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
			</div>
		</div>
	</body>
	<script src="<?= $pathToResource ?>js/vendor.min.js"></script>
	<script src="<?= $pathToResource ?>js/script.min.js"></script>
</html>

