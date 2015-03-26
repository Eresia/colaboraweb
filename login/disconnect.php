<?php
    session_start();
    require_once("../function/base.php");
    echo beginPage(array("../css/style3.css"), "Déconnexion");
    if(isset($_SESSION['pseudo'])){
        session_destroy();
        echo "<p>Vous avez bien été déconnecté</p>";
    }
    else{
        echo "<p>Vous n'êtes pas connecté</p>";
    }
?>