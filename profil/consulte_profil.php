<?php
	session_start();
	require_once("../define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	if(!isset($_GET['name'])){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		echo beginPage(array(HTTP_ROOT."/css/style3.css", HTTP_ROOT."/css/styleProfil.css"), 'Profil de '.$_GET['name']);
		echo '<div class="wrap">';
		echo headerPage();
		echo '	<div class="core">';
		echo topMenu();
		echo rightMenu();
		echo '		<div class="content">';
		$id = get_id($_GET['name']);
		
		if($id != null){
			$info = get_info($id, array('avatar', 'date_inscription', 'description', 'sign'));
			
			echo '		<div class="profil_name">';
			echo '			<p>'.$_GET['name'].'</p>';
			echo '		</div>';
			
			echo '		<div class="profil_date">';
			echo '			<p>Date d\'inscription : '.$info['date_inscription'].'</p>';
			echo '		</div>';
			
			echo '		<div class="profil_content">';
			if(strlen($info['avatar']) != 0){
				$avatar = $info['avatar'];
			}
			else{
				$avatar = AVATAR_DEFAULT;
			}
			echo '			<img src="'.$avatar.'" width="'.AVATAR_WIDTH.'" height="'.AVATAR_HEIGHT.'" alt="" title="Avatar de '.$_GET['name'].'" />';
			echo '			<p>Description : '.$info['description'].'</p>';
			echo '			<p>Signature : '.$info['sign'].'</p>';
			echo '		</div>';
		}
		else{
			echo "<p>Profil inconnu</p>";
		}
		echo '		</div>';
		echo '	</div>';
		echo footerPage();
		echo '</div>';
		echo endPage();
	}
?>