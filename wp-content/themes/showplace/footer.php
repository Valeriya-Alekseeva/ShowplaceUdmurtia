<?php
use Urbanabru\Config;
$pathToResource = home_url() . Config::DEFAULT_TEMPLATE_PATH;?>
		<footer class="footer">
			<div class="container">
				<svg id="svg-banner" viewBox="0 3560.588 2200 1367.727" data-clip-path="M2200 4471.646L518.52 4032.273 2200 3592.903" data-src="[&quot;http://i.fotorama.io/0627c11f-522d-48b9-9f17-9ea05b769aaa/-/stretch/off/-/resize/1280x/&quot;]" class="section-bg">
					<path opacity=".1" fill="#231F20" d="M0 4921.742L2125.983 4243.3 0 3564.853"/>
					<path opacity=".9" fill="#40C0BD" d="M2200 4471.646L518.52 4032.273 2200 3592.903"/>
				</svg>
				<p class="footer__p">© URBANABRU — проект о городских командах и городских практиках.</p>
				<p class="footer__p">
					© 2013-2015 Проект
					&nbsp;<a href="http://www.htc-cs.ru/" target="_blank" class="footer__link">Центра Высоких Технологий</a> при поддержке
					&nbsp;<a href="http://argo18.ru/" target="_blank" class="footer__link">АРГО</a>.
				</p>
				<p class="footer__p">При перепечатке материалов ссылка на сайт проекта обязательна.</p>
				<div class="footer__bottom">
					<a href="#" class="footer__feedback-link">Написать</a>
					<div class="social-box">
						<a href="#" class="social-box__fb"></a>
						<a href="#" class="social-box__vk"></a>
						<a href="#" class="social-box__twitter"></a>
						<a href="#" class="social-box__ok"></a>
					</div>
				</div>
			</div>
		</footer>
	</div>
</body>
<script src="<?= $pathToResource ?>js/vendor.min.js"></script>
<script src="<?= $pathToResource ?>js/script.min.js"></script>
</html>