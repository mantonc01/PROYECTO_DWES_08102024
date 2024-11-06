<?php

require_once 'exceptions/queryException.class.php';
require_once 'views/utils/const.php'; //hay que completarlo
class QueryBuilder
{


    /**
     * Clase  QueryBuilder
     * @var PDO
     */
    private $connection;


    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(string $table, string $classEntity)
    {
        $sql = "SELECT * from $table"; //Sentencia SQL a ejecutar
        //Una posibilidad que tenemos para ejecutar esta consulta es 
        //el método query de la clase PDO: 
        //$this->connection->query($sql); 
        //El problema de query es el mismo que el de exec, es vulnerable 
        //a ataques SOLInyection por lo que mejor vamos a usar prepare 
        //que me devolvera un pdoStatement
        $pdoStatement = $this->connection->prepare($sql);
        //una vez que tengo el pdoStatement ya puedo hacer el execute //Como la sentencia SQL no tiene parámetros, no es necesario //pasarle nada al método execute
        if ($pdoStatement->execute() === false) {
            throw new QueryException('No se ha podido ejecutar la consulta');
        }

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $classEntity);
    }
}
