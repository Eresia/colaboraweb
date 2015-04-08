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
	
	function display_post($post){
		$name = get_pseudo($post['author']);
		$info = get_info($post['author'], array('avatar', 'date_inscription', 'sign'));
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
		$result = '';
		for($i = 0; $i < count($comments); $i++){
			$name = get_pseudo($comments[$i]['author']);
			$info = get_info($comments[$i]['author'], array('avatar', 'date_inscription', 'sign'));
			if(strlen($info['avatar']) == 0){
				$avatar = AVATAR_DEFAULT;
			}
			else{
				$avatar = $info['avatar'];
			}
			$result .=  '<div class="post">'."\n";
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
		}
		return $result;
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
			return intval((($result - 1) / 10) + 1);
		}
		else{
			$nb->close();
			$mysql->close();
			return 0;
		}
	}
	
	function display_pages($post, $page){
		$nbPages = get_nb_pages($post);
		if($nbPages > 1){
			$dispPages = 'Pages';
		}
		else{
			$dispPages = 'Page';
		}
		$result = '<div class="page"><p>'.$dispPages.' : '."\n";
		if($page > 1){
			if($page > 3){
				$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&page=0';
				$result .= '<a href="'.$url.'">0</a> ...'."\n";
			}
			else if($page == 3){
				$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&page=0';
				$result .= '<a href="'.$url.'">0</a>'."\n";
			}
			$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&page='.($page-1);
			$result .= '<a href="'.$url.'">'.($page-1).'</a> '."\n";
		}
		$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&page='.$page;
		$result .= '<span class="currentPage"><a href="'.$url.'">'.$page.'</a></span> '."\n";
		
		if($page < $nbPages){
			$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&page='.($page+1);
			$result .= '<a href="'.$url.'">'.($page+1).'</a>'."\n";
			if($page < ($nbPages - 2)){
				$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&page='.$nbPages;
				$result .= '... <a href="'.$url.'">'.$nbPages.'</a>'."\n";
			}
			else if($page == ($nbPages - 2)){
				$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&page='.$nbPages;
				$result .= '<a href="'.$url.'">'.$nbPages.'</a>'."\n";
			}
		}
		$result .= '</p></div>'."\n";
		return $result;
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
		$post = $mysql->prepare('INSERT INTO url(category, author, url, description, date)  VALUES(?, ?, ?, ?, CURRENT_DATE())');
		$post->bind_param('iiss', $category, $author, $url, $description);
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
	
	function is_url($id){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$prep = $mysql->prepare('SELECT id FROM url WHERE id = ?');
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
	
	function create_comment($author, $url, $comment){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$post = $mysql->prepare('INSERT INTO comment(author, url, comment, date)  VALUES(?, ?, ?, CURRENT_DATE())');
		$post->bind_param('iss', $author, $url, $comment);
		$post->execute();
		$post->close();
		
		$mysql->close();
	}
?>