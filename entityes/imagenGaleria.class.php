<?php

require_once 'entityes/iEntity.class.php';
class ImagenGaleria implements IEntity
{

    const RUTA_IMAGENES_PORTFOLIO = 'images/index/portfolio/';
    const RUTA_IMAGENES_GALLERY = 'images/index/gallery/';

    /**
     * @var string
     */
    private $nombre;
    /**
     * @var string
     */
    private $descripcion;
    /**
     * @var int
     */
    private $numVisualizaciones;
    /**
     * @var int
     */
    private $numLikes;
    /**
     * @var int
     */
    private $numDownloads;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $categoria;



    public function __construct(string $nombre='', string $descripcion='', int $categoria=0, int $numVisualizaciones = 0, int $numLikes = 0, int $numDownloads = 0)
    { //se le pasa el nombre y la descripción, el resto por defecto es 0
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->categoria=$categoria;
        $this->numVisualizaciones = $numVisualizaciones;
        $this->numLikes = $numLikes;
        $this->numDownloads = $numDownloads;
        $this->id=null;
    }

    /**
     *ruta de la imagen para incrustar, en portfolio
     */
    public function getUrlPortfolio(): string
    {
        return self::RUTA_IMAGENES_PORTFOLIO . $this->getNombre();
    }

    /**
     * ruta de la imagen para incrustar, en gallery
     */
    public function getUrlGallery(): string
    {
        return self::RUTA_IMAGENES_GALLERY . $this->getNombre();
    }
    /**
     * Get the value of nombre
     *
     * @return  string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @param  string  $nombre
     *
     * @return  self
     */
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of descripcion
     *
     * @return  string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @param  string  $descripcion
     *
     * @return  self
     */
    public function setDescripcion(string $descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of numVisualizaciones
     *
     * @return  int
     */
    public function getNumVisualizaciones()
    {
        return $this->numVisualizaciones;
    }

    /**
     * Set the value of numVisualizaciones
     *
     * @param  int  $numVisualizaciones
     *
     * @return  self
     */
    public function setNumVisualizaciones(int $numVisualizaciones)
    {
        $this->numVisualizaciones = $numVisualizaciones;

        return $this;
    }

    /**
     * Get the value of numLikes
     *
     * @return  int
     */
    public function getNumLikes()
    {
        return $this->numLikes;
    }

    /**
     * Set the value of numLikes
     *
     * @param  int  $numLikes
     *
     * @return  self
     */
    public function setNumLikes(int $numLikes)
    {
        $this->numLikes = $numLikes;

        return $this;
    }

    /**
     * Get the value of numDownloads
     *
     * @return  int
     */
    public function getNumDownloads()
    {
        return $this->numDownloads;
    }

    /**
     * Set the value of numDownloads
     *
     * @param  int  $numDownloads
     *
     * @return  self
     */
    public function setNumDownloads(int $numDownloads)
    {
        $this->numDownloads = $numDownloads;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }
    
    public function toArray(): array
    {
        return[
            'id'=>$this->getId(),
            'nombre'=>$this->getNombre(),
            'categoria'=>$this->getCategoria(),
            'descripcion'=>$this->getDescripcion(),
            'numVisualizaciones'=>$this->getNumVisualizaciones(),
            'numLikes'=>$this->getNumLikes(),
            'numDownloads'=>$this->getNumDownloads()
        ];
    }

    /**
     * Get the value of categoria
     *
     * @return  int
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @param  int  $categoria
     *
     * @return  self
     */ 
    public function setCategoria(int $categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }
}
