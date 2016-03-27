<?php
/**
 * Страница списка постов.
 */
get_header();

use Showplace\Config;
use Showplace\ContentHelper;

global $post, $wp_query;

$contentHelper = new ContentHelper();
$page = $contentHelper->getPostsList();?><?php

$terms = get_terms(array('post_tag'));
if(count($terms) > 0){?>
	<ul><?php
	foreach ($terms as $term) {?>
		<a href="<?= add_query_arg( array('term' => $term->slug));?>"><?= $term->name ?></a><?php
	}?>
	</ul><?php
}

if (is_array($page->posts) && count($page->posts) > 0) {?>
	<ul class="news-list row"><?php
		foreach ($page->posts as $postData) {
			if (! empty($postData->fields['photoPreview'])) {
				//var_dump($postData); ?>
				<li class="">
					<a href="#" class="news-list__head"><?= $postData->post_title; ?></a><?php
					if (! empty($postData->fields['address'])) {?>
						<span><?= $postData->fields['address']; ?></span><?php
					}?>
					<img src="<?= $postData->fields['photoPreview']; ?>" alt="<?= strip_tags($postData->post_title); ?>" width="250" height="250"/><?php
					if (! empty($postData->fields['authorName'])) {?>
						<span><?= $postData->fields['authorName']; ?></span><?php
					}
					if (! empty($postData->fields['authorSite'])) {?>
						<a href="<?= $postData->fields['authorSite']; ?>" target="_blank"><?= $postData->fields['authorSite']; ?></a><?php
					}
					?>

				</li><?php
			}
		}?>
	</ul><?php
}

echo $paginate;?><?php

get_footer();
