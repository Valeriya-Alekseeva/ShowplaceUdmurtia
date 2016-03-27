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
		$output .= '<li class="header-nav__item">';

		if ('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == $item->url) {
			$attributes = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
			$attributes .= ' class="header-nav__link"';

			$itemOutput = sprintf(
				'%1$s<span%2$s>%3$s%4$s%5$s</span>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters('the_title', $item->title, $item->ID),
				$args->link_after,
				$args->after
			);
		} else {
			$attributes = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
			$attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';
			$attributes .= ' class="main-menu__link"';

			$itemOutput = sprintf(
				'%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		}

		$output .= apply_filters('walker_nav_menu_start_el', $itemOutput, $item, $depth, $args);
	}
} 