<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	
	function edit_profil_page(){
		$result = beginPage(array(HTTP_ROOT."/css/style3.css", HTTP_ROOT."/css/styleProfil.css"), 'Profil de '.$_SESSION['pseudo']);
		
		$result .= begin_content();
		
		if(isset($_GET['msg']) && isset($_GET['result'])){
			if($_GET['result'] == 'true'){
				$result .= '<div class="profil_message_validate"><p>'.$_GET['msg'].'</p></div>';
			}
			else{
				$result .= '<div class="profil_message_error"><p>'.$_GET['msg'].'</p></div>';
			}
		}

		$info = get_info($_SESSION['id'], array('avatar', 'date_inscription', 'description', 'sign'));
		
		$result .= '<div class="profil_name">';
		$result .= '<p>'.$_SESSION['pseudo'].'</p>';
		$result .= '</div>';
		
		$result .= '<div class="profil_date">';
		$result .= '<p>Date d\'inscription : '.$info['date_inscription'].'</p>';
		//echo '<p class="consult_inslink">Consulter profil : <a href="./consulte_profil.php?name=Monsieur>Go</a></p>';
		$result .= '</div>';
		
		$result .= '<div class="profil_content">';
		if(strlen($info['avatar']) != 0){
			$avatar = $info['avatar'];
		}
		else{
			$avatar = AVATAR_DEFAULT;
		}
		$result .= '<form method="post" action="confirm_profil.php" class="profil_form">';
		$result .= '<img class="img_avatar" src="'.$avatar.'" alt="Avatar" title="Avatar de '.$_SESSION['pseudo'].'" />';
		$result .= '<div><p>Lien de l\'avatar : </p> <input type="text" name="avatar" value="'.$info['avatar'].'" /></div>';
		$result .= '<div><p>Description : </p> <textarea rows="5" cols="100" name="description">'.str_replace('<br />', "\n", $info['description']).'</textarea></div>';
		$result .= '<div><p>Signature : </p> <textarea rows="10" cols="100" name="sign">'.str_replace('<br />', "\n", $info['sign']).'</textarea></div>';
		$result .= '<div><input type="submit" value="Modifier" /></div>';
		$result .= '</form>';
		
		$result .= '</div>';
		
		$result .= end_content();
		
		$result .= endPage();
		
		return $result;
	}
	
	if(!isset($_SESSION['pseudo'])){
		$_SESSION['return'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		header('Location: '.HTTP_ROOT.'/login/login.php');
	}
	else{
		echo indent(edit_profil_page());
	}
	
?>