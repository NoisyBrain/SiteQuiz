<?php

abstract class ClassConexao{
 //conectar com o banco de dados
    public function conectar(){
        try {

            $pdo = new PDO('mysql:dbname=cadastros;host=localhost', "root", " ");
            return ('conectou');

        } catch (PDOException $e) {

            $msgErro = $e->getMessage();

        }
    }

}
    

?>
