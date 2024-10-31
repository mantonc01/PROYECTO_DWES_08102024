<?php
//probar con esta dirección
// require_once __DIR__ . 'exceptions/fileException.class.php';
//o con esta
require_once __DIR__ . '../../exceptions/fileException.class.php';
class File
{
    private $file;
    private $fileName;


    public function __construct(string $fileName, array $arrTypes)
    {
        //con $fileName obtendremos el fichero mediante el array $ FILES que contiene 
        //todos los ficheros que se suben al servidor mediante un formulario. 
        $this->file = $_FILES[$fileName];
        // $this->file = $_FILES[$fileName] ?? null; // Usamos el operador null-coalesce para mayor seguridad
        $this->fileName = '';

        //Comprobamos que es array contiene el fichero 
        if (!isset($this->file)) {
            //Mostrar un error
            throw new FileException('Debes seleccionar un fichero');
        }

        //Verificamos si ha habido algún error durante la subida del fichero 
        if ($this->file['error'] !== UPLOAD_ERR_OK) {
            //Dentro del if verificamos de que tipo ha sido el error 
            switch ($this->file['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    //Algún problema con el tamaño del fichero 
                    throw new FileException('El fichero es demasiado grande');
                    break;

                case UPLOAD_ERR_PARTIAL:
                    //Error en la transferencia subida incompleta 
                    throw new FileException('No se ha podido subir el fichero completo');
                    break;

                default:
                    //Error en la subida del fichero
                    throw new FileException('No se ha podido subir el fichero');
                    break;
            }
        }

        //Comprobamos si el fichero subido es de un tipo de los que tenemos soportados 
        // Comprobamos si el tipo de archivo está en la lista de tipos permitidos
        if (!in_array($this->file['type'], $arrTypes, true)) {
            throw new FileException('Tipo de fichero no soportado');
        }
    }

    // Método para obtener el nombre del archivo
    public function getFileName(): string
    {
        return $this->fileName;
    }

    // Método para guardar el archivo en la ruta destino especificada
    public function saveUploadFile(string $rutaDestino)
    {
        //Compruebo que el fichero temporal con el que vamos o trabajar se 
        //haya subido previamente par petición Post 
        // Verificamos que el archivo se haya subido mediante un formulario
        if (!is_uploaded_file($this->file['tmp_name'])) {
            throw new FileException('El archivo no se ha subido mediante el formulario');
        }


        //Cargamos el nombre del fichero 
        $this->fileName = $this->file['name']; //nomare original del fichero cuando se subid 
        $ruta = $rutaDestino . $this->fileName; //concatena la rutadestino con el nombre del fichero 

        //Comprabomos que la ruto no se correspondo con un fichero que ya existo 
        // Comprobamos que el archivo no exista en la ruta destino
        if (is_file($ruta)) {
            //no sobreescrito, sino que genera uno nuevo añadiendo la fecha y hora actual 
            //esta parte hay que cambiarla para que si existe el nombre de archivo
            //genere un nuevo nombre con un numero como hace windows
            $fechaActual = date('dmYHis');
            $this->fileName = $this->fileName . '_' . $fechaActual;
            $ruta = $rutaDestino . $this->fileName; //Actualizo la variable ruta con el nueva nombre 
        }

        //mueve el fichero subido del directorio temporalíviene definido en php.ini) 
        if (!move_uploaded_file($this->file['tmp_name'], $ruta)) {
            //devuelve false si no se ho podido moven 
            throw new FileException("No se puede mover el fichero a su destino");
        }
    }

    /**
     * @param 
     */
    public function copyFile(string $rutaOrigen, string $rutaDestino)
    {
        $origen = $rutaOrigen . $this->fileName;
        $destino = $rutaDestino . $this->fileName;

        if (is_file($origen) === false) {
            throw new FileException("No existe el fichero $origen que intentas copiar");
        }
        if (is_file($destino) === true) {
            throw new FileException('El fichero $destino ya existe y no se puede sobreeescribilo');
        }
        if (copy($origen, $destino) === false) {
            throw new FileException('No se ha podido copiar el fichero $origen a $ destino');
        }
    }
}
