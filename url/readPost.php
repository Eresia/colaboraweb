<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/define/admin_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	function read_post_page($id, $post, $comments, $page, $current_comment, $msg){
		$result = beginPage(array(HTTP_ROOT.'/css/style3.css', HTTP_ROOT.'/css/stylePost.css'), 'Url '.$id);
			
		$result .= begin_content();
		
		$result .= display_post($post);
		
		$result .= display_comments($comments);
		
		$result .= display_pages($id, $page);
		
		if(isset($_SESSION['group']) && ($_SESSION['group'] >= EVALU)){
			$result .= '<div class="create_comment">';
			if(strlen($msg) != 0){
				$result .= '<p>'.$msg.'</p>';
			}
			$result .= '<form method="post" action="confirm_comment.php" class="post_form">';
			$result .= '<div><p>Commentaire : </p> <textarea rows="5" cols="100" name="comment">'.$current_comment.'</textarea></div>';
			$result .= '<div><input type="hidden" name="url" value="'.$id.'" /></div>';
			$result .= '<div><input type="submit" value="Poster" /></div>';
			$result .= '</form>';
			$result .= '</div>';
		}
		
		$result .= end_content();
		
		$result .= endPage();
		
		return $result;
	}
	
	if(isset($_GET['id'])){
		$id = intval($_GET['id']);
		if(!isset($_GET['page'])){
			$page = 1;
		}
		else{
			$page = intval($_GET['page']);
		}
		$post = getPost($id);
		$comments = getComments($id, $page);
		
		if(!empty($post) && (!empty($comments) || ($page == 1))){
			if(isset($_SESSION['comment'])){
				$current_comment = $_SESSION['comment'];
				$_SESSION['comment'] = "";
			}
			else{
				$current_comment = "";
			}
			
			if(isset($_SESSION['msg'])){
				$msg = $_SESSION['msg'];
				$_SESSION['msg'] = "";
			}
			else{
				$msg = "";
			}
			echo indent(read_post_page($id, $post, $comments, $page, $current_comment, $msg));
		}
		else{
			header('Location: '.HTTP_ROOT.'/index.php');
		}
		
	}
	else{
		header('Location: '.HTTP_ROOT.'/index.php');
	}
?>