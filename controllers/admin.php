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
			$static_menus = Static_Menu::search(NULL, NULL, NULL, NULL, array('ASC'=>array('name')));
			$menus = Menu::search(NULL, NULL, NULL, NULL, array('ASC'=>array('order')));
			$sous_menus = Sous_Menu::search(NULL, NULL, NULL, NULL, array('ASC'=>array('order')));
			$this->view->menus = $menus;
			$this->view->sous_menus = $sous_menus;
			$this->view->static_menus = $static_menus;
		}
		else
		{
			$this->site->add_message("Veuillez vous connecter", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'admin/');
		}
	}
	
	function _set_msg($bool, $user_msg_ok = NULL, $user_msg_error = NULL)
	{
		$msg_ok = (empty($user_msg_ok))
			? "Vos changements ont été pris en compte, veuillez rafrachir la page pour visualiser le nouveau menu"
			: $user_msg_ok;
			
		$msg_error = (empty($user_msg_error))
			? "Une erreur est survenue dans l'enregistrement de vos données"
			: $user_msg_error;
			
		$msg_content = ($bool) ? $msg_ok : $msg_error;
		$msg_type = ($bool) ? Site::ALERT_OK : Site::ALERT_ERROR ;
		
		$this->site->add_message($msg_content, $msg_type);
	
	}
	
	function _set_enable($id, $type, $value)
	{
		if ($type == "menu" || $type == "sous_menu")
		{
			$data = ($type == "menu") ? (Menu::load($this->req->id)) : (Sous_Menu::load($this->req->id));
			if (is_object($data))
			{
				$this->_set_msg($data->modify(array("enable" => $value, "date_modification" => date('Y-m-d H:i:s'))));
			}
			else
			{
				$name = str_replace('_', '-', $type);
				$this->site->add_message("Aucun ".$name." ne correspond à votre demande", Site::ALERT_ERROR);
			}
		}
		else
		{
			$this->site->add_message("Aucun élément de ce type n'existe", Site::ALERT_ERROR);
		}
	}
	
	public function enable()
	{
		if ($this->session->is_open())
		{
			if ($this->req->id !== NULL && $this->req->id > 0)
			{
				$this->_set_enable($this->req->id, $this->req->type, 1);
			}
			else
			{
				$this->site->add_message("Vous ne pouvez pas accéder à cet élément", Site::ALERT_ERROR);
			}
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
			if ($this->req->id !== NULL && $this->req->id > 0)
			{
				$this->_set_enable($this->req->id, $this->req->type, 0);
			}
			else
			{
				$this->site->add_message("Vous ne pouvez pas accéder à cet élément", Site::ALERT_ERROR);
			}
			$this->site->redirect($this->site->get_root().'admin/panel/');
		}
		else
		{
			$this->site->add_message("Veuillez vous connecter", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'admin/');
		}
	}
	
	function _set_order($id, $type, $value)
	{
		if ($type == "menu" || $type == "sous_menu")
		{
			$data = ($type == "menu") ? (Menu::load($this->req->id)) : (Sous_Menu::load($this->req->id));
			if (is_object($data))
			{
				$lookup = ''.($data->order + $value);
				$target = ($type == "menu") ? Menu::search('order', $lookup) : Sous_Menu::search(array('id_menu' => $data->id_menu, 'order' => $lookup));
				if ($target != NULL)
				{
					$target = $target[0];
					$new_data = array('order' => $target->order, "date_modification" => date('Y-m-d H:i:s'));
					$new_target = array('order' => $data->order, "date_modification" => date('Y-m-d H:i:s'));
					$update_data = $data->modify($new_data);
					$update_target = $target->modify($new_target);
					$this->_set_msg($update_data && $update_target);
				}
				else
				{
					$name = str_replace('_', '-', $type);
					$verbe = ($value > 0) ? "suit" : "précède";
					$this->site->add_message("Aucun ".$name." ne ".$verbe." celui-ci", Site::ALERT_ERROR);
				}
			}
			else
			{
				$name = str_replace('_', '-', $type);
				$this->site->add_message("Aucun ".$name." ne correspond à votre demande", Site::ALERT_ERROR);
			}
		}
		else
		{
			$this->site->add_message("Aucun élément de ce type n'existe", Site::ALERT_ERROR);
		}
	}
	
	public function moveup()
	{
		if ($this->session->is_open() && $this->req->type !== NULL && $this->req->id !== NULL)
		{
			if (is_numeric($this->req->id) && $this->req->id > 0)
			{
				$this->_set_order($this->req->id, $this->req->type, -1);
			}
			else
			{
				$this->site->add_message("Vous ne pouvez pas accéder à cet élément", Site::ALERT_ERROR);
			}
			$this->site->redirect($this->site->get_root().'admin/panel/');
		}
		else
		{
			if ($this->req->type === NULL)
			{
				$this->site->add_message("Veuillez préciser un type d'élément", Site::ALERT_ERROR);
				$this->site->redirect($this->site->get_root().'admin/panel/');
			}
			elseif ($this->req->id === NULL)
			{
				$this->site->add_message("Veuillez préciser un élément", Site::ALERT_ERROR);
				$this->site->redirect($this->site->get_root().'admin/panel/');
			}
			else
			{
				$this->site->add_message("Veuillez vous connecter", Site::ALERT_ERROR);
				$this->site->redirect($this->site->get_root().'admin/');
			}
		}
	}
	
	public function movedown()
	{
		if ($this->session->is_open() && $this->req->type !== NULL && $this->req->id !== NULL)
		{
			if (is_numeric($this->req->id) && $this->req->id > 0)
			{
				$this->_set_order($this->req->id, $this->req->type, 1);
			}
			else
			{
				$this->site->add_message("Vous ne pouvez pas accéder à cet élément", Site::ALERT_ERROR);
			}
			$this->site->redirect($this->site->get_root().'admin/panel/');
		}
		else
		{
			if ($this->req->type === NULL)
			{
				$this->site->add_message("Veuillez préciser un type d'élément", Site::ALERT_ERROR);
				$this->site->redirect($this->site->get_root().'admin/panel/');
			}
			elseif ($this->req->id === NULL)
			{
				$this->site->add_message("Veuillez préciser un élément", Site::ALERT_ERROR);
				$this->site->redirect($this->site->get_root().'admin/panel/');
			}
			else
			{
				$this->site->add_message("Veuillez vous connecter", Site::ALERT_ERROR);
				$this->site->redirect($this->site->get_root().'admin/');
			}
		}
	}
	
	public function edit()
	{
		if ($this->session->is_open())
		{
			$this->view->type = $this->req->type;
			$this->view->content = NULL;
			$this->view->data = null;
			if ($this->req->type == "menu")
			{
				$this->view->menus = null;
				if (!empty($this->req->id))
				{
					$menu = Menu::load($this->req->id);
					if (is_object($menu))
					{
						$this->view->data = $menu;
						$file = 'views/'.String::format_url($menu->name).'-default_action.php';
						$this->view->content = file_get_contents($file);
					}
					else
					{
						$this->site->add_message("Aucun menu ne correspond à votre demande", Site::ALERT_ERROR);
					}
				}
			}
			elseif ($this->req->type == "sous_menu")
			{
				$this->view->menus = Menu::search();
				if (!empty($this->req->id))
				{
					$sous_menu = Sous_Menu::load($this->req->id);
					if (is_object($sous_menu))
					{
						$this->view->data = $sous_menu;
						$menu = Menu::load($sous_menu->id_menu);
						$file = 'views/'.String::format_url($menu->name).'-'.String::format_url($sous_menu->name).'.php';
						$this->view->content = file_get_contents($file);
					}
					else
					{
						$this->site->add_message("Aucun sous-menu ne correspond à votre demande", Site::ALERT_ERROR);
					}
				}
				elseif (!empty($this->req->id_menu))
				{
					$menu = Menu::load($this->req->id_menu);
					if (is_object($menu))
					{
						$sous_menu = new Sous_Menu();
						$sous_menu->id = "";
						$sous_menu->name = "";
						$sous_menu->order = "";
						$sous_menu->enable = $menu->enable;
						$sous_menu->id_menu = $menu->id;
						$this->view->data = $sous_menu;
					}
					else
					{
						$this->site->add_message("Aucun menu ne correspond à votre demande", Site::ALERT_ERROR);
					}
				}
			}
			elseif ($this->req->type == 'static_menu')
			{
				$this->view->menus = null;
				if (!empty($this->req->id))
				{
					$menu = Static_Menu::load($this->req->id);
					if (is_object($menu))
					{
						$this->view->data = $menu;
						$file = 'views/'.String::format_url($menu->name).'-default_action.php';
						$this->view->content = file_get_contents($file);
					}
					else
					{
						$this->site->add_message("Aucun menu statique ne correspond à votre demande", Site::ALERT_ERROR);
					}
				}
			}
			else
			{
				$this->site->add_message("Erreur valeur de type", Site::ALERT_ERROR);
				$this->site->redirect($this->site->get_root().'admin/panel/');
			}
		}
		else
		{
			$this->site->add_message("Veuillez vous connecter", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'admin/');
		}
	}
	
	public function update()
	{
		if ($this->session->is_open())
		{
			if (in_array($this->req->type, array('menu', 'sous_menu', 'static_menu')) == FALSE)
			{
				$this->site->add_message("Une erreur est survenue lors de la réception de vos données", Site::ALERT_ERROR);
				$this->site->redirect($this->site->get_root().'admin/panel/');				
			}
			$type = $this->req->type;
			$forward_id = ($this->req->id > 0) ? $this->req->id : NULL;
			if (isset($this->req->id))
			{
				if ($this->req->id == -1)
				{
					if ($type == "menu")
					{
						$last_menu = Menu::search(NULL, NULL, NULL, NULL, array('DESC' => 'order'));
						if (is_array($last_menu) && count($last_menu) > 0)
						{
							$order = $last_menu = $last_menu[0]->order + 1;
							$new_menu = Menu::add(array(NULL, $this->req->name, $this->req->enable, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $order));
							file_put_contents('views/'.String::format_url($this->req->name).'-default_action.php', $this->req->content);
							$this->_set_msg($new_menu, "Vos modifications ont été enregistrées");
							$new_menu = Menu::search(array('order' => $order));
							if (is_array($new_menu) && count($new_menu) > 0)
							{
								$forward_id = $new_menu[0]->id;
							}
						}
						else
						{
							$this->site->add_message("Une erreur est survenue dans l'accès à vos données", Site::ALERT_ERROR);
						}
					}
					elseif ($type == 'sous_menu')
					{
						$menu = Menu::load($this->req->id_menu);
						if (is_object($menu))
						{
							$order = 0;
							$last_sous_menu = Sous_Menu::search('id_menu', $this->req->id_menu, NULL, NULL, array('DESC' => 'order'));
							if (is_array($last_sous_menu) && count($last_sous_menu) > 0)
							{
								$order = $last_sous_menu[0]->order + 1;
							}
							$new_sous_menu = Sous_Menu::add(array(NULL, $this->req->name, $this->req->enable, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $order, $this->req->id_menu));
							file_put_contents('views/'.String::format_url($menu->name).'-'.String::format_url($this->req->name).'.php', $this->req->content);
							$this->_set_msg($new_sous_menu, "Vos modifications ont été enregistrées");
							$new_sous_menu = Sous_Menu::search(array('order' => $order, 'id_menu' => $this->req->id_menu));
							if (is_array($new_sous_menu) && count($new_sous_menu) > 0)
							{
								$forward_id = $new_sous_menu[0]->id;
							}
						}
						else
						{
							$this->site->add_message("Vous ne pouvez pas créer un sous-menu sous un menu inexistant", Site::ALERT_ERROR);
						}
					}
					else 
					{
						$date = date('Y-m-d H:i:s');
						$new_menu = Static_Menu::add(array(NULL, $this->req->name, $date, $date));
						file_put_contents('views/'.String::format_url($this->req->name).'-default_action.php', $this->req->content);
						$this->_set_msg($new_menu, "Vos modifications ont été enregistrées");
						$new_menu = Static_Menu::search(array('name' => $this->req->name, 'date_creation'=>date('Y-m-d H:i:s')));
						if (is_array($new_menu) && count($new_menu) > 0)
						{
							$forward_id = $new_menu[0]->id;
						}
					}
				}
				else
				{
					if ($type == "menu")
					{
						$menu = Menu::load($this->req->id);
						$update_menu = $menu->modify(array("name" => $this->req->name, "enable" => $this->req->enable, "date_modification" => date('Y-m-d H:i:s')));
						$menu->set_content($this->req->content);
						$this->_set_msg($update_menu, "Vos modifications ont été enregistrées");
					}
					elseif ($type == 'sous_menu')
					{
						$sous_menu = Sous_Menu::load($this->req->id);
						$update_sous_menu = $sous_menu->modify(array("name" => $this->req->name, "enable" => $this->req->enable, "id_menu" => $this->req->id_menu, "date_modification" => date('Y-m-d H:i:s')));
						$sous_menu->set_content($this->req->content);
						$this->_set_msg($update_sous_menu, "Vos modifications ont été enregistrées");
					}
					else 
					{
						$menu = Static_Menu::load($this->req->id);
						$update_menu = $menu->modify(array("name" => $this->req->name, "date_modification" => date('Y-m-d H:i:s')));
						$menu->set_content($this->req->content);
						$this->_set_msg($update_menu, "Vos modifications ont été enregistrées");
					}
				}
			}
			$id_data = ($forward_id !== NULL) ? '&id='.$forward_id : '';
			$this->site->redirect($this->site->get_root().'admin/edit/?type='.$type.$id_data);
		}
		else
		{
			$this->site->add_message("Veuillez vous connecter", Site::ALERT_ERROR);
			$this->site->redirect($this->site->get_root().'admin/');
		}
	}
}
?>