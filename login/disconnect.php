<?php
    session_start();
    require_once("../function/base.php");
    require_once("../function/function_login.php");
    echo beginPage(array("../css/style3.css"), "Déconnexion");
    echo disconnect();
?>