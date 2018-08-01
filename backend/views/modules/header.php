<div id="cabezote" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

    <?php  if($_SESSION['rol'] == 0) {

        echo '<ul>
                <li  style="background: #333">
                    <a href="messages" style="color: #fff">
                    <i class="fa fa-envelope"></i>';
                    

                        $revisarMensajes = new SuscribersController();
                        $revisarMensajes->notificaciones();

                    ?>
        <?php
                echo '</a>
                </li>

                <li  style="background: #333">
                    <a href="suscribers" style="color: #fff">
                    <i class="fa fa-bell"></i>'; 
        
                        $revisarSuscriptores = new SuscribersController();
                        $revisarSuscriptores->notificacionesSuscriptores();

                    ?>
            <?php
                echo '</a>
                </li>
            
            </ul>'; 

        }
        
       ?> 

    </div>

    <div id="time" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        

        <div class="text-center">
            <?php  
                    switch(date("l")) {
                         case "Sunday":
                         $dia = "Domingo";
                         break;
                         case "Saturday":
                         $dia = "Sábado";
                         break;
                         case "Friday":
                         $dia = "Viernes";
                         break;
                         case "Thursday":
                         $dia = "Jueves";
                         break;
                         case "Wednesday":
                         $dia = "Miércoles";
                         break;
                         case "Tuesday":
                         $dia = "Martes";
                         break;
                         case "Monday":
                         $dia = "Lunes";
                         break;

                    }

                    switch(date("F")) {
                        case "July":
                        $mes = "Julio";
                        break;
                    }

                echo $dia . ", " . date("d") . " de " . $mes . " de " . date("Y");    
            ?>
        </div>
        
        <div class="text-center">

        <?php

            date_default_timezone_set("America/Mexico_City");


            echo '<div id="hora" hora="'. date("h") .'" minutos="'. date("i") .'" segundos="'. date("s") .'" meridiano="'. date("a") .'"></div>';
        ?>
        
        </div>

    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
        
        <img src="<?php echo $_SESSION['foto'];  ?>" class="img-circle">
        
        <p id="member"><?php echo $_SESSION['usuario'];  ?><span class="fa fa-chevron-down"></span>
            <br>
            <ol id="admin">
                <li><a href="profile"><span class="fa fa-user"></span>Editar Perfil</a></li>
                <li><a href=""><span class="fa fa-file-text"></span>Términos y Condiciones</a></li>
                <li><a href="signout"><span class="fa fa-times"></span>Salir</a></li>
            </ol>

        </p>

    </div>

</div>

<!-- reloj dinamico -->

<script>

function reloj() {

    segundos = $('#hora').attr('segundos');
    minutos = $('#hora').attr('minutos');
    hora = $('#hora').attr('hora');
    meridiano = $('#hora').attr('meridiano'); 

    setInterval(function(){

        if(segundos > 58 && segundos < 60) {
            segundos = "0" + 0
            minutos++
        } else {

            segundos++;

            if(segundos > 0 && segundos < 10) {

            segundos = "0" + segundos++
            }

        }

        if(minutos > 59) {
            window.location.reload();
        }
 
        $('#hora').html(hora+" : "+minutos+" : "+segundos+" "+meridiano)

    }, 1000)


}

reloj();

</script>

