<?php
    require_once('../controllers/controlleracess.php');

    $id_curso = $_GET['id'];

    $pdo = new PDO('mysql:dbname=cadastros;host=localhost', 'root', '');

    $conn = $pdo->prepare('SELECT * FROM `questoes` WHERE id_curso = :e');
    $conn->bindParam(':e', $id_curso, PDO::PARAM_STR);
    $conn->execute();

    $dados = $conn->fetchAll(PDO::FETCH_ASSOC);

    $contador = 0;

    $num = count($dados);
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <?php require_once('../libralies/meta_head.php') ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../libralies/subject.css">
        <title>Penem</title>
        
    </head>
    <body>
    <div id="container">
        <?php require_once('../libralies/nav_menu_body.php') ?>
        <main id="main">
    <?php
        if(count($dados) > 0){
                    foreach ($dados as $key) {
                        $id = rand();
                        $contador += 1;  
    ?>
                        <div class="content questao">
                            <div id="display">
                                <p style='text-align:left'><?php echo $key['pergunta'] ?></p>
                            </div>
                            <div class="alternativas" id="<?php echo $id;?>">

                                <span>a</span><button id="a" onclick="resposta(<?php echo $key['id_questao'];  ?>, 'a', <?php echo $id;  ?>)" class="btn"><?php echo $key['respo1']?></button><br>

                                <span>b</span><button id="b"  onclick="resposta(<?php echo $key['id_questao'];  ?>, 'b', <?php echo $id;  ?>)"  class="btn"><?php echo $key['respo2']?></button><br>

                                <span>c</span><button id="c"  onclick="resposta(<?php echo $key['id_questao'];  ?>, 'c', <?php echo $id;  ?>)"  class="btn"><?php echo $key['respo3']?></button><br>

                                <span>d</span><button id="d"  onclick="resposta(<?php echo $key['id_questao'];  ?>, 'd', <?php echo $id;  ?>)"  class="btn"><?php echo $key['respo4']?></button><br>

                                <span>e</span><button id="e"  onclick="resposta(<?php echo $key['id_questao'];  ?>, 'e', <?php echo $id;  ?>)"  class="btn"><?php echo $key['respo5']?></button><br>
                            
                            </div>
                                
                            <div id="nav_question">
                                <?php 
                                    // inicio do for
                                    for ($i=1; $i <= $num; $i++) { 
                                ?>
                                <span class="dot" onclick="currentSlide(<?php echo $i ?>)"></span>
                                <?php }?><!--fechamento do for -->
                            </div>    
                        </div>
                    <?php }?> <!--fim do forEach-->
            
        <?php
        }else{ //fim do if e inicio do else
        ?>
            <div class="content">
                <p>Curso em construção, por favor, volte outro dia</p>
            </div>
        <?php } ?> <!-- fim do else-->
        </main>
            </div>
            <script src="../libralies/test.js"></script>
            <script src="../libralies/buscador.js"></script>
    </body>
    </html>