<?php

// Inicialización del array de errores
$errorString = [];

// Definición de constantes para errores personalizados
define('ERROR_MV_UP_FILE', 9); // Error al mover el archivo subido a su destino final
define('ERROR_EXECUTE_STATEMENT', 10); // Error al ejecutar una consulta en la base de datos

// Definición de mensajes de error estándar de PHP para la subida de archivos
$errorString[UPLOAD_ERR_OK] = 'No hay ningún error.'; // Código 0: Subida sin errores
$errorString[UPLOAD_ERR_NO_FILE] = 'No se ha subido ningún archivo.'; // Código 4: No se subió ningún archivo
$errorString[UPLOAD_ERR_PARTIAL] = 'El archivo se ha subido parcialmente.'; // Código 3: Subida incompleta
$errorString[UPLOAD_ERR_INI_SIZE] = 'El archivo excede el tamaño permitido por la directiva upload_max_filesize en php.ini.'; // Código 1: Tamaño supera el límite de php.ini
$errorString[UPLOAD_ERR_FORM_SIZE] = 'El archivo excede el tamaño permitido por la directiva MAX_FILE_SIZE especificada en el formulario HTML.'; // Código 2: Tamaño supera el límite especificado en el formulario
$errorString[UPLOAD_ERR_CANT_WRITE] = 'Error al escribir el archivo en el disco.'; // Código 7: Fallo al escribir el archivo en el servidor
$errorString[UPLOAD_ERR_NO_TMP_DIR] = 'Falta la carpeta temporal.'; // Código 6: Carpeta temporal no disponible
$errorString[UPLOAD_ERR_EXTENSION] = 'Una extensión de PHP detuvo la subida del archivo.'; // Código 8: Una extensión de PHP bloqueó la subida

// Errores personalizados para manejar casos específicos en el sistema
$errorString[ERROR_MV_UP_FILE] = 'No se ha podido mover el archivo de destino.'; // Error personalizado para fallo en mover el archivo subido a su destino final
$errorString[ERROR_EXECUTE_STATEMENT] = 'No se ha podido ejecutar la consulta.'; // Error personalizado para fallo en la ejecución de una consulta en la base de datos

// Definición de una constante para almacenar todos los mensajes de error
define('ERROR_STRINGS', $errorString);

?>
