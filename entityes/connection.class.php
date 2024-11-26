<?php

require_once 'entityes/app.class.php'; // Se requiere la clase `App` para obtener la configuración de la base de datos.

/**
 * Clase `Connection`
 * Proporciona un método estático para crear una conexión a la base de datos utilizando PDO.
 */
class Connection
{
    /**
     * Crea y retorna una conexión PDO configurada según los parámetros de la base de datos.
     *
     * @return PDO Conexión a la base de datos.
     * @throws AppException Si no se puede establecer la conexión.
     */
    public static function make(): PDO
    {
        try {
            // Obtener la configuración de la base de datos desde el contenedor de dependencias.
            $config = App::get('config')['database'];

            // Crear una nueva instancia de PDO con los parámetros de configuración.
            $connection = new PDO(
                $config['connection'] . ';dbname=' . $config['name'], // DSN (Data Source Name): tipo de base de datos y nombre.
                $config['username'], // Usuario de la base de datos.
                $config['password'], // Contraseña del usuario.
                $config['options']   // Opciones adicionales para configurar PDO.
            );

            // Retornar la conexión si se establece correctamente.
            return $connection;

        } catch (PDOException $PDOException) {
            // Capturar excepciones de PDO y mostrar un mensaje detallado del error.

            // Imprimir el mensaje de error (puede ser útil para depuración, pero no en producción).
            // Se recomienda usar un logger en lugar de `die()` en entornos productivos.
            die($PDOException->getMessage());

            // Lanzar una excepción personalizada para manejar el error en niveles superiores.
            throw new AppException('No se ha podido crear la conexión a la base de datos.');
        }
    }
}
