/*Fichier javascript pour l'animation du système de notations (étoile) et de leur remplissage (demi-étoile ou étoile complète)*/


function star_to_default() {
	var id;
	for (id in notes){
		document.getElementById(id).className = notes[id];
	}
}

function star_animation(current_note) {
	var i;
	for(i = 0; i < 10; i++){
		var id = "note_" + (i+1);
		if(current_note <= i){
			if(i % 2 == 0){
				document.getElementById(id).className = 'img_note_left_empty';
			}
			else{
				document.getElementById(id).className = 'img_note_right_empty';
			}
		}
		else{
			if(i % 2 == 0){
				document.getElementById(id).className = 'img_note_left_full';
			}
			else{
				document.getElementById(id).className = 'img_note_right_full';
			}
		}
	}
}