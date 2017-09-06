<?php

//  On definit le namespace de l'application.
namespace Core;
use \App\AppController;

// On définit une variable globale pour la racine de notre site / application.
define ('ROOT', dirname(__DIR__));

// On requiert l'Autoloader pour pouvoir charger nos classes automatiquement.
require_once(ROOT . '/core/Autoloader.php');
Autoloader::register();

// On instancie notre factory, qui va permettre de créer toutes les classes dont nous avons besoin pour notre application.
$appController = AppController::getInstance();

// On créé les tables dont on a besoin via la factory qui est directement en lien avec la db.
$applicationTable = $appController->getTable('application');
$customerTable = $appController->getTable('customer');
$employeeTable = $appController->getTable('employee');
$serviceTable = $appController->getTable('service');
$projectTable = $appController->getTable('project');

var_dump($applicationTable->query('SELECT customerName FROM customer WHERE customerId = 1009'));
// On peut appeler les methodes de la classe parent 'Table' afin d'obtenir toute la table désirée (voir classe Table).
var_dump($applicationTable->getAll());
var_dump($customerTable->getAll());
var_dump($employeeTable->getAll());
var_dump($serviceTable->getAll());
var_dump($projectTable->getAll());

// Mini controller de page. On requiert la page demandée via requête GET. Par défaut, on charge la page HOME.
ob_start();

if(!isset($_GET['page'])){
	require_once(ROOT . '/public/pages/home.php');
}

// Ces pages seront mises en tampon et chargées dans une variable $content, affichée dans le script public/pages/templates/default.php.
$content = ob_get_clean();

// On requiert le template par defaut et on affiche la variable content (voir default.php).
require_once(ROOT . '/public/pages/templates/default.php');

?>