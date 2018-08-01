<?php


class GalleryController {


    public function mostrarImagen($datos){

        list($ancho, $alto) = getimagesize($datos); 

        if($ancho < 1024 || $alto < 728){
            echo 0;
        } else {
            $aleatorio = mt_rand(100, 999);
            $ruta = "../../views/images/galeria/gallery-$aleatorio.jpg";

            $nuevoAncho = 1024;
            $nuevoAlto = 728;

            $origen = imagecreatefromjpeg($datos);
        
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
             
            imagejpeg($destino, $ruta);

            GalleryModel::subirImagen($ruta, 'galerias');
            $respuesta = GalleryModel::mostrarImagen($ruta, 'galerias');
            $enviarDatos = array(
                    "ruta"  => $respuesta["ruta"]
            );

          
            echo json_encode($enviarDatos);
        }

    }

    public function mostrarImagenContenedor() {

        $respuesta = GalleryModel::mostrarImagenContenedor('galerias');

        foreach($respuesta as $row => $item) {
            echo '<li id="'. $item['id'] .'" class="bloqueGaleria">
                    <span class="fa fa-times eliminarImagen" ruta="'. $item['ruta'] .'"></span>
                    <a rel="grupo" href="'. substr($item['ruta'], 6) .'">
                    <img src="'. substr($item['ruta'], 6) .'" class="handleImg">
                    </a>
                 </li>';

        }

    }

    public function eliminarImagen($datos) {

        $respuesta = GalleryModel::eliminarImagen($datos, "galerias");
        unlink($datos['rutaImagen']);


    }

    public function cambiarOrden($datosAjax) {

         GalleryModel::cambiarOrden($datosAjax, "galerias");

        $respuesta = GalleryModel::mostrarImagenContenedor('galerias');

        foreach($respuesta as $row => $item) {
            echo '<li id="'. $item['id'] .'" class="bloqueGaleria">
                    <span class="fa fa-times eliminarImagen" ruta="'. $item['ruta'] .'"></span>
                    <a rel="grupo" href="'. substr($item['ruta'], 6) .'">
                    <img src="'. substr($item['ruta'], 6) .'" class="handleImg">
                    </a>
                 </li>';

        }

    }

}