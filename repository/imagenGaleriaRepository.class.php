<?php
// Se incluye la clase base QueryBuilder que proporciona métodos genéricos para interactuar con la base de datos.
require_once 'entityes/queryBuilder.class.php';

// Se define la clase ImagenGaleriaRepository que extiende de QueryBuilder.
// Esta clase está diseñada para manejar las operaciones específicas de la entidad "ImagenGaleria".
class ImagenGaleriaRepository extends QueryBuilder
{
    /**
     * Constructor de la clase ImagenGaleriaRepository.
     * Configura la tabla de la base de datos y la clase de entidad asociada.
     * @param string $table Nombre de la tabla en la base de datos (por defecto, 'imagenes').
     * @param string $classEntity Clase que representa los datos de la tabla (por defecto, 'imagenGaleria').
     */
    public function __construct(string $table = 'imagenes', string $classEntity = 'imagenGaleria')
    {
        // Llama al constructor de la clase base (QueryBuilder) para inicializar las propiedades heredadas.
        parent::__construct($table, $classEntity);
    }
}

?>
