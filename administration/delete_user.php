<?php
	session_start();
	require_once("../define/root_define.php");
	require_once("../define/admin_define.php");
	require_once("../function/function_login.php");
	require_once("../function/function_post.php");
	
	if(!isset($_SESSION['group']) || ($_SESSION['group'] != ADMIN) || !isset($_GET['id']) || ($_GET['id'] == $_SESSION['id'])){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		delete_user($_GET['id']);
		delete_user_data($_GET['id']);
		header('Location: '.HTTP_ROOT.'/administration/administration.php');
	}
?>