<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT.'/define/mysql_define.php');
	require_once(SERV_ROOT."/function/function_login.php");
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
	
	if(login($pseudo, $pass)){
		if(isset($_POST['return']) && filter_var($_POST['return'], FILTER_VALIDATE_URL)){
			header('Location: '.$_POST['return']);
		}
		else{
			header('Location: '.HTTP_ROOT.'/index.php');
		}
	}
	else{
		if(isset($_POST['return'])){
			$return = $_POST['return'];
		}
		else{
			$return = "";
		}
		header('Location: '.HTTP_ROOT.'/login/login.php?return='.$return.'&pseudo='.$pseudo.'&pass='.$pass);
	}
	
?>