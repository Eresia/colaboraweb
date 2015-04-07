<?php
	define("LOGIN_FILE", SERV_ROOT.'/login/login.csv');
	
	define('AVATAR_WIDTH', 80);
	define('AVATAR_HEIGHT', 80);
	define('AVATAR_DEFAULT', HTTP_ROOT.'/images/avatar_default.gif');
	
	define('DESCRIPTION_MAX', 255);
	define('SIGN_MAX', 255);
	
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
		$mysql->query("SET NAMES UTF8");
		$request = 'SELECT ';
		$param = array();
		$info = array();
		for($i = 0; $i < count($infoAsked); $i++){
			$request .= $infoAsked[$i];
			$info[] = '';
			$param[] = &$info[count($info) - 1];
			$request .= ',';
		}
		$request = substr($request, 0, -1);
		$request .=  ' FROM profil WHERE user=?';
		$dtbInfo = $mysql->prepare($request);
		$dtbInfo->bind_param('i', $id);
		$dtbInfo->execute();
		call_user_func_array(array($dtbInfo, "bind_result"), $param);
		if($dtbInfo->fetch()){
			$infoFinal = array();
			for($i = 0; $i < count($infoAsked); $i++){
				$infoFinal[$infoAsked[$i]] = $info[$i];
			}
			return $infoFinal;
		}	
		else{
			return null;
		}
	
	}
	
	function set_info($id, $updateInfo){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
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
		call_user_func_array(array($update, "bind_param"), $param);
		$update->execute();
	}
?>