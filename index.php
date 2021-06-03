<?php
/* Démarrage de la Session */
session_start();

require_once 'autoload.php';

// autoload voit passer "new" et fait appel au fichier Controller.php, puis il y a une autre instance mais pour EntityRepository
$controller = new Controller\Controller; 



$controller->handlerRequest();
?>