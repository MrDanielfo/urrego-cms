<!--=====================================
			SLIDE ADMINISTRABLE          
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
<div id="imgSlide" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

<hr>

<p><span class="fa fa-arrow-down"></span>  Arrastra aquí tu imagen, tamaño recomendado: 1600px * 600px y límite de peso recomendado: 2MB</p>
    
    <ul id="columnasSlide">

    <?php

        $slideVista = new SlideController();
        $slideVista->mostrarImagenVista();

    ?>
        
    </ul>

    <button id="ordenarSlide" class="btn btn-warning pull-right" style="margin:10px 30px">Ordenar Slides</button>

    <button id="guardarSlide" class="btn btn-primary pull-right" style="display:none; margin:10px 30px">Guardar Orden Slides</button>

</div>

<!--===============================================-->

<div id="textoSlide" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

<hr>
    
    <ul id="ordenarTextSlide">

    <?php

        $slideDB = new SlideController();
        $slideDB->editarImagenVista();

    ?>
    
    </ul>
</div>



<!--===============================================-->

<div id="slide" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
    
    <hr>
    
    <ul>

        <?php
            $slideGrande = new SlideController();
            $slideGrande->ordenSlideGrande();

        ?>
    
    </ul>

    <ol id="indicadores">			
        <!--<li role-slide="1"><span class="fa fa-circle"></span></li>-->
    </ol>

    <div id="slideIzq"><span class="fa fa-chevron-left"></span></div>
    <div id="slideDer"><span class="fa fa-chevron-right"></span></div>

</div>

			<!--====  Fin de SLIDE ADMINISTRABLE  ====-->
