<?php
	define("LOGIN_FILE", SERV_ROOT.'/login/login.csv');
	define('AVATAR_WIDTH', 80);
	define('AVATAR_HEIGHT', 80);
	define('AVATAR_DEFAULT', HTTP_ROOT.'/images/avatar_default.gif');
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
	
	function set_info($id, $updateInfo){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$request = 'UPDATE profil SET ';
		$str = "";
		$info = array();
		$param = array(&$str);
		foreach($updateInfo as $key => $value){
			$request .= $key;
			$info[] = $value;
			$param[] = &$info[count($info) - 1];
			$str .= 's';
			$request .= ' = ?, ';
		}
		$request = substr($request, 0, -2);
		$request .= ' WHERE id = ?';
		$param[] = &$id;
		$str .= 'i';
		$update = $mysql->prepare($request);
		print_r($param);
		call_user_func_array(array($update, "bind_param"), $param);
		$update->execute();
	}
?>