<?php
    $id_question = $_GET['idQuestion'];
    $alternativa = $_GET['resposta'];
    $id_alternativas = $_GET['idAlternativas'];


    $pdo = new PDO('mysql:dbname=cadastros;host=localhost', "root", "");

    $varer = $pdo->prepare('SELECT respoCorreta FROM `questoes` WHERE `id_questao` = :e');
    $varer->bindValue(':e', $id_question, PDO::PARAM_STR);
    $varer->execute();

    $respoCorreta = $varer->fetchAll(PDO::FETCH_ASSOC);

    if( $alternativa == $respoCorreta[0]['respoCorreta']){
        $dados = ['1', $alternativa, $id_alternativas];
        echo json_encode($dados);
    }else{
        $dados = ['0', $alternativa, $id_alternativas];
        echo json_encode($dados);
    }
?>