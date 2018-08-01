<?php
    session_start();


    if(!$_SESSION['validar']) {
        header('Location:index.php?action=signup');

        exit();
    }

    include 'buttons.php';
    include 'header.php';
        

?>

<div id="bandejaMensajes" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			 
    <div >
        <h1>Bandeja de Entrada</h1>
        <hr>
    </div>

    <?php

        $mensajes = new SuscribersController();
        $mensajes->mostrarMensajes();

    ?>

  

</div> 

<div id="lecturaMensajes" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			 
    <div >
        <hr>
        <button id="mensajesMasivos" class="btn btn-success">Enviar mensaje a todos los usuarios</button>
        <hr>
    </div>

    <div id="visorMensajes">
    
    <?php

        $responderMensajes = new SuscribersController();
        $responderMensajes->responderMensajes();
        $responderMensajes->emailSuscriptores();

    ?>
    
    
    </div>

    



</div>

<?php

    $borrarMensajes = new SuscribersController();
    $borrarMensajes->borrarMensajes();


?>

<script>

$(window).on('load', function() {

    var datos = new FormData();
    

    datos.append("notificaciones", 1);

    $.ajax({
        url: 'views/ajax/gestorSuscribers.php',
        method: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {

            
        }

    })

})

</script>