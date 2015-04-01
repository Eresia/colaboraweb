<?php 
    session_start();
	define("HTTP_ROOT", (strstr($_SERVER['HTTP_HOST'], 'localhost') != false)?"http://localhost/colaboraweb":"http://".$_SERVER['HTTP_HOST']);
	define("SERV_ROOT", ($_SERVER['HTTP_HOST'] == "localhost")?$_SERVER['DOCUMENT_ROOT']."/colaboraweb":$_SERVER['DOCUMENT_ROOT']);
    require_once(SERV_ROOT."/function/base.php");
    echo beginPage(array(HTTP_ROOT."/css/style3.css"), 'ColLABoraWEB');

?>
			
	<div class="wrap">

        <?php echo headerPage(); ?>

		<div class="core">

			<?php echo topMenu();?>
            <?php echo rightMenu(); ?>


			<div class="content">
				<div class="sub-content">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
					</p>
					<p>	
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
					</p>
					<p>	
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
					</p>	
					<p>	
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
					</p>
				</div>
			</div>


		</div>


		<?php echo footerPage(); ?>
	</div>

<?php
    echo endPage();
?>