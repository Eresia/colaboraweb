<?php
	session_start();
	require_once("../define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	function edit_post_page(){
		$result = beginPage(array(HTTP_ROOT.'/css/style3.css', HTTP_ROOT.'/css/stylePost.css'), "Editer un commentaire");
		$result .= begin_content();
		
		$info = getComment($_POST['id']);
		
		if(isset($_SESSION['url'])){
			$url = $_SESSION['url'];
			$_SESSION['url'] = "";
		}
		else{
			$url = $info['url'];
		}
		
		if(isset($_SESSION['comment'])){
			$comment = $_SESSION['comment'];
			$_SESSION['comment'] = "";
		}
		else{
			$comment = str_replace('<br />', "\n", $info['comment']);
		}
		
		if(isset($_SESSION['msg'])){
			$result .= $_SESSION['msg'];
			$_SESSION['msg'] = "";
		}
		
		$result .= '<form method="post" action="confirm_edit_comment.php" class="post_form">';
		$result .= '<div><p>Commentaire : </p> <textarea rows="5" cols="100" name="comment">'.$comment.'</textarea></div>';
		$result .= '<div><input type="hidden" name="id" value="'.$_POST['id'].'" /></div>';
		$result .= '<div><input type="hidden" name="url" value="'.$info['url'].'" /></div>';
		$result .= '<div><input type="submit" value="Poster" /></div>';
		$result .= '</form>';
		
		$result .= end_content();
		
		$result .= endPage();
		
		return $result;
	}
	
	if(!isset($_POST['id']) || !is_comment($_POST['id']) || !isset($_SESSION['id']) || !(($_SESSION['id'] == getComment($_POST['id'])['author']) || ($_SESSION['group'] == ADMIN))){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		echo indent(edit_post_page());
	}
?>