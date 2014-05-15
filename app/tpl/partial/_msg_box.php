<?php if (isset($msg_list)) : ?>
	<div id='msg_box'>
		<?php foreach ($msg_list as $m) : ?>
			<div class='<?= $m['class'] ?>'><?= $m['msg'] ?></div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>