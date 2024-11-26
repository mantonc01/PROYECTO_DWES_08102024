<?php

// Se incluyen archivos necesarios para el funcionamiento de la aplicación.
require_once 'views/utils/utils.php'; // Utilidades generales.
require_once 'entityes/file.class.php'; // Clase para manejar archivos.
require_once 'entityes/connection.class.php'; // Clase para gestionar la conexión a la base de datos.
require_once 'entityes/queryBuilder.class.php'; // Clase para construir consultas SQL.
require_once 'exceptions/appException.clas.php'; // Clase para manejar excepciones específicas de la aplicación.
//////////////////////23/11/2024///////////////////
require_once 'entityes/asociado.class.php'; // Clase para gestionar asociados.
require_once 'repository/asociadoRepository.class.php'; // Repositorio para manejar asociados.

// Declaración de variables iniciales para almacenar errores, descripción  y mensajes.
$errores = []; // Array para guardar mensajes de error.
$descripcion = ''; // Variable para almacenar la descripción del asociado.
$mensaje = 'Asociado no guardado.'; // Variable para almacenar mensajes de éxito.
$nombreDiv = "alert alert-danger"; // Clase CSS predeterminada para mensajes de error.
$datos = []; // Array para almacenar datos no válidos o mensajes de error.
$datosValidos = []; // Array para almacenar datos que pasaron la validación.

try {
    // Se obtiene la configuración de la aplicación desde un archivo de configuración.
    $config = require_once 'app/config.php';

    // Se vincula la configuración a la aplicación utilizando un contenedor de dependencias.
    App::bind('config', $config);

    // Creación de los repositorios necesarios para interactuar con la base de datos.

    $asociadoRepository = new AsociadoRepository(); // Repositorio para asociados.

    // Se verifica si la solicitud es del tipo POST, lo que indica que el formulario ha sido enviado.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $validacion = true; // Inicializamos la validación como válida.

        // Sanitización del nombre del usuario.
        $nombre = trim(htmlspecialchars($_POST['nombre'] ?? ''));

        // Sanitización de la descripción proporcionada por el usuario para evitar inyección de código.
        $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ''));

        // Validación de los campos requeridos:
        // 1. Validar el campo "nombre".
        if (empty($nombre)) {
            $datos[] = 'El campo Nombre no puede estar vacío.';
            // $errores[] = 'El campo Nombre no puede estar vacío.';
            $validacion = false;
        } else {
            $datosValidos[] = "Nombre: " . $nombre;
        }

        // 2. Validar el campo "descripcion".
        if (empty($descripcion)) {
            $datos[] = 'El campo Descripcion no puede estar vacío.';
            // $errores[] = 'El campo Descripcion no puede estar vacío.';
            $validacion = false;
        } else {
            $datosValidos[] = "Descripcion: " . $descripcion;
        }

        // Definición de los tipos MIME aceptados para los archivos subidos (imágenes en este caso).
        $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

        // Creación de una instancia de la clase File para manejar el archivo subido.
        // El parámetro 'logo' se refiere al nombre del campo del formulario.
        try {
            $imagen = new File('logo', $tiposAceptados); // Intentamos crear la instancia.
        } catch (FileException $exception) {
            $errores[] = "Error en el archivo subido: " . $exception->getMessage();
            $validacion = false;
        }

        // 3. Validación adicional para asegurar que se subió una imagen.
        if (!$imagen->isValid()) {
            $datos[] = 'Debe seleccionar una imagen válida.'; // Mensaje de error.
            $validacion = false;
        } else {
            $datosValidos[] = "Imagen válida seleccionada.";
        }

        // Si la validación es exitosa, procedemos a guardar los datos.
        if ($validacion) {
            $nombreDiv = "alert alert-info"; // Cambiamos la clase del mensaje a éxito.
            $datos = $datosValidos; // Reemplazamos los datos con los válidos.

            // Se guarda el archivo subido en la ruta especificada para los logos.
            $imagen->saveUploadFile(Asociado::RUTA_IMAGENES_LOGO);

            // Creación de un objeto `Asociado` con los datos proporcionados (nombre, nombre imagen y descripción).
            $asociado = new Asociado($nombre, $imagen->getFileName(), $descripcion);

            // Se guarda el asociado en el repositorio (base de datos).
            $asociadoRepository->save($asociado);

            // Limpieza de la variable descripción y nombre para que no aparezcan rellenadas tras enviar el formulario.
            $descripcion = '';
            $nombre = '';

            // Mensaje de éxito que indica que el asociados se guardó correctamente.
            $mensaje = 'Asociado guardado.';
        }
    }
} catch (FileException $exception) {
    // Se captura cualquier excepción relacionada con la gestión de archivos y se añade al array de errores.
    $errores[] = "Error al procesar el archivo: " . $exception->getMessage();
} catch (QueryException $exception) {
    // Se captura cualquier excepción relacionada con las consultas SQL y se añade al array de errores.
    $errores[] = "Error al guardar los datos: " . $exception->getMessage();
} catch (AppException $exception) {
    // Se captura cualquier excepción personalizada de la aplicación y se añade al array de errores.
    $errores[] = "Error en la aplicación: " . $exception->getMessage();
} catch (PDOException $exception) {
    // Se captura cualquier excepción relacionada con la base de datos y se añade al array de errores.
    $errores[] = "Error en la base de datos: " . $exception->getMessage();
} catch (Exception $exception) {
    // Se captura cualquier otra excepción genérica y se añade al array de errores.
    $errores[] = "Se produjo un error inesperado: " . $exception->getMessage();
} finally {
    // Finalmente, sin importar si ocurrió un error, se obtienen los asociados desde los repositorios.    
    $asociados = $asociadoRepository->findAll(); //Se recuperan todos los asociados de la base de datos.
}
