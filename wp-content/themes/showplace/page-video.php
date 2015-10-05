<?php
/**
 * Страница списка постов.
 */
get_header();

use Urbanabru\Config;
use Urbanabru\ContentHelper;

global $post, $wp_query;

$contentHelper = new ContentHelper();
$page = $contentHelper->getPostsList();
//var_dump($page);?>
<section class="section section--news">
	<div class="container">
		<h2 class="section-head"><?= $page->post_title; ?></h2><?php
		echo $page->post_content;

		if (is_array($page->paginate)) {
			foreach ($page->paginate as $pageHtml) {
				$paginate .= $pageHtml;
			}
		}

		echo $paginate;

		if (is_array($page->posts) && count($page->posts) > 0) {?>
			<ul class="news-list row"><?php
				foreach ($page->posts as $postData) {
					if (isset($postData->fields['videoSrc']) && ! empty($postData->fields['videoSrc'])) {?>
						<li class="news-list__item"><?
							if (isset($postData->fields['videoSrc']) && ! empty($postData->fields['videoSrc'])) {?>
								<iframe src="<?= $postData->fields['videoSrc']; ?>" width="468" height="250" align="left">
									Ваш браузер не поддерживает плавающие фреймы!
								</iframe><?php
							}?>
							<a href="<?= $postData->permalink; ?>" class="news-list__head"><?= $postData->post_title; ?></a>
							<p class="news-list__body"><?= $postData->contentParts['main']; ?></p>
							<span class="news-list__date"><?= date('d.m.Y', strtotime($postData->post_date)); ?></span>
							<span class="news-list__keys"> /&nbsp;<?php
								// Метки
								foreach($postData->terms as $key => $term){
									echo '<a href="' . sprintf(Config::TAGS_PAGE_URL, $term->slug) . '">'. $term->name .'</a>';
								}?>
							</span>
						</li><?php
					}
				}?>
			</ul><?php
		}

		echo $paginate;?>

	</div>
</section><?php

get_footer();
