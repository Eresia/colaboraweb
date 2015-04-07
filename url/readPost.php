<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT.'/define/mysql_define.php');
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	if(isset($_GET['id'])){
		$id = intval($_GET['id']);
		if(!isset($_GET['page'])){
			$page = 1;
		}
		else{
			$page = intval($_GET['page']);
		}
		$post = getPost($id);
		$nbPages = get_nb_pages($id);
		$comments = getComments($id, $page);
		
		if(!empty($post) && (!empty($comments) || ($page == 1))){
			echo beginPage(array(HTTP_ROOT.'/css/style3.css', HTTP_ROOT.'/css/stylePost.css'), 'Url '.$id);
			
			echo begin_content();
			
			echo display_post($id, $post);
			
			echo display_comments($comments);
			
			echo display_pages($page, $nbPages, get_pseudo($id));
			
			echo end_content();
			
			echo endPage();
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