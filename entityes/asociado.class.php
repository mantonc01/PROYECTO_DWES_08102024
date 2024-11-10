<?php
class Asociado
{

    /**
     * @var string : guardará el nombre del asociado
     */
    private $nombre;
    /**
     * @var string : guarda el nombre de la imagen del logo
     */
    private $logo;
    /**
     * @var string : Esta descripción se pondrá en el texto alternativo de la imagen (atributo alt) y en el título de la imagen (atributo title).
     */
    private $descripcion;




    public function __construct(string $nombre = '', string $logo = '', string $descripcion = '')
    { //valores pasados por defecto
        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->descripcion = $descripcion;
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
     * Get the value of logo
     *
     * @return  string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set the value of logo
     *
     * @param  string  $logo
     *
     * @return  self
     */
    public function setLogo(string $logo)
    {
        $this->logo = $logo;

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
}
