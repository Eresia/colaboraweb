<?php

	/*Fichier d'appel de la fonction de supression de catégorie, on vérifie que la personne agissant est bien administrateur. Elle est redirigée vers index.php si ce n'est pas le cas*/

	session_start();
	require_once("../define/root_define.php");
	require_once("../define/admin_define.php");
	require_once("../function/function_post.php");
	
	if(!isset($_SESSION['group']) || ($_SESSION['group'] != ADMIN) || !isset($_GET['id'])){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		delete_category($_GET['id']);
		header('Location: '.HTTP_ROOT.'/administration/administration.php');
	}
?>