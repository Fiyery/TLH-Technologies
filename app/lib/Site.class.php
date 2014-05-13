<?php
/**
 * Site est la class qui gère les actions primaires du site telles que l'affichage de messages, la modification du titre de la page ou les redirections.
 * @author Yoann Chaumin <yoann.chaumin@gmail.com>
 * @version 1.3
 * @copyright 2011-2014 Yoann Chaumin
 * @uses Singleton
 */
class Site extends Singleton
{
	/**
	 * Constant qui définie le format de retoure de la racine comme adresse url.
	 * @var int
	 */
	const URL = 1;
	
	/**
	 * Constant qui définie le format de retoure de la racine comme chemin de fichier.
	 * @var int
	 */
	const DIR = 2;
	
	/**
	 * Variable d'instance de singleton.
	 * @var Site
	 */
	protected static $_instance = NULL;

	/**
	 * Tableau contenant les racines URL et DIR du site.
	 * @var array<string>
	 */
	private static $_root = NULL;
	
	/**
	 * Constructeur.
	 */
	protected function __construct()
	{
		self::$_root = array();
	}
	
	/**
	 * Envoie un header de redirection au navigateur et quitte le script.
	 * @param string $module Nom du module cible ou Adresse URL.
	 * @param string $action Nom de l'action.
	 */
	public function redirect($module = 'PageIndex', $action = 'index')
	{
		if (strpos($module, '.') === FALSE && strpos($module, '/') === FALSE)
		{
			header("Location: ?module=$module&action=$action");
		}
		else
		{
			header("Location: $module");
		}
		exit();
	}
	
	/**
	 * Fait une redirection vers la page précédente ou l'index si elle n'est pas trouvé
	 */
	public function prev()
	{
		$url = (isset($_SERVER['HTTP_REFERER'])) ? ($_SERVER['HTTP_REFERER']) : (Site::get_root());
		header("Location: " . $url);
		exit();
	}
	
	/**
	 * Retourne la racine du site au format URL ou DIR.
	 * @param int $format Format de retour, utilisez les constantes de classe DIR ou URL.
	 * @return string Racine du site.
	 */
	public static function get_root($format = self::URL)
	{
		if ($format != self::URL && $format != self::DIR)
		{
			return NULL;
		}
		if (array_key_exists($format, self::$_root))
		{
			return self::$_root[$format];
		}
		$root = dirname($_SERVER['SCRIPT_FILENAME']);
		while(! file_exists($root . '/.root') && $root != $_SERVER['DOCUMENT_ROOT'])
		{
			$root = dirname($root);
		}
		if ($format == self::URL)
		{
			$root = str_replace($_SERVER['DOCUMENT_ROOT'], 'http://' . $_SERVER['SERVER_NAME'], $root);
			$root = (substr($root, - 1) != '/') ? ($root . '/') : ($root);
			self::$_root[$format] = $root;
		}
		else
		{
			$root .= '/';
			self::$_root[$format] = $root;
		}
		return $root;
	}
	
	/**
	 * Formate les urls en urls absolues.
	 * @param array|string $url Liste ou élément unique contenant l'adresse URL à parser.
	 * @return array|string URL parsée.
	 */
	public static function parse_url($url)
	{
		$list_url = NULL;
		if (is_array($url))
		{
			$list_url = array();
			foreach($url as $u)
			{
				$list_url[] = self::parse_url_unique($u);
			}
		}
		elseif (is_string($url))
		{
			$list_url = self::parse_url_unique($url);
		}
		return $list_url;
	}
	
	/**
	 * Formate une URL en URL absolue.
	 * @param astring $url L'adresse URL à parser.
	 * @return string URL parsée.
	 */
	private static function parse_url_unique($url)
	{
		if (substr($url, 0, 7) != 'http://')
		{
			$pos = strpos($url, '?');
			if ($pos !== FALSE)
			{
				$get = substr($url, $pos);
				$url = substr($url, 0, $pos);
			}
			$url = (substr($url, - 1) == '/') ? (realpath($url) . '/') : (realpath($url));
			if (DIRECTORY_SEPARATOR != '/')
			{
				$url = str_replace(DIRECTORY_SEPARATOR, '/', $url);
			}
			$url = str_replace(self::get_root(self::DIR), self::get_root(), $url);
			if ($pos !== FALSE)
			{
				$url = $url . $get;
			}
		}
		// Norme W3C & = &amp;.
		$url = str_replace('&amp;', '&', $url);
		$url = str_replace('&', '&amp;', $url);
		return $url;
	}
	
	/**
	 * Vérifie que la request envoyé au site provienne bien de ce même site.
	 * @return boolean
	 */
	public static function check_source()
	{
		$root = self::get_root();
		$request = (array_key_exists('HTTP_REFERER',$_SERVER)) ? ($_SERVER['HTTP_REFERER']) : (NULL);
		return ($root == substr($request,0,strlen($root)));
	}
}
?>