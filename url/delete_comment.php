<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	if(!isset($_SESSION['id'])){
		header('Location: '.HTTP_ROOT.'/login/login.php');
	}
	else if(!isset($_POST['id']) || !is_comment(intval($_POST['id'])) || !((getComment($_POST['id'])['author'] == $_SESSION['id']) || ($_SESSION['group'] == ADMIN))){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		delete_comment(intval($_POST['id']));
		if(!isset($_POST['url']) || !is_url($_POST['url'])){
			header('Location: '.HTTP_ROOT.'/index.php');
		}
		else{
			header('Location: '.HTTP_ROOT.'/url/readPost.php?id='.$_POST['url']);
		}
	}
	
	
?>