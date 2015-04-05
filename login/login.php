<?php 
    session_start();
	require_once("../define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_login.php");
    echo beginPage(array(HTTP_ROOT."/css/style3.css", HTTP_ROOT."/css/styleLogin.css"), 'Se connecter');

?>
			
	<div class="wrap">

        <?php echo headerPage(); ?>

		<div class="core">

			<?php echo topMenu();?>
            <?php echo rightMenu(); ?>

			<div class="content">
				<?php

					if(isset($_SESSION['pseudo'])){
						echo '<p>Vous êtes déja connecté</p>';
					}
					else{
						echo "<form method=\"post\" action=\"confirm_login.php\" class=\"log_form\">";
						if(isset($_GET['pseudo'])){
							$pseudo = $_GET['pseudo'];
							echo "<p>Mauvaise combinaison pseudo/mot de passe</p>";
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
						
						echo "<label for=\"pseudo\" class=\"ps\">Pseudo : </label><input type=\"text\" name=\"pseudo\" value=\"".$pseudo."\" class=\"ps\" /><br/>";
						echo "<label for=\"mdp\" class= \"mdp\">Mot de passe : </label><input type=\"password\" name=\"pass\" value=\"".$pass."\" class=\"mdp\"/>";
						if(isset($_GET['return'])){
							echo '<input type="hidden" name="return" value="'.$_GET['return'].'" />';
						}
						echo "<p class=\"okb\"><input type=\"submit\" value=\"Valider\" /></p>";
						echo "<p class=\"subscribe\"><a href=\"subscribe.php\" class=\"subscribe\">S'inscrire</a></p>"; 
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