<?php 

// Definimos la clase CategoriaRepository que extiende de QueryBuilder.
// Esta clase se utiliza para gestionar las operaciones específicas de la entidad "Contacto".
class ContactRepository extends QueryBuilder
{
    /**
     * Constructor de la clase ContactRepository.
     * Inicializa el repositorio configurando la tabla asociada y la clase de la entidad.
     * @param string $table Nombre de la tabla en la base de datos (por defecto, 'mensajes').
     * @param string $classEntity Clase que representa los datos de la tabla (por defecto, 'Contacto').
     */
    public function __construct(string $table = 'mensajes', string $classEntity = 'Contacto')
    {
        // Llama al constructor de la clase base (QueryBuilder) para inicializar las propiedades heredadas.
        parent::__construct($table, $classEntity);
    }
}
?>
