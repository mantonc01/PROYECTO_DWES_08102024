<?php
// Se requiere la clase 'appException' para manejar excepciones personalizadas
require_once 'exceptions/appException.clas.php';

// Se incluye un archivo de constantes (contiene constantes útiles en el sistema)
require_once 'views/utils/const.php';

require_once 'entityes/connection.class.php';

class App
{
    /**
     * @var array
     * Contenedor estático de dependencias.
     */
    private static $container = [];

    /**
     * Método para añadir una dependencia o configuración al contenedor.
     * 
     * @param string $clave Clave o nombre bajo el cual se guarda la dependencia.
     * @param mixed $valor Valor de la dependencia (puede ser cualquier tipo de dato).
     */
    public static function bind($clave, $valor)
    {
        // Añade la clave y su valor al contenedor
        static::$container[$clave] = $valor;
    }

    /**
     * Método para obtener una dependencia o configuración del contenedor.
     * 
     * @param string $key Clave de la dependencia que se desea obtener.
     * @return mixed Valor de la dependencia asociada a la clave proporcionada.
     * @throws AppException Si la clave no existe en el contenedor.
     */
    public static function get(string $key)
    {
        // Comprueba si la clave existe en el contenedor
        if (!array_key_exists($key, static::$container)) {
            // Lanza una excepción si la clave no está en el contenedor
            throw new AppException('No se ha encontrado la clave en el contenedor');
        }
        
        // Devuelve el valor asociado a la clave
        return static::$container[$key];
    }

    /**
     * Método para obtener una conexión de base de datos.
     * 
     * Si no existe una conexión en el contenedor, crea una nueva conexión usando la clase 'Connection'.
     * 
     * @return mixed Objeto de conexión.
     */
    public static function getConnection()
    {
        // Comprueba si ya existe una conexión en el contenedor
        if (!array_key_exists('connection', static::$container)) {
            // Si no existe, crea una nueva conexión usando Connection::make()
            static::$container['connection'] = Connection::make();
        }
        
        // Devuelve la conexión guardada en el contenedor
        return static::$container['connection'];
    }
}
