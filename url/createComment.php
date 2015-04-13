<?php
	session_start();
	require_once("../define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	function create_comment_page(){
		$result = beginPage(array(HTTP_ROOT.'/css/style3.css', HTTP_ROOT.'/css/stylePost.css'), "Créer un commentaire");
	
		$result .= begin_content();
		
		$url = intval($_GET['url']);
		if(isset($_SESSION['comment'])){
			$description = $_SESSION['comment'];
			$_SESSION['comment'] = "";
		}
		else{
			$comment = "";
		}
		
		if(isset($_SESSION['msg'])){
			$result .= $_SESSION['msg'];
			$_SESSION['msg'] = "";
		}
		
		$result .= display_post($url, getPost($url));
		
		$result .= '<div class="create">';
		$result .= '	<form method="post" action="confirm_comment.php" class="post_form">';
		$result .= '		<div><p>Commentaire : </p> <textarea rows="5" cols="100" name="comment">'.$comment.'</textarea></div>';
		$result .= '		<div><input type="hidden" name="url" value="'.$url.'" /></div>';
		$result .= '		<div><input type="submit" value="Poster" /></div>';
		$result .= '	</form>';
		$result .= '</div>';
		
		$result .= end_content();
	
		$result .= endPage();
		
		return $result;
	}
	
	if(!isset($_SESSION['id'])){
		header('Location: '.HTTP_ROOT.'/login/login.php?return=http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	}
	else if (!isset($_GET['url'])){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else if(!is_url(intval($_GET['url']))){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		echo indent(create_comment_page());
	}
?>