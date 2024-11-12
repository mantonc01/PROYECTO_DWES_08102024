<?php

/**
 * Comprueba si una opción de menú está activa comparando un string dado con la URI actual.
 *
 * @param string $opcionMenu La opción de menú que se desea verificar.
 * @return bool Devuelve `true` si la opción de menú está presente en la URI actual, de lo contrario, `false`.
 */
function esOpcionMenuActiva(string $opcionMenu): bool
{
    // Convertimos la opción de menú a minúsculas para hacer una comparación insensible a mayúsculas/minúsculas.
    $opcionMinuscula = strtolower($opcionMenu);

    // Obtenemos la URI actual del servidor y la convertimos a minúsculas.
    // $_SERVER['REQUEST_URI'] contiene la parte de la URL después del nombre de dominio.
    $uriMinuscula = strtolower($_SERVER['REQUEST_URI']);

    // Utilizamos strpos para buscar la posición de $opcionMinuscula dentro de $uriMinuscula.
    // Si strpos devuelve un valor distinto de `false`, significa que la opción de menú está presente en la URI.
    // La comparación `!== false` asegura que valores como 0 (inicio de la cadena) se consideren válidos.
    return strpos($uriMinuscula, $opcionMinuscula) !== false;
}

/**
 * Comprueba si alguna de las opciones de un array está activa en la URI actual.
 * Esta función es útil, por ejemplo, para destacar un menú basado en múltiples posibles URLs.
 *
 * @param array $opciones Un array de strings que representan las posibles opciones de menú.
 * @return bool Devuelve `true` si alguna de las opciones de menú está presente en la URI actual; de lo contrario, devuelve `false`.
 */
function existeOpcionMenuActivaEnArray(array $opciones): bool
{
    // Recorremos cada opción en el array usando un bucle foreach
    foreach ($opciones as $opcion) {
        // Llamamos a la función esOpcionMenuActiva() para verificar si la opción actual está en la URI
        if (esOpcionMenuActiva($opcion)) {
            // Si encontramos alguna coincidencia, retornamos `true` inmediatamente, sin seguir revisando
            return true;
        }
    }
    // Si ninguna opción del array se encontró en la URI, retornamos `false`
    return false;
}


/**
 * Función que devuelve tres elementos aleatorios de un array.
 * Si el array tiene tres o menos elementos, devuelve el array completo.
 *
 * @param array $array El array del cual se obtendrán los elementos aleatorios.
 * @return array Tres elementos aleatorios del array.
 */
function obtenerTresElementosAleatorios(array $array): array
{
    // Si el array tiene 3 o menos elementos, devolvemos el array completo.
    if (count($array) <= 3) {
        return $array;
    }

    // Mezclamos el array
    shuffle($array);

    // Extraemos los primeros 3 elementos
    return array_slice($array, 0, 3);
}
