<?php

class LinksModel {

    static public function pagesLinkModel($enlaces){
        if( $enlaces == "inicio" ||
            $enlaces == "signup" ||
            $enlaces == "slide" ||
            $enlaces == "articles" ||
            $enlaces == "videos" ||
            $enlaces == "suscribers" ||
            $enlaces == "messages" ||
            $enlaces == "gallery" ||
            $enlaces == "profile" ||
            $enlaces == "signout") {
            
            $page = 'views/modules/'.$enlaces.'.php'; 
    } else if ($enlaces == "index") {

            $page = 'views/modules/signup.php';

    } else if ($enlaces == "fail") {
            $page = 'views/modules/signup.php';
    } else if ($enlaces == "fail3attempts") {
            $page = 'views/modules/signup.php';
    } else {
            $page = 'views/modules/signup.php';
    } 

        return $page;

    }

}