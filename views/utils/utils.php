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

?>