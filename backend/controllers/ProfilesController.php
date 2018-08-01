<?php

class ProfilesController {

    public function crearPerfil() {

        // Validaciones

        $ruta = " ";

        if(isset($_POST['usuarioPerfil'])) {

            if(isset($_FILES['fotoPerfil']['tmp_name'])) {

                $imagen = $_FILES['fotoPerfil']['tmp_name'];
                $aleatorio = mt_rand(100,999);
                $ruta = "views/images/perfiles/" . $_POST['usuarioPerfil'] . "-" . $aleatorio . ".jpg";
                $origen = imagecreatefromjpeg($imagen);
                $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 100, "height" => 100]);
                imagejpeg($destino, $ruta); 

            }

            if($ruta == " ") {

                $ruta = "views/images/photo.jpg";
            }

            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuarioPerfil'])  && 
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['passwordPerfil']) && 
                preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,4}))$/', $_POST['emailPerfil'])) {

                $encriptado = crypt($_POST['passwordPerfil'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array( 
                    "usuario" => $_POST['usuarioPerfil'],
                    "pass" => $encriptado,
                    "email" => $_POST['emailPerfil'],      
                    "foto" => $ruta,
                    "rol" => $_POST['rolPerfil']
                );

                $respuesta = ProfilesModel::crearPerfil($datos, "usuarios");

                if($respuesta == 'ok') {

                    echo '<script>
                            swal({
                            title: "Ok",
                            text: "El usuario se agregó correctamente",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location = "profile";
                            }

                        })
                     </script>'; 

                }



            } else {
                echo '<div class="alert alert-warning"><b>Error</b> No ingrese caracteres especiales</div>';

            }

        }

    
    } // fin del método 

    public function mostrarPerfiles() {

        $respuesta = ProfilesModel::mostrarPerfiles("usuarios");
        foreach($respuesta as $key => $item) {

            echo '<tr id="'. $item['id'] .'">
                    <td>'. $item['usuario'] .'</td>';
            if( $item['rol'] == 0) {

                    echo '<td>Administrador</td>';

                } else {
                    echo '<td>Editor</td>';
                }
                    
            echo    '<td>'. $item['email'] .'</td>
                    <td>
                        <a href="#perfil-'. $item['id'] .'" data-toggle="modal"><span class="btn btn-warning fa fa-pencil quitarSuscriptor"></span></a>
                         <a href="index.php?action=profile&idUsuario='. $item['id'] .'&fotoUsuario='. $item['foto'] .'" ><span class="btn btn-danger fa fa-times quitarSuscriptor"></span></a>
                    </td>
                </tr>

                <div id="perfil-'. $item['id'] .'" class="modal fade">
                    <div class="modal-dialog modal-content">

                        <div class="modal-header" style="border:1px solid #eee">
        
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Editar Perfil</h3>
        
                        </div>

                        <div class="modal-body" style="border:1px solid #eee">
                            
                            <form method="POST"  enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="hidden" name="editarIdPerfil" value="'. $item['id'] .'">
                                    <input type="text" name="editarUsuarioPerfil" value="'. $item['usuario'] .'" class="form-control" required> 
                                </div>
                                <div class="form-group">
                                    <input type="password" name="editarPasswordPerfil"  class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="editarEmailPerfil" value="'. $item['email'] .'" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <select name="editarRolPerfil" class="form-control" required>
                                        <option value="">Seleccione el Rol</option>
                                        <option value="0">Administrador</option>
                                        <option value="1">Editor</option>
                                    </select>  
                                </div>
                                <div class="form-group text-center">
                                    <div class="form-group text-center">
                                        <img src="'. $item['foto'] .'" class="img-circle" width="20%">
                                        <input type="hidden" value="'. $item['foto'] .'" name="fotoActual">
                                    </div>
                                    <input type="file" class="btn btn-default" name="editarFotoPerfil" style="display:inline-block; margin: 10px 0">
                                    <p class="text-center" style="font-size: 12px;">Tamaño recomendado de la imagen 100px * 100px, peso máximo 2MB</p>
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" id="guardarPerfil" value="Actualizar Perfil" class="btn btn-success">
                                </div>
                            </form>
                            
                        </div>

                        <div class="modal-footer" style="border:1px solid #eee">
                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>

                    </div>
                  </div>'; 

        }


    }

    public function editarPerfil() {

        $ruta = " ";

        if(isset($_POST['editarUsuarioPerfil'])) {

            if(isset($_FILES['editarFotoPerfil']['tmp_name'])) {

                $imagen = $_FILES['editarFotoPerfil']['tmp_name'];
                $aleatorio = mt_rand(100,999);
                $ruta = "views/images/perfiles/" . $_POST['editarUsuarioPerfil'] . "-" . $aleatorio . ".jpg";
                $origen = imagecreatefromjpeg($imagen);
                $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 100, "height" => 100]);
                imagejpeg($destino, $ruta); 

            }

            if($ruta == " ") {

                $ruta = $_POST['fotoActual'];
            }

            if($ruta != " " && $_POST['fotoActual'] != "views/images/photo.jpg" ) {

                unlink($_POST['fotoActual']); 

            }

            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarUsuarioPerfil'])  && 
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarPasswordPerfil']) && 
                preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,4}))$/', $_POST['editarEmailPerfil'])) {

                $encriptado = crypt($_POST['editarPasswordPerfil'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array( 
                    "id" => $_POST['editarIdPerfil'],
                    "usuario" => $_POST['editarUsuarioPerfil'],
                    "pass" => $encriptado,
                    "email" => $_POST['editarEmailPerfil'],      
                    "foto" => $ruta,
                    "rol" => $_POST['editarRolPerfil']
                );

                $respuesta = ProfilesModel::editarPerfil($datos, "usuarios");

                if($respuesta == 'ok') {

                        if(isset($_POST['actualizarSesion'])) {

                            $_SESSION['usuario'] = $_POST['editarUsuarioPerfil'];
                            $_SESSION['id'] = $_POST['editarIdPerfil'];
                            $_SESSION['pass'] = $encriptado;
                            $_SESSION['email'] = $_POST['editarEmailPerfil'];
                            $_SESSION['foto'] = $ruta;
                            $_SESSION['rol'] = $_POST['editarRolPerfil'];

                        }

                    echo '<script>
                            swal({
                            title: "Ok",
                            text: "El usuario se editó correctamente",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location = "profile";
                            }

                        })
                     </script>'; 

                }



            } else {
                echo '<div class="alert alert-warning"><b>Error</b> No ingrese caracteres especiales</div>';

            }

        }


    } // fin del método

    public function borrarPerfil() {

        if(isset($_GET['idUsuario'])) {

            $datos = $_GET['idUsuario']; 

            $ruta = $_GET['fotoUsuario'];

            unlink($ruta);

            $respuesta = ProfilesModel::borrarPerfil($datos, "usuarios");

            if($respuesta == 'ok') {

                echo '<script>
                        swal({
                        title: "Ok",
                        text: "El usuario se eliminó correctamente",
                        type: "success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            window.location = "profile";
                        }

                    })
                    </script>'; 

                }

            


        }

        
    }



}