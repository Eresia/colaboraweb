<?php 
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."/function/base.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/function/function_login.php");
    echo beginPage(array("http://localhost/colaboraweb/css/style3.css"), 'Se connecter');

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
						echo "<form method=\"post\" action=\"confirm_login.php\">";
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
						
						echo "<p>Pseudo : <input type=\"text\" name=\"pseudo\" value=\"".$pseudo."\" /></p>";
						echo "<p>Mot de passe : <input type=\"password\" name=\"pass\" value=\"".$pass."\" /></p>";
						echo "<p><input type=\"submit\" value=\"Valider\" /></p>";
						 
						echo "</form>";
						echo "<p><a href=\"suscribe.php\">S'incrire</a></p>";
					}
				?>
			</div>


		</div>


		<?php echo footerPage(); ?>
	</div>

<?php
    echo endPage();
?>