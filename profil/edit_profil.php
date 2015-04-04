<?php
	session_start();
	define("HTTP_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?"http://".$_SERVER['HTTP_HOST']."/colaboraweb":"http://".$_SERVER['HTTP_HOST']);
	define("SERV_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?$_SERVER['DOCUMENT_ROOT']."/colaboraweb":$_SERVER['DOCUMENT_ROOT']);
    require_once(SERV_ROOT."/function/base.php");
    echo beginPage(array(HTTP_ROOT."/css/style3.css"), 'Edition de profil');
	
	echo endPage();
?>