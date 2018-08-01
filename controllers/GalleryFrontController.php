<?php


class GalleryFrontController {

	public function mostrarImagenes() {

		$respuesta = GalleryFrontModel::mostrarImagenes("galerias");
		foreach ($respuesta as $key => $item) {
			echo '<li id="image-'. $item['id'] .'">
	                <a rel="grupo" href="backend/'. substr($item["ruta"], 6) .'">
	                	<img src="backend/'. substr($item["ruta"], 6) .'">
	                </a>
        		</li>';
		}


	}

	





}