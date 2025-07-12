<?php
require_once '../application/core/Router.php';
require_once '../application/core/Controller.php';


$router = new \Application\Core\Router();
$router->run();
define('BASE_URL', '/clinform/sistema-anamnese/clinform/public');
