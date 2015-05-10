<?php

	/*Fichier regroupant les fonctions relatives à la partie administration du site.
	Ces fonctions servent à afficher les formulaires permettant, pour le premier de supprimer et créer des catégories et pour le deuxième de modifier les droits d'un utilisateur
	, son mot de passe, supprimer cet utilisateur ou en créer un nouveau.*/

	require_once(SERV_ROOT.'/define/mysql_define.php');
	require_once(SERV_ROOT.'/define/admin_define.php');
	
	function get_admin_categories(){
		$categories = '<option value="0">Première catégorie</option>';
		$id = 0;
		$list_categories = get_categories();
		$display_categories = '';
		while(isset($list_categories[$id])){
			$display_categories .= '<tr><td class="name_category" style="color:#'.dechex($list_categories[$id]['color']).'">'.$list_categories[$id]['name'].'</td><td class="delete_category"><a href="delete_category.php?id='.$list_categories[$id]['id'].'">Supprimer</a></td></tr>';
			$categories .= '<option value="'.$list_categories[$id]['id'].'">'.$list_categories[$id]['name'].'</option>';
			$id = $list_categories[$id]['id'];
		}
		$result = '<p class="p_admin">SUPPRIMER UNE CATEGORIE</p>';
		$result .= '<table>';
		$result .= $display_categories;
		$result .= '</table>';
		$result .= '<p class="p_admin">CREER UNE CATEGORIE</p>';
		$result .= '<form method="post" action="create_category.php" class="post_form">';
		$result .= '<div>Nom : <input  class="cat_s" type="text" name="name"/> Couleur (Hexadecimal) : <input class="cat_s" type="text" name="color"/> Catégorie précédente : <select name="previous">'.$categories.'</select> <input  class="submit_cat" type="submit" value="Ajouter une catégorie"/></div>';
		$result .= '</form>';
		return $result;
	}
	
	function get_admin_users(){
		$result = '<p class="p_admin">MODIFIER LES DROITS D\'UN UTILISATEUR</p>';
		$users = get_users();
		$result .= '<table>';
		foreach($users as $info){
			$option = '';
			$selected = '';
			if($info['rang'] == USER){
				$selected .= ' selected="selected"';
			}
			$option .= '<option value="'.USER.'"'.$selected.'>Utilisateur</option>';
			$selected = '';
			if($info['rang'] == EVALU){
				$selected .= ' selected="selected"';
			}
			$option .= '<option value="'.EVALU.'"'.$selected.'>Evaluateur</option>';
			$selected = '';
			if($info['rang'] == ADMIN){
				$selected .= ' selected="selected"';
			}
			$option .= '<option value="'.ADMIN.'"'.$selected.'>Admin</option>';
			$result .= '<tr>';
			$result .= '<td class="name_user">'.$info["name"].'</td>';
			$result .= '<td class="rang_user">'.$info["rang"].'</td>';
			if($info['id'] != $_SESSION['id']){
				$result .= '<td class="modify_rang_user">';
				$result .= '<form method="post" action="modify_user.php" class="post_form">';
				$result .= '<div><input type="hidden" name="id" value="'.$info['id'].'" /><select name="rang">'.$option.'</select>';
				$result .= 'Modifier le MDP : <input type="text" name="pass"/>';
				$result .= '<input type="submit" value="Modifier"/></div>';
				$result .= '</form>';
				$result .= '</td>';
				$result .= '<td class="valid_modify"></td>';
				$result .= '<td class="delete_user"><a href="delete_user.php?id='.$info["id"].'">Supprimer</a></td>';
			}
			$result .= '</tr>';
		}
		$result .= '</table>';
		$result .= '<p class="p_admin">AJOUTER UN NOUVEL UTILISATEUR</p>';
		$option = '<option value="'.USER.'" selected="selected">Utilisateur</option>';
		$option .= '<option value="'.EVALU.'">Evaluateur</option>';
		$option .= '<option value="'.ADMIN.'">Admin</option>';
		$result .= '<form method="post" action="create_user.php" class="post_form">';
		$result .= '<div>Nom : <input type="text" name="name"/> MDP : <input type="password" name="pass"/> Rang : <select name="rang">'.$option.'</select> <input type="submit" value="Créer un utilisateur"/></div>';
		$result .= '</form>';
		return $result;
	}
?>