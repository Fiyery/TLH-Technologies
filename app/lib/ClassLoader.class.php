<?php
/**
 * ClassLoader gère le chargement des classe du site.
 * @author Yoann Chaumin <yoann.chaumin@gmail.com>
 * @version 1.1
 * @copyright 2011-2014 Yoann Chaumin
 */
class ClassLoader
{

	/**
	 * Tableau des localisations des fichiers des classes.
	 * @var array<string>
	 */
	private $_dirs = array();

	/**
	 * Nombre de dossiers de classes.
	 * @var int
	 */
	private $_nb_dirs = 0;

	/**
	 * Extention des fichiers classe.
	 * @var sting
	 */
	private $_ext = '.php';

	/**
	 * Constructeur.
	 */
	public function __construct()
	{}

	/**
	 * Ajoute un nouveau dossier de classes.
	 * @param string $dir Chemin du dosier de classes.
	 */
	public function add_dir($dir)
	{
		if (is_string($dir) && file_exists($dir) && in_array($dir, $this->_dirs) == FALSE)
		{
			$this->_dirs[] = (substr($dir, - 1) != '/') ? ($dir . '/') : ($dir);
			$this->_nb_dirs ++;
		}
	}

	/**
	 * Définie l'extention des fichiers.
	 * @param string $ext Extention des classes.
	 */
	public function set_ext($ext = 'php')
	{
		$this->_ext = (substr($ext, 0, 1) != '.') ? ('.' . $ext) : ($ext);
	}

	/**
	 * Active le chargement des classes.
	 */
	public function enable()
	{
		spl_autoload_register(array(
			$this,
			'load'
		), TRUE);
	}

	/**
	 * Désactive le chargement des classes.
	 */
	public function disable()
	{
		spl_autoload_unregister(array(
			$this,
			'load'
		));
	}

	/**
	 * Change une classe.
	 * @param string $name Nom de la classe.
	 * @return boolean
	 */
	public function load($name)
	{
		if ($this->_nb_dirs == 0)
		{
			return FALSE;
		}
		$find = FALSE;
		$file = $name . $this->_ext;
		reset($this->_dirs);
		while($find == FALSE && ($dir = current($this->_dirs)))
		{
			if (file_exists($dir . $file))
			{
				include ($dir . $file);
				$find = TRUE;
			}
			next($this->_dirs);
		}
		return TRUE;
	}
}

?>