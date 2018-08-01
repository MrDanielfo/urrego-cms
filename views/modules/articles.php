<div class="row" id="articulos">
			
        <hr>

        <h1 class="text-center text-info"><b>ARTÍCULOS DE INTERÉS</b></h1>

        <hr>

        <ul id="articulos-front">

            <?php

            $articulos = new ArticlesFrontController();
            $articulos->mostrarArticulos();


            ?>

        </ul>

</div>