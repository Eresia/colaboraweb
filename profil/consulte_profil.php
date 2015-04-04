<?php
	session_start();
	define("HTTP_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?"http://".$_SERVER['HTTP_HOST']."/colaboraweb":"http://".$_SERVER['HTTP_HOST']);
	define("SERV_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?$_SERVER['DOCUMENT_ROOT']."/colaboraweb":$_SERVER['DOCUMENT_ROOT']);
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	if(!isset($_GET['name'])){
		echo beginPage(array(HTTP_ROOT."/css/style3.css"), 'Aucun profil sélectionné');
		echo "<p>Aucun profil sélectionné</p>";
	}
	else{
		echo beginPage(array(HTTP_ROOT."/css/style3.css"), 'Profil de '.$_GET['name']);
		$id = get_id($_GET['name']);
		if($id != null){
			$info = get_info($id, array('avatar', 'date_inscription', 'description', 'sign'));
			
		}
		else{
			echo "<p>Profil inconnu</p>";
		}
	}
	
	echo endPage();
?>