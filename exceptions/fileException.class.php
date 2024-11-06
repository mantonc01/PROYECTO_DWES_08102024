<?php

class FileException extends Exception
{
    /**
     * Representa una excepción relacionada con operaciones de archivos.
     *
     * @param string $mensaje El mensaje de error que describe la excepción.
     */
    public function __construct(string $mensaje)
    {
        parent::__construct($mensaje);
    }
}
