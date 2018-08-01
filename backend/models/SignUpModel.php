<?php

require_once 'ConnModel.php';

class SignUpModel extends Conexion {

    static public function signUp($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario = :usuario");

            $stmt->bindParam(":usuario", $datosModel['usuario'], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();

            $stmt->close();
            
    }

    static public function attemptsUser($datosModel, $tabla) {

         $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos = :intentos WHERE usuario = :usuario");
         $stmt->bindParam(":intentos", $datosModel['actualizarIntentos'], PDO::PARAM_INT);
         $stmt->bindParam(":usuario", $datosModel['usuarioActual'], PDO::PARAM_STR);

         if($stmt->execute()) {
             return 'success';
         } else {
             return 'failed';
         }

         $stmt->close();


    }
}