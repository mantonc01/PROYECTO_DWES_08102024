<?php
class Connection
{
    public static function make()
    {
        $opciones = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //para que utilice utf8 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //para cuando se produzca un error 
            //se genere una excepción y asi poder capturarla 
            PDO::ATTR_PERSISTENT => true //para que no cierr lo conexión y mejorar el rendimiento 
        ];
        try {
            $connection = new PDO('mysql:host=dwes.local; 
            dbname=proyecto; charset=utf8', 'user', 'user', $opciones);
        } catch (PDOException $PDOException) {
            die($PDOException->getMessage());
            //die es una función que muestra el string que se le paso 
            // detiene lo ejecución del script 
        }
        return $connection;
    }
}
