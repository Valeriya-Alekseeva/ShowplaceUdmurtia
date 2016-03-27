<?php

function rewriteRules() {
	/*$sectionsCodes = Constants::TEAM_SECTION_CODE . '|' . Constants::PROJECT_SECTION_CODE;

	add_rewrite_tag('%section%', '(' . $sectionsCodes . ')');
	add_rewrite_tag('%id%', '([0-9]+)');
	add_rewrite_rule (
		'(' . $sectionsCodes . ')/([0-9]+)/?',
		'index.php?section=$matches[1]&id=$matches[2]',
		'top'
	);
	add_rewrite_rule (
		'(' . $sectionsCodes . ')/?',
		'index.php?section=$matches[1]',
		'top'
	);
	flush_rewrite_rules();*/
}

add_action('init', 'rewriteRules');


