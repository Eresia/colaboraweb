<?php

	/*Fichier appelant la fonction d'ajout d'utilisateur. On vérifie que la personne agissant est bien administrateur et on la redirige vers index.php si ce n'est pas le cas.*/

	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/define/admin_define.php");
	require_once(SERV_ROOT."../function/function_login.php");
	
	if(!isset($_SESSION['group']) || ($_SESSION['group'] != ADMIN) || !isset($_POST['name']) || ($_POST['name'] == '') || !isset($_POST['pass']) || ($_POST['pass'] == '') || !isset($_POST['rang']) || (intval($_POST['rang']) < USER) || (intval($_POST['rang']) > ADMIN)){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		subscribe($_POST['name'], $_POST['pass'], $_POST['rang']);
		header('Location: '.HTTP_ROOT.'/administration/administration.php');
	}
?>