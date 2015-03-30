<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."colaboraweb/function/base.php");
    require_once($_SERVER['DOCUMENT_ROOT']."colaboraweb/function/function_login.php");
    echo beginPage(array("http://localhost/colaboraweb/css/style3.css"), "Déconnexion");
    echo disconnect();
	echo endPage();
?>