<?php

require_once 'ConnectionModel.php'; 

class VideosFrontModel {


	static public function mostrarVideos($tabla) {

		$stmt = Conection::connect()->prepare("SELECT * FROM $tabla ORDER BY orden ASC");
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

	}


}