<?php

class ArticlesController {

    public function mostrarImagenMiniatura($datos) {

        list($ancho, $alto) = getimagesize($datos); 

        if($ancho < 800 || $alto < 400) {

            echo 0;

        } else {
            $aleatorio = mt_rand(100, 999); 
            $ruta = "../../views/images/articulos/temp/articulo-$aleatorio.jpg";
            $origen = imagecreatefromjpeg($datos);
            $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 800, "height" => 400]); 
            imagejpeg($destino, $ruta);

            echo $ruta; 
        }
    }

    public function guardarArticulo(){

        if(isset($_POST['tituloArticulo'])) {

            $imagen = $_FILES["imagenArticulo"]["tmp_name"];
            echo $imagen;
            $borrar = glob("views/images/articulos/temp/*");

            foreach($borrar as $file) {
                unlink($file); 
            }

            $aleatorio = mt_rand(100, 999); 
            $ruta = "views/images/articulos/articulo-$aleatorio.jpg";
            $origen = imagecreatefromjpeg($imagen);
            $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 800, "height" => 400]); 
            imagejpeg($destino, $ruta);

            $datosController = array(
                "titulo"    => $_POST['tituloArticulo'],
                "extracto"  => $_POST['extractoArticulo'] . '...',
                "imagen"    => $ruta,
                "contenido" => $_POST['contenidoArticulo']
            );

            $respuesta = ArticlesModel::guardarArticulo($datosController, "articulos"); 

           if($respuesta == 'ok') {
                echo '<script>
                            swal({
                            title: "Ok",
                            text: "El artículo se guardó correctamente",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location = "articles";
                            }

                        })
                     </script>';
            } else { 
                echo $respuesta; 
            } 

        }

    }

    public function mostrarArticulos(){

        $respuesta = ArticlesModel::mostrarArticulos("articulos");

        foreach($respuesta as $row => $item) {
        
            echo '<li id="'. $item['id'] .'" class="bloqueArticulo"> 
                    <span class="handleArticle">
                       <a href="index.php?action=articles&idBorrar='. $item['id'] .'&rutaImagen='. $item['imagen'] .'"> 
                            <i class="fa fa-times eliminar btn btn-danger"></i>
                       </a>
                        <i class="fa fa-pencil editarArticulo btn btn-primary"></i>	
                    </span>
                    <img src="'. $item['imagen'] .'" class="img-thumbnail">
                    <h1>'. $item['titulo'] .'</h1>
                    <p>'. $item['extracto'] .'</p>
                    <input type="hidden" value="'. $item['contenido'] .'">
                    <a href="#articulo'. $item['id'] .'" data-toggle="modal">
                        <button class="btn btn-default">Leer Más</button>
                    </a>

                    <hr>

                </li>'; 

            echo '<div id="articulo'. $item['id'] .'" class="modal fade">

                    <div class="modal-dialog modal-content">

                        <div class="modal-header" style="border:1px solid #eee">
        
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">'. $item['titulo'] .'</h3>
        
                        </div>

                        <div class="modal-body" style="border:1px solid #eee">
                            
                            <img src="'. $item['imagen'] .'" width="100%" style="margin-bottom:20px">
                            <p class="parrafoContenido">'. $item['contenido'] .'</p>
                            
                        </div>

                        <div class="modal-footer" style="border:1px solid #eee">
                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>

                    </div>

                </div>';

        }

    }

    public function borrarArticulo(){

        if(isset($_GET['idBorrar']) && isset($_GET['rutaImagen'])) {

            $id = $_GET['idBorrar'];

            $ruta = $_GET['rutaImagen'];
            
            unlink($ruta);


           $respuesta = ArticlesModel::borrarArticulo($id, "articulos");

           if($respuesta == 'ok') {
                echo '<script>
                            swal({
                            title: "Ok",
                            text: "El artículo se eliminó correctamente",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location = "articles";
                            }

                        })
                     </script>';
            } else { 
                echo $respuesta; 
            }

        }

    
    }

    public function editarArticulo() {

        if(isset($_POST['editarTitulo'])) {

            $ruta = "";

            if(isset($_FILES["editarImagen"]["tmp_name"])) {

                $imagen = $_FILES["editarImagen"]["tmp_name"];
                $aleatorio = mt_rand(100, 999); 
                $ruta = "views/images/articulos/articulo-$aleatorio.jpg";
                $origen = imagecreatefromjpeg($imagen);
                $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 800, "height" => 400]); 
                imagejpeg($destino, $ruta);

                $borrar = glob("views/images/articulos/temp/*");

                foreach($borrar as $file) {
                    unlink($file); 
                }

            }

            if($ruta == "") {
                $ruta = $_POST['rutaImagen'];
            } else {
               unlink($_POST['rutaImagen']); 
            }

            $datosController = array(
                "id"    => $_POST['idArticulo'],
                "titulo"    => $_POST['editarTitulo'],
                "extracto"  => $_POST['editarExtracto'] . '...',
                "imagen"    => $ruta,
                "contenido" => $_POST['editarContenido']
            );

            $respuesta = ArticlesModel::editarArticulo($datosController, "articulos"); 

           if($respuesta == 'ok') {
                echo '<script>
                            swal({
                            title: "Ok",
                            text: "El artículo se editó correctamente",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location = "articles";
                            }

                        })
                     </script>';
            } else { 
                echo $respuesta; 
            } 

        }

    }

    public function actualizarOrdenArticulos($datosAjax) {

        ArticlesModel::actualizarOrdenArticulos($datosAjax, "articulos");

        $respuesta = ArticlesModel::mostrarArticulos("articulos");

        foreach($respuesta as $row => $item) {
        
            echo '<li id="'. $item['id'] .'" class="bloqueArticulo"> 
                    <span class="handleArticle">
                       <a href="index.php?action=articles&idBorrar='. $item['id'] .'&rutaImagen='. $item['imagen'] .'"> 
                            <i class="fa fa-times eliminar btn btn-danger"></i>
                       </a>
                        <i class="fa fa-pencil editarArticulo btn btn-primary"></i>	
                    </span>
                    <img src="'. $item['imagen'] .'" class="img-thumbnail">
                    <h1>'. $item['titulo'] .'</h1>
                    <p>'. $item['extracto'] .'</p>
                    <input type="hidden" value="'. $item['contenido'] .'">
                    <a href="#articulo'. $item['id'] .'" data-toggle="modal">
                        <button class="btn btn-default">Leer Más</button>
                    </a>

                    <hr>

                </li>';

             echo '<div id="articulo'. $item['id'] .'" class="modal fade">

                    <div class="modal-dialog modal-content">

                        <div class="modal-header" style="border:1px solid #eee">
        
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">'. $item['titulo'] .'</h3>
        
                        </div>

                        <div class="modal-body" style="border:1px solid #eee">
                            
                            <img src="'. $item['imagen'] .'" width="100%" style="margin-bottom:20px">
                            <p class="parrafoContenido">'. $item['contenido'] .'</p>
                            
                        </div>

                        <div class="modal-footer" style="border:1px solid #eee">
                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>

                    </div>

                </div>';
        }

    }


}