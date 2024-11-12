<?php

// use FTP\Connection;

require_once 'views/utils/utils.php';
require_once 'entityes/file.class.php';
require_once 'entityes/imagenGaleria.class.php';
// require_once 'exceptions/fileException.class.php';
require_once 'entityes/connection.class.php';
// require_once 'views/galeria.view.php';
require_once 'entityes/queryBuilder.class.php';
require_once 'exceptions/appException.clas.php';
require_once 'repository/imagenGaleriaRepository.class.php';
require_once 'repository/categoriaRepository.class.php';
require_once 'entityes/categoria.class.php';

//array para guardar los mensajes de los errores
$errores = [];
$descripcion = '';
$mensaje = '';

try {

    $config = require_once 'app/config.php';

    App::bind('config', $config);

    // $connection = Connection::make($config['database']);

    // $connection = App::getConnection();

    // $queryBuilder=new QueryBuilder('imagenes','ImagenGaleria');
    $imagenRepository = new ImagenGaleriaRepository();

    $categoriaRepository = new CategoriaRepository();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Sanitizamos la descripción
        $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ''));

        $categoria = trim(htmlspecialchars($_POST['categoria'] ?? ''));

        // Tipos de archivos permitidos (MIME)
        $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

        // Creamos la instancia de la clase File
        $imagen = new File('imagen', $tiposAceptados);
        //el parametro fileName es 'imagen' porque así lo indicamos en
        //el formulario (type='file' name='imagen')

        // Guardamos la imagen en la galería
        $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);

        // Copiamos la imagen al portfolio.
        if (method_exists($imagen, 'copyFile')) { //si el metodo existe
            $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);
        } else {
            throw new FileException('El método copyFile no está implementado en la clase File');
        }

        $imagenGaleria = new ImagenGaleria($imagen->getFileName(), $descripcion, $categoria);
        $imagenRepository->save($imagenGaleria);
        $descripcion = ''; // se reinicia la variable para que no aparezca rellena en el formulario
        // Mensaje de éxito
        $mensaje = 'imagen guardada.';



        //Si llega hasta aqui, es que no ha habido errores.
        /////////////////////////////////////////////////////////////
        // $connection = Connection::make(); ////////////////////////////

        ///////////////////////////////////////////////////////////////
        // $sql = "INSERT INTO imagenes (nombre,descripcion) VALUES (:nombre,:descripcion)";
        // $pdoStatement = $connection->prepare($sql);
        // $parametersStatementArray = [':nombre' => $imagen->getFileName(), ':descripcion' => $descripcion];
        //Lanzamos la sentencia y vemos si se ha ejecutado correctamente.
        // $response = $pdoStatement->execute($parametersStatementArray);

        // if ($response === false) {
        //     $errores[] = 'No se ha podido guardar la imagen en la base de datos.';
        // } else {
        //     $descripcion = '';
        //     $mensaje = 'Imagen guardada';
        // }

        // $querySql = 'Select * from imagenes';
        // $queryStatement = $connection->query($querySql);

        // while ($row = $queryStatement->fetch()) {
        //     //$row= ['id'=>1,'nombre'=>'asd','descripcion'=>'asd']
        //     //numVisualizaciones=>0,numLikes=>0,numDownloads=>0,
        //     // echo "Producto".$row
        // }
    }
} catch (FileException $exception) {
    // Guardamos los errores en el array de errores
    $errores[] = $exception->getMessage();
    //guardo en un array los errores
} catch (QueryException $exception) {
    // Guardamos los errores en el array de errores
    $errores[] = $exception->getMessage();
    //guardo en un array los errores
} catch (AppException $exception) {
    // Guardamos los errores en el array de errores
    $errores[] = $exception->getMessage();
    //guardo en un array los errores
} catch (PDOException $exception) {
    // Guardamos los errores en el array de errores
    $errores[] = $exception->getMessage();
    //guardo en un array los errores
} catch (Exception $exception) {
    // Guardamos los errores en el array de errores
    $errores[] = $exception->getMessage();
    //guardo en un array los errores
} finally {
    // $queryBuilder = new QueryBuilder('imagenes','ImagenGaleria');
    $imagenes = $imagenRepository->findAll();
    $categorias = $categoriaRepository->findAll();
}
require_once 'views/galeria.view.php';
