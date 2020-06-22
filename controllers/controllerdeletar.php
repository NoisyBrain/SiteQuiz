<?php
    session_start();
    
    $id_user = $_SESSION['id_usuario'];

    $id_curso = $_GET['id'];

    $pdo = new PDO('mysql:dbname=cadastros;host=localhost', 'root', '');

    $inserir = $pdo->prepare('DELETE FROM `usuariocursos` WHERE id_usuario = :iu AND id_curso = :ic');

    $inserir->bindParam(':iu', $id_user);

    $inserir->bindParam(':ic', $id_curso);

    $inserir->execute();

?>