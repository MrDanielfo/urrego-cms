<?php


class SlideFrontController {

	public function seleccionarSlide(){

		$respuesta = SlideFrontModel::seleccionarSlide("slides");

		foreach($respuesta as $row => $item) {
            echo '<li>
                	<img src="backend/'. substr($item["ruta"], 6) .'">
                	<div class="slideCaption">
                    	<h3>'. $item["titulo"] .'</h3>
                    	<p>'. $item["descripcion"] .'</p>
                	</div>
                </li>';
        }



	}



}