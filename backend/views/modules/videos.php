<!--=====================================
			VIDEOS ADMINISTRABLE          
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
			
<div id="videos" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

    <form method="post" enctype="multipart/form-data">

        <input type="file" id="subirVideo" name="video" class="btn btn-default" required>
        
    </form>
    <p>El formato permitido para los videos es de MP4, y el peso máximo es de 50MB</p>

    <ul id="galeriaVideo">
        <?php

            $videos = new VideosController();
            $videos->mostrarVideosVista();

        ?>

    </ul>

    		
    <button id="ordenarVideo" class="btn btn-warning" style="margin:10px 30px;">Ordenar Videos</button>
    <button id="guardarOrdenVideo" class="btn btn-primary" style="margin:10px 30px; display:none;">Guardar Orden de Videos</button>

</div>
			
			
			<!--====  Fin de VIDEOS ADMINISTRABLE  ====-->