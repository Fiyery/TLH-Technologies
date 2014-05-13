<?php
/**
 * ControllerManager gère le chargement de controller spécfique.
 * @author Yoann Chaumin <yoann.chaumin@gmail.com>
 * @version 1.0
 * @copyright 2011-2014 Yoann Chaumin
 */
class ControllerManager
{		
	/**
	 * Nom du controller.
	 * @var string
	 */
	private $_controller = NULL;
	
	/**
	 * Nom de l'action
	 * @var string
	 */
	private $_action = NULL;
	
	/**
	 * Constructeur
	 * @param string $controller Nom du module.
	 * @param string $action Nom de l'action.
	 */
	public function __construct($controller, $action)
	{
		$this->_controller = $controller;
		$this->_action = $action;
	}
	
	/**
	 * Lance le controller.
	 * @param string $dir Dossier d'emplacement des modules.
	 * @param array $params Liste des paramètres.
	 * return boolean
	 */
	public function execute($dir, $params=NULL)
	{
		$dir = (substr($dir, -1) != '/') ? ($dir.'/') : ($dir);		
		$file = $dir.$this->_controller.'.php';
		echo $file;
		if (file_exists($file) == FALSE)
		{
			return FALSE;
		}
		require($file);
		$class = $this->_controller;
		$controller = new $class();
		if (method_exists($controller, $this->_action) == FALSE)
		{
			return FALSE;
		}
		if (is_array($params))
		{
			foreach ($params as $name => $value)
			{
				$controller->$name = $value;
			}
		}
		$method =  $this->_action;
		$controller->$method();
		return TRUE;
	}
	
	/**
	 * Retourne le contenu du controller.
	 * @param string $dir Dossier d'emplacement des views.
	 * @param View $view Instance de liste de paramètre vers la template.
	 * return string
	 */
	public function show($dir, View $view)
	{
		$dir = (substr($dir, -1) != '/') ? ($dir.'/') : ($dir);
		$file = $dir.$this->_controller.'-'.$this->_action.'.php';
		if (file_exists($file) == FALSE)
		{
			return FALSE;
		}
		$list_values = $view->get_list();
		foreach ($list_values as $name => $value)
		{
			$$name = $value;
		}
		ob_start();
		require($file);
		return ob_get_clean();
	}
}

?>