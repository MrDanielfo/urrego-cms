<!--=====================================
			SUSCRIPTORES         
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
<div id="suscriptores" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
			 
    <div>

        <table id="tablaSuscriptores" class="table table-striped dt-responsive nowrap">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Acciones</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $mostrarSuscriptores = new SuscribersController();
                $mostrarSuscriptores->mostrarSuscriptores();
                $mostrarSuscriptores->eliminarSuscriptores();


                ?>
            </tbody>
        </table>

        <a href="tcpdf/pdf/suscribers.php" target="blank">
            <button class="btn btn-warning pull-right" style="margin:20px;">Imprimir Suscriptores</button>
        </a>
    </div>

</div>

<script>

$(window).on('load', function(){

    var datos = new FormData();

    datos.append('nuevoSuscriptor', 1);

    $.ajax({
        url: 'views/ajax/gestorSuscribers.php',
        method: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {

            console.log(response)
        }

    })

})

</script>
		
			<!--====  Fin de SUSCRIPTORES  ====-->