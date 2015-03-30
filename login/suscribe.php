<?php 
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']."colaboraweb/function/base.php");
	require_once($_SERVER['DOCUMENT_ROOT']."colaboraweb/function/function_login.php");
    echo beginPage(array("http://localhost/colaboraweb/css/style3.css"), "S'inscrire");

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
						echo "<form method=\"post\" action=\"confirm_subscription.php\">";
						if(isset($_GET['pseudo'])){
							if((strlen($_GET['pseudo']) < 3) || (strlen($_GET['pseudo']) > 10)){
								echo "<p>Merci de mettre un pseudo valide (entre 3 et 10 caractères)</p>";
							}
							else{
								echo "<p>Pseudo invalide ou déjà utilisé</p>";
							}
							$pseudo = $_GET['pseudo'];
						}
						else{
							$pseudo = "";
						}
						
						if(isset($_GET['password'])){
							if(right_pseudo($pass)){
								echo "<p>Merci de mettre un mot de passe valide (entre 3 et 10 caractères)</p>";
							}
							$pass = $_GET['password'];
						}
						else{
							$pass = "";
						}
						
						echo "<p>Pseudo : <input type=\"text\" name=\"pseudo\" value=\"".$pseudo."\" /></p>";
						echo "<p>Mot de passe : <input type=\"password\" name=\"pass\" value=\"".$pass."\" /></p>";
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