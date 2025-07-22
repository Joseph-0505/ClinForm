<?php

namespace Application\Controllers;

use Application\Core\Controller;

class ContatoController extends Controller
{
    public function index()
    {
        $this->renderView('includes/contato', [
            'header/style.css',
            'contato/style.css',
            'footer/style.css'
        ]);
    }
}
