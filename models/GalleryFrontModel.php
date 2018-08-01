<?php

require_once 'ConnectionModel.php';

class GalleryFrontModel {

	static public function mostrarImagenes($tabla){

		$stmt = Conection::connect()->prepare("SELECT * FROM $tabla ORDER BY orden ASC");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}

	






}