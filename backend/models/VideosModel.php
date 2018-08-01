<?php


require_once 'ConnModel.php'; 

class VideosModel {

    static public function subirVideo($ruta, $tabla) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (ruta) VALUES (:ruta)");

        $stmt->bindParam(":ruta", $ruta, PDO::PARAM_STR);
        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();

    }

    static public function mostrarVideo($ruta, $tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ruta = :ruta");
        $stmt->bindParam(":ruta", $ruta, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        

    }

    static public function mostrarVideosVista($tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY orden ASC");
    
        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();


    }

    static public function eliminarVideo($datosAjax, $tabla) {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datosAjax['videoId'], PDO::PARAM_INT);
    
        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();

    }

    static public function cambiarOrden($datos, $tabla) {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden WHERE id = :id");


       
        $stmt->bindParam(":id", $datos['almacenarOrden'], PDO::PARAM_INT);
        $stmt->bindParam(":orden", $datos['ordenItem'], PDO::PARAM_INT);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();


    }




}