<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/define/admin_define.php");
	require_once(SERV_ROOT."../function/function_post.php");
	
	if(!isset($_SESSION['group']) || ($_SESSION['group'] != ADMIN)){
		header('Location: '.HTTP_ROOT.'/index.php');
	}
	else{
		if(!isset($_POST['name']) || ($_POST['name'] == "")){
			header('Location: '.HTTP_ROOT.'/administration/administration.php');
		}
		else{
			$name = $_POST['name'];
			if(!isset($_POST['color']) || (hexdec($_POST['color']) < 0) || (hexdec($_POST['color']) > hexdec(0xFFFFFF))){
				$color = 0;
			}
			else{
				$color = hexdec($_POST['color']);
			}
			if(!isset($_POST['previous'])){
				$previous = -1;
			}
			else{
				$previous = intval($_POST['previous']);
			}
			create_category($name, $color, $previous);
			header('Location: '.HTTP_ROOT.'/administration/administration.php');
		}
	}
?>