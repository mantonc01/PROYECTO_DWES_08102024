<?php
// Incluye archivos necesarios para la ejecución del script.
// 'utils.php' contiene funciones utilitarias comunes.
// 'imagenGaleria.class.php' contiene la definición de la clase imagenGaleria, que permite crear objetos de imagen con propiedades específicas.
require_once 'views/utils/utils.php';
require_once 'entityes/imagenGaleria.class.php';
include_once 'entityes/asociado.class.php';








// Incluye el archivo de vista, 'index.view.php', donde se mostrará la galería.
// Este archivo contiene el HTML y PHP necesarios para renderizar las imágenes almacenadas en $ImagenesGaleria.
require_once 'views/index.view.php';

