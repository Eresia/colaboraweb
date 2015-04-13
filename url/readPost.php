<?php
	session_start();
	require_once("../define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	function read_post_page($id, $post, $comments, $page){
		$result = beginPage(array(HTTP_ROOT.'/css/style3.css', HTTP_ROOT.'/css/stylePost.css'), 'Url '.$id);
			
		$result .= begin_content();
		
		$result .= display_post($post);
		
		$result .= display_comments($comments);
		
		$result .= display_pages($id, $page);
		
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
			echo indent(read_post_page($id, $post, $comments, $page));
		}
		else{
			header('Location: '.HTTP_ROOT.'/index.php');
		}
		
	}
	else{
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	
	
	
	
	
	
	
	
	
	endPage();
?>