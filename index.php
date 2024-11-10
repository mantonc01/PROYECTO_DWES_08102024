<?php
// Incluye archivos necesarios para la ejecución del script.
// 'utils.php' contiene funciones utilitarias comunes.
// 'imagenGaleria.class.php' contiene la definición de la clase imagenGaleria, que permite crear objetos de imagen con propiedades específicas.
require_once 'views/utils/utils.php';
require_once 'entityes/imagenGaleria.class.php';
include_once 'entityes/asociado.class.php';

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

