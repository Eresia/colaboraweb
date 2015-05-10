<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	if(!isset($_SESSION['id'])){
		header('Location: '.HTTP_ROOT.'/login/login.php');
	}
	else if(!isset($_POST['id']) || !is_url(intval($_POST['id'])) || !((getPost($_POST['id'])['author'] == $_SESSION['id']) || ($_SESSION['group'] == ADMIN))){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		remove_post(intval($_POST['id']));
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	
	
?>