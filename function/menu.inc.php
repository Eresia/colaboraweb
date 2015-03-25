<?php

	/*
	@author LEFEBVRE Thomas
	@version 1.0
	@info This fonction will display the site menu in every page of the site
	*/


	function menu(){
	
	$menu_buf = '<div class="header">';
	$menu_buf = $menu_buf.'</div>';


	$menu_buf = $menu_buf.'<div class="core">';
	$menu_buf = 	$menu_buf.'<div class="left_menu"></div>';
	$menu_buf = 	$menu_buf.'<div class="content"></div>';
	$menu_buf = 	$menu_buf.'<div class="right_menu"></div>';
	$menu_buf = $menu_buf.'</div>';
	

	$menu_buf = $menu_buf.'<div class="footer">';
	$menu_buf = $menu_buf.'</div>';

	return $menu_buf;
	}


?>