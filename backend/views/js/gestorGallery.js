/* Subir múltiples imágenes */ 

/* Área de arrastre de Imágenes */

if($('#lightbox').html() == 0 ) {
    $('#lightbox').css({ 'height': '100px' });
} else {
    $('#lightbox').css({ 'height': 'auto' });
}

/* Aplicarlo para todo el cuerpo de la página */ 

$("body").on('dragover', function (e) {

    e.preventDefault();
    e.stopPropagation();

})

$("#lightbox").on('dragover', function(e){

    e.preventDefault();
    e.stopPropagation();

    $('#lightbox').css({
        "background" : "url(views/images/pattern.jpg)"
    })

})

/* Soltar imágenes */ 

$("body").on('drop', function (e) {

    e.preventDefault();
    e.stopPropagation();

})

var imageSize = new Array();
var imageType = new Array();

$("#lightbox").on('drop', function (e) {

    e.preventDefault();
    e.stopPropagation();

    $('#lightbox').css({
        "background": "white"
    })

    var archivo = e.originalEvent.dataTransfer.files;

    for(var i = 0; i < archivo.length; i++) {
        var imagen = archivo[i]; 
        imageSize.push(imagen.size)
        imageType.push(imagen.type)

        if (Number(imageSize[i]) > 2000000) {
            $('#lightbox').before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido de 2 MB</div>');
        } else {
            $('.alerta').remove();
        }
        // validar formato de la imagen

        if (imageType[i] == "image/jpeg" || imageType[i] == "image/png") {
            $('.alerta').remove();
        } else {
            $('#lightbox').before('<div class="alert alert-warning alerta text-center">Sólo se permiten archivos de tipo jpg o png</div>');
        }

        // Subir imágenes al servidor 
        
        if (Number(imageSize[i]) < 2000000 && imageType[i] == "image/jpeg" || imageType[i] == "image/png") {
            var datos = new FormData();
            datos.append('imagen', imagen)
            

        }

        $.ajax({
            url: 'views/ajax/gestorGallery.php',
            method: 'POST',
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function () {
                $('#lightbox').append('<li id="status"><img src="views/images/status.gif"></li>');
            },
            success: function (response) {
                $('#status').remove();
                if (response == 0) {
                    $('#lightbox').before('<div class="alert alert-warning alerta text-center">La imagen es menor al tamaño solicitado</div>');
                } else {
                    $('#lightbox').css({ 'height': 'auto' });
                    $('#lightbox').append('<li>' +
                                            '< span class= "fa fa-times" ></span >' +
                                            '<a rel="grupo" href="' + response["ruta"].slice(6) + '">' +
                                                '<img src="' + response["ruta"].slice(6) + '">' +
                                            '</a>' +
                                        '</li>')
                    console.log(response);
                    swal({
                        title: 'Ok',
                        text: 'La Imagen se subió correctamente',
                        type: 'success',
                        confirmButtonText: 'Cerrar',
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            window.location = "gallery";
                        }

                    });

                }

            }

        })
   
    }// fin del ciclo for

})

// eliminar Imagen

$('.eliminarImagen').on('click', function(){

    var idImagen = $(this).parent().attr('id')
    $(this).parent().remove();
    var rutaImagen = $(this).attr("ruta");

    var borrarImagen = new FormData();
    borrarImagen.append('idImagen', idImagen);
    borrarImagen.append('rutaImagen', rutaImagen);
    $.ajax({
        url: 'views/ajax/gestorGallery.php',
        method: 'POST',
        data: borrarImagen,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {


        }



    })


})

/* ordenar Items Galería */ 

var almacenarOrdenId = new Array()
var ordenItem = new Array()

$('#ordenarGaleria').on('click', function(){

    $('#guardarGaleria').show();
    $('#ordenarGaleria').hide();

    $('#lightbox').css({
        "cursor" : "move"
    })

    $('#lightbox span').hide()
    $('#lightbox').sortable({
        "revert" : true,
        "connectWith" : ".bloqueGaleria",
        "handle" : ".handleImg",
        stop: function(event){

            for(var i = 0; i < $('#lightbox li').length; i++) {

                almacenarOrdenId[i] = event.target.children[i].id
                ordenItem[i] = i + 1

            }

        }

    })

})

$('#guardarGaleria').on('click', function () {

    $('#ordenarGaleria').show();
    $('#guardarGaleria').hide();
    $('#lightbox span').show();

    for (var i = 0; i < $('#lightbox li').length; i++) {

        var actualizarOrden = new FormData();
        actualizarOrden.append("almacenarOrdenId", almacenarOrdenId[i])
        actualizarOrden.append("ordenItem", ordenItem[i])

        $.ajax({
            url: "views/ajax/gestorGallery.php",
            method: "POST",
            data: actualizarOrden,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                $('div.galeria #lightbox').html(response);
                swal({
                    title: 'Ok',
                    text: 'El orden se actualizó correctamente',
                    type: 'success',
                    confirmButtonText: 'Cerrar',
                    closeOnConfirm: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location = "gallery";
                    }

                });
            }

        })

    }

})
