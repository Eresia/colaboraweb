<?php
	session_start();
	require_once("../define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_administration.php");
	require_once(SERV_ROOT."/function/function_login.php");
	require_once(SERV_ROOT."/function/function_post.php");
	
	function administration_page(){
		$result = beginPage(array(HTTP_ROOT."/css/style3.css", HTTP_ROOT."/css/styleAdministration.css"), 'Administration');
		
		$result .= begin_content();
		
		$result .= '<div class="admin" id="admin_list">';
		$result .= '<ul>';
		$result .= '<li><a href="#admin_category">Categories</a></li>';
		$result .= '<li><a href="#admin_users">Utilisateurs</a></li>'; 
		$result .= '</ul>';
		$result .= '</div>';
		
		$result .= '<div class="admin" id="admin_category">';
		$result .= get_admin_categories();
		$result .= '</div>';
		
		$result .= '<div class="space"></div>';

		$result .= '<div class="admin" id="admin_users">';
		$result .= get_admin_users();
		$result .= '</div>';
		
		$result .= end_content();
		
		$result .= endPage();
		
		return $result;
	}
	
	if(!isset($_SESSION['group']) || ($_SESSION['group'] != ADMIN)){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		echo indent(administration_page());
	}
?>