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
                        Cadastro realizado com sucesso. Faça login e aproveite!
                    </div>
                    
                    <?php
                }else{
                    echo'
                        <script>
                            location.href = "../views/registration.php"
                        </script>    
                    ' ;
                                     
                }

            //caso haja algum erro com a conexão
            }else{
                ?>
                    <div class="msg_erro">
                        Erro: <?php $user->$erroMsg; ?>!
                    </div>
                    
                    <?php
            }

        //caso haja algum campo do formulário vazia
        }else{
            ?>
                    <div class="msg_erro">
                        Preencha todos os campos!
                    </div>
                    
                    <?php

        }
    }


?>
