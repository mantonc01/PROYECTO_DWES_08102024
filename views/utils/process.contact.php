<?php

// Se incluyen archivos necesarios para el funcionamiento de la aplicación.
require_once 'views/utils/utils.php'; // Utilidades generales.
require_once 'entityes/connection.class.php'; // Clase para gestionar la conexión a la base de datos.
require_once 'entityes/queryBuilder.class.php'; // Clase base para construir consultas SQL.
require_once 'exceptions/appException.clas.php'; // Clase para manejar excepciones específicas de la aplicación.

// Archivos necesarios para la funcionalidad de contactos.
require_once 'entityes/contact.class.php'; // Clase para gestionar la entidad "Contacto".
require_once 'repository/contactRepository.class.php'; // Repositorio para manejar contactos.

// Declaración de variables iniciales para almacenar errores y mensajes.
$errores = []; // Array para guardar mensajes de error.
$mensaje = ''; // Variable para almacenar mensajes de éxito.
$nombreDiv = "alert alert-danger"; // Clase CSS predeterminada para mensajes de error.
$datos = []; // Array para almacenar datos no válidos o mensajes de error.
$datosValidos = []; // Array para almacenar datos que pasaron la validación.

try {
    // Se obtiene la configuración de la aplicación desde un archivo de configuración.
    // $config = require_once 'app/config.php';

    // // Se vincula la configuración a la aplicación utilizando un contenedor de dependencias.
    // App::bind('config', $config);

    // Creación del repositorio necesario para interactuar con la tabla de contactos en la base de datos.
    $contactRepository = new ContactRepository();

    // Verificamos si la solicitud es de tipo POST, lo que indica que se envió el formulario.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $validacion = true; // Inicializamos la validación como válida.

        // Sanitización de los campos enviados para evitar inyección de código.
        $nombre = trim(htmlspecialchars($_POST['nombre'] ?? ''));
        $apellido = trim(htmlspecialchars($_POST['apellido'] ?? ''));
        $email = trim(htmlspecialchars($_POST['email'] ?? ''));
        $sujeto = trim(htmlspecialchars($_POST['sujeto'] ?? ''));
        $textArea = htmlspecialchars(trim($_POST['textArea'] ?? ''));

        // Capturamos la fecha actual del servidor.
        date_default_timezone_set('UTC'); // Establecemos la zona horaria.
        $fecha = date('Y-m-d H:i:s'); // Formato estándar para bases de datos.

        // Validación de los campos requeridos:
        // 1. Validar el campo "nombre".
        if (empty($nombre)) {
            $datos[] = 'El campo First Name no puede estar vacío.';
            $validacion = false;
        } else {
            $datosValidos[] = "First Name: " . $nombre;
        }

        // 2. Validar el campo "email".
        if (empty($email)) {
            $datos[] = 'El campo Email no puede estar vacío.';
            $validacion = false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $datos[] = 'Email incorrecto.';
            $validacion = false;
        } else {
            $datosValidos[] = 'Email: ' . $email;
        }

        // 3. Validar el campo "sujeto".
        if (empty($sujeto)) {
            $datos[] = 'El campo Subject no puede estar vacío.';
            $validacion = false;
        } else {
            $datosValidos[] = 'Subject: ' . $sujeto;
        }

        // 4. Si se proporciona un mensaje, lo agregamos a los datos válidos.
        if (!empty($textArea)) {
            $datosValidos[] = 'Message: ' . $textArea;
        }

        // Si la validación es exitosa, procedemos a guardar los datos.
        if ($validacion) {
            $nombreDiv = "alert alert-info"; // Cambiamos la clase del mensaje a éxito.
            $datos = $datosValidos; // Reemplazamos los datos con los válidos.

            // Creamos un objeto "Contacto" con los datos proporcionados.
            $contacto = new Contacto($nombre, $apellido, $sujeto, $email, $textArea, $fecha);

            // Guardamos el contacto en la base de datos.
            $contactRepository->save($contacto);

            // Limpiamos las variables para evitar que los datos aparezcan pre-rellenados en el formulario.
            $nombre = '';
            $apellido = '';
            $email = '';
            $sujeto = '';
            $textArea = '';

            // Mensaje de éxito que indica que el contacto fue guardado.
            $mensaje = 'Contacto guardado correctamente.';
        }
    }
} catch (QueryException $exception) {
    // Capturamos errores relacionados con consultas SQL.
    $errores[] = $exception->getMessage();
} catch (AppException $exception) {
    // Capturamos errores personalizados de la aplicación.
    $errores[] = $exception->getMessage();
} catch (PDOException $exception) {
    // Capturamos errores relacionados con la base de datos.
    $errores[] = $exception->getMessage();
} catch (Exception $exception) {
    // Capturamos cualquier otra excepción no específica.
    $errores[] = $exception->getMessage();
} finally {
    // Recuperamos todos los contactos de la base de datos, incluso si hubo errores.
    $contactos = $contactRepository->findAll();
}
