<?php
	require_once(SERV_ROOT.'/define/mysql_define.php');
	require_once(SERV_ROOT.'/define/admin_define.php');

    function beginPage($css, $titleHead){
        $beginText = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
        $beginText .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">';
        $beginText .= '<head>';
        $beginText .= '<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>';
                for($i = 0; $i < count($css); $i++){
                    $beginText .= '<link rel="stylesheet" href="'.$css[$i].'" />';
                }
                $beginText .= '<script src="'.HTTP_ROOT.'/js/notation.js" type="text/javascript"></script>';
				$beginText .= '<link href="http://fonts.googleapis.com/css?family=Lobster|Orbitron:900|Oleo+Script+Swash+Caps:700|Denk+One|Open+Sans:600" rel="stylesheet" type="text/css" />';
                
                $beginText .=  '<title>'.$titleHead.'</title>';
            $beginText .= '</head>';
            $beginText .= '<body>';
        return $beginText;
    }
    
    function headerPage(){
        $menu = '<div class="header">';
		$menu .= '<p class="titre"><a href="http://localhost/colaboraweb/" >Col<span class="gras">LAB</span>ora<span class="gras">WEB</span></a></p>';
        $menu .= '<div class="c_menu">';
        $menu .= '<a href="'.HTTP_ROOT.'/index.php"><img src="'.HTTP_ROOT.'/images/home147.svg" width="2.5%" height="2.5%" alt="Accueil"/>Home</a>';
        if(!isset($_SESSION['pseudo'])){
            $menu.= '<a href="'.HTTP_ROOT.'/login/login.php"><img src="'.HTTP_ROOT.'/images/user155.svg" width="2.5%" height="2.5%" alt="Connexion"/>Log in</a>';
        }
        else{
            $menu.= '<a href="'.HTTP_ROOT.'/login/disconnect.php"><img src="'.HTTP_ROOT.'/images/user155.svg" width="2.5%" height="2.5%" alt="Deconnexion"/>Log out</a>';
        }
        $menu .= '</div>';
        $menu .= '</div>';
        return $menu;
    }
    
    function topMenu(){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$query_category = $mysql->query('SELECT * FROM category');
		$menu = '<div class="h_menu">';
		$menu .= '<ul>';
		$previous = array();
		while($category = $query_category->fetch_assoc()){
			$previous[$category['previous']] = (new ArrayObject($category))->getArrayCopy();
		}
		$id = 0;
		while(isset($previous[$id])){
			$menu .= '<li class="icohtml" id="'.$previous[$id]['name'].'"><a style="color:#'.str_pad(dechex($previous[$id]['color']), 6, "0", STR_PAD_LEFT).'" href="'.HTTP_ROOT.'/index.php?category='.$previous[$id]['id'].'">'.$previous[$id]['name'].'</a></li>';
			$id = $previous[$id]['id'];
		}
		$menu .= '</ul>';
		$menu .= '</div>';
        $query_category->close();
		$mysql->close();
        return $menu;
    }
    
    function rightMenu(){
        $menu = '<div class="r_menu">';
		if(isset($_SESSION['id'])){
			$menu .= '<p>'.$_SESSION['pseudo'].'</p>';
			$menu .= '<p><a href="'.HTTP_ROOT.'/profil/edit_profil.php">Profil</a></p>';

			if($_SESSION['group'] >= EVALU){
				$menu .= '<a href="'.HTTP_ROOT.'/url/createPost.php">Créer un post</a>';

			}
			if($_SESSION['group'] == ADMIN){
				$menu .= '<p><a href="'.HTTP_ROOT.'/administration/administration.php">Administration</a></p>';
			}
		}
		else{
			$menu .= '<p>Bienvenue Visiteur, vous pouvez vous <a href="'.HTTP_ROOT.'/login/subscribe.php">INSCRIRE</a> ou vous <a href="'.HTTP_ROOT.'/login/login.php">CONNECTER</a> si vous d&eacutesirez poster des liens et des commentaires.</p>';
		}
		$menu .= '</div>';
        return $menu;
    }
	
	function begin_content(){
		$result = '<div class="wrap">';
        $result .= headerPage();
		$result .= '<div class="core">';

		$result .= topMenu();
        $result .= rightMenu();


		$result .= '<div class="content">';
	
		return $result;
	}
	
	function end_content(){
		$result = '</div>';
		$result .= '</div>';

		$result .= footerPage();
		$result .= '</div>';
		
		return $result;
	}
    
    function footerPage(){
        $footer = '<div class="footer">';
		$choos = rand(0,1);

		if($choos==0){
			$footer .=  "<p>Thomas LEFEBVRE &amp; Bastien LEPESANT  2015 Copyright : Tous droits réservé parce que c'est plus facile.</p>";
        }
        elseif($choos==1){
            $footer .=  "<p>Bastien LEPESANT &amp; Thomas LEFEBVRE  2015 Copyright : Tous droits réservé parce que c'est plus facile.</p>";
        }		
	
		$footer .=  '</div>';
        return $footer;
    }
    
    function setTitle($title){
       return '<div class="title"><p>'.$title.'</p></div>';
    }
    
    function endPage(){
        return '</body></html>';
    }
	
	function indent($code){
		$code = str_replace("\n", "", $code);
		$code = str_replace("	", "", $code);
		$result = '';
		$indent = 0;
		$doctype = false;
		$close = false;
		$javascript = false;
		$textarea = false;
		for($i = 0; $i < strlen($code); $i++){
			if(!$javascript){
				if(substr($code, $i+1, 2) == '</'){
					$indent--;
				}
				if($code[$i] == '<'){
					if($code[$i+1] == '!'){
						$doctype = true;
					}
					else{
						if($code[$i+1] == '/'){
							$close = true;
							if($textarea){
								$textarea = false;
							}
						}
						else if(substr($code, $i+1, 8) == 'textarea'){
							$textarea = true;
						}
						else if((substr($code, $i+1, 6) == 'script') && !(substr($code, $i+8, 3) == 'src')){
							$javascript = true;
						}
						
					}
					$result .= '<';
				}
				else if($code[$i] == '>'){
					if($doctype){
						$doctype = false;
						$result .= ">\n";
						for($j = 0; $j < $indent; $j++){
							$result .= '	';
						}
					}
					else if($close){
						$close = false;
						$result .= ">\n";
						for($j = 0; $j < $indent; $j++){
							$result .= '	';
						}
					}
					else if($code[$i-1] != '/'){
						if($textarea){
							$result .= ">";
						}
						else{
							$result .= ">\n";
							$indent++;
							for($j = 0; $j < $indent; $j++){
								$result .= '	';
							}
						}
					}
					else{
						
						$result .= ">\n";
						for($j = 0; $j < $indent; $j++){
							$result .= '	';
						}
					}
				}
				else{
					$result .= $code[$i];
					if($code[$i+1] == "<" && (substr($code, $i+2, 9) != '/textarea')){
						$result .= "\n";
						for($j = 0; $j < ($indent); $j++){
							$result .= '	';
						}
					}
				}
			}
			else{
				if(($code[$i] == "<") && (substr($code, $i+1, 3) == '!--')){
					$result .= "\n";
					for($j = 0; $j < ($indent); $j++){
						$result .= '	';
					}
					$result .= '<!--';
					$i+=3;
					$result .= "\n";
					$indent++;
					for($j = 0; $j < ($indent); $j++){
						$result .= '	';
					}
				}
				else if($code[$i] == "{"){
					if(!($code[$i+1] == "}")){
						$result .= $code[$i];
						$result .= "\n";
						$indent++;
						for($j = 0; $j < ($indent); $j++){
							$result .= '	';
						}
					}
					else{
						$result .= "{}";
						$i++;
					}
				}
				else if(($code[$i] == ";") || ($code[$i] == "}")){
					$result .= $code[$i];
					if($code[$i+1] == "}"){
						$indent--;
					}
					if($code[$i+1] != ";"){
						if(substr($code, $i+1, 3) == '-->'){
							$javascript = false;					
							$indent--;
							$result .= "\n";
							for($j = 0; $j < ($indent); $j++){
								$result .= '	';
							}
							$result .= '-->'."\n";
							for($j = 0; $j < ($indent); $j++){
								$result .= '	';
							}
							$i += 3;
						}
						else{
							$result .= "\n";
							for($j = 0; $j < ($indent); $j++){
								$result .= '	';
							}
						}
					}
				}
				else{
					$result .= $code[$i];
				}
			}
		}
		return $result;
	}
?>