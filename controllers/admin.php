<?php
class admin
{
	public function default_action()
	{
		if ($this->session->is_open())
		{
			$this->site->redirect($this->site->get_root().'admin/panel/');
		}
	}
	
	public function connection()
	{
		// Connexion et ouverture de la session.
		if ($this->session->is_open() == FALSE)
		{
			if (empty($this->req->login) || empty($this->req->pass))
			{
				$this->site->add_message("Votre identifiant ou mot de passe sont invalides", Site::ALERT_ERROR);
				$this->site->redirect($this->site->get_root().'admin/');
			}
			$admins = Administrator::search('pseudo', $this->req->login);
			if (is_array($admins) == FALSE && count($admins) == 0)
			{
				$this->site->add_message("Votre identifiant ou mot de passe sont invalides", Site::ALERT_ERROR);
				$this->site->redirect($this->site->get_root().'admin/');
			}
			$pass = sha1(md5($this->req->pass));
			if ($admins[0]->pass != $pass)
			{
				$this->site->add_message("Votre identifiant ou mot de passe sont invalides", Site::ALERT_ERROR);
				$this->site->redirect($this->site->get_root().'admin/');
			}
			$this->session->open($admins[0]);
			$this->site->add_message("Connexion réussie", Site::ALERT_OK);
		}
		$this->site->redirect($this->site->get_root().'admin/panel/');
	}
	
	public function deconnection()
	{
		if ($this->session->is_open())
		{
			$this->session->close();
			$this->site->add_message("Vous avez été déconnecté", Site::ALERT_OK);
		}
		else
		{
			$this->site->add_message("Veuillez vous connecter", Site::ALERT_ERROR);
		}
		$this->site->redirect($this->site->get_root().'admin/');
	}
	
	public function panel()
	{
		if ($this->session->is_open())
		{
			$menus = Menu::search(NULL, NULL, NULL, NULL, array('ASC'=>array('order', 'name')));
			$sous_menus = Sous_Menu::search(NULL, NULL, NULL, NULL, array('ASC'=>array('order', 'name')));
		
			$this->view->menus = $menus;
			$this->view->sous_menus = $sous_menus;
		}
		else
		{
			$this->site->add_message("Veuillez vous connecter", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'admin/');
		}
	}
	
	public function enable()
	{
		if ($this->session->is_open())
		{
			//	TODO Yoann
			// Requete GET. Il faut vérifier si :
			//	- "type" existe et égale à "menu" ou "sous_menu"
			//	- "id" existe et est integer
			// Si OK :
			//  - désactiver élément
			$this->site->redirect($this->site->get_root().'admin/panel/');
		}
		else
		{
			$this->site->add_message("Veuillez vous connecter", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'admin/');
		}
	}
	
	public function disable()
	{
		if ($this->session->is_open())
		{
			//	TODO Yoann
			// Requete GET. Il faut vérifier si :
			//	- "type" existe et égale à "menu" ou "sous_menu"
			//	- "id" existe et est integer
			// Si OK :
			//  - activer élément
			$this->site->redirect($this->site->get_root().'admin/panel/');
		}
		else
		{
			$this->site->add_message("Veuillez vous connecter", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'admin/');
		}
	}
	
	public function edit()
	{
		if ($this->session->is_open())
		{
			//	TODO Yoann
			// Requete GET. Il faut vérifier si :
			//	- "type" existe et égale à "menu" ou "sous_menu"
			//  - "type" == "menu", "id" (existe et est integer) ou (inexistant)
			//  - "type" == "sous_menu", ("id" ou "id_menu" (existe et est integer))
			// Si OK :
			//  - Si "id" existant, charger l'élément du même "type" et "id"
			//  - Si "id" inexistant, nouvel élément avec valeur par défaut du "type"
			//  - Si "id_menu" et "sous_menu", parent par défaut du nouvel élément
		}
		else
		{
			$this->site->add_message("Veuillez vous connecter", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'admin/');
		}
	}
}
?>