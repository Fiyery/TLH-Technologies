<?php
class Menu extends Dao
{
	/**
	 * Définie le contenu du la page.
	 * @param string $content Nouveau contenu.
	 */
	public function set_content($content)
	{
		$file = 'views/'.String::format_url($this->name).'-default_action.php';
		$this->view->content = file_put_contents($file, $content);
	}
}
?>