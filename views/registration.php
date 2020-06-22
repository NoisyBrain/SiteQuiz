<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../libralies/meta_head.php'); ?>

    <link rel="stylesheet" href="../libralies/authentication.css">

    <title>Register</title>

    <script   src="//ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>

    <script src="../libralies/validation.js"></script>

</head>
<body>
    <div class="container">
        <header id="header">
            <h2>Profile</h2>
            <nav>
                <ul>
                    <li class="onPage"><a  href="#">Registration</a></li>
                    <li><a href="index.php">Sign in</a></li>
                </ul>
            </nav>
            <div id="social_signIn">
                <h5>You can sign in with social</h5>

                <div id="icons">
                    <a href="#"><img src="../images/Icons/social_login/icons8-facebook-old.svg"/></a>

                    <a href="#"><img src="../images/Icons/social_login/icons8-gmail.svg"></a>

                    <a href="#"><img src="../images/Icons/social_login/icons8-instagram.svg" alt="Ícone do instagram"></a>
                </div>
            </div>
        </header>
        <main>
            <form id="form" method="post">

                <input name="nome" type="text" id="nome" placeholder="Name" required>

                <input name="email" type="email" id="email" placeholder="E-mail" required>

                <input name="telefone" type="tel" id="telefone" placeholder="Phone" required>

                <input name="senha" type="password" id="senha" placeholder="Password" required>

                <div id="contract">
                    <input type="checkbox" id="checkbox" required>

                    <h4>I accept the terms of the offer of <a href="#">the privacy policy</a></h4>
                </div>

                <footer>
                    <button class="input footer btn" id="btn" type='submit'>Registration</button>
                </footer>

            </form>
        </main>
    </div>
</body>
</html>
<?php
    require_once('../class/usuario.php');

    if(isset($_POST['nome'])){
        $nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);

        $telefone = filter_input(INPUT_POST,'telefone',FILTER_SANITIZE_STRING);

        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);

        $senha = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_STRING);

        //verificar se os campos estão vazios
        if(!empty($nome) && !empty($telefone)  && !empty($email)  && !empty($senha)){

            $user = new usuario;

            $user->conectar();

            if(empty($user->erroMsg)){ // Se a mensagem de erro estiver vazia, quer dizer que não há erros ao conectar com o BD!

                if($user->cadastrar($nome, $email, $telefone, $senha)){
                    ?>

                    <div id="msg_sucesso">
                        <p>Cadastro realizado com sucesso. Faça login e aproveite!</p>
                        <button class="btn" id="sucesso" onclick='confirmar("sucesso")'>OK</button>
                    </div>
                    
                    <?php
                }else{
                    ?>

                        <div class="msg_erro">
                            <p>Email já cadastrado!</p>
                            <button class="btn" id="emailErro" onclick='confirmar("emailErro")'>OK</button>
                        </div>
                    
                    <?php
                                     
                }

            //caso haja algum erro com a conexão
            }else{
                ?>
                    <div class="msg_erro">
                        <p>Erro: <?php $user->$erroMsg; ?>!</p>
                        <button class="btn" class="btn" id="conexaoErro" onclick='confirmar("conexaoErro")'>OK</button>
                    </div>
                    
                    <?php
            }

        //caso haja algum campo do formulário vazia
        }else{
            ?>
                    <div class="msg_erro">
                        <p>Preencha todos os campos!</p>
                        <button class="btn" id="blankField" onclick='confirmar("blankField")'>OK</button>
                    </div>
                    
                    <?php

        }
    }


?>