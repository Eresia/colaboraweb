<?php 
    session_start();
	require_once("../define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_login.php");
	
	function login_page(){
		$result = beginPage(array(HTTP_ROOT."/css/style3.css", HTTP_ROOT."/css/styleLogin.css"), 'Se connecter');

		$result .= begin_content();

		if(isset($_SESSION['pseudo'])){
			$result .= '<p>Vous êtes déja connecté</p>';
		}
		else{
			$result .= "<form method=\"post\" action=\"confirm_login.php\" class=\"log_form\">";
			if(isset($_GET['pseudo'])){
				$pseudo = $_GET['pseudo'];
				$result .= "<p>Mauvaise combinaison pseudo/mot de passe</p>";
			}
			else{
				$pseudo = "";
			}
			
			if(isset($_GET['password'])){
				$pass = $_GET['password'];
			}
			else{
				$pass = "";
			}
			
			$result .= "<div><label for=\"pseudo\" class=\"ps\">Pseudo : </label><input type=\"text\" name=\"pseudo\" value=\"".$pseudo."\" class=\"ps\" /><br/>";
			$result .= "<label for=\"mdp\" class= \"mdp\">Mot de passe : </label><input type=\"password\" name=\"pass\" value=\"".$pass."\" class=\"mdp\"/>";
			if(isset($_SESSION['return'])){
				$result .= '<input type="hidden" name="return" value="'.$_SESSION['return'].'" />';
				$_SESSION['return'] = "";
			}
			$result .= "<p class=\"okb\"><input type=\"submit\" value=\"Valider\" /></p>";
			$result .= "<p class=\"subscribe\"><a href=\"subscribe.php\" class=\"subscribe\">S'inscrire</a></p>"; 
			$result .= "</form>";
			
		}
					
		$result .= end_content();
		$result .= endPage();
		
		return $result;
	}
	
	echo indent(login_page());
?>