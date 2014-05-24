<?php
class navigation_menu
{
	public function init()
	{
		$vars = $this->cache->read('navigation_menu', Cache::MONTH);
		$vars = NULL;
		if (is_array($vars) == FALSE)
		{
			$menus = Menu::search(NULL, NULL, NULL, NULL, array('ASC'=>'order'));
			$sous_menus = Sous_Menu::search(NULL, NULL, NULL, NULL, array('ASC'=>'order'));
			$static_menus = Static_Menu::search(NULL, NULL, NULL, NULL, array('ASC'=>'id'));
			$list_links = array();
			$root = $this->site->get_root();
			foreach ($menus as $m)
			{
				if ($m->enable == 1)
				{
					$link['name'] = $m->name;
					$link['href'] = $root.String::format_url($m->name).'/';
					$link['list'] = array();
					foreach ($sous_menus as $sm)
					{
						if ($sm->id_menu == $m->id && $sm->enable == 1)
						{
							$sub_link['name'] = $sm->name;
							$sub_link['href'] = $link['href'].String::format_url($sm->name).'/';
							$link['list'][] = $sub_link;
						}
					}
					$list_links[] = $link;
				}
			}
			$this->cache->add('list_links', $list_links);
			$this->cache->write();
		}
		else 
		{
			$list_links = $vars['list_links'];
		}
		$this->view->list_links = $list_links;
		$this->view->static_menus = $static_menus;
	}
}
?>