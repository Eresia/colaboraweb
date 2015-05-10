<?php
	session_start();
	require_once("../define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	function edit_post_page(){
		$result = beginPage(array(HTTP_ROOT.'/css/style3.css', HTTP_ROOT.'/css/stylePost.css'), "Créer un post");
		$result .= begin_content();
		
		$info = getPost($_POST['id']);
		$category  = $info['category'];
		
		if(isset($_SESSION['url'])){
			$url = $_SESSION['url'];
			$_SESSION['url'] = "";
		}
		else{
			$url = $info['url'];
		}
		
		if(isset($_SESSION['description'])){
			$description = $_SESSION['description'];
			$_SESSION['description'] = "";
		}
		else{
			$description = $info['description'];
		}
		
		if(isset($_SESSION['msg'])){
			$result .= $_SESSION['msg'];
			$_SESSION['msg'] = "";
		}
		
		$list_categories = get_categories();
		
		$categories = "";
		$id = 0;
		while(isset($list_categories[$id])){
			if($category == $list_categories[$id]['id']){
				$categories .= '<option value="'.$list_categories[$id]['id'].'" selected="selected">'.$list_categories[$id]['name'].'</option>';
			}
			else{
				$categories .= '<option value="'.$list_categories[$id]['id'].'">'.$list_categories[$id]['name'].'</option>';
			}
			$id = $list_categories[$id]['id'];
		}
		
		$result .= '<form method="post" action="confirm_edit_post.php" class="post_form">';
		$result .= '<div><p>Catégorie : </p> <select name="category" />'.$categories.'</select></div>';
		$result .= '<div><p>URL : </p> <input type="text" name="url" value="'.$url.'" /></div>';
		$result .= '<div><p>Description : </p> <textarea rows="5" cols="100" name="description">'.$description.'</textarea></div>';
		$result .= '<div><input type="hidden" name="id" value="'.$_POST['id'].'" /></div>';
		$result .= '<div><input type="submit" value="Poster" /></div>';
		$result .= '</form>';
		
		$result .= end_content();
		
		$result .= endPage();
		
		return $result;
	}
	
	if(!isset($_POST['id']) || !isset($_SESSION['id']) || !(($_SESSION['id'] == getPost($_POST['id'])['author']) || ($_SESSION['group'] == ADMIN))){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		echo indent(edit_post_page());
	}
?>