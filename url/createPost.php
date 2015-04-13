<?php
	session_start();
	require_once("../define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	function create_post_page(){
		$result = beginPage(array(HTTP_ROOT.'/css/style3.css', HTTP_ROOT.'/css/stylePost.css'), "Créer un post");
		
		$result .= begin_content();
		
		if(is_category(intval($_GET['category']))){
			$category = intval($_GET['category']);
		}
		else{
			$category = 1;
		}
		
		if(isset($_SESSION['url'])){
			$url = $_SESSION['url'];
			$_SESSION['url'] = "";
		}
		else{
			$url = "";
		}
		
		if(isset($_SESSION['description'])){
			$description = $_SESSION['description'];
			$_SESSION['description'] = "";
		}
		else{
			$description = "";
		}
		
		if(isset($_SESSION['msg'])){
			$result .= $_SESSION['msg'];
			$_SESSION['msg'] = "";
		}
		
		$list_categories = get_categories();
		
		$categories = "";
		foreach($list_categories as $id => $values){
			$categories = '<option value="'.$id.'">'.$values.'</option>';
		}
		
		$result .= '<form method="post" action="confirm_post.php" class="post_form">';
		$result .= '	<div><p>Catégorie : </p> <select name="category" />'.$categories.'</select></div>';
		$result .= '	<div><p>URL : </p> <input type="text" name="url" value="'.$url.'" /></div>';
		$result .= '	<div><p>Description : </p> <textarea rows="5" cols="100" name="description">'.$description.'</textarea></div>';
		$result .= '	<div><input type="submit" value="Poster" /></div>';
		$result .= '</form>';
		
		$result .= end_content();
		
		$result .= endPage();
		
		return $result;
	}
	
	if(!isset($_SESSION['id'])){
		header('Location: '.HTTP_ROOT.'/login/login.php?return=http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	}
	else if (!isset($_GET['category'])){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		echo indent(create_post_page());
	}
?>