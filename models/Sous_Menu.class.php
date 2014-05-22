<?php
class Sous_Menu extends Dao
{
	/**
	 * Définie le contenu du la page.
	 * @param string $content Nouveau contenu.
	 */
	public function set_content($content)
	{
		$menu = Menu::load($this->id_menu);
		$file = 'views/'.String::format_url($menu->name).'-'.String::format_url($this->name).'.php';
		$this->view->content = file_put_contents($file, $content);
	}
}
?>