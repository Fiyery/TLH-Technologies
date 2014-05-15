<?php
class admin
{
	public function default_action()
	{
		
	}
	
	public function panel()
	{
		if (empty($this->req->login) || empty($this->req->pass))
		{
			$this->site->add_message("Votre identifiant ou mot de passe sont invalides");
			$this->site->redirect($this->site->get_root().'admin/');
		}
	}
}
?>