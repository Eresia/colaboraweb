<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	require_once(SERV_ROOT."/function/function_login.php");
	
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
	
	if(isset($_POST['pass']) && isset($_POST['confirmPass'])){
		if($_POST['pass'] == $_POST['confirmPass']){
			if(right_pass($_POST['pass'])){
				update_user($_SESSION['id'], $_POST['pass']);
			}
			else{
				$msg = "Le mot de passe n'est pas conforme";
				header('Location: edit_profil.php?msg='.$msg.'&result=false');
			}
		}
		else{
			$msg = "Les mots de passes ne sont pas identiques";
			header('Location: edit_profil.php?msg='.$msg.'&result=false');
		}
	}
	
	if(isset($_POST['description'])){
		if(strlen($_POST['description']) <= DESCRIPTION_MAX){
			$validDescription = true;
			$description = str_replace("\n", '<br />', htmlspecialchars($_POST['description'], ENT_QUOTES | ENT_XHTML, 'UTF-8'));
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
			$sign = str_replace("\n", '<br />', htmlspecialchars($_POST['sign'], ENT_QUOTES | ENT_XHTML, 'UTF-8'));
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
		//$msg = "Mise à jour des info réussi";
		//header('Location: edit_profil.php?msg='.$msg.'&result=true');
	}	
?>