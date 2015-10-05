<?php
/**
 * Событие вызываемое при сохранении / изменении поста
 * @param $postId
 */
function onSavePost($postId) {
	$fields = get_field_objects($postId);
	if (isset($fields['detail_image']) && isset($fields['detail_image']['key']) && ! empty($fields['detail_image']['key']) &&
		isset($fields['preview_image']) && isset($fields['preview_image']['key']) && ! empty($fields['preview_image']['key']) &&
		isset($_POST['fields'][$fields['detail_image']['key']]) && ! empty($_POST['fields'][$fields['detail_image']['key']]) &&
		isset($_POST['fields'][$fields['preview_image']['key']])) {

		$detailImageId = $_POST['fields'][$fields['detail_image']['key']];
		$previewImageId = &$_POST['fields'][$fields['preview_image']['key']];

		$detailImageData = wp_get_attachment_image_src($detailImageId, 'full');
		if (isset($detailImageData[0]) && ! empty($detailImageData[0])) {
			$detailImageUrl = $detailImageData[0];
			$detailImagePath = $_SERVER['DOCUMENT_ROOT'] . str_replace(get_site_url(), '', $detailImageUrl);
			$image = wp_get_image_editor($detailImagePath);
			if (! is_wp_error($image)) {
				$image->resize(300, 230, true);
				$image->save($detailImagePath);
			}
			$previewImageId = $detailImageId;
		}
	}
	//var_dump($postId, $fields, $_POST); die;
}
add_action('save_post', 'onSavePost');