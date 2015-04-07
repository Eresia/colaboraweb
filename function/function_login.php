<?php
	define("LOGIN_FILE", SERV_ROOT.'/login/login.csv');
	
	require_once(SERV_ROOT.'/define/mysql_define.php');
    
    function suscribe($pseudo, $pass){
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
			$right = 1;
			$passCrypt = password_hash($pass, PASSWORD_DEFAULT);
			$currentId = $idMax + 1;
			fputs($file, $currentId."\t".$pseudo."\t".$passCrypt."\t".$right."\n");
			
			fclose($file);
			$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
			$mysql->query("SET NAMES UTF8");
			$insertProfil = $mysql->prepare("INSERT  INTO profil(user, date_inscription) VALUES(?, CURRENT_DATE())");
			$insertProfil->bind_param('i', $currentId);
			$insertProfil->execute();
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