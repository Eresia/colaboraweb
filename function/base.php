<?php
	require_once(SERV_ROOT.'/define/mysql_define.php');

    function beginPage($css, $titleHead){
        $beginText = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'."\n";
        $beginText .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">'."\n";
        $beginText .= '<head>'."\n";
        $beginText .= '<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>'."\n";
                for($i = 0; $i < count($css); $i++){
                    $beginText .= '<link rel="stylesheet" href="'.$css[$i].'" />'."\n";
                }
				$beginText .= '<link href="http://fonts.googleapis.com/css?family=Lobster|Orbitron:900|Oleo+Script+Swash+Caps:700|Denk+One|Open+Sans:600" rel="stylesheet" type="text/css" />'."\n";
                
                $beginText .=  '<title>'.$titleHead.'</title>'."\n";
            $beginText .= '</head>'."\n";
            $beginText .= '<body>'."\n";
        return $beginText;
    }
    
    function headerPage(){
        $menu = '<div class="header">'."\n";
		$menu .= '	<p class="titre">Col<span class="gras">LAB</span>ora<span class="gras">WEB</span></p>'."\n";
        $menu .= '  <div class="c_menu">'."\n";
        $menu .= '  <a href="'.HTTP_ROOT.'/index.php"><img src="'.HTTP_ROOT.'/images/home147.svg" width="2.5%" height="2.5%" alt="Accueil"/>Home</a> ' ."\n";
        if(!isset($_SESSION['pseudo'])){
            $menu.= '   <a href="'.HTTP_ROOT.'/login/login.php"><img src="'.HTTP_ROOT.'/images/user155.svg" width="2.5%" height="2.5%" alt="Connexion"/>Log in</a>'."\n";
        }
        else{
            $menu.= '<a href="'.HTTP_ROOT.'/login/disconnect.php"><img src="'.HTTP_ROOT.'/images/user155.svg" width="2.5%" height="2.5%" alt="Deconnexion"/>Log out</a>'."\n";
        }
        $menu .= '   </div>'."\n";
        $menu .= '</div>'."\n";
        return $menu;
    }
    
    function topMenu(){
		$mysql = new MySQLi(DTB_LINK, DTB_USER, DTB_PASS, DTB_NAME);
		$mysql->query("SET NAMES UTF8");
		$query_category = $mysql->query('SELECT * FROM category');
		$menu = '<div class="h_menu">'."\n";
		$menu .= '    <ul>'."\n";
		$previous = array();
		while($category = $query_category->fetch_assoc()){
			$previous[$category['previous']] = (new ArrayObject($category))->getArrayCopy();
		}
		$id = 0;
		while(isset($previous[$id])){
			$menu .= '        <li class="icohtml" id="'.$previous[$id]['name'].'"><a style="color:#'.dechex($previous[$id]['color']).'" href="'.HTTP_ROOT.'/index.php?category='.$previous[$id]['id'].'">'.$previous[$id]['name'].'</a></li>'."\n";
			$id = $previous[$id]['id'];
		}
		$menu .= '    </ul>'."\n";
		$menu .= '</div>'."\n";
        
        return $menu;
    }
    
    function rightMenu(){
        $menu = '<div class="r_menu">'."\n";
		if(isset($_SESSION['id'])){
			$menu .= '  <p>'.$_SESSION['pseudo'].'</p>'."\n";
			$menu .= '  <p><a href="'.HTTP_ROOT.'/profil/edit_profil.php">Profil</a></p>'."\n";
			if($_SESSION['group'] == 3){
				$menu .= '  <p><a href="'.HTTP_ROOT.'/administration/administration.php">Administration</a></p>'."\n";
			}
		}
		else{
			$menu .= '  <p>
                            Bienvenue Visiteur,
                            vous pouvez vous <a href="'.HTTP_ROOT.'/login/subscribe.php">INSCRIRE</a> ou vous <a href="'.HTTP_ROOT.'/login/login.php">CONNECTER</a> si vous désirez poster des liens et des commentaires.
                        </p>'."\n";
		}
		$menu .= '</div>';
        return $menu;
    }
	
	function begin_content(){
		$result = '<div class="wrap">'."\n";
        $result .= headerPage();
		$result .= '	<div class="core">'."\n";

		$result .= topMenu();
        $result .= rightMenu();

		$result .= '		<div class="content">'."\n";
			
		return $result;
	}
	
	function end_content(){
		$result = '		</div>'."\n";
		$result .= '	</div>'."\n";

		$result .= footerPage();
		$result .= '</div>'."\n";
		
		return $result;
	}
    
    function footerPage(){
        $footer = '<div class="footer">'."\n";
		$choos = rand(0,1);

		if($choos==0){
			$footer .=  "   <p>Thomas LEFEBVRE &amp; Bastien LEPESANT  2015 Copyright : Tous droits réservés parce que c'est plus facile.</p>"."\n";
        }
        elseif($choos==1){
            $footer .=  "   <p>Bastien LEPESANT &amp; Thomas LEFEBVRE  2015 Copyright : Tous droits réservés parce que c'est plus facile.</p>"."\n";
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
		$textarea = false;
		for($i = 0; $i < strlen($code); $i++){
			if($code[$i] == '<'){
				if($code[$i+1] == '!'){
					$doctype = true;
				}
				else{
					$result .= "\n";
					if($code[$i+1] == '/'){
						$close = true;
						$indent--;
						if(substr($code, $i+2, 8) == 'textarea'){
							$textarea = false;
						}
					}
					else if(substr($code, $i+1, 8) == 'textarea'){
						$textarea = true;
					}
					for($j = 0; $j < $indent; $j++){
						$result .= '	';
					}
				}
				$result .= '<';
			}
			else if($code[$i] == '>'){
				if($doctype){
					$doctype = false;
				}
				else if($close){
					$close = false;
				}
				else if($code[$i-1] != '/'){
					$indent++;
				}
				$result .= ">\n";
			}
			else{
				if(($result[strlen($result)-1] == "\n") && !$textarea){
					for($j = 0; $j < $indent; $j++){
						$result .= '	';
					}
				}
				$result .= $code[$i];
			}
		}
		return $result;
	}
?>