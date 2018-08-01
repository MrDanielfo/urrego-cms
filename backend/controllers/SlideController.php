<?php

class SlideController {

    public function subirImagen($datosController){

        #getimagesize : obtiene el tamaño de la imagen 

        list($ancho, $alto) = getimagesize($datosController["imagenTemporal"]); 
        #List es un contructor del lenguaje, toma los índices de un arreglo, en este caso el datosController

        if($ancho < 1600 || $alto < 600){
            echo 0;
        } else {
            $aleatorio = mt_rand(100, 999);
            $ruta = "../../views/images/slide/slide-$aleatorio.jpg";
            // imagecreatejpeg(Crea una nueva imagen a partir de un fichero o una URL)
            $origen = imagecreatefromjpeg($datosController["imagenTemporal"]);
            #imagecrop

            $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 1600, "height" => 600]);
            
            
            // imagejpeg() Exporta la imagen al navegador o un fichero  
            imagejpeg($destino, $ruta);
            SlideModel::subirImagen($ruta, 'slides');
            $respuesta = SlideModel::mostrarImagen($ruta, 'slides');
            $enviarDatos = array(
                    "ruta"  => $respuesta["ruta"],
                    "titulo" => $respuesta["titulo"],
                    "descripcion" => $respuesta["descripcion"]
            );

          
            echo json_encode($enviarDatos);
        }

    }

    public function mostrarImagenVista() {

        $respuesta = SlideModel::mostrarImagenVista("slides");

        foreach($respuesta as $row => $item) {
            echo '<li id="'. $item['id'] .'" class="bloqueSlide"><span class="fa fa-times eliminarSlide" ruta="'. $item['ruta'] .'"></span><img src="'. substr($item['ruta'], 6) .'" class="handleImg"></li>';
        }

    }

    public function editarImagenVista() {

        $respuesta = SlideModel::mostrarImagenVista("slides");

        foreach($respuesta as $row => $item) {
            echo '<li id="slide-'.$item["id"].'">
                    <span class="fa fa-pencil editarSlide" style="background:blue; float:left;"></span>
                    <img src="'. substr($item['ruta'], 6) .'" style="position: center; margin-bottom:10px" width="95%">
                    <h1 class="titulo-chico">'. $item['titulo']. '</h1>
                    <p>'. $item['descripcion'].'</p>
                </li>';
        }

    }

    public function eliminarImagenVista($datos) {

        $respuesta = SlideModel::eliminarImagenVista($datos, "slides");

        unlink($datos['rutaSlide']);
        

    }

    public function editarSlideVista($datos){

        SlideModel::editarSlideVista($datos, "slides");
        $respuesta = SlideModel::actualizacionSlideVista($datos, "slides");
        $enviarDatos = array(
                    "enviarTitulo" => $respuesta["titulo"],
                    "enviarDescripcion" => $respuesta["descripcion"]
            );
        echo json_encode($enviarDatos);

    }

    public function actualizarOrdenSlide($datos){

        SlideModel::actualizarOrdenSlide($datos, "slides");
        $respuesta = SlideModel::ordenActualizado("slides");

        foreach($respuesta as $row => $item) {
            echo '<li id="slide-'.$item["id"].'">
                    <span class="fa fa-pencil editarSlide" style="background:blue"></span>
                    <img src="'. substr($item['ruta'], 6) .'" style="float:left; margin-bottom:10px" width="80%">
                    <h1>'. $item['titulo']. '</h1>
                    <p>'. $item['descripcion'].'</p>
                </li>';
        }

    }

    public function ordenSlideGrande(){

        $respuesta = SlideModel::ordenActualizado("slides");

        foreach($respuesta as $row => $item) {
            echo '<li id="slidegrande-'.$item["id"].'">
                    <img src="'. substr($item['ruta'], 6) .'">
                    <div class="slideCaption">
                        <h3>'. $item['titulo']. '</h3>
                        <p>'. $item['descripcion'].'</p>
                    </div>
                </li>'; 
        }

    }

}