<?php
	session_start();
	define("HTTP_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?"http://".$_SERVER['HTTP_HOST']."/colaboraweb":"http://".$_SERVER['HTTP_HOST']);
	define("SERV_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?$_SERVER['DOCUMENT_ROOT']."/colaboraweb":$_SERVER['DOCUMENT_ROOT']);
	require_once(SERV_ROOT."/function/function_login.php");
	if(!isset($_POST['pseudo'])){
		$pseudo = "";
	}
	else{
		$pseudo = $_POST['pseudo'];
	}
	if(!isset($_POST['pass']) || !isset($_POST['confirmpass'])){
		$same = "false";
		$pass = "";
	}
	else{
		if($_POST['pass'] != $_POST['confirmpass']){
			$same = "false";
			$pass = "";
		}
		else{
			$pass = $_POST['pass'];
			$same = "true";
		}
	}
	
	if(subscribe($pseudo, $pass)){
		header('Location: http://localhost/colaboraweb/index.php');
	}
	else{
		header('Location: http://localhost/colaboraweb/login/subscribe.php?pseudo='.$pseudo.'&pass='.$pass.'&same='.$same);
	}
	
?>