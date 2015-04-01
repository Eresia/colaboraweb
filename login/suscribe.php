<?php 
    session_start();
	define("HTTP_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?"http://localhost/colaboraweb":"http://".$_SERVER['HTTP_HOST']);
	define("SERV_ROOT", ($_SERVER['HTTP_HOST'] == "localhost")?$_SERVER['DOCUMENT_ROOT']."/colaboraweb":$_SERVER['DOCUMENT_ROOT']);
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_login.php");
    echo beginPage(array(HTTP_ROOT."/css/style3.css"), "S'inscrire");

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
						echo '<p>Vous êtes déja connecté</p>';
					}
					else{
						echo "<form method=\"post\" action=\"confirm_subscription.php\">";
						if(isset($_GET['pseudo'])){
							if(!right_pseudo($_GET['pseudo'])){
								echo "<p>Merci de mettre un pseudo valide (entre 3 et 10 caractères)</p>";
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
								echo "<p>Les deux mots de passes ne sont pas égaux</p>";
							}
							else{
								if(isset($_GET['password'])){
									if(!right_pass($_GET['password'])){
										echo "<p>Merci de mettre un mot de passe valide (entre 3 et 10 caractères)</p>";
									}
									else{
										$goodPass = true;
									}
								}
							}
						}
						
						if($goodPseudo && $goodPass){
							echo "<p>Pseudo invalide ou déjà utilisé</p>";
						}
						
						echo "<p>Pseudo : <input type=\"text\" name=\"pseudo\" value=\"".$pseudo."\" /></p>";
						echo "<p>Mot de passe : <input type=\"password\" name=\"pass\" /></p>";
						echo "<p>Confirmer votre mot de passe : <input type=\"password\" name=\"confirmpass\" /></p>";
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