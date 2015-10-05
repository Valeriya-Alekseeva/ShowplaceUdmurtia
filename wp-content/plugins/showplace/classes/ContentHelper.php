<?php

namespace Urbanabru;

use Urbanabru\Config;

/**
 * Class ContentHelper
 * @package Urbanabru
 */
class ContentHelper {

	/**
	 * Количество выводимых постов на страницу списка
	 * @var int
	 */
	private $numberPostsOnPageList = 10;

	/**
	 * Возвращает массив данных о записи
	 * @return array|bool|null|\WP_Post
	 */
	function getSinglePost() {
		global $post;
		$result = false;
		if (have_posts()) {
			the_post();
			$category = get_the_category($post->ID);
			if (is_array($category) && count($category) > 0) {
				$post->category = $category;
				// Получаем произвольные поля
				$post->fields = get_fields($post->ID);
				$post->fields['detail_image'] = (isset($post->fields['detail_image']) && ! empty($post->fields['detail_image'])) ? $post->fields['detail_image'] : Config::DEFAULT_IMAGE_SRC;

				// Получаем текст поста
				$content = get_post_field('post_content', $post->ID);
				$post->contentParts = get_extended($content);

				// Метки
				$post->terms = wp_get_post_tags($post->ID);

				if (isset($post->fields['photos']) && is_array($post->fields['photos']) && count($post->fields['photos']) > 0) {
					foreach ($post->fields['photos'] as &$photo) {
						$photo->fields = get_fields($photo->ID);
						$photo->terms = wp_get_post_tags($photo->ID);
						$post->fields['detail_image'] = (isset($post->fields['detail_image']) && ! empty($post->fields['detail_image'])) ? $post->fields['detail_image'] : Config::DEFAULT_IMAGE_SRC;
					}
				}

				$result = $post;

				// Читайте далее
				$readMorePosts = array();
				// Получаем предыдущий пост для блока читайте далее
				$previousPost = get_previous_post(true);
				$isHavePosts = is_object($previousPost) ? true : false;
				$readMorePosts[] = $previousPost;
				// Получаем 2 последующих поста для блока читайте далее
				$query = new \WP_Query(array(
					'posts_per_page' => 2,
					'category_name' => $category[0]->slug,
					'orderby' => 'post_date',
					'order'=> 'DESC',
					'post_status' => 'publish',
					'post__not_in' => array($post->ID),
					'date_query' => array(
						array(
							'after' => $post->post_date,
							'inclusive' => true,
						),
					)
				));
				while ($query->have_posts()) {
					$query->the_post();
					$readMorePosts[] = $post;
				}
				wp_reset_postdata();
				$result->readMorePosts = array();
				if ($isHavePosts || count($readMorePosts) > 2) {
					$numperReadMorePosts = 0;
					foreach ($readMorePosts as &$post) {
						if (is_object($post) && $numperReadMorePosts < 2) {
							// Получаем прикрепленное изображение для поста в блоке Читайте далее
							$post->fields = get_fields($post->ID);
							// Получаем текст для поста в блоке Читайте далее
							$content = get_post_field('post_content', $post->ID);
							$post->contentParts = get_extended($content);
							$post->terms = wp_get_post_tags($post->ID);
							$post->permalink = get_permalink($post->ID);
							$result->readMorePosts[] = $post;
						}
					}
				}
			}
		}

		return $result;
	}

	/**
	 * Возвращает список постов
	 * @param array $filter
	 * @return array|bool|null|\WP_Post
	 */
	function getPostsList($filter = array()) {
		global $post, $wp_query;
		$result = false;
		// Добавляем данные о странице
		$post->permalink = get_permalink($post->ID);
		$result = $post;

		// Получение 10 постов
		$arguments = array(
			'posts_per_page' => $this->numberPostsOnPageList,
			'post_status' => 'publish',
			'orderby' => 'post_date',
			'order'=> 'DESC',
			'category_name' => $post->post_name,
			'paged' => max(0, get_query_var('paged'))
		);
		$arguments = array_merge($arguments, $filter);
		$wp_query = new \WP_Query($arguments);

		// Навигация
		$pagesHtml = paginate_links(array(
			'base' => '%_%',
			'format' => '/' . $post->post_name . '/?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages,
			'end_size' => 4,
			'mid_size' => 4,
			'prev_text' => '<',
			'next_text' => '>',
			'type' => 'array'
		));
		$result->paginate = $pagesHtml;

		$result->posts = array();
		while ($wp_query->have_posts()) {

			$wp_query->the_post();
			$post->fields = get_fields($post->ID);
			$post->permalink = get_permalink($post->ID);

			// Получаем текст поста
			$content = get_post_field('post_content', $post->ID);
			$post->contentParts = get_extended($content);

			// Метки
			$post->terms = wp_get_post_tags($post->ID);

			$result->posts[] = $post;
		}
		wp_reset_query();

		return $result;
	}

	/**
	 * Вовращает массив постов заданной категории, указанное количество
	 * @param string $categoryCode Код категории
	 * @param int $numberPosts Количество постов
	 * @param array $filter Дополнительные параметры для фильтрации постов
	 * @return array
	 */
	function getPreviewPostsList($categoryCode, $numberPosts, $filter = array()) {
		global $post, $wp_query;

		// Получение $numberPosts постов
		$arguments = array(
			'posts_per_page' => $numberPosts,
			'post_status' => 'publish',
			'orderby' => 'post_date',
			'order'=> 'DESC',
			'category_name' => $categoryCode,
			'paged' => max(0, get_query_var('paged'))
		);
		$arguments = array_merge($arguments, $filter);

		$wp_query = new \WP_Query($arguments);
		$result = array();
		while ($wp_query->have_posts()) {
			$wp_query->the_post();
			$post->fields = get_fields($post->ID);
			$post->permalink = get_permalink($post->ID);

			// Получаем текст поста
			$content = get_post_field('post_content', $post->ID);
			$post->contentParts = get_extended($content);

			// Метки
			$post->terms = wp_get_post_tags($post->ID);

			$result[] = $post;
		}
		wp_reset_query();

		return $result;
	}

	/**
	 * Возвращает список постов по тегу
	 * @return array
	 */
	function getPostsListByTag() {
		global $post, $wp_query;
		$result = array();
		// Навигация
		$pagesHtml = paginate_links(array(
			'base' => '%_%',
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages,
			'end_size' => 4,
			'mid_size' => 4,
			'prev_text' => '<',
			'next_text' => '>',
			'type' => 'array'
		));
		$result['paginate'] = $pagesHtml;

		$result['posts'] = array();
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				$post->fields = get_fields($post->ID);
				$post->permalink = get_permalink($post->ID);

				// Получаем текст поста
				$content = get_post_field('post_content', $post->ID);
				$post->contentParts = get_extended($content);

				// Метки
				$post->terms = wp_get_post_tags($post->ID);

				$result['posts'][] = $post;
			}
		}

		return $result;
	}

	/**
	 * Возвращает результат поиска
	 * @param string $searchString
	 * @return array
	 */
	function getSearchResults($searchString) {
		global $post, $wp_query;
		$result = array();
		// Навигация
		$pagesHtml = paginate_links(array(
			'base' => '%_%',
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages,
			'end_size' => 4,
			'mid_size' => 4,
			'prev_text' => '<',
			'next_text' => '>',
			'type' => 'array'
		));
		$result['paginate'] = $pagesHtml;

		$result['posts'] = array();
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				$post->fields = get_fields($post->ID);
				$post->permalink = get_permalink($post->ID);

				// Получаем текст поста
				$content = get_post_field('post_content', $post->ID);
				$post->contentParts = get_extended($content);

				// Метки
				$post->terms = wp_get_post_tags($post->ID);

				$result['posts'][] = $post;
			}
		}

		return $result;
	}
} 