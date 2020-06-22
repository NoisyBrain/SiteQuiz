<?php

class ClassBuscar{
    private $pdo; 
    public $erroMsg = "";

    #Método construtor
    public function conectar(){
        global $pdo;
        try {

            $pdo = new PDO('mysql:dbname=cadastros;host=localhost', "root", " ");

            return 'certo';

        } catch (PDOException $e) {

            $erroMsg = $e->getMessage();

        }
    }

    #Método de Busca
    public function buscarCursos($titulo){
        global $pdo;

        global $pdo;
        $varer = $pdo->prepare('SELECT * FROM `cursos` WHERE `titulo` = :e');
        $varer->bindValue(':e', $titulo, PDO::PARAM_STR);
        $varer->execute();

        $dados = $varer->fetchAll(PDO::FETCH_ASSOC);

        print_r($dados);
         
    }
}

?> 
