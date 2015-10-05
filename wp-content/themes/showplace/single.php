<?php
/**
 * Страница поста. Вывод детальной информации.
 */
get_header();

use Urbanabru\Config;
use Urbanabru\ContentHelper;

$contentHelper = new ContentHelper();

$singlePost = $contentHelper->getSinglePost();

if ($singlePost !== false && is_object($singlePost)) {?>
	<div class="container">
		<article class="article article--interview">
			<header class="article-header">
				<svg id="svg-slider" viewBox="0 -510.218 2200 1620.717" data-clip-path="M2200 1097.166L518.52 516.063 2200-65.04" data-src="[&quot;<?= $post->fields['image']; ?>&quot;]" class="section-bg">
					<path opacity=".1" fill="#231F20" d="M0 970.324l2125.983-734.718L0-499.112"/>
					<path opacity=".2" fill="#231F20" d="M0 360.85l566.93-195.926L0-31"/>
					<path opacity=".9" fill="#40C0BD" d="M2200 1097.166L518.52 516.063 2200-65.04"/>
					<path opacity=".1" fill="#231F20" d="M2200 1097.166V210L916.447 653.584"/>
				</svg>
				<div class="row">
					<div class="editor-choice-content"><a href="/<?= $singlePost->category[0]->slug ?>" class="editor-choice__link"><?= $singlePost->category[0]->name; ?> /</a>
						<h1 class="editor-choice__header"><strong class="decor"><?= $singlePost->post_title; ?></h1>
					</div>
				</div>
			</header>
			<div class="article-lead"><?= $singlePost->contentParts['main']; ?></div>
			<div class="article-properties">
				<div class="article-properties__date"><?= date('d.m.Y', strtotime($singlePost->post_date)); ?></div>
				<span class="article-properties__divider">/</span><?php
				// Метки
				if (count($singlePost->terms) > 0) {?>
					<ul class="article-properties__hash-list"><?php
						foreach($singlePost->terms as $key => $term){?>
							<li class="article-properties__hash">
								<a href="<?= sprintf(Config::TAGS_PAGE_URL, $term->slug); ?>" class="article-properties__link"><?= $term->name; ?></a>
							</li><?php
						}?>
					</ul><?php
				}?>
			</div>
			<div class="article-body"><?= $singlePost->contentParts['extended']; ?></div><?php
			if (isset($singlePost->fields['photos']) && is_array($singlePost->fields['photos']) && count($singlePost->fields['photos']) > 0) {?>
				<div class="photogallery-list-box">
					<div class="photogallery-list js-owl-carousel"><?php
						foreach ($singlePost->fields['photos'] as $photo) {
							if (isset($photo->fields['detail_image'])) {?>
								<div class="photogallery-list__item">
									<a href="#">
										<img src="<?= $photo->fields['detail_image']; ?>" alt="<?= $photo->post_title; ?>" class="photogallery-list__pic">
									</a>
									<a href="#" class="news-list__head"><?= $photo->post_title; ?></a>
									<span class="news-list__date"><?= date('d.m.Y', strtotime($photo->post_date));?></span>
									<span class="news-list__keys"> /&nbsp;<?php
										// Метки
										if (count($photo->terms) > 0) {
											foreach($photo->terms as $key => $term){?>
												<a href="<?= sprintf(Config::TAGS_PAGE_URL, $term->slug); ?>"><?= $term->name; ?></a><?php
											}
										}?>
								</div><?php
							}
						}?>
					</div>
				</div><?php
			}?>
			<footer class="article-properties"><?php
				if (isset($singlePost->fields['author']) && ! empty($singlePost->fields['author'])) {?>
					<strong class="article-properties__author">Материал составлен и подготовлен&nbsp;
						<span class="article-properties__author-link"><?= $singlePost->fields['author']; ?></span>
					</strong><?php
				}
				if (count($singlePost->terms) > 0) {?>
					<span class="article-properties__divider">/</span>
					<ul class="article-properties__hash-list"><?php
						foreach($singlePost->terms as $key => $term){?>
							<li class="article-properties__hash">
								<a href="<?= sprintf(Config::TAGS_PAGE_URL, $term->slug); ?>" class="article-properties__link"><?= $term->name; ?></a>
							</li><?php
						}?>
					</ul><?php
				}?>
			</footer>
			<div class="social-likes">
				<div title="Поделиться ссылкой на Фейсбуке" class="facebook">Facebook</div>
				<div title="Поделиться ссылкой в Твиттере" class="twitter">Twitter</div>
				<div title="Поделиться ссылкой во Вконтакте" class="vkontakte">Вконтакте</div>
				<div title="Поделиться ссылкой в Гугл-плюсе" class="plusone">Google+</div>
				<div title="Поделиться картинкой на Пинтересте" data-media="" class="pinterest">Pinterest</div>
			</div>
		</article>
		<div class="comment">
			<h4 class="comment__head">Комментарии<span class="comment__head-counter">44</span></h4>
			<div class="comment-form-box">
				<div class="comment-form-box__icon">
					<svg width="113.39" height="113.39" viewBox="0 0 113.39 113.39" class="comment-icon"><path fill="#3EBFBD" d="M96.56 77.564c3.274-6.238 5.136-13.336 5.136-20.87 0-24.853-20.148-45-45-45-24.853 0-45 20.147-45 45 0 24.852 20.147 45 45 45 12.053 0 22.99-4.748 31.07-12.465l13.93 2.464-5.135-14.13z"/></svg>
				</div>
				<form action="/" class="comment-form">
					<textarea name="comment" placeholder="Поделитесь своим мнением с общественностью" class="comment-form__textarea js-textarea-autosize"></textarea>
					<div class="login-as social-likes">
						<div class="social-likes__widget social-likes__widget_facebook"><span class="social-likes__button social-likes__button_facebook"><span class="social-likes__icon social-likes__icon_facebook"></span></span></div>
						<div class="social-likes__widget social-likes__widget_twitter"><span class="social-likes__button social-likes__button_twitter"><span class="social-likes__icon social-likes__icon_twitter"></span></span></div>
						<div class="social-likes__widget social-likes__widget_vkontakte"><span class="social-likes__button social-likes__button_vkontakte"><span class="social-likes__icon social-likes__icon_vkontakte"></span></span></div>
						<div class="social-likes__widget social-likes__widget_plusone"><span class="social-likes__button social-likes__button_plusone"><span class="social-likes__icon social-likes__icon_plusone"></span></span></div>
						<div class="social-likes__widget social-likes__widget_pinterest"><span class="social-likes__button social-likes__button_pinterest"><span class="social-likes__icon social-likes__icon_pinterest"></span></span></div>
					</div>
					<button type="submit" class="comment-form__submit">Отпарвить</button>
				</form>
			</div>
		</div><?php
		if (comments_open() || get_comments_number()) {
			comments_template();
		}?>
		<section class="section section--feedback-action section--article-feedback-action">
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
		</section><?

		// Блок "Читайте далее"
		if (is_array($singlePost->readMorePosts) && count($singlePost->readMorePosts) > 0) {?>
			<div class="read-more">
				<h4 class="read-more__head">Читайте далее</h4>
				<ul class="read-more-list"><?php
					foreach ($singlePost->readMorePosts as $readMorePost) {?>
						<li class="read-more-list__item">
							<div class="read-more-list__pic-box">
								<a href="<?= $readMorePost->permalink; ?>">
									<img src="<?= $readMorePost->fields['detail_image']; ?>" alt="" width="550" height="325" class="read-more-list__pic">
								</a>
								<div class="read-more-list__pic-box-triangle read-more-list__pic-box-triangle--top"></div>
								<div class="read-more-list__pic-box-triangle read-more-list__pic-box-triangle--bottom"></div>
							</div>
							<div class="read-more-list__title">
								<a href="<?= $readMorePost->permalink; ?>" class="read-more-list__title-link"><?= $readMorePost->post_title; ?></a>
							</div>
							<div class="read-more-list__preview"><?= $readMorePost->contentParts['main']; ?></div>
							<div class="read-more-list-properties">
								<span class="read-more-list-properties__date"><?= date('d.m.Y', strtotime($readMorePost->post_date)) ?></span>
								<span class="read-more-list-properties__divider">/</span><?php
								// Метки
								foreach($readMorePost->terms as $key => $term){?>
									<a href="<?= sprintf(Config::TAGS_PAGE_URL, $term->slug); ?>" class="read-more-list-properties__tag"><?= $term->name; ?></a><?php
								}?>
							</div>
						</li><?
					}?>
				</ul>
			</div><?php
		}?>
	</div><?php
}





get_footer();
