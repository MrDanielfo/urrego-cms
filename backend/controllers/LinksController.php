<?php


class LinksController {


    public function links(){
        if(isset($_GET["action"])) {

            $enlaces = $_GET["action"];
        } else {
            $enlaces = "index";
        }

        $respuesta = LinksModel::pagesLinkModel($enlaces);
        include $respuesta;
    }
}