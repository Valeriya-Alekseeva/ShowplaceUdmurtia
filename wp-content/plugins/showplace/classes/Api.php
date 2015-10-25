<?php

namespace RunaCapital;

use RunaCapital\Content;

class Api {
	/**
	 * Возвращает детальную информацию о проекте
	 * @param $id
	 * @return array
	 */
	static function getProject($id) {
		$cacheKey = 'getProject_' . $id;
		$result = wp_cache_get($cacheKey);
		if ($result === false) {
			$projects = Content::getInfo(Helper::getCategoryPortfolio(), array('p' => $id));
			$result = array(
				'success' => false,
				'error' => '',
				'data' => array()
			);
			try {
				if (isset($projects[0]) && isset($projects[0]->ID) && $projects[0]->ID == $id && is_array($projects[0]->fields)) {
					$project = $projects[0];
					$fields = $project->fields;
						$result['data'] = array(
							'id' => $id,
							'name' => $project->post_title,
							'img' => isset($fields['img']) ? $fields['img'] : '',
							'type' => isset($fields['project_type']) ? $fields['project_type'] : '',
							'brief_description' => $project->post_content,
							'description' => isset($fields['detail_description']) ? $fields['detail_description'] : '',
							'links' => array(
								'tw' => isset($fields['tw']) ? Helper::formattingLink($fields['tw']) : '',
								'fb' => isset($fields['fb']) ? Helper::formattingLink($fields['fb']) : '',
								'lin' => isset($fields['lin']) ? Helper::formattingLink($fields['lin']) : '',
								'website' => isset($fields['website']) ? Helper::formattingLink($fields['website']) : '',
							),
							'ceo' => array(),
							'participants' => array()
						);
					$result['data']['quick_fact'] = array();
					$result['data']['investment_fact'] = array();
					if ($project->fields['investment_fact']) {
						foreach ($project->fields['investment_fact'] as $fact) {
							$result['data']['investment_fact'][] = $fact->post_title;
						}
					}
					if ($project->fields['quick_fact']) {
						foreach ($project->fields['quick_fact'] as $fact) {
							$result['data']['quick_fact'][] = $fact->post_title;
						}
					}

						if (isset($fields['ceo']) && is_array($fields['ceo'])) {
							foreach ($fields['ceo'] as $person) {
								$img = get_field('img', $person->ID);
								$result['data']['ceo'][] = array(
									'id' => $person->ID,
									'name' => $person->post_title,
									'img' => $img
								);
							}
						}

						if (isset($fields['involved']) && is_array($fields['involved'])) {
							foreach ($fields['involved'] as $person) {
								$img = get_field('img', $person->ID);
								$result['data']['participants'][] = array(
									'id' => $person->ID,
									'name' => $person->post_title,
									'img' => $img
								);
							}
						}
						$result['success'] = true;
					}
			}
			catch (\Exception $e) {
				$result['error'] = $e->getCode() . ': '. $e->getMessage();
			}
			return $result;
			wp_reset_query();
			wp_cache_set($cacheKey, $result);
		}

		return $result;
	}

	/**
	 * Возвращает денальную информацию о члене команды
	 * @param $id
	 * @return array
	 */
	static function getPerson($id) {
		$cacheKey = 'getPerson_' . $id;
		$result = wp_cache_get($cacheKey);
		if ($result === false) {
			$result = array(
				'success' => false,
				'error' => '',
				'data' => array()
			);
			try {
				$persons = Content::getInfo(Helper::getCategoryPortfolio(), array('p' => $id));
				$result = array();
				if (isset($persons[0]) && isset($persons[0]->ID) && $persons[0]->ID == $id && is_array($persons[0]->fields)) {
					$person = $persons[0];
					$fields = $person->fields;
					$result['data'] = array(
						'id' => $id,
						'name' => $person->post_title,
						'img' => isset($fields['img']) ? $fields['img'] : '',
						'type' => isset($fields['type_of_team']) ? $fields['type_of_team'] : '',
						'job' => isset($fields['job_title']) ? $fields['job_title'] : '',
						'brief_description' => isset($fields['brief_description']) ? $fields['brief_description'] : '',
						'description' => $person->post_content,
						'links' => array(
							'tw' => isset($fields['tw']) ? Helper::formattingLink($fields['tw']) : '',
							'fb' => isset($fields['fb']) ? Helper::formattingLink($fields['fb']) : '',
							'lin' => isset($fields['lin']) ? Helper::formattingLink($fields['lin']) : ''
						),
						'projects' => array()
					);

					if (isset($fields['projects']) && is_array($fields['projects'])) {
						foreach ($fields['projects'] as $person) {
							$img = get_field('img', $person->ID);
							$result['data']['projects'][] = array(
								'id' => $person->ID,
								'name' => $person->post_title,
								'img' => $img
							);
						}
					}
					$result['success'] = true;
				}
				else {
					$result['error'] = '200: Data not found. ';
				}
			}
			catch (\Exception $e) {
				$result['error'] = $e->getCode() . ': '. $e->getMessage();
			}

			return $result;
			wp_reset_query();
			wp_cache_set($cacheKey, $result);
		}

		return $result;
	}

	/**
	 * Возвращает список постов (новостей / пресс-релизов и тп) за определенный год
	 * @param $categoryName
	 * @param $year
	 * @param $urlTemplate
	 * @return array
	 */
	static function getPostsForYear($categoryName, $urlTemplate, $year) {
		$cacheKey = 'getPostsForYear_' . $categoryName . '_' . (int)$year;
		$result = wp_cache_get($cacheKey);
		if ($result === false) {
			$result = array(
				'success' => false,
				'error' => '',
				'availableYears' => array(),
				'data' => array()
			);
			try {
				$postList = Content::getInfo($categoryName);
				$years = array();
				foreach ($postList as $post) {
					$postYear = date('Y', strtotime($post->post_date));
					if(! in_array($postYear, $years)) {
						if ($categoryName == Helper::getCategoryBootcamp()) {
							/* Если задан параметр "Выбрать прошедшие события" и он равняется соответствующему парамерту поста.
							По умолчанию выводить "Предстоящие события"*/
							if ((isset($_GET['isPast']) && (bool)$post->fields['is_past'] == (bool)$_GET['isPast']) ||
								(! isset($_GET['isPast']) && (bool)$post->fields['is_past'] == false)) {
								$years[] = $postYear;
							}
						}
						else {
							$years[] = $postYear;
						}
					}
				}
				rsort($years);
				$result['availableYears'] = $years;

				$filter = array(
					'posts_per_page' => -1
				);
				if (! empty($year)) {
					$filter['year'] = $year;
				}
				elseif(isset($result['availableYears'][0])) {
					$filter['year'] = $result['availableYears'][0];
				}
				if ($categoryName == Helper::getCategoryBootcamp()) {
					if (isset($_GET['q']) && ! empty($_GET['q'])) {
						$filter['s'] = addslashes($_GET['q']);
					}
				}
				$posts = Content::getInfo($categoryName, $filter);
				foreach ($posts as $post) {
					if (($categoryName == Helper::getCategoryBootcamp() && isset($_GET['isPast']) && (bool)$post->fields['is_past'] == (bool)$_GET['isPast']) ||
						$categoryName != Helper::getCategoryBootcamp() || ! isset($_GET['isPast'])) {
							$result['data'][] = array(
								'id' => $post->ID,
								'name' => $post->post_title,
								'date' => Helper::getFormattedDate($post->post_date),
								'img' => ((isset($post->fields['preview_img']) && ! empty($post->fields['preview_img'])) ? $post->fields['preview_img'] : Constants::PATH_RESOURCES . 'img_news/no-image.jpg'),
								'link' => sprintf($urlTemplate, $post->ID),
								'isPast' => $post->fields['is_past']
							);
						}
				}

				if (count($result['data']) > 0) {
					$result['success'] = true;
				}
				else {
					$result['error'] = '200: Data not found.';
				}
			}
			catch (\Exception $e) {
				$result['error'] = $e->getCode() . ': '. $e->getMessage();
			}

			return $result;
			wp_reset_query();
			wp_cache_set($cacheKey, $result);
		}

		return $result;
	}

	static function getPostsContent($id, $categoryName, $urlTemplate) {
		$cacheKey = 'getPostsContent_' . $categoryName . '_' . $id;
		$result = wp_cache_get($cacheKey);
		if ($result === false) {
			$result = array(
				'success' => false,
				'error' => '',
				'data' => array()
			);
			try {
				$result = array(
					'id' => $id,
					'title' => '',
					'html' => ''
				);

				$posts = Content::getInfo($categoryName, array('p' => $id));

				if (isset($posts[0])) {
					$result['title'] = $posts[0]->post_title;
					$result['html'] = htmlspecialchars_decode (Content::getPostContent($posts[0], $categoryName, $urlTemplate));
				}

				if (! empty($result['html'])) {
					$result['success'] = true;
				}
				else {
					$result['error'] = '200: Data not found. ';
				}
			}
			catch (\Exception $e) {
				$result['error'] = $e->getCode() . ': '. $e->getMessage();
			}

			return $result;
			wp_reset_query();
			wp_cache_set($cacheKey, $result);
		}

		return $result;
	}
} 