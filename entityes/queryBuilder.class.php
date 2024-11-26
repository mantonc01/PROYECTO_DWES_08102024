<?php

// Importa las clases necesarias
require_once 'exceptions/queryException.class.php'; // Clase para manejar excepciones personalizadas relacionadas con consultas SQL
require_once 'views/utils/const.php'; // Archivo de constantes para definir los errores  (falta definirlo)

// Clase abstracta QueryBuilder para interactuar con la base de datos
abstract class QueryBuilder
{
    /**
     * Conexión a la base de datos
     * @var PDO
     */
    private $connection;

    /**
     * Nombre de la tabla de la base de datos
     * @var string
     */
    private $table;

    /**
     * Nombre de la clase de la entidad asociada
     * @var string
     */
    private $classEntity;

    /**
     * Constructor de la clase
     * @param string $table Nombre de la tabla de la base de datos
     * @param string $classEntity Nombre de la clase de la entidad asociada
     */
    public function __construct(string $table, string $classEntity)
    {
        // Obtiene la conexión a la base de datos desde la clase App
        $this->connection = App::getConnection();
        $this->table = $table;
        $this->classEntity = $classEntity;
    }

    /**
     * Método para obtener todos los registros de una tabla
     * @return array Array de objetos de tipo $classEntity
     * @throws QueryException Si ocurre un error al ejecutar la consulta
     */
    public function findAll(): array
    {
        // Construye la consulta SQL para obtener todos los registros de la tabla
        $sql = "SELECT * FROM $this->table";

        // Prepara la consulta utilizando PDO para prevenir inyección SQL
        $pdoStatement = $this->connection->prepare($sql);

        // Ejecuta la consulta y verifica si ocurrió un error
        if ($pdoStatement->execute() === false) {
            throw new QueryException('No se ha podido ejecutar la consulta');
        }

        // Devuelve los resultados como una lista de objetos de la clase $classEntity
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    /**
     * Método para insertar un nuevo registro en la tabla
     * @param IEntity $entity Instancia de una clase que implementa IEntity
     * @throws QueryException Si ocurre un error al insertar en la base de datos
     */
    public function save(IEntity $entity): void
    {
        try {
            // Convierte el objeto en un array con las propiedades de la entidad
            $parameters = $entity->toArray();

            // Construye dinámicamente la consulta SQL para insertar el registro
            $sql = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $this->table,
                implode(', ', array_keys($parameters)), // Nombres de las columnas
                ':' . implode(',:', array_keys($parameters)) // Placeholders para los valores
            );

            // Prepara la consulta SQL
            $statement = $this->connection->prepare($sql);

            // Ejecuta la consulta con los valores del array
            $statement->execute($parameters);

            // Si la entidad es de tipo ImagenGaleria, incrementa el contador de imágenes en su categoría
            if ($entity instanceof ImagenGaleria) {
                $this->incrementaNumCategorias($entity->getCategoria());
            }

        } catch (PDOException $exception) {
            // Si ocurre un error, muestra el mensaje del error (o podría lanzarse una excepción personalizada)
            die($exception->getMessage());
            // throw new QueryException($exception->getMessage());
            // throw new QueryException('Error al insertar en la BD .');
        }
    }

    /**
     * Incrementa el número de imágenes en una categoría
     * @param int $categoria ID de la categoría
     * @throws Exception Si ocurre un error durante la transacción
     */
    public function incrementaNumCategorias(int $categoria)
    {
        try {
            // Inicia una transacción
            $this->connection->beginTransaction();

            // Actualiza el contador de imágenes en la categoría especificada
            $sql = "UPDATE categorias SET numImagenes = numImagenes + 1 WHERE id = $categoria";
            $this->connection->exec($sql);

            // Confirma la transacción
            $this->connection->commit();
        } catch (Exception $exception) {
            // Si ocurre un error, revierte la transacción
            $this->connection->rollBack();
            throw new Exception($exception->getMessage());
        }
    }
}
?>

