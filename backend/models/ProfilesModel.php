<?php

require_once 'ConnModel.php';

class ProfilesModel {

    static public function crearPerfil($datos, $tabla) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, pass, email, foto, rol) values (:usuario, :pass, :email, :foto, :rol)");
        $stmt->bindParam(":usuario", $datos['usuario'], PDO::PARAM_STR);
        $stmt->bindParam(":pass", $datos['pass'], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos['foto'], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $datos['rol'], PDO::PARAM_INT);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();

    }

    static public function mostrarPerfiles($tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();


    }

    static public function editarPerfil($datos, $tabla) {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, pass = :pass, email = :email, foto = :foto, rol = :rol WHERE id = :id");
        $stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);
        $stmt->bindParam(":usuario", $datos['usuario'], PDO::PARAM_STR);
        $stmt->bindParam(":pass", $datos['pass'], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos['foto'], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $datos['rol'], PDO::PARAM_INT);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();

    }

    static public function borrarPerfil($datos, $tabla) {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla  WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt->close();


    }



}