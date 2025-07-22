<?php
// application/core/Controller.php
namespace Application\Core;

class Controller
{
    protected function renderView($viewName, $cssFiles = [])
    {
        $viewPath = dirname(__DIR__) . '/views';

        // Torna os estilos visíveis para o header
        $GLOBALS['cssPage'] = $cssFiles;

        include $viewPath . '/includes/header.php';
        include $viewPath . '/' . $viewName . '.php';
        include $viewPath . '/includes/footer.php';
    }
}
