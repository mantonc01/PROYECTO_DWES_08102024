<?php 
require_once 'entityes/app.class.php';
require_once 'entityes/request.class.php';
require_once 'entityes/router.class.php';
require_once 'exceptions/appException.clas.php';


// Se obtiene la configuración de la aplicación desde un archivo de configuración.
$config=require_once 'app/config.php';

// Se vincula la configuración a la aplicación utilizando un contenedor de dependencias.
App::bind('config', $config);

$router=Router::load('utils/routes.php');
App::bind('router', $router);
