<?php
// Entête de la requête de retour.
header('Content-type:text/html; charset=utf-8');

// Affichage des erreurs PHP.
ini_set('display_errors', 1);
ini_set('error_reporting',E_ALL);

// Fuseau horaire français.
date_default_timezone_set('Europe/Paris');

// Chargement de classes.
require ("app/lib/ClassLoader.class.php");
$loader = new ClassLoader();
$loader->set_ext('.class.php');
$loader->add_dir('models/');
$loader->add_dir('app/lib/');
$loader->enable();

// Paramètres.
$config = Config::get_instance();
$config->set_json('app/var/config.json');

// Base de données.
$base = Base::get_instance('UTF-8');
$base->add_base($config->DB->host, $config->DB->name, $config->DB->user, $config->DB->pass);

// Système de cache.
$cache = Cache::get_instance('app/tmp/');

// Intitialisation des Dao.
Dao::set_base($base);

// Traitement particulier.
$name = (isset($_GET['controller']) && empty($_GET['controller']) == FALSE) ? ($_GET['controller']) : ('home');
$action = (isset($_GET['action']) && empty($_GET['action']) == FALSE) ? ($_GET['action']) : ('default_action');
$controller = new ControllerManager($name, $action);

// Gestion des paramètre à envoyer à la vue.
$view = View::get_instance();

// Définition des variables globales.
$vars = array(
	'conf' => $config,
	'cache' => $cache,
	'view' => $view
);

// Exécution du controler.
ob_start();
$executed = $controller->execute('controllers/', $vars);

// Affichage de la vue.
$content = $controller->show('views/', $view);

// Page d'erreur si page de view et controller.
if ($executed == FALSE && $content === FALSE)
{
	$controller = new ControllerManager('error', 'not_found');
	$controller->execute('controllers/', $vars);
	$content = $controller->show('views/', $view);
}

$echos = ob_get_clean();
require('app/tpl/main.php');

require('app/tpl/debug_area.php');
?>