/* gestor de Artículos */

$('#btnAgregarArticulo').on('click', function(){

    $('#agregarArticulo').toggle(400);

})

// Mostrar imagen al momento de seleccionar en la sección de Editar Artículo 

var imagen = "";

$('#subirFoto').on('change', function(){

    var imagen = this.files[0]; 

    // Validar tamaño de imagen

    var imageSize = imagen.size;
    if(Number(imageSize) > 2000000) {
        $('#arrastreImagenArticulo').before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido de 2 MB</div>')
    }else {
        $('.alerta').remove(); 
    }

    // validar formato o tipo de la imagen 

    imageType = imagen.type;

    if(imageType == "image/jpeg" || imageType == "image/png" ) {
        $('.alerta').remove()
    } else {
        $('#arrastreImagenArticulo').before('<div class="alert alert-warning alerta text-center">Sólo se puede subir archivos en formato jpg y png</div>')
    }

    console.log('Imagen: ', imagen);
    
    // Mostrar imagen con Ajax 

    if (Number(imageSize) < 2000000 && imageType == "image/jpeg" || imageType == "image/png" ) {

        var imagenFrontal = new FormData();

        imagenFrontal.append("imagen", imagen); 

        $.ajax({
            url : "views/ajax/gestorArticle.php",
            method: "POST",
            data: imagenFrontal,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $("#arrastreImagenArticulo").before('<img src="views/images/status.gif" id="status">'); 
            },
            success: function(response) {
                $("#status").remove();
                if(response == 0) {
                    $('#arrastreImagenArticulo').before('<div class="alert alert-warning alerta text-center">Tu archivo debe ser de mayor o igual tamaño que el requerido</div>')
                } else {
                    $('#arrastreImagenArticulo').append('<div id="imagenArticulo"><img src="'+ response.slice(6) +'" class="img-thumbnail"></div>')
                }
            }
        })

    }

})

// Editar Artículo 


$(".editarArticulo").on('click', function(){

    var idArticulo = $(this).parent().parent().attr('id')
    var rutaImagen = $("#" + idArticulo).children("img").attr("src")
    var titulo = $("#" + idArticulo).children("h1").html()
    var extracto = $("#" + idArticulo).children("p").html()
    var contenido = $("#" + idArticulo).children("input").val()
    console.log(idArticulo, rutaImagen, titulo, extracto, contenido)
    $("#" + idArticulo).html('<form method="POST" enctype="multipart/form-data">' +
                                    '<span>' +
                                        '<input type="submit" style="width: 20%; padding: 5px 0; margin-top: 4px" class="btn btn-primary pull-right" value="Guardar">'	
			                     +  '</span> ' +

                                   ' <div id="editarImagen"> ' +
                                        '<input type="file" style="display: none" id="subirNuevaFoto" class="btn btn-default">' +
                                        '<div id="nuevaFoto">' +
                                            '<span class="fa fa-times cambiarImagen"></span>' +
                                            '<img src="' + rutaImagen  +'" class="img-thumbnail">' +
                                        '</div>' +
                                    '</div>' +

                                    '<input type="text" name="editarTitulo" value="' + titulo +'">' +

                                    '<textarea name="editarExtracto" cols="30" rows="5">' + extracto +'</textarea>' +

                                    '<textarea name="editarContenido" id="editarContenido" cols="30" rows="10">' + contenido +'</textarea>' +
                                    '<input type="hidden" name="idArticulo" value="' + idArticulo +'">' +
                                    '<input type="hidden" name="rutaImagen" value="' + rutaImagen + '">' +

                                  '<hr></form>');

    $('.cambiarImagen').on('click', function(){

        $(this).hide(); 
        $('#subirNuevaFoto').show()
        
        $('#subirNuevaFoto').css({
            "width" : "90%"
        })
        $('#nuevaFoto').html("")
        $('#subirNuevaFoto').attr('name', "editarImagen")
        $('#subirNuevaFoto').attr('required', true)

        var imagen = "";

        $('#subirNuevaFoto').on('change', function(){

            var imagen = this.files[0];

            // Validar tamaño de imagen

            var imageSize = imagen.size;
            if (Number(imageSize) > 2000000) {
                $('#editarImagen').before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido de 2 MB</div>')
            } else {
                $('.alerta').remove();
            }

            // validar formato o tipo de la imagen 

            imageType = imagen.type;

            if (imageType == "image/jpeg" || imageType == "image/png") {
                $('.alerta').remove()
            } else {
                $('#editarImagen').before('<div class="alert alert-warning alerta text-center">Sólo se puede subir archivos en formato jpg y png</div>')
            }

            console.log('Imagen: ', imagen);

            // Mostrar imagen con Ajax 

            if (Number(imageSize) < 2000000 && imageType == "image/jpeg" || imageType == "image/png") {

                var imagenMiniatura = new FormData();

                imagenMiniatura.append("imagen", imagen);

                $.ajax({
                    url: "views/ajax/gestorArticle.php",
                    method: "POST",
                    data: imagenMiniatura,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $("#nuevaFoto").html('<img src="views/images/status.gif" id="status2">');
                    },
                    success: function (response) {
                        $("#status2").remove();
                        if (response == 0) {
                            $('#editarImagen').before('<div class="alert alert-warning alerta text-center">Tu archivo debe ser de mayor o igual tamaño que el requerido</div>')
                        } else {
                            $('#editarImagen').append('<div id="nuevaFoto"><img src="' + response.slice(6) + '" class="img-thumbnail"></div>')
                        }
                    }
                })

            }


        }); 

    })

});

/* Orden de Artículos */ 

var almacenarOrdenId = new Array();
var ordenItem = new Array();

$('#ordenarArticulos').on('click', function(){

    $('#ordenarArticulos').hide();
    $('#guardarOrdenArticulos').show(); 

    $('#editarArticulo').css({
        "cursor" : "move"
    })

    $('#editarArticulo span i').hide()
    $('#editarArticulo button').hide()
    $('#editarArticulo img').hide()
    $('#editarArticulo p').hide()
    $('#editarArticulo hr').hide()
    $('#editarArticulo div').remove()
    $('.bloqueArticulo h1').css({
        "font-size" : "16px",
        "position" : "absolute",
        "padding"  : "10px",
        "top"      : "-15px"
    })
    $('.bloqueArticulo').css({
        "padding" : "2px"
    })
    $('#editarArticulo span').html("<i class='glyphicon glyphicon-move' style='padding:8px'></i>")

    $("body, html").animate({
        scrollTop: $("body").offset().top
    }, 500)

    // Utilizando jquery Sortable

    $('#editarArticulo').sortable({
        revert : true,
        connectWith : ".bloqueArticulo",
        handle: ".handleArticle",
        stop: function(event){

            for(var i = 0; i < $('#editarArticulo li').length; i++) {

                almacenarOrdenId[i] = event.target.children[i].id
                ordenItem[i] = i + 1;

            }

        }
    })


    $('#guardarOrdenArticulos').on('click', function(){

        $('#ordenarArticulos').show();
        $('#guardarOrdenArticulos').hide();

        for (var i = 0; i < $('#editarArticulo li').length; i++) {

            var actualizarOrden = new FormData();

            actualizarOrden.append("almacenarOrden", almacenarOrdenId[i]);
            actualizarOrden.append("ordenItem", ordenItem[i]);

            $.ajax({
                url: "views/ajax/gestorArticle.php",
                method: "POST",
                data: actualizarOrden,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#editarArticulo ul').html(response);
                    swal({
                        title: 'Ok',
                        text: 'El orden se actualizó correctamente',
                        type: 'success',
                        confirmButtonText: 'Cerrar',
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            window.location = "articles";
                        }

                    });
                }
            })



        }

    })

})