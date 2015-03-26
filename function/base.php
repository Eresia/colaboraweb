<?php

    function beginPage($css, $titleHead){
        $beginText = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'."\n";
        $beginText .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">'."\n";
        $beginText .= '<head>'."\n";
        $beginText .= '<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>'."\n";
                for($i = 0; $i < count($css); $i++){
                    $beginText .= '<link rel="stylesheet" href="'.$css[$i].'" />'."\n";
                    $beginText .= '<link href="http://fonts.googleapis.com/css?family=Lobster|Orbitron:900|Oleo+Script+Swash+Caps:700|Denk+One|Open+Sans:600" rel="stylesheet" type="text/css">'."\n";
                }
                
                $beginText .=  '<title>'.$titleHead.'</title>'."\n";
            $beginText .= '</head>'."\n";
            $beginText .= '<body>'."\n";
        return $beginText;
    }
    
    function headerPage(){
        $menu = '<div class="header">'."\n";
		$menu .= '	<p class="titre">Col<span class="gras">LAB</span>ora<span class="gras">WEB</span></p>'."\n";
        $menu .= '  <div class="c_menu">'."\n";
        $menu .= '  <a href="http://localhost/colaboraweb/index.php"><img src="images/home147.svg" width="2.5%" height="2.5%" alt="Accueil"/>Home</a> ' ."\n";
        if(!isset($_SESSION['pseudo'])){
            $menu.= '   <a href="http://localhost/colaboraweb/login/login.php"><img src="images/user155.svg" width="2.5%" height="2.5%" alt="Connexion"/>Log in</a>'."\n";
        }
        else{
            $menu.= '<a href="http://localhost/colaboraweb/login/disconnect.php"><img src="images/user155.svg" width="2.5%" height="2.5%" alt="Deconnexion"/>Log out</a>'."\n";
        }
        $menu .= '   </div>'."\n";
        $menu .= '</div>'."\n";
        return $menu;
    }
    
    function rightMenu(){
        $menu = '<div class="r_menu">'."\n";
		$menu .= '  <p>TEST</p>'."\n";
		$menu .= '</div>';
        return $menu;
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
?>