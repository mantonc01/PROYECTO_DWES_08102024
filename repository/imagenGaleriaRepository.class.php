<?php 
require_once 'entityes/queryBuilder.class.php';

class ImagenGaleriaRepository extends QueryBuilder{

    public function __construct(string $table='imagenes',string $classEntity='imagenGaleria')
    {
        parent::__construct($table,$classEntity);
    }
}

?>