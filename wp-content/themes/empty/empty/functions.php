<?php
use \RunaCapital\Helper as Helper;
use \RunaCapital\Content as Content;
use \RunaCapital\Constants as Constants;

function rewriteRules() {
	$sectionsCodes = Constants::TEAM_SECTION_CODE . '|' . Constants::PROJECT_SECTION_CODE;

	add_rewrite_tag('%section%', '(' . $sectionsCodes . ')');
	add_rewrite_tag('%id%', '([0-9]+)');
	add_rewrite_rule (
		'(' . $sectionsCodes . ')/([0-9]+)/?',
		'index.php?section=$matches[1]&id=$matches[2]',
		'top'
	);
	add_rewrite_rule (
		'(' . $sectionsCodes . ')/?',
		'index.php?section=$matches[1]',
		'top'
	);
	flush_rewrite_rules();
}

add_action("init", "rewriteRules");

if (function_exists("add_theme_support")) {
	add_theme_support("menus");
}

/**
 * Именение meta тегов для внутренних страниц
 * @param $metatags
 * @return mixed
 */
function customizeOgMetatag($metatags) {
	global $wp_query;
	$id = $wp_query->query_vars['id'];

	if (! empty($id)) {
		$posts = Content::getInfo('', array('p' => $id));

		if (is_array($posts) && isset($posts[0]) && ! empty($posts[0])) {
			$post = $posts[0];
			$title = Helper::removeSpecialCharacters($post->post_title);
			$desc = Helper::removeSpecialCharacters($post->post_content);
			foreach ($metatags as &$tag) {
				if (substr_count($tag, 'og:title')) {
					$tag = str_replace('content="', 'content="' . $title . ' | ', $tag);
				}
				elseif (substr_count($tag, 'og:description')) {
					$tag = '<meta property="og:description" content="' . $desc . '" />';
				}
				elseif (substr_count($tag, 'og:url')) {
					$tag = '<meta property="og:url" content="' . esc_url(home_url($_SERVER['REDIRECT_URL'])) . '" />';
				}
			}
		}
	}
	return $metatags;
}

add_filter('amt_opengraph_metadata_head', 'customizeOgMetatag', 12, 1);


function customize2OgMetatag($metatags) {
	global $wp_query;
	$id = $wp_query->query_vars['id'];
	if (! empty($id)) {
		$posts = Content::getInfo('', array('p' => $id));

		if (is_array($posts) && isset($posts[0]) && ! empty($posts[0])) {
			$post = $posts[0];
			$desc = Helper::removeSpecialCharacters($post->post_content);
			foreach ($metatags as &$tag) {
				if (substr_count($tag, 'name="description"')) {
					$tag = '<meta name="description" content="' . $desc . '" />';
				}
			}
		}
	}
	return $metatags;
}

add_filter('amt_basic_metadata_head', 'customize2OgMetatag', 10, 1);

/**
 * Изменение заголовка страницы
 *
 * @param $title
 * @return string
 */
function customizeTitle($title) {
	global $wp_query;
	$id = $wp_query->query_vars['id'];
	if (! empty($id)) {
		$posts = Content::getInfo('', array('p' => $id));

		if (is_array($posts) && isset($posts[0]) && ! empty($posts[0])) {
			$post = $posts[0];
			$title = Helper::removeSpecialCharacters($post->post_title);
			return $title . ' | ';
		}
	}
	return $title;
}
add_filter('wp_title', 'customizeTitle', 10, 1);

/**
 * Событие на изменение произвольного поля
 * Добавляется / изменяется короткая ссылка для постов групп: News, Press-releases, Bootcamp
 *
 * @param $value
 * @param $postId
 * @param $field
 * @return mixed
 */
//function updateValueCustomField($value, $postId, $field)
//{
//	if ((int)$postId > 0 && isset($field['key'])) {
//		$urlPost = '';
//		switch ($field['key']) {
//			case Constants::KEY_FIELD_SHORT_LINK_FOR_NEWS:
//				/* News */
//				$urlPost = sprintf(Constants::URL_TEMPLATE_FOR_SECTION, Constants::NEWS_SECTION_CODE, $postId);
//				break;
//			case Constants::KEY_FIELD_SHORT_LINK_FOR_PRESS_RELEASES:
//				/* Press-releases */
//				$urlPost = sprintf(Constants::URL_TEMPLATE_FOR_SECTION, Constants::PRESS_RELEASES_SECTION_CODE, $postId);
//				break;
//			case Constants::KEY_FIELD_SHORT_LINK_FOR_BOOTCAMP:
//				/* Bootcamp */
//				$urlPost = sprintf(Constants::URL_TEMPLATE_FOR_SECTION, Constants::BOOTCAMP_SECTION_CODE, $postId);
//				break;
//		}
//
//		if (! empty($urlPost)) {
//			$bitlyLinkDate = Bitly::getShortenLink($_SERVER['HTTP_ORIGIN'] . $urlPost, Constants::BITLY_DOMAIN);
//			if (is_array($bitlyLinkDate) && $bitlyLinkDate['short_url'] != $value) {
//				/* Добавляется / изменяется короткая ссылка для постов групп: News, Press-releases, Bootcamp */
//				return $bitlyLinkDate['short_url'];
//			}
//		}
//	}
//
//	return $value;
//}
//add_filter('acf/update_value/name=short_link', 'updateValueCustomField', 10, 3);