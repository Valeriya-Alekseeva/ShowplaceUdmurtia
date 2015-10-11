<?php
/**
 * Страница списка постов.
 */
get_header();

use Showplace\Config;
use Showplace\ContentHelper;

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
				foreach ($page->posts as $postData) {?>
					<li class="news-list__item"><?
						if (isset($postData->fields['detail_image']) && ! empty($postData->fields['detail_image'])) {?>
							<img src="<?= $postData->fields['detail_image']; ?>" alt="<?= strip_tags($postData->post_title); ?>" width="250" height="250"/><?php
						}?>
						<a href="<?= $postData->permalink; ?>" class="news-list__head"><?= $postData->post_title; ?></a>
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
		}

		echo $paginate;?>

	</div>
</section><?php

get_footer();
