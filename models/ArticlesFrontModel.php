<?php

require_once 'ConnectionModel.php';


class ArticlesFrontModel  {

  	static public function mostrarArticulos($tabla){

	  	$stmt = Conection::connect()->prepare("SELECT id, titulo, extracto, imagen, contenido FROM $tabla ORDER BY orden ASC");
	  	$stmt->execute();

	    return $stmt->fetchAll();
	    $stmt->close();

  	}


}