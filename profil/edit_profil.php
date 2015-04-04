<?php
	session_start();
	define("HTTP_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?"http://".$_SERVER['HTTP_HOST']."/colaboraweb":"http://".$_SERVER['HTTP_HOST']);
	define("SERV_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?$_SERVER['DOCUMENT_ROOT']."/colaboraweb":$_SERVER['DOCUMENT_ROOT']);
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	
	if(!isset($_SESSION['pseudo'])){
		echo beginPage(array(HTTP_ROOT."/css/style3.css",), 'Non connecté');
		echo "<p>Vous n'êtes pas connecté</p>";
	}
	else{
		echo beginPage(array(HTTP_ROOT."/css/style3.css", HTTP_ROOT."/css/styleProfil.css"), 'Profil de '.$_SESSION['pseudo']);
		echo '<div class="wrap">';
		echo headerPage();
		echo '	<div class="core">';
		echo topMenu();
		echo rightMenu();
		echo '		<div class="content">';

		$info = get_info($_SESSION['id'], array('avatar', 'date_inscription', 'description', 'sign'));
		
		echo '			<div class="profil_name">';
		echo '				<p>'.$_SESSION['pseudo'].'</p>';
		echo '			</div>';
		
		echo '			<div class=profil_date>';
		echo '				<p>Date d\'inscription : '.$info['date_inscription'].'</p>';
		echo '			</div>';
		
		echo '			<div class="profil_content">';
		if(strlen($info['avatar']) != 0){
			$avatar = $info['avatar'];
		}
		else{
			$avatar = AVATAR_DEFAULT;
		}
		echo '				<a href=""><img src="'.$avatar.'" width="'.AVATAR_WIDTH.'" height="'.AVATAR_HEIGHT.'" alt="Avatar" title="Modifier son avatar"/></a>';
		echo '				<form method="post" action="confirm_login.php" class="log_form">';
		echo '					<div><p>Description : </p> <textarea rows="5" cols="100" name="description">'.$info['description'].'</textarea></div>';
		echo '					<div><p>Signature : </p> <textarea rows="10" cols="100" name="sign">'.$info['sign'].'</textarea></div>';
		echo '					<div><input type="submit" value="Modifier" /></div>';
		echo '				</form>';
		echo '			</div>';
		echo '			</div>';
		echo '		</div>';
		echo '	</div>';
		echo footerPage();
		echo '</div>';
	}
	
	echo endPage();
?>