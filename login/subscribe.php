<?php 
    session_start();
	require_once("../define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_login.php");
	
	function subscribe_page(){
		$result = beginPage(array(HTTP_ROOT."/css/style3.css", HTTP_ROOT."/css/styleSubscribe.css"), "S'inscrire");

		$result .= begin_content();
		
		$goodPseudo = false;
		if(isset($_SESSION['pseudo'])){
			$result .= '<p class="err">Vous êtes déja connecté</p>';
		}
		else{
			$result .= "<form method=\"post\" action=\"confirm_subscription.php\" class=\"sub_form\"><div>";
			if(isset($_GET['pseudo'])){
				if(!right_pseudo($_GET['pseudo'])){
					$result .= "<p class=\"err\">Merci de mettre un pseudo valide (entre 3 et 10 caractères)</p>";
				}
				else{
					$goodPseudo = true;
				}
				$pseudo = $_GET['pseudo'];
			}
			else{
				$pseudo = "";
			}
			$goodPass = false;
			if(isset($_GET['same'])){
				if($_GET['same'] == "false"){
					$result .= "<p class=\"err\">Les deux mots de passes ne sont pas égaux</p>";
				}
				else{
					if(isset($_GET['password'])){
						if(!right_pass($_GET['password'])){
							$result .= "<p class=\"err\">Merci de mettre un mot de passe valide (entre 3 et 10 caractères)</p>";
						}
						else{
							$goodPass = true;
						}
					}
				}
			}
			
			if($goodPseudo && $goodPass){
				$result .= "<p class=\"err\">Pseudo invalide ou déjà utilisé</p>";
			}
			
			$result .= "<label class=\"ps_s\">Pseudo : </label><input type=\"text\" name=\"pseudo\" value=\"".$pseudo."\" class=\"ps_s\"/>";
			$result .= "<label class=\"mdp_s\">Mot de passe : </label><input type=\"password\" name=\"pass\" class=\"mdp_s\"/>";
			$result .= "<label class=\"mdp_s\">Confirmer votre mot de passe : </label><input type=\"password\" name=\"confirmpass\" class=\"mdp_s\"/>";
			$result .= "<p><input type=\"submit\" value=\"Valider\" /></p>";
			 
			$result .= "</div></form>";
		}
		
		$result .= end_content();
		
		$result .= endPage();
		return $result;
	}
	
	echo indent(subscribe_page());
?>