<?php

namespace Showplace;

/**
 * Class Menu
 * @package Showplace
 */
class Menu extends \Walker_Nav_Menu
{
	/**
	 * Добавление классов для тегов li, a и span
	 * @param string $output
	 * @param object $item
	 * @param int $depth
	 * @param array $args
	 */
	function start_el(&$output, $item, $depth, $args)
	{
		$class = '';
		if ('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == $item->url) {
			$class = ' active';
		}
		$output .= '<li class="main-menu__item' . $class . '">';
		$attributes = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';
		$attributes .= ' class="main-menu__link"';

		/** @var string $description Описание пункта меню которое выводится после названия пункта. Задается из админки в доп свойстве страницы */
		$description = get_field('description', $item->object_id);
		$args->after = sprintf($args->after, $description);

		$itemOutput = sprintf(
			'%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);

		$output .= apply_filters('walker_nav_menu_start_el', $itemOutput, $item, $depth, $args);
	}
} 