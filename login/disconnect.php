<?php
    session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/function/function_login.php");
    disconnect();
	header('Location: http://localhost/colaboraweb/index.php');
?>