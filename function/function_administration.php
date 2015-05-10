<?php
	require_once(SERV_ROOT.'/define/mysql_define.php');
	require_once("../define/admin_define.php");
	
	function get_admin_categories(){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$cat = $mysql->prepare("SELECT id,name,color FROM category");
		$cat->execute();
		$cat->bind_result($id, $name, $color);
		$result = '<table>';
		while($cat->fetch()){
			$result .= '<tr><td class="name_category" style="color:#'.dechex($color).'">'.$name.'</td><td class="delete_category"><a href="supprimer_category.php?id='.$id.'">Supprimer</a></td></tr>';
		}
		$result .= '</table>';
		$cat->close();
		$mysql->close();
		return $result;
	}
	
	function get_admin_users(){
		$users = get_users();
		$result = '<table>';
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
			$option .= '<option value="'.USER.'"'.$selected.'>Admin</option>';
			$result .= '<tr>';
			$result .= '<td class="name_user">'.$info["name"].'</td>';
			$result .= '<td class="rang_user">'.$info["rang"].'</td>';
			if($info['id'] != $_SESSION['id']){
				$result .= '<td class="modify_rang_user">';
				$result .= '<form method="post" action="modify_rang.php" class="post_form">';
				$result .= '<div><select name="rang">'.$option.'</select>';
				$result .= '<input type="submit" value="Modifier le rang"/></div>';
				$result .= '</form>';
				$result .= '</td>';
				$result .= '<td class="valid_modify"></td>';
				$result .= '<td class="delete_user"><a href="delete_user.php?id='.$info["id"].'">Supprimer</a></td>';
			}
			$result .= '</tr>';
		}
		$result .= '</table>';
		return $result;
	}
?>