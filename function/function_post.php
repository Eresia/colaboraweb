<?php	
	require_once(SERV_ROOT.'/define/mysql_define.php');
	require_once(SERV_ROOT.'/define/admin_define.php');

	function getPost($post){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$info = $mysql->prepare('SELECT url,description,author,date,category FROM url WHERE id = ?');
		$info->bind_param('i', $post);
		$info->execute();
		$info->bind_result($url, $description, $author, $date, $category);
		if($info->fetch()){
			$info->close();
			$mysql->close();
			return array('id' => $post, 'url' => $url, 'description' => $description, 'author' => $author, 'date' => $date, 'category' => $category);
		}
		else{
			$info->close();
			$mysql->close();
			return array();
		}
	}
	
	function get_post_by_category($category=-1, $date="asc", $notation="none"){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$request = 'SELECT url.id,url.url,url.description,url.author,url.date,url.category FROM url LEFT JOIN note ON url.id = note.url';
		if($category != -1){
			$request .= ' WHERE category = ?';
		}
		$request .= ' ORDER BY';
		if($notation != 'none'){
			$request .= ' note.note '.$notation.', url.date '.$date;
		}
		else{
			$request .= ' url.date '.$date;
		}
		$info = $mysql->prepare($request);
		if($category != -1){
			$info->bind_param('i', $category);
		}
		$info->execute();
		$info->bind_result($id, $url, $description, $author, $date, $category);
		$result = array();
		while($info->fetch()){
			$result[] = array('id' => $id, 'url' => $url, 'description' => $description, 'author' => $author, 'date' => $date, 'category' => $category);
		}
		$info->close();
		$mysql->close();
		return $result;
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
	
	function display_post($post, $notation=true, $index=false){
		$name = get_pseudo($post['author']);
		$notes = get_note_img($post['id']);
		$nbNotes = get_nb_notes($post['id']);
		$info = get_info($post['author'], array('avatar', 'date_inscription', 'sign'));
		if(strlen($info['avatar']) == 0){
			$avatar = AVATAR_DEFAULT;
		}
		else{
			$avatar = $info['avatar'];
		}
		$result =  '<div class="post">';
		$result .= '<div class="info_author">';
		$result .= '<img class="img_avatar" src="'.$avatar.'" alt="Avatar de '.$name.'" />';
		$result .= '<p class="message_name"><a href="'.HTTP_ROOT.'/profil/consulte_profil.php?name='.$name.'">'.$name.'</a></p>';
		$result .= '<p class="sub_date">Inscription : '.$info['date_inscription'].'</p>';
		$result .= '</div>';
		$result .= '<div class="content_post">';
		$result .= '<div class="info_post">';
		if(isset($_SESSION['id']) && (($_SESSION['id'] == $post['author']) || ($_SESSION['group'] == ADMIN))){
			$result .= '<div class="info_post_edit">';
			$result .= '<form method="post" action="'.HTTP_ROOT.'/url/delete_post.php" class="post_form">';
			$result .= '<input type="hidden" name="id" value="'.$post['id'].'" />';
			$result .= '<input type="submit" value="Supprimer" />';
			$result .= '</form>';
			$result .= '</div>';
			$result .= '<div class="info_post_edit">';
			$result .= '<form method="post" action="'.HTTP_ROOT.'/url/edit_post.php" class="post_form">';
			$result .= '<input type="hidden" name="id" value="'.$post['id'].'" />';
			$result .= '<input type="submit" value="Editer" />';
			$result .= '</form>';
			$result .= '</div>';			
		}
		$result .= '<div class="info_post_info">';
		$result .= 'Posté le : '.$post['date'].', Catégorie : '.get_category_name($post['category']);
		$result .= '</div>';
		$result .= '</div>';
		$result .= '<div class="subcontent_post">';
		$result .= '<div class="display_url">';
		$result .= '<p><a href="'.$post['url'].'">'.$post['url'].'</a></p>';
		$result .= '<p class="para_note">';
		for($i = 1; $i <= 10; $i++){
			if($notation && isset($_SESSION['group']) && ($_SESSION['group'] >= EVALU)){
				$result .= '<a href="'.HTTP_ROOT.'/url/confirm_notation.php?id='.$post['id'].'&amp;note='.$i.'"><img id="note_'.$i.'" onmouseover="star_animation('.$i.')" onmouseout="star_to_default()" src="'.HTTP_ROOT.'/images/star_trans.png" alt="Note '.$i.'" title="Note de l\'url" /></a>';
			}
			else{
				$result .= '<img class="img_note" src="'.HTTP_ROOT.'/images/star_'.$notes[$i].'.png" alt="Note '.$i.'" title="Note de l\'url" />';
			}
		}
		if($notation){
			$result .= '<script type="text/javascript"><!--';
			$result .= 'var notes = {};';
			$result .= 'var id;';
			for($i = 1; $i <= 10; $i++){
				$result .= "notes.note_".$i." = 'img_note_".$notes[$i]."';";
			}
			$result .= "star_to_default();";
			$result .= '--></script>';
		}
		$result .= '</p>';
		$result .= '<p class="nb_notes">Note : '.($notes[0] / 2).'/5, Nombre de participation : '.$nbNotes.'</p>';
		$result .= '</div>';
		$result .= '<div class="display_description">';
		$result .= '<p>'.$post['description'].'</p>';
		if($index){
			$result .= '<p><a href="'.HTTP_ROOT.'/url/readPost.php?id='.$post['id'].'">Voir plus</a></p>';
		}
		$result .= '<hr />';
		$result .= '<p>'.$info['sign'].'</p>';
		$result .= '</div>';
		$result .= '</div>';
		$result .= '</div>';
		$result .= '</div>';
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
			$result .=  '<div class="post">';
			$result .= '<div class="info_author">';
			$result .= '<img class="img_avatar" src="'.$avatar.'" alt="Avatar de '.$name.'" />';
			$result .= '<p class="message_name"><a href="'.HTTP_ROOT.'/profil/consulte_profil.php?name='.$name.'">'.$name.'</a></p>';
			$result .= '<p>Inscription : '.$info['date_inscription'].'</p>';
			$result .= '</div>';
			$result .= '<div class="content_post">';
			$result .= '<div class="info_post">';
			$result .= '<p>Posté le : '.$comments[$i]['date'].'</p>';
			$result .= '</div>';
			$result .= '<div class="subcontent_post">';
			$result .= '<p>'.$comments[$i]['comment'].'</p>';
			$result .= '<hr />';
			$result .= '<p>'.$info['sign'].'</p>';
			$result .= '</div>';
			$result .= '</div>';
			$result .= '</div>';
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
		$result = '<div class="page"><p>'.$dispPages.' : ';
		if($page > 1){
			if($page > 3){
				$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&amp;page=1';
				$result .= '<a href="'.$url.'">1</a> ...';
			}
			else if($page == 3){
				$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&amp;page=1';
				$result .= '<a href="'.$url.'">1</a>';
			}
			$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&amp;page='.($page-1);
			$result .= '<a href="'.$url.'">'.($page-1).'</a> ';
		}
		$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&amp;page='.$page;
		$result .= '<span class="currentPage"><a href="'.$url.'">'.$page.'</a></span> ';
		
		if($page < $nbPages){
			$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&amp;page='.($page+1);
			$result .= '<a href="'.$url.'">'.($page+1).'</a>';
			if($page < ($nbPages - 2)){
				$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&amp;page='.$nbPages;
				$result .= '... <a href="'.$url.'">'.$nbPages.'</a>';
			}
			else if($page == ($nbPages - 2)){
				$url = HTTP_ROOT.'/url/readPost.php?id='.$post.'&amp;page='.$nbPages;
				$result .= '<a href="'.$url.'">'.$nbPages.'</a>';
			}
		}
		$result .= '</p></div>';
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
	
	function get_category_name($category){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$prep = $mysql->prepare('SELECT name FROM category WHERE id = ?');
		$prep->bind_param('i', $category);
		$prep->execute();
		$prep->bind_result($name);
		if($prep->fetch()){
			$prep->close();
			$mysql->close();
			return $name;
		}
		else{
			$prep->close();
			$mysql->close();
			return null;
		}
	}
	
	function get_categories(){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$prep = $mysql->query('SELECT id, name,previous, color FROM category');
		while($result_query = $prep->fetch_assoc()){
			$result[$result_query['previous']] = array('name' => $result_query['name'], 'id' => $result_query['id'], 'color' => $result_query['color']);
		}
		$prep->close();
		$mysql->close();
		return $result;
	}
	
	function get_last_categorie(){
		$list_categories = get_categories();
		$id = 0;
		while(isset($list_categories[$id])){
			$id = $list_categories[$id]['id'];
		}
		return $id;
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
	
	function edit_post($id, $category, $url, $description){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$post = $mysql->prepare('UPDATE url SET category=?, url=?, description=? WHERE id=?');
		$post->bind_param('issi', $category, $url, $description, $id);
		$post->execute();
		$post->close();
		$mysql->close();
	}
	
	function remove_post($id){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$post = $mysql->prepare('DELETE FROM url WHERE id=?');
		$post->bind_param('i', $id);
		$post->execute();
		$post->close();
		$mysql->close();
	}
	
	function is_url($id){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$prep = $mysql->prepare('SELECT COUNT(id) FROM url WHERE id = ?');
		$prep->bind_param('i', $id);
		$prep->execute();
		$prep->bind_result($nb);
		$prep->fetch();
		$prep->close();
		$mysql->close();
		return ($nb == 1);
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
	
	function create_category($name, $color, $askPrevious=-1){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$lastCategory = get_last_categorie();
		if($askPrevious != 0){
			$post = $mysql->prepare('SELECT id FROM category WHERE id=?');
			$post->bind_param('i', $askPrevious);
			$post->execute();
			$post->bind_result($exist);
			if($post->fetch()){
				$previous = $exist;
			}
			else{
				$previous = $lastCategory;
			}
			$post->close();
		}
		else{
			$previous = 0;
		}
		$post = $mysql->prepare('INSERT INTO category(name, color, previous)  VALUES(?, ?, ?)');
		$post->bind_param('sis', $name, $color, $previous);
		$post->execute();
		$post->close();
		if($previous != $lastCategory){
			$lastId = $mysql->insert_id;
			$mysql->query('UPDATE category SET previous='.$lastId.' WHERE previous='.$previous.' AND NOT id='.$lastId);
		}
		
		$mysql->close();
	}
	
	function delete_category($id){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$post = $mysql->prepare('SELECT previous FROM category WHERE id=?');
		$post->bind_param('i', $id);
		$post->execute();
		$post->bind_result($previous);
		if($post->fetch()){
			$post->close();
			$mysql->query('UPDATE category SET previous='.$previous.' WHERE previous='.$id);
		}
		$post->close();
		$post = $mysql->prepare('DELETE FROM category WHERE id=?');
		$post->bind_param('i', $id);
		$post->execute();
		$mysql->close();
	}
	
	function get_note($id){
		$nbNotes = get_nb_notes($id);
		if($nbNotes > 0){
			$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
			$mysql->query("SET NAMES UTF8");
			$allNotes = $mysql->prepare('SELECT note FROM note WHERE url = ?');
			$allNotes->bind_param('i', $id);
			$allNotes->execute();
			$allNotes->bind_result($note);
			$total = 0;
			while($allNotes->fetch()){
				$total += $note;
			}		
			$allNotes->close();
			$mysql->close();
			return $total / $nbNotes;
		}
		else{
			return 0;
		}
	}
	
	function get_nb_notes($id){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$nbNote = $mysql->prepare('SELECT COUNT(id) FROM note WHERE url = ?');
		$nbNote->bind_param('i', $id);
		$nbNote->execute();
		$nbNote->bind_result($nb);
		$nbNote->fetch();
		$nbNote->close();
		$mysql->close();
		return $nb;
	}
	
	function get_note_img($id){
		$note = get_note($id);
		$result = array($note);
		for($i = 0; $i < 10; $i++){
			if($note <= $i){
				if($i % 2 == 0){
					$result[] = 'left_empty';
				}
				else{
					$result[] = 'right_empty';
				}
			}
			else{
				if($i % 2 == 0){
					$result[] = 'left_full';
				}
				else{
					$result[] = 'right_full';
				}
			}
		}
		return $result;
	}
	
	function add_notation($author, $url, $note){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$alreadyNote = $mysql->prepare('SELECT COUNT(id) FROM note WHERE url = ? AND author = ?');
		$alreadyNote->bind_param('ii', $url, $author);
		$alreadyNote->execute();
		$alreadyNote->bind_result($nb);
		$alreadyNote->fetch();
		$alreadyNote->close();
		if($nb > 0){
			$createNote = $mysql->prepare('UPDATE note SET note = ? WHERE url = ? AND author = ?');
			$createNote->bind_param('iii', $note, $url, $author);
			$createNote->execute();
			$createNote->close();
		}
		else{
			$createNote = $mysql->prepare('INSERT INTO note(url, note, author) VALUES(?, ?, ?)');
			$createNote->bind_param('iii', $url, $note, $author);
			$createNote->execute();
			$createNote->close();
		}
		$mysql->close();
	}
?>