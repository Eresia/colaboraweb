<?php

function comment_form(){
 
	$disp = "Vous devez vous connecter avant de pouvoir noter ce lien :|";
	$log = True;

	if($log==False){
		return $disp;
	}

	else{
	$disp = '<form method="post">';
	$disp = $disp.'<textarea name="Commentaire" rows=3 cols=20></textarea><br/>';
	$disp = $disp.'<input type="submit" value="Poster le commentaire"/>';
	$disp = $disp.'</form>';
	}


	return $disp;
}

?>