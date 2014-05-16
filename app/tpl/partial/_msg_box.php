<?php
	$success_list = array();
	$error_list = array();
	$info_list = array();

	if (isset($msg_list)) {
		foreach ($msg_list as $item) {
			switch($item['class'])
			{
				case 'alert_info':
				{
					array_push($info_list, $item['msg']);
					break;
				}
				case 'alert_ok':
				{
					array_push($success_list, $item['msg']);
					break;
				}
				case 'alert_warning':
				{
					array_push($info_list, $item['msg']);
					break;
				}
				case 'alert_error':
				{
					array_push($error_list, $item['msg']);
					break;
				}
				default:
				{
					array_push($info_list, $item['msg']);
					break;
				}
			}
		}
	}
?>

<?php if (isset($success_list) && sizeof($success_list) > 0) : ?>
	<div class="msg_box success">
		<?php while (list($key, $value) = each($success_list)) :?>
			<p><?= $value ?></p>
		<?php endwhile; ?>
	</div>
<?php endif; ?>

<?php if (isset($error_list) && sizeof($error_list) > 0) : ?>
	<div class="msg_box error">
		<?php while (list($key, $value) = each($error_list)) :?>
			<p><?= $value ?></p>
		<?php endwhile; ?>
	</div>
<?php endif; ?>

<?php if (isset($info_list) && sizeof($info_list) > 0) : ?>
	<div class="msg_box info">
		<?php while (list($key, $value) = each($info_list)) :?>
			<p><?= $value ?></p>
		<?php endwhile; ?>
	</div>
<?php endif; ?>