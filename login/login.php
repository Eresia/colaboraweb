<?php
    session_start();
    require_once("../function/base.php");
    echo beginPage(array("../css/style3.css"), "Connexion");
    if(isset($_SESSION['pseudo'])){
        echo "<p>Vous êtes déja connecté</p>";
    }
    else{
        $_SESSION['pseudo'] = "test";
        echo "<p>Vous avez bien été connecté</p>";
    }
    
    echo endPage();
?>