<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT.'/define/mysql_define.php');
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
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
		echo beginPage(array(HTTP_ROOT.'/css/style3.css', HTTP_ROOT.'/css/stylePost.css'), "Créer un commentaire");
	
		echo begin_content();
		
		$url = intval($_GET['url']);
		if(isset($_SESSION['comment'])){
			$description = $_SESSION['comment'];
			$_SESSION['comment'] = "";
		}
		else{
			$comment = "";
		}
		
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
		}
		
		echo display_post($url, getPost($url));
		
		echo '<div class="create">';
		echo '	<form method="post" action="confirm_comment.php" class="post_form">';
		echo '		<div><p>Commentaire : </p> <textarea rows="5" cols="100" name="comment">'.$comment.'</textarea></div>';
		echo '		<div><input type="hidden" name="url" value="'.$url.'" /></div>';
		echo '		<div><input type="submit" value="Poster" /></div>';
		echo '	</form>';
		echo '</div>';
		
		echo end_content();
	
		echo endPage();
	}
?>