<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

	$CI = & get_instance();
	//$plugin_url = getinfo('site_url') . 'admin/tree_comments/';
	
	$options_key = 'tree_comments';
	
	if ( $post = mso_check_post(array('f_session_id', 'f_submit')) )
	{
		mso_checkreferer();
		
		$options = array();
		$options['header'] = $post['f_header'];
	
		mso_add_option($options_key, $options, 'plugins');
		echo '<div class="update">' . t('Обновлено!', 'plugins') . '</div>';
	}
	
?>
<h1><?= t('Плагин', tree_comments) ?></h1>
<p class="info"><?= t('Описание', tree_comments) ?></p>

<?php
		$options = mso_get_option($options_key, 'plugins', array());
		if ( !isset($options['header']) ) $options['header'] = ''; 

		$form = '';
		$form .= '<h2>' . t('Настройки', 'plugins') . '</h2>';
		$form .= '<p><strong>' . t('Заголовок:', 'plugins') . '</strong> ' . ' <input name="f_header" type="text" value="' . $options['header'] . '"></p>';
		
		echo '<form action="" method="post">' . mso_form_session('f_session_id');
		echo $form;
		echo '<input type="submit" name="f_submit" value="' . t('Сохранить изменения', 'plugins') . '" style="margin: 25px 0 5px 0;">';
		echo '</form>';

?>