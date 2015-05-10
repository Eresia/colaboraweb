<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/define/admin_define.php");
	require_once(SERV_ROOT."../function/function_login.php");
	
	if(!isset($_SESSION['group']) || ($_SESSION['group'] != ADMIN) || !isset($_POST['id']) || !isset($_POST['rang']) || (intval($_POST['rang']) < USER) || (intval($_POST['rang']) > ADMIN) || ($_SESSION['id'] == $_POST['id'])){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		if(!isset($_POST['pass'])){
			$pass = '';
		}
		else{
			$pass = $_POST['pass'];
		}
		update_user($_POST['id'], $pass, $_POST['rang']);
		header('Location: '.HTTP_ROOT.'/administration/administration.php');
	}
?>