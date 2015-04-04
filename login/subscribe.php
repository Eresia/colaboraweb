<?php 
    session_start();
	define("HTTP_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?"http://".$_SERVER['HTTP_HOST']."/colaboraweb":"http://".$_SERVER['HTTP_HOST']);
	define("SERV_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?$_SERVER['DOCUMENT_ROOT']."/colaboraweb":$_SERVER['DOCUMENT_ROOT']);
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_login.php");
    echo beginPage(array(HTTP_ROOT."/css/style3.css", HTTP_ROOT."/css/styleSuscribe.css"), "S'inscrire");

?>
			
	<div class="wrap">

        <?php echo headerPage(); ?>

		<div class="core">

			<?php echo topMenu();?>
            <?php echo rightMenu(); ?>

			<div class="content">
				<?php
					$goodPseudo = false;
					if(isset($_SESSION['pseudo'])){
						echo '<p class="err">Vous êtes déja connecté</p>';
					}
					else{
						echo "<form method=\"post\" action=\"confirm_subscription.php\" class=\"sub_form\">";
						if(isset($_GET['pseudo'])){
							if(!right_pseudo($_GET['pseudo'])){
								echo "<p class=\"err\">Merci de mettre un pseudo valide (entre 3 et 10 caractères)</p>";
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
								echo "<p class=\"err\">Les deux mots de passes ne sont pas égaux</p>";
							}
							else{
								if(isset($_GET['password'])){
									if(!right_pass($_GET['password'])){
										echo "<p class=\"err\">Merci de mettre un mot de passe valide (entre 3 et 10 caractères)</p>";
									}
									else{
										$goodPass = true;
									}
								}
							}
						}
						
						if($goodPseudo && $goodPass){
							echo "<p class=\"err\">Pseudo invalide ou déjà utilisé</p>";
						}
						
						echo "<label class=\"ps_s\">Pseudo : </label><input type=\"text\" name=\"pseudo\" value=\"".$pseudo."\" class=\"ps_s\"/>";
						echo "<label class=\"mdp_s\">Mot de passe : </label><input type=\"password\" name=\"pass\" class=\"mdp_s\"/>";
						echo "<label class=\"mdp_s\">Confirmer votre mot de passe : </label><input type=\"password\" name=\"confirmpass\" class=\"mdp_s\"/>";
						echo "<p><input type=\"submit\" value=\"Valider\" /></p>";
						 
						echo "</form>";
					}
				?>
			</div>


		</div>


		<?php echo footerPage(); ?>
	</div>

<?php
    echo endPage();
?>