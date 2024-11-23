<?php

// Se incluyen archivos necesarios para el funcionamiento de la aplicación.
require_once 'views/utils/utils.php'; // Utilidades generales.
require_once 'entityes/file.class.php'; // Clase para manejar archivos.
require_once 'entityes/connection.class.php'; // Clase para gestionar la conexión a la base de datos.
require_once 'entityes/queryBuilder.class.php'; // Clase para construir consultas SQL.
require_once 'exceptions/appException.clas.php'; // Clase para manejar excepciones específicas de la aplicación.
//////////////////////23/11/2024///////////////////
require_once 'entityes/asociado.class.php';// Clase para gestionar asociados.
require_once 'repository/asociadoRepository.class.php';// Repositorio para manejar asociados.

// Declaración de variables iniciales para almacenar errores, descripción  y mensajes.
$errores = []; // Array para guardar mensajes de error.
$descripcion = ''; // Variable para almacenar la descripción del asociado.
$mensaje = ''; // Variable para almacenar mensajes de éxito.

try {
    // Se obtiene la configuración de la aplicación desde un archivo de configuración.
    $config = require_once 'app/config.php';

    // Se vincula la configuración a la aplicación utilizando un contenedor de dependencias.
    App::bind('config', $config);

    // Creación de los repositorios necesarios para interactuar con la base de datos.
    
    $asociadoRepository = new AsociadoRepository();// Repositorio para asociados.
   
    // Se verifica si la solicitud es del tipo POST, lo que indica que el formulario ha sido enviado.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Sanitización de la categoría seleccionada por el usuario.
        $nombre = trim(htmlspecialchars($_POST['nombre'] ?? ''));


        // Sanitización de la descripción proporcionada por el usuario para evitar inyección de código.
        $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ''));

        
        // Definición de los tipos MIME aceptados para los archivos subidos (imágenes en este caso).
        $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

        // Creación de una instancia de la clase File para manejar el archivo subido.
        // El parámetro 'logo' se refiere al nombre del campo del formulario.
        $imagen = new File('logo', $tiposAceptados);

        // Se guarda el archivo subido en la ruta especificada para los logos.
        $imagen->saveUploadFile(Asociado::RUTA_IMAGENES_LOGO);
        

        // Creación de un objeto `Asociado` con los datos proporcionados (nombre, nombre imagen y descripción).
        $asociado = new Asociado($nombre, $imagen->getFileName(), $descripcion);

        // Se guarda el asociado en el repositorio (base de datos).
        $asociadoRepository->save($asociado);

        // Limpieza de la variable descripción y nombre para que no aparezcan rellenadas tras enviar el formulario.
        $descripcion = '';
        $nombre='';

        // Mensaje de éxito que indica que el asociados se guardó correctamente.
        $mensaje = 'asociado guardado.';
    }
} catch (FileException $exception) {
    // Se captura cualquier excepción relacionada con la gestión de archivos y se añade al array de errores.
    $errores[] = $exception->getMessage();
} catch (QueryException $exception) {
    // Se captura cualquier excepción relacionada con las consultas SQL y se añade al array de errores.
    $errores[] = $exception->getMessage();
} catch (AppException $exception) {
    // Se captura cualquier excepción personalizada de la aplicación y se añade al array de errores.
    $errores[] = $exception->getMessage();
} catch (PDOException $exception) {
    // Se captura cualquier excepción relacionada con la base de datos y se añade al array de errores.
    $errores[] = $exception->getMessage();
} catch (Exception $exception) {
    // Se captura cualquier otra excepción genérica y se añade al array de errores.
    $errores[] = $exception->getMessage();
} finally {
    // Finalmente, sin importar si ocurrió un error, se obtienen los asociados desde los repositorios.    
    $asociados = $asociadoRepository->findAll();//Se recuperan todos los asociados de la base de datos.
}
