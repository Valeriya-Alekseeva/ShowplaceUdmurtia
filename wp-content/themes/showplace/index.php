<?php
/**
 * Главная страница
 */

get_header();

use Urbanabru\Config;
use Urbanabru\ContentHelper;

global $post;

$contentHelper = new ContentHelper();
// Выбор редактора
$editorChoiceList = $contentHelper->getPreviewPostsList(
	'',
	4,
	array(
		'meta_key' => 'editors_choice',
		'orderby' => 'meta_value post_date'
	)
);
$imagesSrc = '';
$editorChoiceHtml = '';
foreach ($editorChoiceList as $key => $editorChoice) {
	$imagesSrc .= '&quot;' . $editorChoice->fields['detail_image'] . '&quot;,';
	$editorChoiceHtml .= '<li class="editor-choice__header' . ($key == 0 ? ' editor-choice__header--active' : '') . '">
		<a href="' . $editorChoice->permalink . '" title="' . $editorChoice->post_title . '">
			<strong class="decor">' . $editorChoice->post_title . '</strong>
		</a>
	</li>';
}
$imagesSrc = trim($imagesSrc, ',');?>
<section class="section section--editor-choice">
	<div class="container">
		<svg id="svg-slider" viewBox="0 -510.218 2200 1620.717" data-clip-path="M2200 1097.166L518.52 516.063 2200-65.04" data-src="[<?= $imagesSrc; ?>]" class="section-bg">
			<path opacity=".1" fill="#231F20" d="M0 970.324l2125.983-734.718L0-499.112"/>
			<path opacity=".2" fill="#231F20" d="M0 360.85l566.93-195.926L0-31"/>
			<path opacity=".9" fill="#40C0BD" d="M2200 1097.166L518.52 516.063 2200-65.04"/>
			<path opacity=".1" fill="#231F20" d="M2200 1097.166V210L916.447 653.584"/>
		</svg>
		<div class="row">
			<div class="editor-choice-content"><span class="editor-choice__link">Выбор редактора /</span>
				<div class="editor-slider js-editor-slider">
					<ul class="editor-choice-list"><?= $editorChoiceHtml; ?></ul>
					<nav class="editor-choice-nav"></nav>
				</div>
			</div>
		</div>
	</div>
</section><?php

// Новости
$newsList = $contentHelper->getPreviewPostsList(Config::NEWS_POST_TYPE_CODE, 2);
if (count($newsList) > 0) {?>
	<section class="section section--news">
		<div class="container">
			<h2 class="section-head">
				<a href="/<?= Config::NEWS_POST_TYPE_CODE; ?>/" class="section-head__link">Новости</a>
			</h2>
			<ul class="news-list row"><?php
				$numberNews = 0;
				foreach ($newsList as $news) {?>
					<li class="news-list__item">
						<a href="<?= $news->permalink; ?>" class="news-list__head"><?= $news->post_title; ?></a>
						<p class="news-list__body"><?= $news->contentParts['main']; ?></p>
						<span class="news-list__date"><?= date('d.m.Y', strtotime($news->post_date)) ?></span>
						<span class="news-list__keys"> /&nbsp;<?php
							//Метки
							foreach($news->terms as $key => $term){
								echo '<a href="' . sprintf(Config::TAGS_PAGE_URL, $term->slug) . '">'. $term->name .'</a>';
							}
							if ($numberNews == 2) {?>
								<p><a href="/<?= Config::NEWS_POST_TYPE_CODE ?>/" class="news-list__all-news">Все новости</a></p><?php
							}?>
						</span>
					</li><?php
					$numberNews ++;
				}?>
			</ul>
		</div>
	</section><?php
}?>

<section class="section section--discussion">
	<div class="container">
		<svg viewBox="0 856.452 2200 1314.286" class="section-bg">
			<path opacity=".4" fill="#40C0BD" d="M0 2106.205l1681.48-581.103L0 944"/>
			<path opacity=".1" fill="#231F20" d="M0 2149.96l566.93-195.924L0 1758.112M2200 2030.465V878.97l-1194.084 412.665 675.563 233.467-471.9 163.084"/>
			<path opacity=".2" fill="#231F20" d="M2200 1142.672l-466.93 161.364L2200 1465.402"/>
		</svg>
		<svg class="section-bg">
			<use xlink:href="#section-2"></use>
		</svg>
		<h2 class="section-head"><a href="#" class="section-head__link">Дискуссии</a></h2>
		<ul class="discussion-list row">
			<li class="discussion-list__item">
				<div class="discussion-list__user-pic">
					<svg width="113.39" height="113.39" viewBox="0 0 113.39 113.39" class="comment-icon"><path fill="#3EBFBD" d="M96.56 77.564c3.274-6.238 5.136-13.336 5.136-20.87 0-24.853-20.148-45-45-45-24.853 0-45 20.147-45 45 0 24.852 20.147 45 45 45 12.053 0 22.99-4.748 31.07-12.465l13.93 2.464-5.135-14.13z"/></svg>
				</div>
				<h4 class="discussion-list__head"><a href="#" class="discussion-list__head-link">Лев Гордон об итогах Форума Живых городов и следующих шагах<span class="decor"> /&nbsp;Лев&nbsp;Гордон</span></a></h4>
				<blockquote class="discussion-list__quote">Текст комментария. Показательный пример – минерализация выстраивает гирогоризонт, что позволяет проследить соответствующий денудационный уровень...</blockquote><span class="discussion-list__quote-author">Сергей Соловьев</span><span class="discussion-list__quote-date"> 17.06.2015</span>
			</li>
			<li class="discussion-list__item">
				<div class="discussion-list__user-pic">
					<svg width="113.39" height="113.39" viewBox="0 0 113.39 113.39" class="comment-icon">
						<defs>
							<mask id="commentMask"><path d="M96.56 77.564c3.274-6.238 5.136-13.336 5.136-20.87 0-24.853-20.148-45-45-45-24.853 0-45 20.147-45 45 0 24.852 20.147 45 45 45 12.053 0 22.99-4.748 31.07-12.465l13.93 2.464-5.135-14.13z" fill="#ffffff"></path></mask>
						</defs>
						<image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="https://avatars.yandex.net/get-music-content/bbb2f47e.p.188963/400x400" preserveAspectRatio="none" x="0" y="0" width="113.39" height="113.39" mask="url('#commentMask')"></image>
					</svg>
				</div>
				<h4 class="discussion-list__head"><a href="#" class="discussion-list__head-link">Лев Гордон об итогах Форума Живых городов и следующих шагах<span class="decor"> /&nbsp;Лев&nbsp;Гордон</span></a></h4>
				<blockquote class="discussion-list__quote">Текст комментария. Показательный пример – минерализация выстраивает гирогоризонт, что позволяет проследить соответствующий денудационный уровень...</blockquote><span class="discussion-list__quote-author">Сергей Соловьев</span><span class="discussion-list__quote-date"> 17.06.2015</span>
			</li>
			<li class="discussion-list__item">
				<div class="discussion-list__user-pic">
					<svg width="113.39" height="113.39" viewBox="0 0 113.39 113.39" class="comment-icon">
						<defs>
							<mask id="commentMask"><path d="M96.56 77.564c3.274-6.238 5.136-13.336 5.136-20.87 0-24.853-20.148-45-45-45-24.853 0-45 20.147-45 45 0 24.852 20.147 45 45 45 12.053 0 22.99-4.748 31.07-12.465l13.93 2.464-5.135-14.13z" fill="#ffffff"></path></mask>
						</defs>
						<image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="https://avatars.yandex.net/get-music-content/bbb2f47e.p.188963/400x400" preserveAspectRatio="none" x="0" y="0" width="113.39" height="113.39" mask="url('#commentMask')"></image>
					</svg>
				</div>
				<h4 class="discussion-list__head"><a href="#" class="discussion-list__head-link">Лев Гордон об итогах Форума Живых городов и следующих шагах<span class="decor"> /&nbsp;Лев&nbsp;Гордон</span></a></h4>
				<blockquote class="discussion-list__quote">Текст комментария. Показательный пример – минерализация выстраивает гирогоризонт, что позволяет проследить соответствующий денудационный уровень...</blockquote><span class="discussion-list__quote-author">Сергей Соловьев</span><span class="discussion-list__quote-date"> 17.06.2015</span>
			</li>
			<li class="discussion-list__item">
				<div class="discussion-list__user-pic">
					<svg width="113.39" height="113.39" viewBox="0 0 113.39 113.39" class="comment-icon">
						<defs>
							<mask id="commentMask"><path d="M96.56 77.564c3.274-6.238 5.136-13.336 5.136-20.87 0-24.853-20.148-45-45-45-24.853 0-45 20.147-45 45 0 24.852 20.147 45 45 45 12.053 0 22.99-4.748 31.07-12.465l13.93 2.464-5.135-14.13z" fill="#ffffff"></path></mask>
						</defs>
						<image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="https://avatars.yandex.net/get-music-content/bbb2f47e.p.188963/400x400" preserveAspectRatio="none" x="0" y="0" width="113.39" height="113.39" mask="url('#commentMask')"></image>
					</svg>
				</div>
				<h4 class="discussion-list__head"><a href="#" class="discussion-list__head-link">Лев Гордон об итогах Форума Живых городов и следующих шагах<span class="decor"> /&nbsp;Лев&nbsp;Гордон</span></a></h4>
				<blockquote class="discussion-list__quote">Текст комментария. Показательный пример – минерализация выстраивает гирогоризонт, что позволяет проследить соответствующий денудационный уровень...</blockquote><span class="discussion-list__quote-author">Сергей Соловьев</span><span class="discussion-list__quote-date"> 17.06.2015</span>
			</li>
		</ul>
	</div>
</section><?php

// Интервью
$interviewList = $contentHelper->getPreviewPostsList(Config::INTERVIEW_POST_TYPE_CODE, 1);
if (count($interviewList) > 0 && isset($interviewList[0])) {
	$interview = $interviewList[0];?>
	<section class="section section--interview">
		<div class="container">
			<svg id="svg-interview" viewBox="0 1504.071 2200 1219.048" data-clip-path="M2200 2581.063L518.52 2085 2200 1588.938" data-src="[&quot;<?= $interview->fields['detail_image']; ?>&quot;]" class="section-bg">
				<path opacity=".1" fill="#231F20" d="M0 2149.96l566.93-195.924L0 1758.112"/>
				<path opacity=".9" fill="#40C0BD" d="M2200 2581.063L518.52 2085 2200 1588.938"/>
				<path opacity=".1" fill="#231F20" d="M0 1521.69v1186.054l1210.91-418.477L518.52 2085l599.61-176.895"/>
			</svg>
			<div class="row">
				<h2 class="interview-lead">
					<a href="/<?= Config::INTERVIEW_POST_TYPE_CODE; ?>/" class="interview-lead__sub">Интервью /</a>
					<strong class="decor"><?= $interview->post_title; ?></strong><?= $interview->contentParts['main']; ?>
				</h2>
			</div>
		</div>
	</section><?php
}

// Кейсы
$caseList = $contentHelper->getPreviewPostsList(Config::CASES_POST_TYPE_CODE, 2);
if (count($caseList) > 0 && isset($caseList[0])) {?>
	<section class="section section--case">
		<div class="container">
			<h2 class="section-head"><a href="/<?= Config::CASES_POST_TYPE_CODE; ?>/" class="section-head__link">Кейсы</a></h2>
			<ul class="news-list row"><?php
				$numberCase = 0;
				foreach ($caseList as $case) {?>
					<li class="news-list__item">
						<div class="news-list__pic-box">
							<img src="<?= $case->fields['detail_image']?>" alt="<?= $case->post_title; ?>" class="news-list__pic" width="100" height="100"/>
						</div>
						<a href="<?= $case->permalink; ?>" class="news-list__head"><?= $case->post_title; ?></a>
						<p class="news-list__body"><?= $case->contentParts['main']; ?></p>
						<span class="news-list__date"><?= date('d.m.Y', strtotime($case->post_date)) ?></span>
						<span class="news-list__keys"> /&nbsp;<?php
							//Метки
							foreach($case->terms as $key => $term){
								echo '<a href="' . sprintf(Config::TAGS_PAGE_URL, $term->slug) . '">'. $term->name .'</a>';
							}
							if ($numberCase == 2) {?>
								<p><a href="/<?= Config::CASES_POST_TYPE_CODE ?>/" class="news-list__all-news">Все кейсы</a></p><?php
							}?>
						</span>
					</li><?php
					$numberCase ++;
				}?>
			</ul>
		</div>
	</section><?php
}?>


<section class="section section--feedback-action">
	<div class="container">
		<svg id="svg-form" viewBox="0 2489.786 2200 1128.571" data-clip-path="M0 3602.83l1681.48-515.654L0 2571.52" data-src="[&quot;http://i.fotorama.io/9e7211c0-b73b-4b1d-8b47-4b1700f9a80f/-/stretch/off/-/resize/1280x/&quot;]" class="section-bg">
			<path opacity=".1" fill="#231F20" d="M0 3328.11v274.72l421.182-129.162"/>
			<path opacity=".8" fill="#40C0BD" d="M0 3602.83l1681.48-515.654L0 2571.52"/>
			<path opacity=".1" fill="#231F20" d="M2200 3535.62V2513.814l-1194.084 366.187 675.563 207.174-471.9 144.715"/>
			<path opacity=".2" fill="#231F20" d="M2200 3062.67l-466.93 161.366L2200 3385.402"/>
		</svg>
		<div class="feedback-action__head"><strong class="decor">Поделитесь</strong>своими кейсами</div>
		<button class="feedback-action__button">Прислать</button>
	</div>
</section>


<section class="section section--photogallery">
	<div class="container"><?php
		// Фотогалерея
		$photosList = $contentHelper->getPreviewPostsList(Config::PHOTOS_POST_TYPE_CODE, 6);
		if (count($photosList) > 0) {?>
			<h2 class="section-head"><a href="#" class="section-head__link">Фотогаллерея</a></h2>
			<div class="photogallery-list-box">
				<div class="photogallery-list js-owl-carousel"><?
					foreach ($photosList as $photo) {?>
						<div class="photogallery-list__item">
							<a href="<?= $photo->permalink; ?>">
								<img src="<?= $photo->fields['detail_image']; ?>" alt="<?= $photo->post_title; ?>" class="photogallery-list__pic" />
							</a>
							<a href="<?= $photo->permalink; ?>" class="news-list__head"><?= $photo->post_title; ?></a>
							<span class="news-list__date"><?= date('d.m.Y', strtotime($photo->post_date)) ?></span>
							<span class="news-list__keys"> /&nbsp;<?php
								//Метки
								foreach($photo->terms as $key => $term){
									echo '<a href="' . sprintf(Config::TAGS_PAGE_URL, $term->slug) . '">'. $term->name .'</a>';
								}?>
							</span>
						</div><?php
					}?>
				</div>
			</div><?php
		}?>

		<nav class="photogallery-nav">
			<ul class="photogallery-nav-list">
				<li class="photogallery-nav-list__item"><a href="/<?= Config::PHOTOS_POST_TYPE_CODE; ?>/" class="photogallery-nav-list__link">Фотогалерея</a></li>
				<li class="photogallery-nav-list__item"><a href="/<?= Config::VIDEO_POST_TYPE_CODE; ?>/" class="photogallery-nav-list__link">Видеогалерея</a></li>
			</ul>
		</nav>
	</div>
</section><?php

echo do_shortcode('[contact-form-7 id="209" title="Поделиться своим кейсом"]');

get_footer();
