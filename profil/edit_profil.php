<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT.'/define/mysql_define.php');
	require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	
	if(!isset($_SESSION['pseudo'])){
		header('Location: '.HTTP_ROOT.'/login/login.php?return=http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	}
	else{
		echo beginPage(array(HTTP_ROOT."/css/style3.css", HTTP_ROOT."/css/styleProfil.css"), 'Profil de '.$_SESSION['pseudo']);
		
		echo begin_content();
		
		if(isset($_GET['msg']) && isset($_GET['result'])){
			if($_GET['result'] == 'true'){
				echo '<div class="profil_message_validate"><p>'.$_GET['msg'].'</p></div>';
			}
			else{
				echo '<div class="profil_message_error"><p>'.$_GET['msg'].'</p></div>';
			}
		}

		$info = get_info($_SESSION['id'], array('avatar', 'date_inscription', 'description', 'sign'));
		
		echo '			<div class="profil_name">';
		echo '				<p>'.$_SESSION['pseudo'].'</p>';
		echo '			</div>';
		
		echo '			<div class="profil_date">';
		echo '				<p>Date d\'inscription : '.$info['date_inscription'].'</p>';
		echo '			</div>';
		
		echo '			<div class="profil_content">';
		if(strlen($info['avatar']) != 0){
			$avatar = $info['avatar'];
		}
		else{
			$avatar = AVATAR_DEFAULT;
		}
		echo '				<form method="post" action="confirm_profil.php" class="profil_form">';
		echo '					<img src="'.$avatar.'" width="'.AVATAR_WIDTH.'" height="'.AVATAR_HEIGHT.'" alt="Avatar" title="Avatar de '.$_SESSION['pseudo'].'" />';
		echo '					<div><p>Lien de l\'avatar : </p> <input type="text" name="avatar" value="'.$info['avatar'].'" /></div>';
		echo '					<div><p>Description : </p> <textarea rows="5" cols="100" name="description">'.str_replace('<br />', "\n", $info['description']).'</textarea></div>';
		echo '					<div><p>Signature : </p> <textarea rows="10" cols="100" name="sign">'.str_replace('<br />', "\n", $info['sign']).'</textarea></div>';
		echo '					<div><input type="submit" value="Modifier" /></div>';
		echo '				</form>';
		
		echo '			</div>';
		
		echo end_content();
		
		echo endPage();
	}
	
?>