<?php

require_once '../../controllers/SuscribersController.php';
require_once '../../models/SuscribersModel.php';


class SuscribersAjax  {

    public $notificaciones;

    public $nuevoSuscriptor;

    public function recibirNotificacionesAjax() {

        $datosAjax = $this->notificaciones;

        $respuesta = new SuscribersController();

        $respuesta->recibirNotificaciones($datosAjax);

        return $respuesta;

    }

    public function nuevoSuscriptorAjax() {

        $datosAjax = $this->nuevoSuscriptor;

        $respuesta = new SuscribersController();
        $respuesta->nuevoSuscriptor($datosAjax);

        return $respuesta; 


    }

    
}


if(isset($_POST['notificaciones'])) {
    $actualizacion = new SuscribersAjax();
    $actualizacion->notificaciones = $_POST['notificaciones'];
    $actualizacion->recibirNotificacionesAjax();

}

if(isset($_POST['nuevoSuscriptor'])) {

    $actualizacionSuscriptores = new SuscribersAjax();
    $actualizacionSuscriptores->nuevoSuscriptor = $_POST['nuevoSuscriptor'];
    $actualizacionSuscriptores->nuevoSuscriptorAjax();


}