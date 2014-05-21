<?php
class contact 
{
	public function envoyer()
	{
		if (empty($this->req->name) || empty($this->req->firstname) || empty($this->req->mail) || empty($this->req->topic) || empty($this->req->content))
		{
			$this->site->add_message('Les informations transmises ne sont pas valides', Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'contact/');
		}
		if (preg_match(Regex::PSEUDO, $this->req->firstname) == FALSE)
		{
			$this->site->add_message("Certains caractères dans votre prénom ne sont pas acceptés", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'contact/');
		}
		if (preg_match(Regex::PSEUDO, $this->req->name) == FALSE)
		{
			$this->site->add_message("Certains caractères dans votre nom ne sont pas acceptés", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'contact/');
		}
		if (preg_match(Regex::MAIL, $this->req->mail) == FALSE)
		{
			$this->site->add_message("Votre mail n'est pas valide");
			$this->site->redirect($this->site->get_root().'contact/');
		}
		if (preg_match(Regex::SHORT_TEXT, $this->req->topic) == FALSE)
		{
			$this->site->add_message("Certains caractères dans le titre de votre mail ne sont pas acceptés", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'contact/');
		}
		if (preg_match(Regex::LONG_TEXT, $this->req->content) == FALSE)
		{
			$this->site->add_message("Certains caractères dans le contenu de votre mail ne sont pas acceptés", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'contact/');
		}		
		$m = new Mail();
		$m->add_receiver('contact@technologies.com');
		$m->set_sender('contact@technologies.com');
		$m->set_subject('Contact : '.$this->req->topic);
		$content = "<div>Mail envoyé par : ".$this->req->firstname." ".$this->req->name."</div>".$this->req->content;
		$m->set_body($content);
		if ($m->send())
		{
			$this->site->add_message("Votre mail à correctement été envoyé", Site::ALERT_OK);;
		}		
		else
		{
			$this->site->add_message("Une erreur est survenue lors de l'envoie de votre mail", Site::ALERT_ERROR);
		}
		$this->site->redirect($this->site->get_root().'contact/');
	}
}
?>