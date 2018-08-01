<?php


require_once '../../controllers/VideosController.php';
require_once '../../models/VideosModel.php';


class VideosAjax  {

    public $video;
    public $videoId;
    public $videoRuta;

    public $almacenarOrden;
    public $ordenItem;

    public function mostrarVideoAjax(){

        $datos = $this->video;

        $respuesta = new VideosController();
        $respuesta->mostrarVideo($datos);
        return $respuesta; 

    }

    public function eliminarVideoAjax(){

        $datosAjax = array(
            "videoId" => $this->videoId,
            "videoRuta" => $this->videoRuta
        );

        $envio = new VideosController();
        $envio->eliminarVideo($datosAjax);

    }

    public function cambiarOrdenAjax(){
        $datosAjax = array(
            "almacenarOrden" => $this->almacenarOrden,
            "ordenItem" => $this->ordenItem
        );

        $envio = new VideosController();
        $envio->cambiarOrden($datosAjax);

        return $envio;

    }

}



if(isset($_FILES['video']['tmp_name'])) {

    $video = new VideosAjax();
    $video->video = $_FILES['video']['tmp_name'];
    $video->mostrarVideoAjax();

}

if(isset($_POST['videoId'])) {

    $eliminarVideo = new VideosAjax();
    $eliminarVideo->videoId = $_POST['videoId'];
    $eliminarVideo->videoRuta = $_POST['videoRuta'];
    $eliminarVideo->eliminarVideoAjax();


}


if(isset($_POST['almacenarOrden'])) {

    $ordenVideos = new VideosAjax();
    $ordenVideos->almacenarOrden = $_POST['almacenarOrden'];
    $ordenVideos->ordenItem = $_POST['ordenItem'];
    $ordenVideos->cambiarOrdenAjax();


}