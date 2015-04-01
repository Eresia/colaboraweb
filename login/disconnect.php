<?php
    session_start();
	define("HTTP_ROOT", ($_SERVER['HTTP_HOST'] == "localhost")?"http://localhost/colaboraweb":"http://".$_SERVER['HTTP_HOST']);
	define("SERV_ROOT", ($_SERVER['HTTP_HOST'] == "localhost")?$_SERVER['DOCUMENT_ROOT']."/colaboraweb":$_SERVER['DOCUMENT_ROOT']);
	require_once(SERV_ROOT."/function/function_login.php");
    disconnect();
	header('Location: http://localhost/colaboraweb/index.php');
?>