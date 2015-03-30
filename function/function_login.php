<?php
	define("LOGIN_FILE", 'login.csv');
    
    function suscribe($pseudo, $pass){
        if(right_pseudo($pseudo) && right_pass($pass)){
			$idMax = 0;
			if(file_exists(LOGIN_FILE)){
				$file = fopen(LOGIN_FILE, "r+");
				while($line = fgets($file)){
					$id = strval(explode('\t', $line)[0]);
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
			fputs($file, ($idMax+1)."\t".$pseudo."\t".$pass."\t".$right."\n");
			
			fclose($file);
			return true;
		}
		else{
			return false;
		}
    }
    
    function login($pseudo, $pass){
        if(isset($_SESSION['pseudo'])){
            return "<p>Vous êtes déja connecté</p>";
        }
        else{
            $_SESSION['pseudo'] = "test";
            return "<p>Vous avez bien été connecté</p>";
        }
    }
    
    function disconnect(){
        if(isset($_SESSION['pseudo'])){
            session_destroy();
            return "<p>Vous avez bien été déconnecté</p>";
        }
        else{
            return "<p>Vous n'êtes pas connecté</p>";
        }
    }

	function right_pseudo($pseudo){
		return ((strlen($pseudo) > 3) && (strlen($pseudo) < 10));
	}
	
	function right_pass($pass){
		return ((strlen($pass) > 3) && (strlen($pass) < 10));
	}







?>