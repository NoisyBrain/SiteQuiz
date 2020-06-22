<?php

    $titulo = $_GET['titulo'];

    $pdo = new PDO('mysql:dbname=cadastros;host=localhost', "root", "");

    $varer = $pdo->prepare('SELECT * FROM `cursos` WHERE `titulo` = :e');
    $varer->bindValue(':e', $titulo, PDO::PARAM_STR);
    $varer->execute();

    $cursos = $varer->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($cursos);

?>