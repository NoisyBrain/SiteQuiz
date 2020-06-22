<?php

class usuario{
    private $pdo;
    public $erroMsg = "";

    public function conectar(){
        global $pdo;
        try {

            $pdo = new PDO('mysql:dbname=cadastros;host=localhost', "root", "");

        } catch (PDOException $e) {

            $erroMsg = $e->getMessage();

        }
    }
    //inserir dado no banco de dados
    public function cadastrar($nome, $email, $telefone, $senha){
        //verificar se o email já está cadastrado
            global $pdo;
            $varer = $pdo->prepare('SELECT id FROM usuarios WHERE email = :e');
            $varer->bindValue(':e', $email, PDO::PARAM_STR);
            $varer->execute();

            if($varer->rowCount() > 0){

                return false;

            //caso não, cadastrar
            }else{

                $varer = $pdo->prepare("INSERT INTO `usuarios`(`nome`, `email`, `telefone`, `senha`) VALUES (:n, :e, :t, :s)");
                $varer->bindParam(':n', $nome, PDO::PARAM_STR);
                $varer->bindParam(':e', $email, PDO::PARAM_STR);
                $varer->bindParam(':t', $telefone, PDO::PARAM_STR);
                $varer->bindParam(':s', $senha, PDO::PARAM_STR);
                $varer->execute();

                return true;

            }
        
    }
    //logar
    public function logar($email, $senha){
        global $pdo;
        //verificar se O email e senha estão cadastrados, se sim
        $varer=$pdo->prepare('SELECT id FROM `usuarios` WHERE `email` = :e AND `senha` = :s');

        $varer->bindValue(':e', $email, PDO::PARAM_STR);
        $varer->bindValue(':s', $senha, PDO::PARAM_STR);
        $varer->execute();

        if($varer->rowCount() > 0){
            //entrar no sistema
            $dado = $varer->fetch();
            echo $dado;
            session_start();
            $_SESSION['id_usuario'] = $dado['id'];

            return true; //Inicio sessão

            //caso não, mostrar falha ao tentar logar
            }else{
                //caso não, cadastrar
                return false; //não foi possível logar
            }
        
        
    }

    public function buscarLessons($id){
        global $pdo;
        //verificar os cursos do usuário
        $varer = $pdo->prepare('SELECT id_usuario, id, titulo, num_aulas, num_atividades, num_videos, descricao, img_backgroung FROM (`usuariocursos` AS U INNER JOIN `cursos` AS C ON id_curso = id) where id_usuario = :e'); 

        $varer->bindValue(':e', $id, PDO::PARAM_STR);
        $varer->execute();

        if($varer->rowCount() > 0){
            //exibir os cursos
            $dados = $varer->fetchAll(PDO::FETCH_ASSOC);
            
            return $dados;

            //caso não, mostrar falha ao tentar logar
        }else{
            //caso não, cadastrar
            return false; //não foi possível logar
        }
    }
    
}

?>