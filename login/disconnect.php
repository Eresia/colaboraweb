<?php
    session_start();
	require_once("../define/root_define.php");
	require_once(SERV_ROOT."/function/function_login.php");
    disconnect();
	header('Location: '.HTTP_ROOT.'/index.php');
?>