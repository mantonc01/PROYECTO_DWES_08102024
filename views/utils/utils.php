<?php
//esta función comprueba si el string pasado está en la uri de $_Server
function esOpcionMenuActiva(string $opcionMenu):bool{
    //pasamos a minusculas todo
    $opcionMinuscula = strtolower($opcionMenu);
    $uriMinuscula = strtolower($_SERVER['REQUEST_URI']);
    //compruebo que no me devuelve false
    return strpos($uriMinuscula, $opcionMinuscula) !== false;
}

//esta función recibe un array para el caso de los blogs
function existeOpcionMenuActivaEnArray(array $opciones): bool {
    //foreach para recorrer el array
    foreach ($opciones as $opcion) {
        if (esOpcionMenuActiva($opcion)) {
            return true;//si al pasar el array lo encuentro devuelvo true
        }
    }
    return false;// si no lo encuentro devuelvo false
}

/**
 * Función que devuelve tres elementos aleatorios de un array.
 * Si el array tiene tres o menos elementos, devuelve el array completo.
 *
 * @param array $array El array del cual se obtendrán los elementos aleatorios.
 * @return array Tres elementos aleatorios del array.
 */
function obtenerTresElementosAleatorios(array $array): array {
    // Si el array tiene 3 o menos elementos, devolvemos el array completo.
    if (count($array) <= 3) {
        return $array;
    }

    // Mezclamos el array
    shuffle($array);

    // Extraemos los primeros 3 elementos
    return array_slice($array, 0, 3);
}

?>