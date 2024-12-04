<?php
//para tener siempre cargada la configuración Config php 
//en todas las peticiones a la base de datos que se realicen.
require_once 'views/utils/bootstrap.php';

//Cargamos la tabla de rutas asignándola a una variable.
$routes = require_once 'views/utils/routes.php';

//Obtener la URL del 
//usuario Limpiado las barras / existentes tanto al principio como al final 
//(para que quede igual que en los indices del array de la tabla de rutas)
$uri = trim($_SERVER['REQUEST_URI'], '/');

//require del controlador correspondiente
//accediendo a través de la uri indicada por el usuario.
require_once $routes[$uri];

?>
