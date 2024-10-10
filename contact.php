<?php
$errores = [];
$datosIntroducidos = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //$validacion = true;
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $apellido = htmlspecialchars(trim($_POST['apellido']));
    $email = htmlspecialchars(trim($_POST['email']));
    $sujeto = htmlspecialchars(trim($_POST['sujeto']));
    $textArea = htmlspecialchars(trim($_POST['textArea']));
    if (empty($nombre)) {
        $errores[] = 'El campo First Name no puede estar vacío.';
    } else {
        $datosIntroducidos[] = $nombre;
    };
    if (empty($email)) {
        $errores[] = 'El campo Email no puede estar vacío.';
    } else {
        $datosIntroducidos[] = $email;
    };
    if (empty($sujeto)) {
        $errores[] = 'El campo subjet no puede estar vacío.';
    } else {
        $datosIntroducidos[] = $sujeto;
    };
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Email incorrecto';
    } else {
        $datosIntroducidos[] = $email;
    }
}
require 'views/contact.view.php';
