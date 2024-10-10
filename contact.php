<?php
$nombreDiv = "alert alert-danger";//doy a la clase del div este valor
$datos = [];//array para introducir los datos
$datosValidos = [];//array de datos válidos

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $validacion = true;//inicio la validación a true

    //cargo las variables con los datos POST
    //compruebo no haya caracteres especiales y quito espacios antes y despues
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $apellido = htmlspecialchars(trim($_POST['apellido']));
    $email = htmlspecialchars(trim($_POST['email']));
    $sujeto = htmlspecialchars(trim($_POST['sujeto']));
    $textArea = htmlspecialchars(trim($_POST['textArea']));

    //agrego el dato a cada array según corresponda y compruebo validacion
    if (empty($nombre)) {
        $datos[] = 'El campo First Name no puede estar vacío.';
        $validacion = false;
    } else {
        $datosValidos[] = "First Name: " . $nombre;
    };

    if (empty($email)) {
        $datos[] = 'El campo Email no puede estar vacío.';
        $validacion = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $datos[] = 'Email incorrecto';
        $validacion = false;
    } else {
        $datosValidos[] = 'Email: ' . $email;
    };

    if (empty($sujeto)) {
        $datos[] = 'El campo subjet no puede estar vacío.';
        $validacion = false;
    } else {
        $datosValidos[] = 'Subjet: ' . $sujeto;
    };

    if (!empty($textArea)) {
        $datosValidos[] = 'Message: ' . $textArea;
    };

    //si validación está ok 
    if ($validacion) {
        $nombreDiv = "alert alert-info";//doy este valor
        $datos = $datosValidos;//a datos le paso los datos válidos
        //le paso vacio a cada variable
        $nombre = '';
        $apellido = '';
        $email = '';
        $sujeto = '';
        $textArea = '';
    }
}
require 'views/contact.view.php';
