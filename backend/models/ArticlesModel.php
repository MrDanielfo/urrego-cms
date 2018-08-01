<?php

require_once 'ConnModel.php';

class ArticlesModel extends Conexion {

    static public function guardarArticulo($datos, $tabla){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (titulo, extracto, imagen, contenido  ) VALUES (:titulo, :extracto, :imagen, :contenido)"); 
        $stmt->bindParam(":titulo", $datos['titulo'], PDO::PARAM_STR);
        $stmt->bindParam(":extracto", $datos['extracto'], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $datos['imagen'], PDO::PARAM_STR);
        $stmt->bindParam(":contenido", $datos['contenido'], PDO::PARAM_STR);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();

    }

    static public function mostrarArticulos($tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY orden ASC");
        $stmt->execute();

        return $stmt->fetchAll();
         $stmt->close();
    }

    static public function borrarArticulo($id, $tabla) {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();


    }

    static public function editarArticulo($datos, $tabla) {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo, extracto = :extracto, imagen = :imagen, contenido = :contenido WHERE id = :id"); 
        $stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);
        $stmt->bindParam(":titulo", $datos['titulo'], PDO::PARAM_STR);
        $stmt->bindParam(":extracto", $datos['extracto'], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $datos['imagen'], PDO::PARAM_STR);
        $stmt->bindParam(":contenido", $datos['contenido'], PDO::PARAM_STR);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();



    }

    static public function actualizarOrdenArticulos($datos, $tabla) {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden  WHERE id = :id"); 
        $stmt->bindParam(":id", $datos['almacenarOrden'], PDO::PARAM_INT);
        $stmt->bindParam(":orden", $datos['ordenItem'], PDO::PARAM_INT);

        $stmt->execute();
    
        $stmt->close();

    }


}