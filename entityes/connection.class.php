<?php

require_once 'entityes/app.class.php';
class Connection
{
    public static function make()
    {
        // $opciones = [
        //     PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //para que utilice utf8 
        //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //para cuando se produzca un error 
        //     //se genere una excepción y asi poder capturarla 
        //     PDO::ATTR_PERSISTENT => true //para que no cierr lo conexión y mejorar el rendimiento 
        // ];
        try {
            $config = App::get('config')['database'];

            $connection = new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']

            );
        } catch (PDOException $PDOException) {
            //si activo el die me muestra esto
            //SQLSTATE[HY000] [1045] Acceso denegado para el usuario 'user'@'localhost' (usando contraseña: YES)
            die($PDOException->getMessage());
            //die es una función que muestra el string que se le paso 
            // detiene lo ejecución del script 
            throw new AppException('No se ha podido crear la conexión a la base de datos.');
        }
        return $connection;
    }
}
