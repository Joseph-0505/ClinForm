<?php
// application/config/mail-config.php

return [
    'smtp' => [
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'encryption' => 'tls',
        'username' => 'sjosevictor31@gmail.com',
        'password' => 'oobh ccsz odah fros', // Use senha de app do Gmail
    ],

    'from' => [
        'address' => 'noreply@clinform.com.br',
        'name' => 'ClinForm'
    ],

    'to' => [
        'address' => 'contato@clinform.com.br',
        'name' => 'Contato ClinForm'
    ]
];
