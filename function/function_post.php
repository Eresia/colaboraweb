<?php
	function getPost($post){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$info = $mysql->prepare('SELECT url,description,author,date FROM url WHERE id = ?');
		$info->bind_param('i', $post);
		$info->execute();
		$info->bind_result($url, $description, $author, $date);
		if($info->fetch()){
			return array('url' => $url, 'description' => $description, 'author' => $author, 'date' => $date);
		}
		else{
			return array();
		}
	}
	
	function getComments($post, $page){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$askPage = ($page - 1) * 10;
		$comments = $mysql->prepare('SELECT comment,author,date FROM comment WHERE url = ? ORDER BY date LIMIT 10 OFFSET ?');
		$comments->bind_param('ii', $post, $askPage);
		$comments->execute();
		$comments->bind_result($currentComment, $currentAuthor, $currentDate);
		$result = array();
		while($comments->fetch()){
			$result[] = array('comment' => $currentComment, 'author' => $currentAuthor, 'date' => $currentDate);
		}
		return $result;
	}
	
	function display_post($id, $post){
		$name = get_pseudo($id);
		$info = get_info($id, array('avatar', 'date_inscription'));
		if(strlen($info['avatar']) == 0){
			$avatar = AVATAR_DEFAULT;
		}
		else{
			$avatar = $info['avatar'];
		}
		$result =  '<div class="post">'."\n";
		$result .= '	<div class="info_author">'."\n";
		$result .= '		<img src="'.$avatar.'" width="'.AVATAR_WIDTH.'" height="'.AVATAR_HEIGHT.'" alt="Avatar de '.$name.'" />'."\n";
		$result .= '		<p class="message_name"><a href="'.HTTP_ROOT.'/profil/consulte_profil.php?name='.$name.'">'.$name.'</a></p>'."\n";
		$result .= '		<p>Inscription : '.$info['date_inscription'].'</p>'."\n";
		$result .= '	</div>'."\n";
		$result .= '	<div class="info_post">'."\n";
		$result .= '		<p>Posté le : '.$post['date'].'</p>'."\n";
		$result .= '	</div>'."\n";
		$result .= '	<div class="content_post">'."\n";
		$result .= '		<p class="display_url"><a href="'.$post['url'].'">'.$post['url'].'</a></p>'."\n";
		$result .= '		<p>'.$post['description'].'</p>'."\n";
		$result .= '	</div>'."\n";
		$result .= '</div>'."\n";
		return $result;
	}
	
	function display_comments($comments){
		for($i = 0; $i < count($comments); $i++){
			$name = get_pseudo($comments[$i]['author']);
			$info = get_info($comments[$i]['author'], array('avatar', 'date_inscription'));
			if(strlen($info['avatar']) == 0){
				$avatar = AVATAR_DEFAULT;
			}
			else{
				$avatar = $info['avatar'];
			}
			$result =  '<div class="post">'."\n";
			$result .= '	<div class="info_author">'."\n";
			$result .= '		<img src="'.$avatar.'" width="'.AVATAR_WIDTH.'" height="'.AVATAR_HEIGHT.'" alt="Avatar de '.$name.'" />'."\n";
			$result .= '		<p class="message_name"><a href="'.HTTP_ROOT.'/profil/consulte_profil.php?name='.$name.'">'.$name.'</a></p>'."\n";
			$result .= '		<p>Inscription : '.$info['date_inscription'].'</p>'."\n";
			$result .= '	</div>'."\n";
			$result .= '	<div class="info_post">'."\n";
			$result .= '		<p>Posté le : '.$comments[$i]['date'].'</p>'."\n";
			$result .= '	</div>'."\n";
			$result .= '	<div class="content_post">'."\n";
			$result .= '		<p>'.$comments[$i]['comment'].'</p>'."\n";
			$result .= '	</div>'."\n";
			$result .= '</div>'."\n";
			return $result;
		}
	}
	
	function get_nb_pages($post){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$comments = $mysql->prepare('SELECT COUNT(id) FROM comment WHERE url = ?');
		$comments->bind_param('i', $post);
		$comments->execute();
		$comments->bind_result($result);
		if($comments->fetch()){
			return $result;
		}
		else{
			return 0;
		}
	}
	
	function display_pages($page, $nbPages, $name){
		echo '<div class="page"><p>Page ';
		if($page > 1){
			echo '<a href="">'.($page-1).'</a> ';
		}
		$url = HTTP_ROOT.'/profil/consulte_profil.php?name='.$name.'&page='.$page;
		echo '<span class="currentPage"><a href="'.$url.'">'.$page.'</a></span> ';
		
		if($page < $nbPages){
			echo '<a href="">'.($page+1).'</a>';
		}
		echo '</p></div>'."\n";
	}
?>