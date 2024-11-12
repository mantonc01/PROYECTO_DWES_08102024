<?php 
// require_once 'entityes/queryBuilder.class.php';

class CategoriaRepository extends QueryBuilder{

    public function __construct(string $table='categorias',string $classEntity='Categoria')
    {
        parent::__construct($table,$classEntity);
    }
}

?>