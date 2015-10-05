<?php
/**
 * Страница вывода результатов поиска
 */
get_header();

use Urbanabru\Config;
use Urbanabru\ContentHelper;

global $post, $wp_query;

$contentHelper = new ContentHelper();
$searchString = isset($_GET['s']) ? $_GET['s'] : '';
$page = $contentHelper->getSearchResults($searchString);?>
<section class="section section--news">
	<div class="container">
		<h2 class="section-head">Результат поиска по строке «<?= $searchString; ?>»</h2><?php
		$paginate = '';
		if (is_array($page['paginate'])) {
			foreach ($page['paginate'] as $pageHtml) {
				$paginate .= $pageHtml;
			}
		}

		echo $paginate;

		if (is_array($page['posts']) && count($page['posts']) > 0) {?>
			<ul class="news-list row"><?php
			foreach ($page['posts'] as $postData) {?>
				<li class="news-list__item"><?
				if (isset($postData->fields['detail_image']) && ! empty($postData->fields['detail_image'])) {?>
					<img src="<?= $postData->fields['detail_image']; ?>" alt="<?= strip_tags($postData->post_title); ?>" width="100" height="100"/><?php
				}?>
				<a href="<?= $postData->permalink; ?>" class="news-list__head"><?= $postData->post_title; ?></a><?php
				if (isset($postData->contentParts['main']) && ! empty($postData->contentParts['main'])) {?>
					<p class="news-list__body"><?= $postData->contentParts['main']; ?></p><?php
				}?>
				<span class="news-list__date"><?= date('d.m.Y', strtotime($postData->post_date)); ?></span>
				<span class="news-list__keys"> /&nbsp;<?php
					// Метки
					foreach($postData->terms as $key => $term){
						echo '<a href="' . sprintf(Config::TAGS_PAGE_URL, $term->slug) . '">'. $term->name .'</a>';
					}?>
						</span>
				</li><?php
			}?>
			</ul><?php
		} else {?>
			<p>Результатов не найдено.</p><?php
		}

		echo $paginate;?>

	</div>
</section><?php

get_footer();
