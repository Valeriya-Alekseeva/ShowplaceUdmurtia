<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?= wp_title('|', true, 'right') ?><?php bloginfo('name'); ?></title>
	<link rel="apple-touch-icon" sizes="57x57" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?= \RunaCapital\Constants::PATH_RESOURCES; ?>favicons/favicon-16x16.png" sizes="16x16">
	<?php wp_head() ?>
	<!--script type="text/javascript"><?php
		/*global $wp_query;
		if (! empty($wp_query->query_vars['id'])) {
			echo 'window.location.href = "/#" + window.location.pathname;';
		}
		else {
			echo 'window.location.href = "/"';
		}*/?>
	</script-->
</head>
<body>