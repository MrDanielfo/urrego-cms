<?php

require_once 'ConnectionModel.php';

class SuscribersFrontModel {

  static  public function registroMensajes($datosModel, $tabla) {

    $stmt = Conection::connect()->prepare("INSERT INTO $tabla (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)");
    $stmt->bindParam(":nombre", $datosModel['nombreFrontal'], PDO::PARAM_STR);
    $stmt->bindParam(":email", $datosModel['emailFrontal'], PDO::PARAM_STR);
    $stmt->bindParam(":mensaje", $datosModel['mensajeFrontal'], PDO::PARAM_STR);


    if($stmt->execute()) {
        return 'ok';
    } else {
       return  'error';
    }


	$stmt->close();


  }


  static public function registroSuscriptores($datosModel, $tabla) {

    $stmt = Conection::connect()->prepare("INSERT INTO $tabla (nombre, email) VALUES (:nombre, :email)");
    $stmt->bindParam(":nombre", $datosModel['nombreFrontal'], PDO::PARAM_STR);
    $stmt->bindParam(":email", $datosModel['emailFrontal'], PDO::PARAM_STR);

      if($stmt->execute()) {
          return 'ok';
      } else {
        return  'error';
      }


	    $stmt->close();

  }

  static public function revisarSuscriptor($suscriptor, $tabla) {

    $stmt = Conection::connect()->prepare("SELECT email FROM $tabla WHERE email = :email");
    $stmt->bindParam(":email", $suscriptor, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetch();


    $stmt->close();

  }

}