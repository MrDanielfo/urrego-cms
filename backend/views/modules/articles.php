<!--=====================================
			ARTÍCULOS ADMINISTRABLE          
			======================================-->
<?php
    session_start();


    if(!$_SESSION['validar']) {
        header('Location:index.php?action=signup');

        exit();
    }

    include 'buttons.php';
    include 'header.php';
        

?>
			
<div id="seccionArticulos" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
				
    <button id="btnAgregarArticulo" class="btn btn-info btn-lg">Agregar Artículo</button>

				<!--==== AGREGAR ARTÍCULO  ====-->

    <div id="agregarArticulo" style="display:none;">

        <form method="POST" enctype="multipart/form-data">
        
            <input type="text" name="tituloArticulo" placeholder="Título del Artículo" class="form-control" required>

            <textarea name="extractoArticulo" id="" cols="30" rows="5" placeholder="Introducción del Articulo" class="form-control" maxlength="170" required></textarea>

            <input type="file" name="imagenArticulo" class="btn btn-default" id="subirFoto" required>

            <p>Tamaño recomendado: 800px * 400px, peso máximo 2MB</p>

            <div id="arrastreImagenArticulo">	
                <!-- se llama con Ajax -->
            </div>

            <textarea name="contenidoArticulo" id="" cols="30" rows="10" placeholder="Contenido del Articulo" class="form-control" required></textarea>

            <input type="submit" id="guardarArticulo" class="btn btn-primary" value="Guardar Artículo">

        </form>

        <?php
            $guardarArticulo = new ArticlesController();
            $guardarArticulo->guardarArticulo();
        ?>
    </div>

    <hr>

				<!--==== EDITAR ARTÍCULO  ====-->

        <ul id="editarArticulo">

        
        <?php
            $mostrarArticulos = new ArticlesController();
            $mostrarArticulos->mostrarArticulos();
            $mostrarArticulos->borrarArticulo();
            $mostrarArticulos->editarArticulo();
        ?>

        </ul>

        

        <button class="btn btn-warning pull-right" id="ordenarArticulos" style="margin:10px 30px">Ordenar Artículos</button>
        <button class="btn btn-primary pull-right" id="guardarOrdenArticulos" style="display: none; margin:10px 30px">Guardar Orden Artículos</button>

</div>

			<!--====  Fin de ARTÍCULOS ADMINISTRABLE  ====-->

			<!--=====================================
			ARTÍCULO MODAL         
			======================================-->

<!--<div id="articulo1" class="modal fade">

    <div class="modal-dialog modal-content">

        <div class="modal-header" style="border:1px solid #eee">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Lorem Ipsum</h3>
        
        </div>

        <div class="modal-body" style="border:1px solid #eee">
            
            <img src="views/images/articulos/landscape02.jpg" width="100%" style="margin-bottom:20px">
            <p class="parrafoContenido">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            
        </div>

        <div class="modal-footer" style="border:1px solid #eee">
            
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
        </div>

    </div>

</div>-->

    		<!--====  Fin de ARTICULO MODAL ====-->

		<!--====  Fin de COLUMNA CONTENIDO  ====-->