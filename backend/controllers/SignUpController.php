<?php

class SignUpController {

    public function signUp(){

        if(isset($_POST['usuarioIngreso'])) {

            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuarioIngreso']) &&
               preg_match('/^[a-zA-Z0-9]+$/', $_POST['passIngreso']) ) {

                $encriptado = crypt($_POST['passIngreso'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datosController = array(
                    "usuario" => $_POST['usuarioIngreso'],
                    "pass"    => $encriptado
                );

                $respuesta = SignUpModel::signUp($datosController, 'usuarios');

                $intentos = $respuesta['intentos'];
                $usuarioActual = $_POST['usuarioIngreso'];
                $maxIntentos = 2;

                if($intentos < $maxIntentos) {

                    if($respuesta['usuario'] == $_POST['usuarioIngreso'] && $respuesta['pass'] == $encriptado) {
                       
                        $intentos = 0;
                        $datosController = array(
                                "usuarioActual" => $usuarioActual,
                                "actualizarIntentos" => $intentos
                            );

                        $respuestaIntentos = SignUpModel::attemptsUser($datosController, 'usuarios');
                        
                        session_start();

                        $_SESSION['validar'] = true;
                        $_SESSION['usuario'] = $respuesta['usuario'];
                        $_SESSION['id'] = $respuesta['id'];
                        $_SESSION['pass'] = $respuesta['pass'];
                        $_SESSION['email'] = $respuesta['email'];
                        $_SESSION['foto'] = $respuesta['foto'];
                        $_SESSION['rol'] = $respuesta['rol'];

                        header('Location:inicio');


                    } else {
                        ++$intentos;

                        $datosController = array(
                            "usuarioActual" => $usuarioActual,
                            "actualizarIntentos"    => $intentos
                        );
                        $respuestaIntentos = SignUpModel::attemptsUser($datosController, 'usuarios');
                        //echo '<div class="alert alert-danger">Hubo un fallo al ingresar</div>';
                        header('Location:fail');
                    }

                } else {
                    $intentos = 0;
                    $datosController = array(
                        "usuarioActual" => $usuarioActual,
                        "actualizarIntentos"    => $intentos
                    );
                    $respuestaIntentos = SignUpModel::attemptsUser($datosController, 'usuarios');
                    //header('Location:index.php?action=fail3attempts');  
                    echo '<div class="alert alert-danger">Excedió el límite de intentos para ingresar</div>';
                }
            }
        }

    }


}