<div class="row" id="galeria">

    <hr>
    
    <h1 class="text-center text-info"><b>GALERÍA DE IMÁGENES</b></h1>

    <hr>

    <ul>

        <?php 

        $mostrarGaleria = new GalleryFrontController();
        $mostrarGaleria->mostrarImagenes();


        ?>
            
    </ul>

</div>