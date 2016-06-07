<?php
use Showplace\Config;
$pathToResource = home_url() . Config::DEFAULT_TEMPLATE_PATH;?>
					</div>
				</div>
				<footer class="footer">
					<div class="footer__content">
						<?php get_template_part('social-block'); ?>
						<p class="footer__copy"><span class="text-accent">©</span> 2010-<?= date('Y');?></p>
						<?php get_template_part('footer', $_COOKIE['qtrans_front_language']);?>
					</div>
				</footer>
			</div>
		</div>
	</body>
	<script src="<?= $pathToResource ?>js/vendor.min.js"></script>
	<script src="<?= $pathToResource ?>js/script.min.js"></script>
</html>