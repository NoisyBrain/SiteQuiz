<?php
    session_start();
    
    $id_user = $_SESSION['id_usuario'];

    $id_curso = filter_input(INPUT_GET,'curso',FILTER_SANITIZE_STRING);

    $pdo = new PDO('mysql:dbname=cadastros;host=localhost', 'root', '');

    $inserir = $pdo->prepare('INSERT INTO `usuariocursos`(`id_usuario`, `id_curso`) VALUES (:iu, :ic)');

    $inserir->bindParam(':iu', $id_user);

    $inserir->bindParam(':ic', $id_curso);

    $inserir->execute();

    echo $id_curso;


?>
