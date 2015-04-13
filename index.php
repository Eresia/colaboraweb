<?php 
    session_start();
	require_once("define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_profil.php");
	require_once(SERV_ROOT."/function/function_post.php");

	function index_page(){
	
		if(isset($_GET['category']) && is_category(intval($_GET['category']))){
			$select_category = intval($_GET['category']);
		}
		else{
			$select_category = -1;
		}
		
		if(isset($_GET['date']) && in_array($_GET['date'], array('asc' , 'desc'))){
			$current_date = $_GET['date'];
		}
		else{
			$current_date = 'asc';
		}
		
		if(isset($_GET['notation']) && in_array($_GET['notation'], array('none' , 'desc', 'asc'))){
			$current_notation = $_GET['notation'];
		}
		else{
			$current_notation = 'none';
		}
		
		$urls = get_post_by_category($select_category, $current_date, $current_notation);
		
		$list_categories = get_categories();
		
		$categories = "";
		$id = 0;
		$categories .= '<option value="-1" selected="selected">Toutes</option>';
		while(isset($list_categories[$id])){
			if($select_category == $list_categories[$id]['id']){
				$categories .= '<option value="'.$list_categories[$id]['id'].'" selected="selected">'.$list_categories[$id]['name'].'</option>';
			}
			else{
				$categories .= '<option value="'.$list_categories[$id]['id'].'">'.$list_categories[$id]['name'].'</option>';
			}
			$id = $list_categories[$id]['id'];
		}
		
		
		
		$list_date = array('desc' => 'Du plus récent au plus ancien', 'asc' => 'Du plus ancien au plus récent');
		$list_notation = array('none' => 'Peu importe', 'desc' => 'Les mieux notés', 'asc' => 'Les moins bien notés');
		
		$date = "";
		$notation = "";
		
		foreach($list_date as $key => $value){
			if($key == $current_date){
				$date .= '<option value="'.$key.'" selected="selected">'.$value.'</option>';
			}
			else{
				$date .= '<option value="'.$key.'">'.$value                   .'</option>';
			}
		}
		
		foreach($list_notation as $key => $value){
			if($key == $current_notation){
				$notation .= '<option value="'.$key.'" selected="selected">'.$value.'</option>';
			}
			else{
				$notation .= '<option value="'.$key.'">'.$value.'</option>';
			}
		}
	
		$result = beginPage(array(HTTP_ROOT."/css/style3.css", HTTP_ROOT."/css/styleIndex.css", HTTP_ROOT."/css/stylePost.css"), 'ColLABoraWEB');
		
		$result .= begin_content();
		
		$result .= '<div class="search_url">';
		
		$result .= '<form method="get" action="index.php" class="index_form">';
		$result .= '<p>Catégorie : <select name="category">'.$categories.'</select>';
		$result .= 'Ancienneté : <select name="date">'.$date.'</select>';
		$result .= 'Notation : <select name="notation">'.$notation.'</select>';
		$result .= '<input type="submit" value="Rechercher" /></p>';
		$result .= '</form>';
		
		$result .= '</div>';
		
		$result .= '<div class="result_url">';
		for($i = 0; $i < count($urls); $i++){
			$result .= display_post($urls[$i], false);
		}
		$result .= '</div>';
		
		$result .= end_content();
		$result .= endPage();
	
		return $result;
	}
	
	echo indent(index_page());
	//echo index_page();
?>