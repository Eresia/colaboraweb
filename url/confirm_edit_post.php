<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	if(!isset($_SESSION['id'])){
		header('Location: '.HTTP_ROOT.'/login/login.php');
	}
	else if(!isset($_POST['category']) || !is_category(intval($_POST['category'])) || !isset($_POST['id']) || !is_url(intval($_POST['id'])) || !isset($_POST['url']) || !isset($_POST['description']) || (getPost($_POST['id'])['author'] != $_SESSION['id'])){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		if(!filter_var($_POST['url'], FILTER_VALIDATE_URL)){
			$_SESSION['url'] = $_POST['category'];
			$_SESSION['description'] = $_POST['description'];
			$_SESSION['msg'] = "Vous n'avez pas rentré une URL valide";
			header('Location: '.HTTP_ROOT.'/url/createPost.php?category='.$_POST['category']);
		}
		else{
			edit_post(intval($_POST['id']), intval($_POST['category']), $_POST['url'], str_replace("\n", '<br />', htmlspecialchars($_POST['description'], ENT_QUOTES | ENT_XHTML, 'UTF-8')));
			header('Location: '.HTTP_ROOT.'/url/readPost.php?id='.$_POST['id']);
		}	
	}
	
	
?>