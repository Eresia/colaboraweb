<?php
	session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT.'/define/mysql_define.php');
	require_once(SERV_ROOT."/function/function_post.php");
	
	create_comment(1, 7, str_replace("\n", '<br />', htmlspecialchars("coucou", ENT_QUOTES | ENT_XHTML, 'UTF-8')));
	
	
?>