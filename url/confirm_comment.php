<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	if(!isset($_SESSION['group'])){
		header('Location: '.HTTP_ROOT.'/login/login.php');
	}
	else if(($_SESSION['group'] < EVALU) || !isset($_POST['url']) || !is_url(intval($_POST['url'])) || !isset($_POST['comment'])){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		$url = intval($_POST['url']);
		create_comment($_SESSION['id'], $url, str_replace("\n", '<br />', htmlspecialchars($_POST['comment'], ENT_QUOTES | ENT_XHTML, 'UTF-8')));
		header('Location: '.HTTP_ROOT.'/url/readPost.php?id='.$url.'&page='.get_nb_pages($url));
	}
	
	
?>