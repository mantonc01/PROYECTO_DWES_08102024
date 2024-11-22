<?php
// Incluye archivos necesarios para la ejecución del script.
// 'utils.php' contiene funciones utilitarias comunes.
// 'imagenGaleria.class.php' contiene la definición de la clase imagenGaleria, que permite crear objetos de imagen con propiedades específicas.
require_once 'views/utils/utils.php';
require_once 'entityes/imagenGaleria.class.php';
include_once 'entityes/asociado.class.php';



// Definimos un array de objetos Asociado
$asociados = [
    new Asociado('1 José Andrés', 'log2.jpg', 'Descripción del primer asociado'),
    new Asociado('2 Luís Domingo', 'log1.jpg', 'Descripción del segundo asociado'),
    new Asociado('3 Juan José', 'log3.jpg', 'Descripción del tercer asociado'),
    new Asociado('4 Claudia Shiffer', 'log2.jpg', 'Descripción del cuarto asociado'),
    new Asociado('5 José Mota', 'log1.jpg', 'Descripción del quinto asociado')
    // Para agregar más asociados aquí
];

// Usamos la función de utils para obtener tres asociados aleatorios
$asociadosAMostrar = obtenerTresElementosAleatorios($asociados);




// Incluye el archivo de vista, 'index.view.php', donde se mostrará la galería.
// Este archivo contiene el HTML y PHP necesarios para renderizar las imágenes almacenadas en $ImagenesGaleria.
require_once 'views/index.view.php';

