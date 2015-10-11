<?php
/**
 * Plugin Name: Плагин для udmurtia.kicasso.com
 * Description: Плагин содержит функции для вывода контента на страницы
 */

$classes = array(
	'Config.php',
	'Menu.php',
	'ContentHelper.php'
);

foreach ($classes as $classPath) {
	require('classes/' . $classPath);
}