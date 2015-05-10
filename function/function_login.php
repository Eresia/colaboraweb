<?php
	define("LOGIN_FILE", SERV_ROOT.'/login/login.csv');
	
	require_once(SERV_ROOT.'/define/mysql_define.php');
    
    function subscribe($pseudo, $pass, $right=1){
        if(right_pseudo($pseudo) && right_pass($pass)){
			$idMax = 0;
			if(file_exists(LOGIN_FILE)){
				$file = fopen(LOGIN_FILE, "r+");
				while($line = fgets($file)){
					$values = explode("\t", $line);
					if($values[1] == $pseudo){
						fclose($file);
						return false;
					}
					$id = strval($values[0]);
					if($id > $idMax){
						$idMax = $id;
					}
				}
				fseek($file, 0, SEEK_END);
			}
			else{
				$file = fopen(LOGIN_FILE, "w");
			}
			$passCrypt = password_hash($pass, PASSWORD_DEFAULT);
			$currentId = $idMax + 1;
			fputs($file, $currentId."\t".$pseudo."\t".$passCrypt."\t".$right."\n");
			
			fclose($file);
			$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
			$mysql->query("SET NAMES UTF8");
			$insertProfil = $mysql->prepare("INSERT INTO profil(user, date_inscription) VALUES(?, CURRENT_DATE())");
			$insertProfil->bind_param('i', $currentId);
			$insertProfil->execute();
			$insertProfil->close();
			$mysql->close();
			return true;
		}
		else{
			return false;
		}
    }
    
    function login($pseudo, $pass){
        if(right_pseudo($pseudo) && right_pass($pass)){
			if(file_exists(LOGIN_FILE)){
				$file = fopen(LOGIN_FILE, "r");
				while($line = fgets($file)){
					$values = explode("\t", $line);
					if(($values[1] == $pseudo) && password_verify($pass, $values[2])){
						fclose($file);
						$_SESSION['pseudo'] = $pseudo;
						$_SESSION['id'] = strval($values[0]);
						$_SESSION['group'] = strval($values[3]);
						return true;
					}
				}
				fclose($file);
				return false;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
    }
	
	function update_user($id, $pass,$rang=-1){
		$file = file(LOGIN_FILE);
		for($i = 0; $i < count($file); $i++){
			$line = explode("\t", $file[$i]);
			if(intval($line[0] == $id)){
				if($pass != ""){
					$line[2] = password_hash($pass, PASSWORD_DEFAULT);
				}
				if($rang != -1){
					$line[3] = $rang.'\n';
				}
				$file[$i] = $line[0];
				for($j = 1; $j < count($line); $j++){
				echo "::".$line[$j]."::";
					$file[$i] .= "\t".$line[$j];
				}
				break;
			}
		}
		file_put_contents(LOGIN_FILE, $file);
	}
	
	function delete_user($id){
		$file = file(LOGIN_FILE);
		for($i = 0; $i < count($file); $i++){
			if(intval(explode("\t", $file[$i])[0]) == $id){
				unset($file[$i]);
				break;
			}
		}
		file_put_contents(LOGIN_FILE, $file);
	}
	
	function get_users(){
		$result = array();
		if(file_exists(LOGIN_FILE)){
			$file = fopen(LOGIN_FILE, "r");
			while($line = fgets($file)){
				$values = explode("\t", $line);
				$result[] = array('id' => $values[0], 'name' => $values[1], 'rang' => $values[3]);
			}
			fclose($file);
		}
		return $result;
	}
    
    function disconnect(){
        if(isset($_SESSION['pseudo'])){
            session_destroy();
        }
    }

	function right_pseudo($pseudo){
		return ((strlen($pseudo) > 3) && (strlen($pseudo) < 10));
	}
	
	function right_pass($pass){
		return ((strlen($pass) > 3) && (strlen($pass) < 10));
	}







?>