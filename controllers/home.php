<?php
class Home
{
	public function default_action()
	{
		echo 'action par défaut';
		$this->view->var_test = "Variable de template !";
	}
	
	public function send()
	{
		echo 'action send';
	}
}
?>