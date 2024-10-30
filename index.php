<?php
require_once 'views/utils/utils.php';
require_once 'entityes/imagenGaleria.class.php';
// require_once 'views/partials/imagegallery.part.php';

// $ImagenGaleria1 = new imagenGaleria('1.jpg', 'descripcion imagen 1', 1000, 500, 100);


$ImagenesGaleria = [];

for ($i = 1; $i <= 12; $i++) {
    $ImagenG = new imagenGaleria($i . '.jpg', 'descripcion imagen ' . $i, rand(0, 1000), rand(0, 500), rand(0, 100));
    array_push($ImagenesGaleria, $ImagenG);
}

require_once 'views/index.view.php';
