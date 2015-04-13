<?php
	session_start();
	require_once("../define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	
	
	function consulte_profil_page(){
		$result = beginPage(array(HTTP_ROOT."/css/style3.css", HTTP_ROOT."/css/styleProfil.css"), 'Profil de '.$_GET['name']);
		
		$result .= begin_content();
		
		$id = get_id($_GET['name']);
		
		if($id != null){
			$info = get_info($id, array('avatar', 'date_inscription', 'description', 'sign'));
			
			$result .= '		<div class="profil_name">';
			$result .= '			<p>'.$_GET['name'].'</p>';
			$result .= '		</div>';
			
			$result .= '		<div class="profil_date">';
			$result .= '			<p>Date d\'inscription : '.$info['date_inscription'].'</p>';
			$result .= '		</div>';
			
			$result .= '		<div class="profil_content">';
			if(strlen($info['avatar']) != 0){
				$avatar = $info['avatar'];
			}
			else{
				$avatar = AVATAR_DEFAULT;
			}
			$result .= '			<img src="'.$avatar.'" width="'.AVATAR_WIDTH.'" height="'.AVATAR_HEIGHT.'" alt="" title="Avatar de '.$_GET['name'].'" />';
			$result .= '			<p>Description : '.$info['description'].'</p>';
			$result .= '			<p>Signature : '.$info['sign'].'</p>';
			$result .= '		</div>';
		}
		else{
			$result .= "<p>Profil inconnu</p>";
		}
		
		$result .= end_content();
		
		$result .= endPage();
		return $result;
	}
	if(!isset($_GET['name'])){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	
	else{
		echo indent(consulte_profil_page());
	}
?>