<?php

require_once 'exceptions/fileException.class.php';

/**
 * Clase `File`
 * Maneja archivos subidos mediante formularios, verificando su validez,
 * moviéndolos a directorios específicos y permitiendo operaciones como copiar a otra ubicación.
 */
class File
{
    private $file; // Datos del archivo subido desde `$_FILES`.
    private $fileName; // Nombre del archivo procesado.
    private $allowedTypes; // Tipos MIME permitidos.

    /**
     * Constructor.
     * Inicializa un objeto `File` validando el archivo subido y su tipo MIME.
     *
     * @param string $fileName Nombre del campo en el formulario (`name`).
     * @param array $arrTypes Tipos MIME permitidos.
     * @throws FileException Si el archivo no es válido.
     */
    public function __construct(string $fileName, array $arrTypes)
    {
        $this->file = $_FILES[$fileName] ?? null; // Usamos null-coalesce para evitar errores si no existe el campo.
        $this->fileName = '';
        $this->allowedTypes = $arrTypes;

        // Validar si el archivo fue enviado en el formulario.
        if (!isset($this->file)) {
            throw new FileException('Debes seleccionar un fichero.');
        }
    }

    /**
     * Verifica si el archivo subido es válido.
     *
     * @return bool Retorna true si el archivo es válido, de lo contrario, false.
     */
    public function isValid(): bool
    {
        // Verificar si el archivo tiene errores en la subida.
        if ($this->file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Verificar si el tipo MIME del archivo es válido.
        if (!in_array($this->file['type'], $this->allowedTypes, true)) {
            return false;
        }

        // Verificar si el archivo tiene un tamaño válido.
        if ($this->file['size'] <= 0) {
            return false;
        }

        return true;
    }

    /**
     * Obtiene el nombre del archivo.
     *
     * @return string Nombre del archivo procesado.
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Guarda el archivo subido en la ubicación especificada.
     *
     * @param string $rutaDestino Directorio donde se guardará el archivo.
     * @throws FileException Si el archivo no es válido o no se puede mover.
     */
    public function saveUploadFile(string $rutaDestino)
    {
        // Verificar que el archivo es válido antes de intentar guardarlo.
        if (!$this->isValid()) {
            throw new FileException('El archivo no es válido y no se puede guardar.');
        }

        // Verificar que el archivo fue subido mediante un formulario.
        if (!is_uploaded_file($this->file['tmp_name'])) {
            throw new FileException('El archivo no se ha subido mediante el formulario.');
        }

        // Obtener el nombre original del archivo.
        $this->fileName = $this->file['name'];
        $ruta = $rutaDestino . $this->fileName;

        // Evitar sobrescribir archivos existentes.
        $contador = 1;
        while (is_file($ruta)) {
            $nombreSinExtension = pathinfo($this->file['name'], PATHINFO_FILENAME);
            $extension = pathinfo($this->file['name'], PATHINFO_EXTENSION);
            $this->fileName = $nombreSinExtension . '_' . $contador . '.' . $extension;
            $ruta = $rutaDestino . $this->fileName;
            $contador++;
        }

        // Mover el archivo al destino final.
        if (!move_uploaded_file($this->file['tmp_name'], $ruta)) {
            throw new FileException('No se puede mover el fichero a su destino.');
        }
    }

    /**
     * Copia un archivo desde una ubicación de origen a una ubicación de destino.
     *
     * @param string $rutaOrigen Directorio de origen del archivo.
     * @param string $rutaDestino Directorio de destino.
     * @throws FileException Si el archivo no existe, ya está en el destino, o no se puede copiar.
     */
    public function copyFile(string $rutaOrigen, string $rutaDestino)
    {
        $origen = $rutaOrigen . $this->fileName;
        $destino = $rutaDestino . $this->fileName;

        // Verificar que el archivo de origen existe.
        if (!is_file($origen)) {
            throw new FileException("No existe el fichero $origen que intentas copiar.");
        }

        // Verificar si el archivo ya existe en el destino.
        if (is_file($destino)) {
            throw new FileException("El fichero $destino ya existe y no se puede sobreescribir.");
        }

        // Intentar copiar el archivo.
        if (!copy($origen, $destino)) {
            throw new FileException("No se ha podido copiar el fichero $origen a $destino.");
        }
    }
}
