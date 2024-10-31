<?php
// Incluye archivos necesarios para la ejecución del script.
// 'utils.php' contiene funciones utilitarias comunes.
// 'imagenGaleria.class.php' contiene la definición de la clase imagenGaleria, que permite crear objetos de imagen con propiedades específicas.
require_once 'views/utils/utils.php';
require_once 'entityes/imagenGaleria.class.php';

// Inicializa un array vacío donde se almacenarán las instancias de imágenes.
$ImagenesGaleria = [];

// Genera 12 instancias de la clase imagenGaleria.
for ($i = 1; $i <= 12; $i++) {
    // Para cada iteración, crea un objeto de imagenGaleria con:
    // - Un nombre de archivo en formato 'n.jpg', donde 'n' es el número de iteración.
    // - Una descripción única concatenando el número de iteración.
    // - Un número aleatorio de visualizaciones entre 0 y 1000.
    // - Un número aleatorio de "me gusta" entre 0 y 500.
    // - Un número aleatorio de descargas entre 0 y 100.
    $ImagenG = new imagenGaleria($i . '.jpg', 'descripcion imagen ' . $i, rand(0, 1000), rand(0, 500), rand(0, 100));

    // Agrega el objeto de imagenGaleria creado al array $ImagenesGaleria.
    array_push($ImagenesGaleria, $ImagenG);
}

// Incluye el archivo de vista, 'index.view.php', donde se mostrará la galería.
// Este archivo contiene el HTML y PHP necesarios para renderizar las imágenes almacenadas en $ImagenesGaleria.
require_once 'views/index.view.php';
