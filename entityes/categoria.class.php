<?php

require_once 'entityes/iEntity.class.php'; // Se incluye la interfaz que define las reglas que debe implementar esta clase.

/**
 * Clase `Categoria` que representa una categoría en la aplicación.
 * Implementa la interfaz `IEntity` para asegurar que incluye el método `toArray`.
 */
class Categoria implements IEntity
{
    /**
     * @var int|null $id ID único de la categoría obtenido de la base de datos. Se inicia como null hasta que sea asignado.
     */
    private $id;

    /**
     * @var string $nombre Nombre de la categoría.
     */
    private $nombre;

    /**
     * @var int $numImagenes Número de imágenes asociadas a esta categoría.
     */
    private $numImagenes;

    /**
     * Constructor de la clase `Categoria`.
     * Permite inicializar una categoría con un nombre y un número de imágenes opcionales.
     *
     * @param string $nombre Nombre de la categoría. Por defecto, cadena vacía.
     * @param int $numImagenes Número de imágenes asociadas. Por defecto, 0.
     */
    public function __construct(string $nombre = '', int $numImagenes = 0)
    {
        $this->nombre = $nombre;
        $this->numImagenes = $numImagenes;
    }

    /**
     * Obtiene el número de imágenes asociadas a la categoría.
     *
     * @return int Número de imágenes.
     */
    public function getNumImagenes(): int
    {
        return $this->numImagenes;
    }

    /**
     * Establece el número de imágenes asociadas a la categoría.
     *
     * @param int $numImagenes Número de imágenes.
     * @return self Retorna la instancia actual de la clase para permitir encadenamiento de métodos.
     */
    public function setNumImagenes(int $numImagenes): self
    {
        $this->numImagenes = $numImagenes;

        return $this;
    }

    /**
     * Obtiene el nombre de la categoría.
     *
     * @return string Nombre de la categoría.
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Establece el nombre de la categoría.
     *
     * @param string $nombre Nombre de la categoría.
     * @return self Retorna la instancia actual de la clase para permitir encadenamiento de métodos.
     */
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Obtiene el ID único de la categoría.
     *
     * @return int|null ID de la categoría. Puede ser null si no está asignado.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Establece el ID único de la categoría.
     *
     * @param int $id ID de la categoría.
     * @return self Retorna la instancia actual de la clase para permitir encadenamiento de métodos.
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Convierte el objeto `Categoria` en un array asociativo.
     * Este método es requerido por la interfaz `IEntity`.
     *
     * @return array Array con las propiedades de la categoría.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(), // ID único de la categoría.
            'nombre' => $this->getNombre(), // Nombre de la categoría.
            'numImagenes' => $this->getNumImagenes() // Número de imágenes asociadas.
        ];
    }
}
