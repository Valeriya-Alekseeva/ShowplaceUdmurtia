<?php
/**
 * Форма поиска
 */
?>
<div class="header-search">
	<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
		<input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" class="header-search__input" />
	</form>
</div>