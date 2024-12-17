<?php 
$router->get('','controllers/index.php');
$router->get('about','controllers/about.php');
$router->get('asociados','controllers/asociados.php');
$router->get('blog','controllers/blog.php');

$router->get('contact','controllers/contact.php');

$router->get('galeria','controllers/galeria.php');

$router->get('index','controllers/index.php');

$router->get('pruebaSql','controllers/pruebaSQL.php');

$router->get('single_post','controllers/single_post.php');

$router->post('imagenes-galeria/nueva', 'controllers/nueva-imagen-galeria.php');

// $router->define([
//     ''=>'controllers/index.php',
//     'about'=>'controllers/about.php',
//     'asociados'=>'controllers/asociados.php',
//     'blog'=>'controllers/blog.php',
//     'contact'=>'controllers/contact.php',
//     'galeria'=>'controllers/galeria.php',
//     'index'=>'controllers/index.php',
//     'pruebaSql'=>'controllers/pruebaSQL.php',
//     'single_post'=>'controllers/single_post.php',
// ]);