<?php


class ArticlesFrontController {

	public function mostrarArticulos() {

		$respuesta = ArticlesFrontModel::mostrarArticulos("articulos");

		foreach ($respuesta as $key => $item) {

		echo '<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                <img src="backend/'. $item['imagen'] .'" class="img-thumbnail">
                <h1>'. $item['titulo'] .'</h1>
                <p>'. $item['extracto'] .'.</p>
                <a href="#articulo-'. $item['id'] .'" data-toggle="modal">
                	<button class="btn btn-default">Leer Más</button>
                </a>

                <hr>

              </li>'; 

        echo '<div id="articulo-'. $item['id'] .'" class="modal fade">
      
    			<div class="modal-dialog modal-content">

        			<div class="modal-header" style="border:1px solid #eee">
        
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
        				<h3 class="modal-title">'. $item['titulo'] .'</h3>
        
    				</div>

	    			<div class="modal-body" style="border:1px solid #eee">
	        
		    			<img src="backend/'. $item['imagen'] .'" width="100%" style="margin-bottom:20px">
		    			<p class="parrafoContenido text-justify">'. $item['contenido'] .'</p>
	        
	    			</div>

	    			<div class="modal-footer" style="border:1px solid #eee">
	        
	    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	    			</div>

    			</div>

			</div>';
			
		}

	}


}