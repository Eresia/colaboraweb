<?php
	session_start();
	define("HTTP_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?"http://".$_SERVER['HTTP_HOST']."/colaboraweb":"http://".$_SERVER['HTTP_HOST']);
	define("SERV_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?$_SERVER['DOCUMENT_ROOT']."/colaboraweb":$_SERVER['DOCUMENT_ROOT']);
	require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	
	if(isset($_POST['avatar'])){
		$tabAvatar = explode('.', $_POST['avatar']);
		$emptyAvatar = (strlen($_POST['avatar']) == 0);
		$isRightURL = filter_var($_POST['avatar'], FILTER_VALIDATE_URL);
		$isImg = (in_array($tabAvatar[count($tabAvatar) - 1], array('jpg', 'jpeg', 'gif', 'png', 'bmp')));
		if($emptyAvatar || ($isRightURL && $isImg)){
			$validAvatar = true;
			$avatar = $_POST['avatar'];
		}
		else{
			$validAvatar = false;
			$msg = "L'URL n'est pas valide ou n'est pas une image";
			header('Location: edit_profil.php?msg='.$msg.'&result=false');
		}
	}
	else{
		$validAvatar = false;
		$msg = "L'avatar n'est pas défini";
		header('Location: edit_profil.php?msg='.$msg.'&result=false');
	}
	
	if(isset($_POST['description'])){
		if(strlen($_POST['description']) <= DESCRIPTION_MAX){
			$validDescription = true;
			$description = htmlspecialchars($_POST['description'], ENT_QUOTES | ENT_XHTML, 'UTF-8');
		}
		else{
			$validDescription = false;
			$msg = "Description trop longue, ".DESCRIPTION_MAX." caract max";
			header('Location: edit_profil.php?msg='.$msg.'&result=false');
		}
	}
	else{
		$validDescription = false;
		$msg = "La description n'est pas défini";
		header('Location: edit_profil.php?msg='.$msg.'&result=false');
	}
	
	if(isset($_POST['sign'])){
		if(strlen($_POST['sign']) <= SIGN_MAX){
			$validSign = true;
			$sign = htmlspecialchars($_POST['sign'], ENT_QUOTES | ENT_XHTML, 'UTF-8');
		}
		else{
			$validSign = false;
			$msg = "Signature trop longue, ".SIGN_MAX." caract max";
			header('Location: edit_profil.php?msg='.$msg.'&result=false');
		}
	}
	else{
		$validSign = false;
		$msg = "La signature n'est pas défini";
		header('Location: edit_profil.php?msg='.$msg.'&result=false');
	}
	
	if($validAvatar && $validDescription && $validSign){
		set_info($_SESSION['id'], array('avatar' => $avatar, 'description' => $description, 'sign' => $sign));
		$msg = "Mise à jour des info réussi";
		header('Location: edit_profil.php?msg='.$msg.'&result=true');
	}	
?>