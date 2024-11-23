<?php
require_once 'entityes/iEntity.class.php';
class Contacto implements IEntity
{


    /**
     * @var string : guardará el nombre del contacto
     */
    private $nombre;

    /**
     * @var string : guardará el apellido del contacto
     */
    private $apellidos;

    /**
     * @var string : guardará el asunto del contacto
     */
    private $asunto;

    /**
     * @var string : guardará el email del contacto
     */
    private $email;

    /**
     * @var string : guardará el texto del contacto
     */
    private $texto;

    /**
     * @var string : guardará la fecha del contacto
     */
    private $fecha;

    /**
     * @var int
     */
    private $id;


    public function __construct(string $nombre = '', string $apellidos = '', string $asunto = '', string $email = '', string $texto = '', string $fecha = '')
    { //valores pasados por defecto
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->asunto = $asunto;
        $this->email = $email;
        $this->texto = $texto;
        $this->fecha = $fecha;
        $this->id = null;
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
     * Get : guardará el apellido del contacto
     *
     * @return  string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set : guardará el apellido del contacto
     *
     * @param  string  $apellidos  : guardará el apellido del contacto
     *
     * @return  self
     */
    public function setApellidos(string $apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }


    /**
     * Get : guardará el asunto del contacto
     *
     * @return  string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set : guardará el asunto del contacto
     *
     * @param  string  $asunto  : guardará el asunto del contacto
     *
     * @return  self
     */
    public function setAsunto(string $asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get : guardará el email del contacto
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set : guardará el email del contacto
     *
     * @param  string  $email  : guardará el email del contacto
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get : guardará el texto del contacto
     *
     * @return  string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set : guardará el texto del contacto
     *
     * @param  string  $texto  : guardará el texto del contacto
     *
     * @return  self
     */
    public function setTexto(string $texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get : guardará la fecha del contacto
     *
     * @return  string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set : guardará la fecha del contacto
     *
     * @param  string  $fecha  : guardará la fecha del contacto
     *
     * @return  self
     */
    public function setFecha(string $fecha)
    {
        $this->fecha = $fecha;

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
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'apellidos' => $this->getApellidos(),
            'asunto' => $this->getAsunto(),
            'email' => $this->getEmail(),
            'texto' => $this->getTexto(),
            'fecha' => $this->getFecha()
        ];
    }
}
