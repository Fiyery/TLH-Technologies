<?php
class recherche 
{
	public function default_action()
	{
		if (empty($this->req->keywords))
		{
			
		}	
		
		$dir = 'views/';
		$excluded = array('.', '..', 
			'navigation_menu-init.php', 
			'admin-default_action.php',
			'admin-panel.php',
			'admin-edit.php',
			'error-not_found.php',
			'rechercher-default_action.php'
		);
		$templates = array_diff(scandir($dir), $excluded);
		$finded = array();
		$words = explode(' ', str_replace('%20', ' ', $this->req->keywords));
		$words_count = count($words);
		foreach ($templates as $t)
		{
			$content = strip_tags(file_get_contents($dir.$t));
			for($i=0; $i < $words_count; $i++)
			{
				if (strpos($content, $words[$i]) !== FALSE)
				{
					$finded[] = $t;
					$i = $words_count;
				}
			}
			
		}
		$count = count($finded);
		if ($count > 0)
		{
			$links = array();
			$root = $this->site->get_root();
			$menu = Menu::search();
			$sous_menu = Sous_Menu::search();
			foreach ($finded as $f)
			{
				$pos = strpos($f, '-');
				$controller = substr($f, 0, $pos);
				$action = substr($f, $pos + 1, -4);
				$parent_name = NULL;
				foreach ($menu as $m)
				{
					if (String::format_url($m->name) == $controller)
					{
						$parent_name = $m->name;
					}
				}
				if ($action != 'default_action')
				{
					foreach ($sous_menu as $m)
					{
						if (String::format_url($m->name) == $action)
						{
							$name = $m->name;
						}
					}
				}
				else
				{
					$name = $parent_name;
					$parent_name = NULL;
				}
				$links[] = array(
					'link' => ($action != 'default_action') ? ($root.$controller.'/'.$action.'/') : ($root.$controller.'/'),
					'parent_link' => (empty($parent_name) == FALSE) ? ($root.$controller.'/') : (NULL),
					'name' => $name,
					'parent_name' => $parent_name
				);
			}
			$this->view->links = $links;
			$this->view->nb_links = count($links);
		}
	}
}
?>