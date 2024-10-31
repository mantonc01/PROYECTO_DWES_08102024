<?php
require_once 'views/utils/utils.php';
require_once 'entityes/file.class.php';
require_once 'entityes/imagenGaleria.class.php';
require_once 'exceptions/fileException.class.php';

//array para guardar los mensajes de los errores
$errores = [];
$descripcion = '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));

        $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];
        //tipología MIME 'tipodearchivo/extension'

        $imagen = new File('imagen', $tiposAceptados);
        //el parametro fileName es 'imagen' porque así lo indicamos en
        //el formulario (type='file' name='imagen')


        $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
        $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY,ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);
        $mensaje = 'Datos enviados';
    } catch (FileException $exception) {
        $errores[] = $exception->getMessage();
        //guardo en un array los errores
    }
}

require_once 'views/galeria.view.php';
