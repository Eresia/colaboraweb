<?php
	session_start();
	require_once("../define/root_define.php");
	require_once("../define/admin_define.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	if(!isset($_SESSION['group'])){
		$_SESSION['return'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		header('Location: '.HTTP_ROOT.'/login/login.php');
	}
	else if(($_SESSION['group'] < EVALU) || !isset($_GET['id']) || !is_url($_GET['id']) || !isset($_GET['note']) || (intval($_GET['note']) < 1) || (intval($_GET['note']) > 10)){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		add_notation($_SESSION['id'], $_GET['id'], $_GET['note']);
		header('Location: '.HTTP_ROOT.'/url/readPost.php?id='.$_GET['id']);	
	}
	
	
?>