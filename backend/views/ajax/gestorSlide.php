<?php

require_once '../../models/SlideModel.php';
require_once '../../controllers/SlideController.php';

#Clase Slide Ajax

class SlideAjax {

    public $nombreImagen;
    public $imagenTemporal;
    public $idSlide;
    public $rutaSlide;

    public $enviarId;
    public $enviarTitulo;
    public $enviarDescripcion;

    public $actualizarOrden;
    public $ordenItem;

    public function gestorSlideAjax(){

        $datosAjax = array(
            "nombreImagen" => $this->nombreImagen,
            "imagenTemporal" => $this->imagenTemporal
        );

        $respuesta = new SlideController();

        $respuesta->subirImagen($datosAjax);

        return $respuesta;

    }

    public function eliminarSlideAjax(){

        $datos = array(
            "idSlide"  => $this->idSlide,
            "rutaSlide" => $this->rutaSlide
        );

        $respuesta = new SlideController();
        $respuesta->eliminarImagenVista($datos);

        return $respuesta;

    }

    public function editarSlideAjax(){

        $datos = array(
            "enviarId"           => $this->enviarId,
            "enviarTitulo"        => $this->enviarTitulo,
            "enviarDescripcion"   => $this->enviarDescripcion
        );

        $respuesta = new SlideController();
        $respuesta->editarSlideVista($datos);

        return $respuesta;

    }

    public function actualizarOrdenAjax(){
        $datos = array(
            "actualizarOrden" => $this->actualizarOrden,
            "ordenItem"       => $this->ordenItem
        );

        $respuesta = new SlideController();
        $respuesta->actualizarOrdenSlide($datos);

    }



}

if(isset($_FILES['imagen']['name'])) {
    $imagen = new SlideAjax();
    $imagen->nombreImagen = $_FILES['imagen']['name'];
    $imagen->imagenTemporal = $_FILES['imagen']['tmp_name'];

    $imagen->gestorSlideAjax();
}





if(isset($_POST['idSlide'])) {

    $id = new SlideAjax();
    $id->idSlide = $_POST['idSlide'];
    $id->rutaSlide = $_POST['rutaSlide'];
    $id->eliminarSlideAjax();

}

if(isset($_POST['enviarId'])) {

    $slideEditado = new SlideAjax();
    $slideEditado->enviarId = $_POST['enviarId'];
    $slideEditado->enviarTitulo = $_POST['enviarTitulo'];
    $slideEditado->enviarDescripcion = $_POST['enviarDescripcion'];

    $slideEditado->editarSlideAjax();

}

if(isset($_POST['actualizarOrden'])) {

    $slideOrdenado =  new SlideAjax();
    $slideOrdenado->actualizarOrden = $_POST['actualizarOrden'];
    $slideOrdenado->ordenItem = $_POST['ordenItem'];

    $slideOrdenado->actualizarOrdenAjax();



}

