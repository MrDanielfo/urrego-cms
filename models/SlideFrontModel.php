<?php

require_once 'ConnectionModel.php';


class SlideFrontModel {

	static public function seleccionarSlide($tabla) {

		$stmt = Conection::connect()->prepare("SELECT id, ruta, titulo, descripcion FROM $tabla ORDER BY orden ASC"); 
        $stmt->execute();

        return $stmt->fetchAll();
        $stmt->close();

	}




}