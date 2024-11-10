<?php
return [
    'database' =>
    [
        'name' => 'proyecto', //nombre BD 
        'username' => 'user',        
        'password' => 'user',
        'connection' => 'mysql:host=localhost', //Configuración de la conexión 
        'options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        ]
    ]
];
