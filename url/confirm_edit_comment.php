<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	if(!isset($_SESSION['id'])){
		header('Location: '.HTTP_ROOT.'/login/login.php');
	}
	else if(!isset($_POST['id']) || !is_comment(intval($_POST['id'])) || !isset($_POST['id']) || !isset($_POST['url']) || !is_url($_POST['url']) || !isset($_POST['comment']) || !((getComment($_POST['id'])['author'] == $_SESSION['id']) || ($_SESSION['group'] >= ADMIN))){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		edit_comment(intval($_POST['id']),  str_replace("\n", '<br />', htmlspecialchars($_POST['comment'], ENT_QUOTES | ENT_XHTML, 'UTF-8')));
		header('Location: '.HTTP_ROOT.'/url/readPost.php?id='.$_POST['url']);
	}
	
	
?>