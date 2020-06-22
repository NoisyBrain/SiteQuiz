<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])){
       header('location: ../views/');
       echo "alert($_SESSION[id_usuario])";
        exit;
    }else{
        
    }
?>