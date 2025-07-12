<?php
// Defina a BASE_URL primeiro, para ser usada em todo o sistema
define('BASE_URL', '/clinform/sistema-anamnese/clinform/public/');

// Carregue o core do sistema
require_once '../application/core/Router.php';
require_once '../application/core/Controller.php';

// Inicie o roteador
$router = new \Application\Core\Router();
$router->run();
