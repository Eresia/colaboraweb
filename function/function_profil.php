<?php
	define("LOGIN_FILE", '../login/login.csv');
	define('AVATAR_WIDTH', 200);
	define('AVATAR_HEIGHT', 150);
	require_once(SERV_ROOT.'/define/mysql_define.php');
	
	function get_id($pseudo){
		$file = fopen(LOGIN_FILE, "r");
		while($line = fgets($file)){
			$values = explode("\t", $line);
			if($values[1] == $pseudo){
				fclose($file);
				return $values[0];
			}
		}
		fclose($file);
		return null;
	}
	
	function get_pseudo($id){
		$file = fopen(LOGIN_FILE, "r");
		while($line = fgets($file)){
			$values = explode("\t", $line);
			if($values[0] == $id){
				fclose($file);
				return $values[1];
			}
		}
		fclose($file);
		return null;
	}
	
	function get_info($id, $infoAsked){
		$info = array();
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$dtbInfo = $mysql->prepare('SELECT date_inscription,avatar,description,sign FROM profil WHERE user=?');
		$dtbInfo->bind_param('i', $id);
		$dtbInfo->execute();
		$dtbInfo->bind_result($info['date_inscription'], $info['avatar'], $info['description'], $info['sign']);
		if($dtbInfo->fetch()){
			$infoFinal = array();
			for($i = 0; $i < count($infoAsked); $i++){
				$infoFinal[$infoAsked[$i]] = $info[$infoAsked[$i]];
			}
			return $infoFinal;
		}	
		else{
			return null;
		}
	
	}
?>