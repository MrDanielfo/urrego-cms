<?php

class SuscribersFrontController {

    public function registroMensajes(){

        if(isset($_POST['nombreFrontal'])) {

            if(preg_match('/^[a-zA-Z\s]+$/', $_POST['nombreFrontal']) && preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,4}))$/', $_POST['emailFrontal']) && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['mensajeFrontal']) ) {

                // Enviar correo electrónico

                $correoDestino = "mr.danielfo@gmail.com";
                $asunto = "Mensaje de la Web";
                $mensaje = 'Nombre: ' . $_POST['nombreFrontal'] . "\n" . 
                           'Email: ' . $_POST['emailFrontal'] . "\n" . 
                           'Mensaje: ' . $_POST['mensajeFrontal'];

                $cabecera = "FROM: Sitio Web" . "\r\n" .
                            "CC: " . $_POST['emailFrontal']; 

                $envio = mail($correoDestino, $asunto, $mensaje, $cabecera);

                $datosController = array(
                    "nombreFrontal" => $_POST['nombreFrontal'],
                    "emailFrontal" => $_POST['emailFrontal'],
                    "mensajeFrontal" => $_POST['mensajeFrontal']
                ); 

                // almacenar en base de datos de sucriptores

                

                // Revisar si el suscriptor ya existe en nuestra base de dato

                $suscriptor = $_POST['emailFrontal'];

                $validacionSuscriptor = SuscribersFrontModel::revisarSuscriptor($suscriptor, "suscriptores");

                if(count($validacionSuscriptor["email"]) == 0) {

                    $suscriptores = SuscribersFrontModel::registroSuscriptores($datosController, "suscriptores"); 

                } 

                // almacenar en base de datos de mensajes
  
                $respuesta = SuscribersFrontModel::registroMensajes($datosController, "mensajes");

                if($envio == true && $respuesta == "ok") {

                    echo '<script>
                        swal({
                            title: "Ok",
                            text: "El mensaje se envió correctamente, en breve te responderemos",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                            }, function (isConfirm) {
                            if (isConfirm) {
                                window.location = "index.php";
                            }

                        })
                    </script>';

                }
                

            } else {

                echo '<div class="alert alert-danger">!No se pudo enviar el mensaje, no se permiten caracteres especiales</div>'; 
            }

        } 


    }




}