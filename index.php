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
$loader->add_dir('app/models/');
$loader->add_dir('app/lib/');
$loader->enable();

// Paramètres.
$config = Config::get_instance();
$config->set_json('app/var/config.json');

// Base de données.
$base = Base::get_instance('UTF-8');
$base->add_base($config->DB->host, $config->DB->name, $config->DB->user, $config->DB->pass);

// Système de cache.
$cache = Cache::get_instance('app/cache/');

// Intitialisation des Dao.
Dao::set_base($base);

Debug::show(Menu::search());

require('app/tpl/main.php');
?>