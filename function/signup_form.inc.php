<?php

	/*
	@author LEFEBVRE Thomas
	@version 1.0
	@info This is the form used for user to signup.
	*/


	function signup(){
	$disp = '<form method="post">';
	$disp = 	$disp.'<label>Pseudo :<input type="text" name="pseudo"/></label><br/>';
	$disp = 	$disp.'<label>Mot de passe :<input type="password" name="mdp"/></label><br/>';
	$disp = 	$disp.'<label>Confirmation du mot de passe :<input type="password" name="mdp2"/></label><br/>';
	$disp = 	$disp.'<label>Adresse mail<input type="text" name="mail"/></label><br/>';
	$disp = 	$disp.'<input type="submit" value="S inscrire" />';  
	$disp = $disp.'</form>';

	return $disp;
	}

?>