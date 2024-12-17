<?php

// Se incluyen archivos necesarios para el funcionamiento de la aplicación.
require_once 'utils/utils.php'; // Utilidades generales.
require_once 'entityes/file.class.php'; // Clase para manejar archivos.
require_once 'entityes/imagenGaleria.class.php'; // Clase específica de imágenes de la galería.
require_once 'entityes/connection.class.php'; // Clase para gestionar la conexión a la base de datos.
require_once 'entityes/queryBuilder.class.php'; // Clase para construir consultas SQL.
require_once 'exceptions/appException.clas.php'; // Clase para manejar excepciones específicas de la aplicación.
require_once 'repository/imagenGaleriaRepository.class.php'; // Repositorio para manejar datos de imágenes.
require_once 'repository/categoriaRepository.class.php'; // Repositorio para manejar categorías.
require_once 'entityes/categoria.class.php'; // Clase para gestionar categorías.


// Declaración de variables iniciales para almacenar errores, descripción de imágenes y mensajes.
$errores = []; // Array para guardar mensajes de error.
$descripcion = ''; // Variable para almacenar la descripción de la imagen.
$mensaje = ''; // Variable para almacenar mensajes de éxito.

try {
    // Se obtiene la configuración de la aplicación desde un archivo de configuración.
    // $config = require_once 'app/config.php';

    // // Se vincula la configuración a la aplicación utilizando un contenedor de dependencias.
    // App::bind('config', $config);

    // Creación de los repositorios necesarios para interactuar con la base de datos.
    $imagenRepository = new ImagenGaleriaRepository(); // Repositorio para imágenes.
    // $categoriaRepository = new CategoriaRepository(); // Repositorio para categorías.
    
    // Se verifica si la solicitud es del tipo POST, lo que indica que el formulario ha sido enviado.
    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Sanitización de la descripción proporcionada por el usuario para evitar inyección de código.
        $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ''));

        // Sanitización de la categoría seleccionada por el usuario.
        $categoria = trim(htmlspecialchars($_POST['categoria'] ?? ''));

        // Definición de los tipos MIME aceptados para los archivos subidos (imágenes en este caso).
        $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

        // Creación de una instancia de la clase File para manejar el archivo subido.
        // El parámetro 'imagen' se refiere al nombre del campo del formulario.
        $imagen = new File('imagen', $tiposAceptados);

        // Se guarda el archivo subido en la ruta especificada para la galería.
        $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);

        // Se copia el archivo a la carpeta de portfolio.
        $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);

        // Creación de un objeto `ImagenGaleria` con los datos proporcionados (nombre del archivo, descripción y categoría).
        $imagenGaleria = new ImagenGaleria($imagen->getFileName(), $descripcion, $categoria);

        // Se guarda la imagen en el repositorio (base de datos).
        $imagenRepository->save($imagenGaleria);

        // Limpieza de la variable descripción para que no aparezca rellenada tras enviar el formulario.
        $descripcion = '';

        // Mensaje de éxito que indica que la imagen se guardó correctamente.
        $mensaje = 'imagen guardada.';
    // }
} catch (FileException $exception) {
    die($exception->getMessage()); // Se termina la ejecución del script con el mensaje de error.
    // Se captura cualquier excepción relacionada con la gestión de archivos y se añade al array de errores.
    // $errores[] = $exception->getMessage();
} catch (QueryException $exception) {
    die($exception->getMessage()); // Se termina la ejecución del script con el mensaje de error.

    // Se captura cualquier excepción relacionada con las consultas SQL y se añade al array de errores.
    // $errores[] = $exception->getMessage();
} 
// catch (AppException $exception) {
//     // Se captura cualquier excepción personalizada de la aplicación y se añade al array de errores.
//     $errores[] = $exception->getMessage();
// } catch (PDOException $exception) {
//     // Se captura cualquier excepción relacionada con la base de datos y se añade al array de errores.
//     $errores[] = $exception->getMessage();
// } catch (Exception $exception) {
//     // Se captura cualquier otra excepción genérica y se añade al array de errores.
//     $errores[] = $exception->getMessage();
// } 

// finally {
//     // Finalmente, sin importar si ocurrió un error, se obtienen las imágenes y las categorías desde los repositorios.

//     $imagenes = $imagenRepository->findAll(); // Se recuperan todas las imágenes de la base de datos.
//     $categorias = $categoriaRepository->findAll(); // Se recuperan todas las categorías de la base de datos.
// }


// header('Location: /galeria.php'); // Redirección a la página de galería después de guardar la imagen.

App::get('router')->redirect('galeria'); // Redirección a la página de galería después de guardar la imagen.