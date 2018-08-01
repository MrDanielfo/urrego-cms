<?php

require_once 'ConnModel.php';


class SlideModel extends Conexion {

    static public function subirImagen($ruta, $tabla){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (ruta ) VALUES (:ruta)"); 
        $stmt->bindParam(":ruta", $ruta, PDO::PARAM_STR);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();

    }

    static public function mostrarImagen($ruta, $tabla){
         $stmt = Conexion::conectar()->prepare("SELECT ruta, titulo, descripcion FROM $tabla WHERE ruta = :ruta"); 
         $stmt->bindParam(":ruta", $ruta, PDO::PARAM_STR);
         $stmt->execute();

         return $stmt->fetch();
         $stmt->close();

    }

    static public function mostrarImagenVista($tabla) {

         $stmt = Conexion::conectar()->prepare("SELECT id, ruta, titulo, descripcion FROM $tabla ORDER BY orden ASC"); 
         $stmt->execute();

         return $stmt->fetchAll();
         $stmt->close();
    }

    static public function eliminarImagenVista($datos, $tabla) {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos['idSlide'], PDO::PARAM_INT);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        
        $stmt->close();


    }

    static public function editarSlideVista($datos, $tabla) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo, descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(":id", $datos['enviarId'], PDO::PARAM_INT);
        $stmt->bindParam(":titulo", $datos['enviarTitulo'], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos['enviarDescripcion'], PDO::PARAM_STR);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

      
        $stmt->close();

    }

    static public function actualizacionSlideVista($datos, $tabla){

         $stmt = Conexion::conectar()->prepare("SELECT titulo, descripcion FROM $tabla WHERE id = :id");
         $stmt->bindParam(":id", $datos['enviarId'], PDO::PARAM_INT);
         $stmt->execute();

         return $stmt->fetch();
         $stmt->close();


    }

    static public function actualizarOrdenSlide($datos, $tabla) {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden WHERE id = :id");
        $stmt->bindParam(":id", $datos['actualizarOrden'], PDO::PARAM_INT);
        $stmt->bindParam(":orden", $datos['ordenItem'], PDO::PARAM_INT);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        $stmt->close();
    }

    static public function ordenActualizado($tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT id, ruta, titulo, descripcion FROM $tabla ORDER BY orden ASC"); 
        $stmt->execute();

         return $stmt->fetchAll();
        $stmt->close();

    }


}