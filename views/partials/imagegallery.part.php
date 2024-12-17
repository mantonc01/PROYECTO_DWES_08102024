<?php

// Incluimos dos archivos PHP necesarios para el funcionamiento del script.
// 'imagenGaleria.class.php' contiene la clase ImagenGaleria, que define la estructura y métodos para gestionar las imágenes.
// 'index.php' se incluye para proporcionar configuraciones adicionales para la página.
include_once 'entityes/imagenGaleria.class.php';
include_once 'index.php';

// include_once 'utils/utils.php';

// obtencion de las imagenenes de la base de datos
include_once 'utils/process.img.php';




// Creamos un array vacío donde se guardará el HTML de cada imagen generada para la galería.
$arrayCreado = [];

///////////////////////////////////////////
// Recorremos el array $imagenes con un foreach para generar un bloque HTML para cada imagen.
  foreach ($imagenes as $imagen) {
    
  // Definimos el HTML de cada imagen usando HEREDOC para mejorar la legibilidad de la plantilla.
  // Se accede a la información de cada imagen mediante métodos de la clase ImagenGaleria.
  $htmlARepetir = <<<EOD
<div class="col-xs-12 col-sm-6 col-md-3">
<div class="sol">
  <!-- Imagen principal con la URL obtenida del método getUrlPortfolio() -->
  <img class="img-responsive" src="{$imagen->getUrlPortfolio()}" alt="First category picture">
  <div class="behind">
    <div class="head text-center">
      <!-- Lista de iconos interactivos (ver, me gusta, descargar y más información) -->
      <ul class="list-inline">
        <li>
          <a class="gallery" href="{$imagen->getUrlGallery()}" data-toggle="tooltip" data-original-title="Quick View">
            <i class="fa fa-eye"></i>
          </a>
        </li>
        <li>
          <a href="#" data-toggle="tooltip" data-original-title="Click if you like it">
            <i class="fa fa-heart"></i>
          </a>
        </li>
        <li>
          <a href="#" data-toggle="tooltip" data-original-title="Download">
            <i class="fa fa-download"></i>
          </a>
        </li>
        <li>
          <a href="#" data-toggle="tooltip" data-original-title="More information">
            <i class="fa fa-info"></i>
          </a>
        </li>
      </ul>
    </div>
    <!-- Información adicional de la imagen: visualizaciones, likes y descargas -->
    <div class="row box-content">
      <ul class="list-inline text-center">
        <li><i class="fa fa-eye"></i> {$imagen->getNumVisualizaciones()}</li>
        <li><i class="fa fa-heart"></i> {$imagen->getNumLikes()}</li>
        <li><i class="fa fa-download"></i> {$imagen->getNumDownloads()}</li>
      </ul>
    </div>
  </div>
</div>
</div>  
EOD;

  // Añadimos cada bloque de HTML generado al array $arrayCreado.
  array_push($arrayCreado, $htmlARepetir);
}


?>

<!-- Sección HTML para mostrar las imágenes de la galería en la página -->
<div class="row popup-gallery">
  <?php
  // Mezcla los elementos del array $arrayCreado para mostrar las imágenes en orden aleatorio.
  shuffle($arrayCreado);
  
  // Imprime los bloques HTML generados y aleatorizados en la galería.  
  foreach ($arrayCreado as $elemento) {
    echo $elemento;
}
  ?>
</div>

<!-- Navegación de paginación debajo de la galería -->
<nav class="text-center">
  <ul class="pagination">
    <!-- Links de la paginación para mostrar diferentes páginas de la galería -->
    <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#" aria-label="siguiente">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>
