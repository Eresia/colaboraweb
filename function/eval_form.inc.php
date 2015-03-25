<?php

	/*
	@author LEFEBVRE Thomas
	@version 1.0
	@info This fonction will display the rating form in order for the user to rate all the links :)
	*/


	function rating(){

	$disp = "Vous devez vous connecter avant de pouvoir noter ce lien :|";
	$log = True;

	if($log==False){
		return $disp;
	}

	else{
		$disp = '<div class="radio">';
		$disp = $disp.'<form method="post">';

		$disp = 	$disp.'<label>1 étoile<input type="radio" name="rating" value="1"/></label></br>';
		$disp = 	$disp.'<label>2 étoiles<input type="radio" name="rating" value="2"/></label></br>';
		$disp = 	$disp.'<label>3 étoiles<input type="radio" name="rating" value="3"/></label></br>';
		$disp = 	$disp.'<label>4 étoiles<input type="radio" name="rating" value="4"/></label></br>';
		$disp = 	$disp.'<label>5 étoiles<input type="radio" name="rating" value="5"/></label></br>';

		$disp = 	$disp.'<input type="submit" value="Noter"/>';

		$disp = $disp.'</form>';
		$disp = $disp.'</div>';

		return $disp;
	}
	
	}


?>