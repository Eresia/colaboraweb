<?php

    function beginPage($css, $titleHead){
        $beginText = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
        $beginText .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">';
        $beginText .= '<head>';
        $beginText .= '<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>';
                for($i = 0; $i < count($css); $i++){
                    $beginText .= '<link rel="stylesheet" href="'.$css[$i].'" />';
                    $beginText .= '<link href="http://fonts.googleapis.com/css?family=Lobster|Orbitron:900|Oleo+Script+Swash+Caps:700|Denk+One|Open+Sans:600" rel="stylesheet" type="text/css">';
                }
                
                $beginText .=  '<title>'.$titleHead.'</title>';
            $beginText .= '</head>';
            $beginText .= '<body>';
        return $beginText;
    }
    
    function menu(){
        $menu = '<div class="menu">';
        $menu .= '<a href="http://localhost/colaboraweb/index.php">Accueil</a> ' ;
        if(!isset($_SESSION['pseudo'])){
            $menu.= '<a href="http://localhost/colaboraweb/login/login.php">Connexion</a>';
        }
        else{
            $menu.= '<a href="http://localhost/colaboraweb/login/disconnect.php">Se déconnecter</a>';
        }
        $menu.= '</div>';
        return $menu;
    }
    
    function setTitle($title){
       return '<div class="title"><p>'.$title.'</p></div>';
    }
    
    function endPage(){
        return '</body></html>';
    }
?>