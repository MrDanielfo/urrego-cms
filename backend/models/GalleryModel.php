<?php

require_once 'ConnModel.php';

class GalleryModel {

    static public function subirImagen($ruta, $tabla){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (ruta) VALUES (:ruta)" );
        $stmt->bindParam(":ruta", $ruta, PDO::PARAM_STR);
        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();

    }

    static public function mostrarImagen($ruta, $tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ruta = :ruta ORDER BY orden ASC" );
        $stmt->bindParam(":ruta", $ruta, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
        $stmt->close();

    }

    static public function mostrarImagenContenedor($tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT id, ruta, orden FROM $tabla ORDER BY orden ASC" );
        $stmt->execute();

        return $stmt->fetchAll();
        $stmt->close();

    }

    static public function eliminarImagen($datos, $tabla) {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id" );
        $stmt->bindParam(":id", $datos['idImagen'], PDO::PARAM_INT);
        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();

    }

    static public function cambiarOrden($datos, $tabla) {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden WHERE id = :id" );
        $stmt->bindParam(":id", $datos['almacenarOrdenId'], PDO::PARAM_INT);
        $stmt->bindParam(":orden", $datos['ordenItem'], PDO::PARAM_INT);
        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();


    }


}