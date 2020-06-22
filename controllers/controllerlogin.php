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

                    <div>
                        Confira as informações fornecidas!
                    </div>

                    <?php
                }
            
            //caso haja algum erro com a conexão
            }else{
                ?>

                <div class="msg_erro">
                    Erro: <?php $user->erroMsg; ?>
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
