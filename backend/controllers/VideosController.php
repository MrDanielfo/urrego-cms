<?php


class VideosController {

    public function mostrarVideo($datos) {

        $aleatorio = mt_rand(100, 999);

        $ruta = "../../views/videos/video-$aleatorio.mp4";

        move_uploaded_file($datos, $ruta);

        VideosModel::subirVideo($ruta, "videos");

        $respuesta = VideosModel::mostrarVideo($ruta, "videos"); 

        $enviarDatos = array(
                    "ruta"  => $respuesta["ruta"]
            );

          
        echo json_encode($enviarDatos);

    }

    public function mostrarVideosVista() {

        $respuesta = VideosModel::mostrarVideosVista("videos");

        foreach($respuesta as $row => $item) {

            echo '<li id="'. $item['id'] .'" class="bloqueVideo">
                    <span class="fa fa-times eliminarVideo" ruta="'. $item['ruta'] .'"></span>
                    <video controls class="handleVideo">
                        <source src="'. substr($item['ruta'], 6) .'" type="video/mp4">
                    </video>	
                </li>'; 

        }

    }

    public function eliminarVideo($datosAjax) {

        $respuesta = VideosModel::eliminarVideo($datosAjax, "videos");

        unlink($datosAjax['videoRuta']);


    }

    public function cambiarOrden($datosAjax) {

        VideosModel::cambiarOrden($datosAjax, "videos");

        $respuesta = VideosModel::mostrarVideosVista("videos");

        foreach($respuesta as $row => $item) {

            echo '<li id="'. $item['id'] .'" class="bloqueVideo">
                    <span class="fa fa-times eliminarVideo" ruta="'. $item['ruta'] .'"></span>
                    <video controls class="handleVideo">
                        <source src="'. substr($item['ruta'], 6) .'" type="video/mp4">
                    </video>	
                </li>'; 

        }
        

    }




}