<?php
	function getPost($post){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$info = $mysql->prepare('SELECT url,description,author,date FROM url WHERE id = ?');
		$info->bind_param('i', $post);
		$info->execute();
		$info->bind_result($url, $description, $author, $date);
		if($info->fetch()){
			$info->close();
			$mysql->close();
			return array('url' => $url, 'description' => $description, 'author' => $author, 'date' => $date);
		}
		else{
			$info->close();
			$mysql->close();
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
		$comments->close();
		$mysql->close();
		return $result;
	}
	
	function display_post($id, $post){
		$name = get_pseudo($id);
		$info = get_info($id, array('avatar', 'date_inscription', 'sign'));
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
		$result .= '	<div class="content_post">'."\n";
		$result .= '		<div class="info_post">'."\n";
		$result .= '			<p>Posté le : '.$post['date'].'</p>'."\n";
		$result .= '		</div>'."\n";
		$result .= '		<div class="subcontent_post">'."\n";
		$result .= '		<p class="display_url"><a href="'.$post['url'].'">'.$post['url'].'</a></p>'."\n";
		$result .= '		<p>'.$post['description'].'</p>'."\n";
		$result .= '		<hr />'."\n";
		$result .= '		<p>'.$info['sign'].'</p>'."\n";
		$result .= '		</div>'."\n";
		$result .= '	</div>'."\n";
		$result .= '</div>'."\n";
		return $result;
	}
	
	function display_comments($comments){
		for($i = 0; $i < count($comments); $i++){
			$name = get_pseudo($comments[$i]['author']);
			$info = get_info($comments[$i]['author'], array('avatar', 'date_inscription', 'sign'));
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
			$result .= '	<div class="content_post">'."\n";
			$result .= '		<div class="info_post">'."\n";
			$result .= '			<p>Posté le : '.$comments[$i]['date'].'</p>'."\n";
			$result .= '		</div>'."\n";
			$result .= '		<div class="subcontent_post">'."\n";
			$result .= '			<p>'.$comments[$i]['comment'].'</p>'."\n";
			$result .= '			<hr />'."\n";
			$result .= '			<p>'.$info['sign'].'</p>'."\n";
			$result .= '		</div>'."\n";
			$result .= '	</div>'."\n";
			$result .= '</div>'."\n";
			return $result;
		}
	}
	
	function get_nb_pages($post){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$nb = $mysql->prepare('SELECT COUNT(id) FROM comment WHERE url = ?');
		$nb->bind_param('i', $post);
		$nb->execute();
		$nb->bind_result($result);
		if($nb->fetch()){
			$nb->close();
			$mysql->close();
			return $result;
		}
		else{
			$nb->close();
			$mysql->close();
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
	
	function is_category($id){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$prep = $mysql->prepare('SELECT id FROM category WHERE id = ?');
		$prep->bind_param('i', $id);
		$prep->execute();
		$prep->store_result();
		if($prep->num_rows == 1){
			$prep->close();
			$mysql->close();
			return true;
		}
		else{
			$prep->close();
			$mysql->close();
			return false;
		}
	}
	
	function get_categories(){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$prep = $mysql->prepare('SELECT id, name FROM category');
		$prep->execute();
		$prep->bind_result($id, $name);
		$result = array();
		while($prep->fetch()){
			$result[$id] = $name;
		}
		$prep->close();
		$mysql->close();
		return $result;
	}
	
	function create_post($category, $author, $url, $description){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$previousPost = $mysql->prepare('SELECT id,previous FROM url WHERE category = ?');
		$previousPost->bind_param("i", $category);
		$previousPost->execute();
		$previousPost->bind_result($id, $previous);
		while($previousPost->fetch()){
			$previous_tab[$previous] = $id;
		}
		$previousPost->close();
		$maxPrevious = $previous_tab[0];
		while(isset($previous_tab[$maxPrevious])){
			$maxPrevious = $previous_tab[$maxPrevious];
		}
		$post = $mysql->prepare('INSERT INTO url(category, author, url, description, previous, date)  VALUES(?, ?, ?, ?, ?, CURRENT_DATE())');
		$post->bind_param('iissi', $category, $author, $url, $description, $maxPrevious);
		$post->execute();
		$post->close();
		
		$max = $mysql->prepare('SELECT id FROM url ORDER BY id DESC LIMIT 0,1');
		$max->execute();
		$max->bind_result($result);
		$max->fetch();
		$max->close();
		$mysql->close();
		return $result;
	}
?>