<?php

namespace Application\Controllers;

use Application\Models\Produto;

class HomeController
{
    public function index()
    {


        $viewPath = dirname(__DIR__) . '/views';
        $cssPage = [
            'header/style.css',
            'home/style.css'
        ];

        include $viewPath . '/includes/header.php';
        include $viewPath . '/includes/home.php';
        include $viewPath . '/includes/footer.php';
    }
}
