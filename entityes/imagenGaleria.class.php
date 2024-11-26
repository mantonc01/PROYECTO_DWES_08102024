<?php

require_once 'entityes/iEntity.class.php'; // Se incluye la interfaz `IEntity` para garantizar que la clase implemente el método `toArray`.

class ImagenGaleria implements IEntity
{
    // Constantes para definir las rutas de las imágenes
    const RUTA_IMAGENES_PORTFOLIO = 'images/index/portfolio/'; // Ruta para imágenes del portfolio
    const RUTA_IMAGENES_GALLERY = 'images/index/gallery/';     // Ruta para imágenes de la galería

    /**
     * @var string Nombre del archivo de imagen.
     */
    private $nombre;

    /**
     * @var string Descripción de la imagen.
     */
    private $descripcion;

    /**
     * @var int Número de visualizaciones de la imagen.
     */
    private $numVisualizaciones;

    /**
     * @var int Número de likes de la imagen.
     */
    private $numLikes;

    /**
     * @var int Número de descargas de la imagen.
     */
    private $numDownloads;

    /**
     * @var int|null ID único de la imagen. Null hasta que se guarda en la base de datos.
     */
    private $id;

    /**
     * @var int ID de la categoría a la que pertenece la imagen.
     */
    private $categoria;

    /**
     * Constructor de la clase.
     * Inicializa la imagen con un nombre, descripción, categoría y otros valores opcionales.
     *
     * @param string $nombre Nombre del archivo de imagen (opcional).
     * @param string $descripcion Descripción de la imagen (opcional).
     * @param int $categoria ID de la categoría (opcional).
     * @param int $numVisualizaciones Número de visualizaciones (opcional, por defecto 0).
     * @param int $numLikes Número de likes (opcional, por defecto 0).
     * @param int $numDownloads Número de descargas (opcional, por defecto 0).
     */
    public function __construct(
        string $nombre = '',
        string $descripcion = '',
        int $categoria = 0,
        int $numVisualizaciones = 0,
        int $numLikes = 0,
        int $numDownloads = 0
    ) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->numVisualizaciones = $numVisualizaciones;
        $this->numLikes = $numLikes;
        $this->numDownloads = $numDownloads;
        $this->id = null; // ID inicializado como null hasta que se guarde en la base de datos.
    }

    /**
     * Obtiene la URL completa de la imagen en la carpeta "portfolio".
     *
     * @return string URL completa de la imagen.
     */
    public function getUrlPortfolio(): string
    {
        return self::RUTA_IMAGENES_PORTFOLIO . $this->getNombre();
    }

    /**
     * Obtiene la URL completa de la imagen en la carpeta "gallery".
     *
     * @return string URL completa de la imagen.
     */
    public function getUrlGallery(): string
    {
        return self::RUTA_IMAGENES_GALLERY . $this->getNombre();
    }

    // Métodos `get` y `set` para acceder y modificar las propiedades de la clase.

    /**
     * Obtiene el nombre del archivo de imagen.
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * Obtiene la descripción de la imagen.
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * Obtiene el número de visualizaciones.
     */
    public function getNumVisualizaciones(): int
    {
        return $this->numVisualizaciones;
    }

    public function setNumVisualizaciones(int $numVisualizaciones): self
    {
        $this->numVisualizaciones = $numVisualizaciones;
        return $this;
    }

    /**
     * Obtiene el número de likes.
     */
    public function getNumLikes(): int
    {
        return $this->numLikes;
    }

    public function setNumLikes(int $numLikes): self
    {
        $this->numLikes = $numLikes;
        return $this;
    }

    /**
     * Obtiene el número de descargas.
     */
    public function getNumDownloads(): int
    {
        return $this->numDownloads;
    }

    public function setNumDownloads(int $numDownloads): self
    {
        $this->numDownloads = $numDownloads;
        return $this;
    }

    /**
     * Obtiene el ID único de la imagen.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Obtiene el ID de la categoría de la imagen.
     */
    public function getCategoria(): int
    {
        return $this->categoria;
    }

    public function setCategoria(int $categoria): self
    {
        $this->categoria = $categoria;
        return $this;
    }

    /**
     * Convierte el objeto `ImagenGaleria` en un array asociativo.
     *
     * @return array Array con las propiedades de la imagen.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'categoria' => $this->getCategoria(),
            'descripcion' => $this->getDescripcion(),
            'numVisualizaciones' => $this->getNumVisualizaciones(),
            'numLikes' => $this->getNumLikes(),
            'numDownloads' => $this->getNumDownloads(),
        ];
    }
}
