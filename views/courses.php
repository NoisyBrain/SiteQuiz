<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once('../libralies/meta_head.php') ?>


    <link rel="stylesheet" href="../libralies/courses_body.css">

    <script src="../libralies/buscador.js" ></script>


    <title>Profile</title>
    
</head>
<body>
    <div id="content">
       <?php require_once('../libralies/nav_menu_body.php'); ?>
        <main>
            <article id="ads">
                <h1 id="title_session">Course catalog</h1>
                <p id="subtitle">Each course contains video lectures, tasks and text materials. All course viewed by you are displayed in persinal account.</p>
            </article>
            <div id="reaserch">
                <input class="reaserch" type="text" id="reaserch_bar" placeholder="Search">
                <button onclick="buscar()" class="reaserch">Buscar</button>
            </div>
            <div id="courses">
                <p id="resultados">
                    <span id="resultados1">Busque por cursos</span>
                    <span id="resultados2"></span>
                    <span id="resultados3"></span>
                </p>
                <ul id="section">
                    
                </ul>
            </div>
        </main>
    </div>
</body>
</html>