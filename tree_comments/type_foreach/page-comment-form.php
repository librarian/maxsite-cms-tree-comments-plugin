<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

mso_cur_dir_lang('templates');
$options = mso_get_option('tree_comments', 'plugins', array() ); // получаем опции
?>

<div class="comment-form">
	<form method="post">
		<input type="hidden" name="comments_page_id" value="<?= $page_id ?>">
		<?= mso_form_session('comments_session') ?>
		
		<?php  if (!is_login()) { ?>
		
			<?php if (! $comuser = is_login_comuser()) { ?>
			
			<div class="comments-auth">
			
				<?php if ($allow_comment_anonim = mso_get_option('allow_comment_anonim', 'general', '1') ) { ?>
				
				<?php if ($options['tc_compact_form']) { ?>	
					<p class="radio" style="float:left;"><label><input type="radio" name="comments_reg" id="comments_reg_1" value="noreg" checked="checked"> <?=t('Не регистрировать/аноним')?></label></p>
					<p class="radio right" style="float:right;"><label><input type="radio" name="comments_reg" id="comments_reg_2" value="reg"> <?=t('Зарегистрирован или новая регистрация')?></label></p>
					<div style="clear:both"></div>
				<?php } ?>
				
					<div class="comments-noreg <? if ($options['tc_compact_form']) echo 'sep'?>">
						
					<?php if (mso_get_option('allow_comment_comusers', 'general', '1')) { ?>
						<?php if (!$options['tc_compact_form']) { ?>
						<p class="radio"><label><input type="radio" name="comments_reg" id="comments_reg_1" value="noreg" checked="checked"> <?=t('Не регистрировать/аноним')?></label></p>
						<?php } ?>
					<?php } else { ?>
						<input type="hidden" name="comments_reg" value="noreg">
					<?php } ?>
						
							<table class="no-border"><tr class="r1">
								<td class="t1"><label for="comments_author"><?=t('Ваше имя')?></label></td>
								<td class="t2"><input type="text" name="comments_author" id="comments_author" onfocus="document.getElementById('comments_reg_1').checked = 'checked';"></td>
							</tr></table>
						
							<p class="hint"><?php
								#echo ($options['tc_form_text1']);
								
								if (mso_get_option('new_comment_anonim_moderate', 'general', '1') ) {
									$tc_form_text1 = $options['tc_form_text1'] . 'Ваш комментарий будет опубликован после проверки.';
									echo $tc_form_text1;
									}
								else echo ($options['tc_form_text1']);
							?></p>
						
						
					</div><!-- div class="comments-noreg" -->	
				<?php } ?>
			
			<?php if (mso_get_option('allow_comment_comusers', 'general', '1')) { ?>
				
				<div class="comments-reg<?php if ($allow_comment_anonim) echo ' sep'; ?>">
				
					<?php if ( mso_get_option('allow_comment_anonim', 'general', '1') ) {	?>
						<?php if (!$options['tc_compact_form']) { ?>
						<p class="radio"><label><input type="radio" name="comments_reg" id="comments_reg_2" value="reg"> <?=t('Зарегистрирован или новая регистрация')?></label></p> 
						<?php } ?>
					<?php } else { ?>
						<input type="hidden" name="comments_reg" id="comments_reg_2" value="reg" checked="checked"> 
					<?php } ?>
				
						<table class="no-border">
						<? #<tr class="r1"> ?>
						<?	#<td class="t1"><label for="comusers_nik" class="comments_email"><?= t('Ник') ?><? #</label></td>?>
						<?	#<td class="t2"><input type="text" name="comusers_nik" id="comusers_nik" value="" class="text" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></td>?>
						<?#</tr>?>						
						<tr class="r1">
							<td class="t1"><label for="comments_email" class="comments_email"><?= t('E-mail*') ?></label></td>
							<td class="t2"><input type="text" name="comments_email" id="comments_email" value="" class="text" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></td>
						</tr>
						<tr class="r1">
							<td class="t1"><label for="comments_password" class="comments_password"><?= t('Пароль*') ?></label></td>
							<td class="t2"><input type="password" name="comments_password" id="comments_password" value="" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></td>
						</tr>
						<? #<tr class="r1">?>
						<? #<td class="t1"><label for="comusers_url" class="comments_email"><?= t('Сайт') ?><?#</label></td>?>
						<? #<td class="t2"><input type="text" name="comusers_url" id="comusers_url" value="" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></td>?>
						<? #</tr>?>						
						</table>
				
						<p class="hint"><? echo ($options['tc_form_text2']); ?></p>
						<?php 
						if (mso_hook_present('page-comment-form')) 
						{
							echo '<p class="hint">' . ($options['tc_form_text3']) . ' ';
							mso_hook('page-comment-form');
							echo '</p>';
						}
						?>
											
				</div><!-- div class="comments-reg" -->
			
				<?php } ?>
				
			</div><!-- div class="comments-auth" -->
			
			<?php  } else { // comusers?>
				
				<input type="hidden" name="comments_email" value="<?= $comuser['comusers_email'] ?>">
				<input type="hidden" name="comments_password" value="<?= $comuser['comusers_password'] ?>">
				<input type="hidden" name="comments_password_md" value="1">
				<input type="hidden" name="comments_reg" value="reg">
				
				<div class="comments-user comments-comuser">
					<?php
						if (!$comuser['comusers_nik']) echo t('Привет!');
							else echo t('Привет,') . ' ' . $comuser['comusers_nik'] . '!';
					?> <a href="<?= getinfo('siteurl') ?>logout"><?=t('Выйти')?></a>
				</div>
			
			<?php  } ?>
			
		<?php  } else { // users?>
			<input type="hidden" name="comments_user_id" value="<?= getinfo('users_id') ?>">
		
			<div class="comments-user">
				<?=t('Привет')?>, <?= getinfo('users_nik') ?>! <a href="<?= getinfo('siteurl') ?>logout"><?=t('Выйти')?></a>
			</div>
		
		<?php  } ?>
		
		<div class="comments-textarea">
			<p class="you-comment"><label for="comments_content"><?=t('Ваш комментарий')?></label></p>
			<?php mso_hook('comments_content_start') ?>
			<textarea name="comments_content" id="comments_content" rows="10" cols="80"></textarea>
			<?php mso_hook('comments_content_end') ?>
			<div><input name="comments_submit" type="submit" value="<?=t('Отправить')?>" class="comments_submit"></div>
		</div><!-- div class="comments-textarea" -->
		
	</form>
</div><!-- div class=comment-form -->
