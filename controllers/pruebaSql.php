<?php

    $pdo = new PDO('mysql:host=localhost; dbname=proyecto;charset=utf8', 'user','user');
    // $pdo->exec('INSERT INTO asociados(nombre,logo,descripcion) VALUES('Peter','asd'))');


require_once 'views/index.view.php';
