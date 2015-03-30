<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."colaboraweb/function/base.php");
	require_once($_SERVER['DOCUMENT_ROOT']."colaboraweb/function/function_login.php");
	if(!isset($_POST['pseudo'])){
		$pseudo = "";
	}
	else{
		$pseudo = $_POST['pseudo'];
	}
	if(!isset($_POST['pass'])){
		$pass = "";
	}
	else{
		$pass = $_POST['pass'];
	}
	
	if(suscribe($pseudo, $pass)){
		header('Location: http://localhost/colaboraweb/index.php');
	}
	else{
		header('Location: http://localhost/colaboraweb/login/suscribe.php?pseudo='.$pseudo.'&pass='.$pass);
	}
	
?>