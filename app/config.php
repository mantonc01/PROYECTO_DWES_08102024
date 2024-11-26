<?php

// Retorna un array con la configuración de la base de datos.
return [
    'database' => [ 
        // Nombre de la base de datos.
        'name' => 'proyecto',

        // Nombre de usuario para la conexión.
        'username' => 'user',

        // Contraseña asociada al usuario.
        'password' => 'user',

        // Tipo de conexión y host del servidor de base de datos.
        'connection' => 'mysql:host=localhost', 

        // Opciones adicionales para configurar PDO.
        'options' => [
            // Establecer el conjunto de caracteres a UTF-8.
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",

            // Configurar PDO para que lance excepciones en caso de errores.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

            // Usar conexiones persistentes para mejorar el rendimiento.
            PDO::ATTR_PERSISTENT => true
        ]
    ]
];
