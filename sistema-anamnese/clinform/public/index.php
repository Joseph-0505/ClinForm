<?php
// public/index.php

// Carrega o autoload do Composer
$autoloadPath = __DIR__ . '/../../../vendor/autoload.php';
if (!file_exists($autoloadPath)) {
    die('❌ Autoload do Composer não encontrado. Execute `composer install` na raiz do projeto.');
}
require_once $autoloadPath;

// Define a URL base do sistema
define('BASE_URL', '/clinform/sistema-anamnese/clinform/public/');

// Rota especial para envio de e-mail
if (isset($_GET['action']) && $_GET['action'] === 'enviar-email') {
    $controllerPath = '../application/controllers/EmailController.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['teste'])) {
            // Modo teste via GET
            if (isset($_GET['teste']) && $_GET['teste'] == '1') {
                $_POST['nome']     = 'Teste Formulário';
                $_POST['email']    = 'teste@clinform.com';
                $_POST['empresa']  = 'ClinForm Teste';
                $_POST['assunto']  = 'Assunto de teste';
                $_POST['mensagem'] = 'Mensagem de teste.';
            }

            $emailController = new EmailController();
            $emailController->enviarContato();
        } else {
            echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Controller não encontrado em: $controllerPath"]);
    }
    exit; // Finaliza após envio
}

// Carregamento normal do sistema
require_once '../application/core/Router.php';
require_once '../application/core/Controller.php';

$router = new \Application\Core\Router();
$router->run();
