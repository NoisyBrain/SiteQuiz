 <?php
    require_once('../controllers/controlleracess.php');

    require_once('../class/usuario.php');
 
    $user = new usuario;

    $user->conectar();

    $cursos = $user->buscarLessons($_SESSION['id_usuario']);
    ?>   

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <?php require_once('../libralies/meta_head.php'); ?>    

        <title>lessons</title>

        <meta name="description" content="Somos uma empresa focada no preparatório de joven e adolescentes para vestibulares e Enem. Habiente lúdico e apredizagem de forma interativa.">
        
        <meta name="keywords" content="Penem pré vestibular, pré vestibular, pre vestibular, pre-vestibular, Penem">

        <link rel="stylesheet" href="../libralies/lesson_body.css"> <!-- confifuração de estilo do corpo das lessons -->

        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    </head>
    <body>
        <div id="content">
            <?php require_once('../libralies/nav_menu_body.php');?>
            <main>
                <h1 id="title_session">My lessons</h1>
                <div id="courses">
                    <ul>
                        <?php
                            if($cursos != false){
                                foreach ($cursos as $key) {
                                    ?>
                                        <li id="<?php echo $key["id"]; ?>">
                                            <div class="contain_bar">
                                                <i  onclick = 'call_deletar(<?php echo $key["id"]; ?>)' class="fas fa-trash-alt"></i>
                                            </div>
                                            <img src="../images/img/image 10.svg" class="background">
                                            <img src="../images/img/ava.svg" class="teacher_photo">
                                            <div class="description">
                                                <h5><?php echo $key['titulo'] ?></h5>
                                                <div class="scheme">

                                                    <p>
                                                        <img src="../images/Icons/scheme_icon/student.svg"><?php echo $key['num_aulas']. " lessons"?>
                                                    </p>
                                                    <p>
                                                        <img src="../images/Icons/scheme_icon/pen.svg"><?php echo $key['num_atividades']. " tasks"?>
                                                    </p>
                                                    <p>
                                                        <img src="../images/Icons/scheme_icon/video.svg" ><?php echo $key['num_videos']. " minutes"?>
                                                    </p>

                                                </div>
                                                <p id="descricao" class="descricao"><?php echo $key['descricao'] ?></p>
                                                <div class="btn">

                                                    <button onclick="licao(<?php echo($key['id']); ?>)">Continue</button>
                                                    <a id="saibamais" onclick="show_descricao()" href="#">More</a>
                                                    
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                }
                            }else{?>
                                        <div>
                                            <h5>Você não está fazendo nenhum curso</h5>
                            </div>
                            <?php } ?>
                    </ul>
                </div>
            </main>
        </div>
        <script src="../libralies/buscador.js"></script>
    </body>
    </html>