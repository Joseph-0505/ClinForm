<?php

namespace Application\Controllers;

use Application\Core\Controller;

class SobreController extends Controller
{
    public function index()
    {
        $this->renderView('includes/sobre', [
            'header/style.css',
            'sobre/style.css',
            'footer/style.css'
        ]);
    }
}
