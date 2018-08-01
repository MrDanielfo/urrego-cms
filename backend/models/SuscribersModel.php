<?php

require_once 'ConnModel.php'; 


class SuscribersModel {

    static public function mostrarMensajes($tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();


    }

    static public function borrarMensajes($id, $tabla) {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);


        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();

    }

    static public function emailSuscriptores($tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();  

    }

    static public function eliminarSuscriptores($id, $tabla) {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);


        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();


    }

    static public function notificaciones($tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT revision FROM $tabla");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();



    }

    static public function recibirNotificaciones($datosAjax, $tabla) {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET revision = :revision");
        $stmt->bindParam(":revision", $datosAjax, PDO::PARAM_INT);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();

    }

    static public function notificacionesSuscriptores($tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT revision FROM $tabla");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

    }

    static public function nuevoSuscriptor($datosAjax, $tabla) {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET revision = :revision");
        $stmt->bindParam(":revision", $datosAjax, PDO::PARAM_INT);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();

    }


}