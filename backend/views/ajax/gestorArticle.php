<?php


require_once '../../models/ArticlesModel.php';
require_once '../../controllers/ArticlesController.php'; 


class ArticlesAjax {

    public $imagenTemporal;
    public $almacenarOrden;
    public $ordenItem;

    public function mostrarImagenMiniatura(){

        $datos = $this->imagenTemporal; 

        $respuesta = new ArticlesController();
        $respuesta->mostrarImagenMiniatura($datos);

        return $respuesta; 

    }

    public function ordenArticulosAjax() {

        $datosAjax = array(
            "almacenarOrden" => $this->almacenarOrden,
            "ordenItem"     => $this->ordenItem
        ); 

        $respuesta = new ArticlesController();
        $respuesta->actualizarOrdenArticulos($datosAjax);

        return $respuesta;

    }

    

}

if(isset($_FILES['imagen']['tmp_name'])) {

    $imagenMiniatura = new ArticlesAjax();
    $imagenMiniatura->imagenTemporal = $_FILES['imagen']['tmp_name']; 
    $imagenMiniatura->mostrarImagenMiniatura();

}

if(isset($_POST['almacenarOrden'])) {

    $ordenArticulos = new ArticlesAjax();
    $ordenArticulos->almacenarOrden = $_POST['almacenarOrden'];
    $ordenArticulos->ordenItem = $_POST['ordenItem'];

    $ordenArticulos->ordenArticulosAjax();

}

