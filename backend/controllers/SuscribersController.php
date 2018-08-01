<?php

class SuscribersController {

    public function mostrarMensajes() {

        $respuesta = SuscribersModel::mostrarMensajes("mensajes");

        foreach($respuesta as $key => $item) {

            echo '<div class="well well-sm" id="#'. $item['id'] .'" >
                    <a href="index.php?action=messages&idBorrar='. $item['id'] .'"><span class="fa fa-times pull-right"></span></a>
                        <h3>De: '. $item['nombre']  .'</h3>
                        <h5>Email: '. $item['email']  .'</h5>
                        <input type="text" class="form-control" value="'. $item['mensaje']  .'" readonly>
                    <br>
                    <button class="btn btn-info btn-sm leerMensaje">Leer</button>
                </div>'; 

        }

    }

    public function borrarMensajes(){

        if(isset($_GET['idBorrar'])){

            $id = $_GET['idBorrar'];

            $respuesta = SuscribersModel::borrarMensajes($id, "mensajes");

            if($respuesta = 'ok') {

                echo '<script>
                            swal({
                            title: "Ok",
                            text: "El mensaje se eliminó correctamente",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location = "messages";
                            }

                        })
                     </script>'; 

            }



        }

    }

    public function responderMensajes(){

        if(isset($_POST['emailRespuesta'])) {

            $datosController = array(
                "email" => $_POST['emailRespuesta'],
                "nombre" => $_POST['nombreRespuesta'],
                "titulo" => $_POST['tituloRespuesta'],
                "mensaje" => $_POST['mensajeRespuesta']
            );

            $para = $datosController['email'] . ', ';
            $para .= 'mr.danielfo@gmail.com';

            $titulo = 'Respuesta a su mensaje'; 

            $mensaje = '<html>
                            <head>
                                <title>Respuesta</title>
                            </head>
                            <body>
                                <h1>Hola ' . $datosController['nombre'] . '</h1> 
                                <p>' . $datosController['mensaje']   .'</p>
                                <p><b>Israel Velázquez</b><br>
                                Reportero al gusto <br>
                                WhatsApp: + 22 23 44 5542<br>
                                israel@gmail.com
                                </p>
                                <br>
                                <a href="http://elpopular.mx" target="blank"><img src="href=https://www.cuartopoder.es/wp-content/uploads/2017/06/MG_.jpg"></a>
                            </body>

                        </html>';
            
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $cabeceras .= 'From: <mr.danielfo@gmail.com>' . "\r\n";

            $envio = mail($para, $titulo, $mensaje, $cabeceras);

            if($envio) {

                echo '<script>
                            swal({
                            title: "Ok",
                            text: "El mensaje se envió correctamente",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location = "messages";
                            }

                        })
                     </script>';
            }



        }

    }

    public function emailSuscriptores(){

        if(isset($_POST['tituloMasivo'])) {

            $respuesta = SuscribersModel::emailSuscriptores("suscriptores"); 

            foreach($respuesta as $key => $item) {

            $titulo = $_POST['tituloMasivo'];
            $mensaje = $_POST['mensajeMasivo']; 

            $tituloMensaje = 'Mensaje para todos';

            $para = $item['email']; 

            $mensajeMasivo = '<html>
                            <head>
                                <title>'. $ituloMensaje  .'</title>
                            </head>
                            <body>
                                <h1>Hola ' . $item['nombre'] . '</h1> 
                                <p>' . $mensaje  .'</p>
                                <p><b>Israel Velázquez</b><br>
                                Reportero al gusto <br>
                                WhatsApp: + 22 23 44 5542<br>
                                israel@gmail.com
                                </p>
                                <br>
                                <a href="http://elpopular.mx" target="blank"><img src="href=https://www.cuartopoder.es/wp-content/uploads/2017/06/MG_.jpg"></a>
                            </body>

                        </html>';
            
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $cabeceras .= 'From: <mr.danielfo@gmail.com>' . "\r\n";

            $envio = mail($para, $titulo, $mensajeMasivo, $cabeceras);

                if($envio) {

                    echo '<script>
                                swal({
                                title: "Ok",
                                text: "Los mensajes enviaron correctamente",
                                type: "success",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    window.location = "messages";
                                }

                            })
                        </script>';
                }

            }

            
        }

    }

    public function mostrarSuscriptores(){

        $respuesta = SuscribersModel::emailSuscriptores("suscriptores");

        foreach($respuesta as $key => $item) {

            echo '<tr>
                    <td>'. $item['nombre']  .'</td>
                    <td>'. $item['email']  .'</td>
                    <td>
                        <a href="index.php?action=suscribers&idSuscriptor='. $item['id']  .'">
                            <span class="btn btn-danger fa fa-times quitarSuscriptor"></span>
                        </a>
                    </td>
                    <td></td>
                </tr>'; 

        }


    }

    public function eliminarSuscriptores() {

        if(isset($_GET['idSuscriptor'])) {

            $id = $_GET['idSuscriptor'];

           $respuesta =  SuscribersModel::eliminarSuscriptores($id, "suscriptores");

            if($respuesta = 'ok') {

                echo '<script>
                                swal({
                                title: "Ok",
                                text: "El suscriptor fue eliminado correctamente",
                                type: "success",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    window.location = "suscribers";
                                }

                            })
                        </script>';

            }

        }

        
    }

    static public function imprimirSuscriptores($tabla){

        $respuesta = SuscribersModel::emailSuscriptores($tabla);
        return $respuesta;

    }

    public function notificaciones() {

        $respuesta = SuscribersModel::notificaciones("mensajes"); 

        $sumaRevision = 0;

        foreach($respuesta as $row => $item) {

            if($item['revision'] == 0) {

                $sumaRevision++;

                echo '<span>'. $sumaRevision .'</span>'; 

            } else {
                echo '<span style="display:none;"></span>';
            }

        }

    }

    public function recibirNotificaciones($datosAjax) {

        $respuesta = SuscribersModel::recibirNotificaciones($datosAjax, "mensajes");

         return $respuesta; 


    }

    public function notificacionesSuscriptores() {

        $respuesta = SuscribersModel::notificacionesSuscriptores("suscriptores"); 
        

        $sumaRevision = 0;

        foreach($respuesta as $row => $item) {

            if($item['revision'] == 0) {

                $sumaRevision++;

                echo '<span>'. $sumaRevision .'</span>'; 

            } else {
                echo '<span style="display:none;"></span>';
            }

        }

    }

    public function nuevoSuscriptor($datosAjax) {

        $respuesta = SuscribersModel::nuevoSuscriptor($datosAjax, "suscriptores");

         return $respuesta; 


    }

    
}