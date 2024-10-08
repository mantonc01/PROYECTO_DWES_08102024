<?php
if ($_SERVER["REQUEST_METHOD"] == "post") {
    $validacion = true;
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $apellido = htmlspecialchars(trim($_POST['apellido']));
    $email = htmlspecialchars(trim($_POST['email']));
    $sujeto = htmlspecialchars(trim($_POST['sujeto']));
    $textArea = htmlspecialchars(trim($_POST['textArea']));
    if (!empty($nombre) && !empty($email) && !empty($sujeto)) {
        
    } else {
        echo "<div> <p>campos vacios</p></div>";
        $validacion = false;
    }
}
require 'views/contact.view.php';
