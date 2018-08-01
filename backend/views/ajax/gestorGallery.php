<?php

require_once '../../controllers/GalleryController.php';
require_once '../../models/GalleryModel.php';


class GalleryAjax {

    public $imagenTemporal;

    public $idImagen;
    public $rutaImagen;

    public $almacenarOrdenId;
    public $ordenItem;


    public function gestorGalleryAjax() {

        $datos = $this->imagenTemporal; 

        $respuesta = new GalleryController();
        $respuesta->mostrarImagen($datos);

        return $respuesta;

    }

    public function eliminarImagenAjax() {

        $datos = array(
            "idImagen" => $this->idImagen,
            "rutaImagen" => $this->rutaImagen
        );

        $respuesta = new GalleryController();
        $respuesta->eliminarImagen($datos);

        return $respuesta;

    }

    public function cambiarOrdenAjax() {

        $datosAjax = array(
            "almacenarOrdenId" => $this->almacenarOrdenId,
            "ordenItem" => $this->ordenItem
        );

        $respuesta = new GalleryController();
        $respuesta->cambiarOrden($datosAjax);

        return $respuesta; 

    }



}

if(isset($_FILES['imagen']['tmp_name'])) {

    $imagenesAjax = new GalleryAjax();
    $imagenesAjax->imagenTemporal = $_FILES['imagen']['tmp_name']; 
    $imagenesAjax->gestorGalleryAjax();

}

if(isset($_POST['idImagen'])) {

    $borrarImagen = new GalleryAjax();
    $borrarImagen->idImagen = $_POST['idImagen'];
    $borrarImagen->rutaImagen = $_POST['rutaImagen'];
    $borrarImagen->eliminarImagenAjax();

}

if(isset($_POST['almacenarOrdenId'])) {

    $ordenImagen = new GalleryAjax();
    $ordenImagen->almacenarOrdenId = $_POST['almacenarOrdenId'];
    $ordenImagen->ordenItem = $_POST['ordenItem'];
    $ordenImagen->cambiarOrdenAjax();

}

