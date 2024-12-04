<?php 
require_once 'entityes/app.class.php';


// Se obtiene la configuración de la aplicación desde un archivo de configuración.
$config=require_once 'app/config.php';

// Se vincula la configuración a la aplicación utilizando un contenedor de dependencias.
App::bind('config', $config);
