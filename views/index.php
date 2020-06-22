<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../libralies/meta_head.php'); ?>

    <link rel="stylesheet" href="../libralies/authentication.css">

    <title>Sign in - Penem</title>

    <script src="../libralies/validation.js"></script>

</head>
<body>
    <div class="container">
        <header>
            <h2>Sign in</h2>
            <nav>
                <ul>
                    <li><a  href="registration.php">Registration</a></li>
                    <li class="onPage"><a href="#">Sign in</a></li>
                </ul>
            </nav>
            <div id="social_signIn">
                <h5>You can sign in with social</h5>

                <div id="icons">
                    <a><img src="../images/Icons/social_login/icons8-facebook-old.svg"/></a>

                    <a><img src="../images/Icons/social_login/icons8-gmail.svg"></a>

                    <a><img src="../images/Icons/social_login/icons8-instagram.svg" alt="Ícone do instagram"></a>
                </div>
            </div>
        </header>
        <main>
            <form id="form" method="post">

            <input name="email" type="email" id="email" placeholder="E-mail" required>

            <input name="senha" type="password" id="senha" placeholder="Password" required>

            <a id="remind" href="#">Forgot your password?</a>

            <footer>
                <button type="submit" class="btn input footer" id="btn">Sign In</button>
            </footer>

            </form>
        </main>
        
    </div>
</body>
</html>
<?php
    require_once('../class/usuario.php');

    if(isset($_POST['email'])){
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);

        $senha = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_STRING);

        //verificar se os campos estão vazios
        if(!empty($email) && !empty($senha)){
            
            

            $user = new usuario;

            $user->conectar();

            if(empty($user->erroMsg)){ // Se a mensagem de erro estiver vazia, quer dizer que não há erros ao conectar com o BD!

                
                if($user->logar($email, $senha)){

                    header('location: ../views/lesson.php');

                }else{
                    ?>
                    <script>
                        var x = document.getElementById('form');
                        x.disabled = true;
                    </script>
                    <div class="msg_erro">
                        <p>Confira as informações fornecidas!</p>
                        <button class="btn" id="errodedados" onclick='confirmar("errodedados")'>OK</button>
                    </div>

                    <?php
                }
            
            //caso haja algum erro com a conexão
            }else{
                ?>

                    <div class="msg_erro">
                        <p>Erro: <?php $user->erroMsg; ?></p>
                        <button class="btn" id="erroConexao" onclick='confirmar("erroConexao")'>OK</button>
                    </div>
                    
                <?php
                
            }

        //caso haja algum campo do formulário vazia
        }else{
            ?>

                <div class="msg_erro">
                   <p>Preencha todos os campos!</p>
                    <button class="btn" id="erroBlank" onclick='confirmar("erroBlank")'>OK</button>
                </div>
                    
            <?php

        }
    }


?>

