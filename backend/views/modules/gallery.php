<!--=====================================
			GALERIA ADMINISTRABLE          
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

<div id="galeria" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

<hr>

<p><span class="fa fa-arrow-down"></span>  Arrastra aquí tu imagen, tamaño recomendado: 1024px * 728px</p>
    
    <ul id="lightbox">

    <?php 

            $imagenes = new GalleryController();
            $imagenes->mostrarImagenContenedor();


    ?>
        <!--<li>
            <span class="fa fa-times"></span>
            <a rel="grupo" href="views/images/galeria/photo01.jpg">
            <img src="views/images/galeria/photo01.jpg">
            </a>
        </li>-->
            
    
            
    
    </ul>

    <button id="ordenarGaleria" class="btn btn-warning pull-right" style="margin:10px 30px">Ordenar Imágenes</button>
    <button id="guardarGaleria" class="btn btn-success pull-right" style="margin:10px 30px; display: none;">Guardar Orden Imágenes</button>

</div>
			
			<!--====  Fin de GALERIA ADMINISTRABLE  ====-->