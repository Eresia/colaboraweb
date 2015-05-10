<?php
	
	/*Fichier appelant la fonction de modification des droits (et du mot de passe) des utilisateurs. On vérifie que la personne agissant est bien administrateur et on la redirige vers index.php si
	ce n'est pas le cas.*/

	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/define/admin_define.php");
	require_once(SERV_ROOT."../function/function_login.php");
	
	if(!isset($_SESSION['group']) || ($_SESSION['group'] != ADMIN) || !isset($_POST['id']) || !isset($_POST['rang']) || (intval($_POST['rang']) < USER) || (intval($_POST['rang']) > ADMIN) || ($_SESSION['id'] == $_POST['id'])){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		if(!isset($_POST['pass'])){
			$pass = '';
		}
		else{
			$pass = $_POST['pass'];
		}
		update_user($_POST['id'], $pass, $_POST['rang']);
		header('Location: '.HTTP_ROOT.'/administration/administration.php');
	}
?>