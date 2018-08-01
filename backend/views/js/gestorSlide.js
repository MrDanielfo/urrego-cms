
/* Tamaño de caja de arrastre Slide */
if($('#columnasSlide').html() == 0 ) {
    $('#columnasSlide').css({'height':'100px'});
    
} else {
    $('#columnasSlide').css({ 'height': 'auto' });
}

/* Fin de tamaño de caja del Slide */ 
/* Subir y arrastrar imagen */

$('#columnasSlide').on('dragover', function(e){
    e.preventDefault();
    e.stopPropagation();
    $('#columnasSlide').css({'background': 'url(views/images/pattern.jpg)'})
});

/* Soltar imagen */ 

$('#columnasSlide').on('drop', function (e) {
    e.preventDefault();
    e.stopPropagation();
    $('#columnasSlide').css({ 'background': 'white' })

    var archivo = e.originalEvent.dataTransfer.files
    var imagen = archivo[0]

    // Validar tamaño de la imagen
    var imageSize = imagen.size
    if(Number(imageSize) > 2000000) {
        $('#columnasSlide').before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido de 2 MB</div>');
    } else {
        $('.alerta').remove();
    }
    // validar formato de la imagen
    
    var imageType = imagen.type
    if (imageType == "image/jpeg" || imageType == "image/png") {
        $('.alerta').remove();
    } else {
        $('#columnasSlide').before('<div class="alert alert-warning alerta text-center">Sólo se permiten archivos de tipo jpg o png</div>');
    }
    //console.log(imageType)

    // Subir imagen al servidor 

    if (Number(imageSize) < 2000000 && imageType == "image/jpeg" || imageType == "image/png" ) {
        var datos = new FormData();
        datos.append('imagen', imagen)
        $.ajax({
            url: 'views/ajax/gestorSlide.php',
            method: 'POST',
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function(){
                $('#columnasSlide').before('<img src="views/images/status.gif" id="status">'); 
            },
            success: function(response){
                $('#status').remove();
                if(response == 0){
                    $('#columnasSlide').before('<div class="alert alert-warning alerta text-center">La imagen es menor al tamaño solicitado</div>');
                }
                else {
                    $('#columnasSlide').css({ 'height': 'auto' });
                    $('#columnasSlide').append('<li class="bloqueSlide"><span class="fa fa-times eliminarSlide" ></span><img src="'+ response["ruta"].slice(6) +'" class="handleImg"></li>');

                    $('#ordenarTextSlide').append('<li><span class="fa fa-pencil" style="background:blue"></span><img src="' + response["ruta"].slice(6) +'" style="float:left; margin-bottom:10px" width="80%"><h1>'+ response["titulo"] + '</h1><p>'+ response["descripcion"]+'</p></li>');

                    swal({
                        title: 'Ok',
                        text: 'La Imagen se subió correctamente',
                        type: 'success',
                        confirmButtonText: 'Cerrar',
                        closeOnConfirm: false
                    }, function(isConfirm){
                        if(isConfirm){
                            window.location = "slide";
                        }

                    });
                }
                
            }

        })
    }
})

// Eliminar Item Slide

$('.eliminarSlide').on('click', function(){

    if($(".eliminarSlide").length == 1) {

        $('#columnasSlide').css({"height":"100px"});

    }


    var idSlide = $(this).parent().attr('id');
    var rutaSlide = $(this).attr('ruta');
    $(this).parent().remove();
    $("#slide-"+idSlide).remove();

    var borrarSlide = new FormData();
        borrarSlide.append('idSlide', idSlide)
        borrarSlide.append('rutaSlide', rutaSlide)  
        $.ajax({
            url: 'views/ajax/gestorSlide.php',
            method: 'POST',
            data: borrarSlide,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                
            }

        })

})

// Editar Slide 

$('.editarSlide').on('click', function () {


    var idSlide = $(this).parent().attr('id');
    var rutaSlideCorta = $(this).parent().children("img").attr("src");
    var rutaTitulo = $(this).parent().children("h1").html();
    var rutaDescripcion = $(this).parent().children("p").html();

    console.log(rutaSlideCorta);
    
    $(this).parent().html('<img src="' + rutaSlideCorta + '" class="img-thumbnail"><input type="text" class="form-control" placeholder="Título" value="' + rutaTitulo + '" id="enviarTitulo"><textarea class="form-control" placeholder="Descripción" id="enviarDescripcion">' + rutaDescripcion +'</textarea><button class="btn btn-info pull-right" style="margin:10px" id="guardar'+ idSlide +'">Guardar</button>');

    $('#guardar'+idSlide).on('click', function(){

        var enviarId = idSlide.slice(6)
        var enviarTitulo = $('#enviarTitulo').val();
        var enviarDescripcion = $('#enviarDescripcion').val();


        var editarSlide = new FormData();
        editarSlide.append('enviarId', enviarId)
        editarSlide.append('enviarTitulo', enviarTitulo)
        editarSlide.append('enviarDescripcion', enviarDescripcion)
        $.ajax({
            url: 'views/ajax/gestorSlide.php',
            method: 'POST',
            data: editarSlide,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('#guardar' + idSlide).parent().html('<span class="fa fa-pencil editarslide" style="background:blue"></span><img src="' + rutaSlideCorta + '" style="float:left; margin-bottom:10px" width="80%"><h1>' + response["enviarTitulo"] + '</h1><p>' + response["enviarDescripcion"] +'</p>')

                swal({
                    title: 'Ok',
                    text: 'La Imagen se editó correctamente',
                    type: 'success',
                    confirmButtonText: 'Cerrar',
                    closeOnConfirm: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location = "slide";
                    }

                });
            }

        })

    })

})

/* Ordenar Slide */ 

var almacenarOrdenId = new Array();
var ordenItem = new Array();
$('#ordenarSlide').on('click', function(){

    $('#ordenarSlide').hide();
    $('#guardarSlide').show();

    $('#columnasSlide').css({'cursor':'move'})
    $('#columnasSlide li span').hide();

    $('#columnasSlide').sortable({
        revert: true,
        connectWith: ".bloqueSlide",
        handle: ".handleImg",
        stop: function(event){

            for(var i = 0; i < $('#columnasSlide li').length; i++) {
                almacenarOrdenId[i] = event.target.children[i].id;
                ordenItem[i] = i+1
                
            }

        }
    })


})

$('#guardarSlide').on('click', function () {

    $('#guardarSlide').hide();
    $('#ordenarSlide').show();
    $('#columnasSlide').css({ 'cursor': 'default' })
    $('#columnasSlide li span').show();

    for (var i = 0; i < $('#columnasSlide li').length; i++) {

        var actualizarOrden = new FormData();
        actualizarOrden.append('actualizarOrden', almacenarOrdenId[i]);
        actualizarOrden.append('ordenItem', ordenItem[i] );

        $.ajax({
            url: 'views/ajax/gestorSlide.php',
            method: 'POST',
            data: actualizarOrden,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#textoSlide ul').html(response); 
                swal({
                    title: 'Ok',
                    text: 'El orden se actualizó correctamente',
                    type: 'success',
                    confirmButtonText: 'Cerrar',
                    closeOnConfirm: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location = "slide";
                    }

                });
            }

        })
        

    }


})


/* Fin de Ordenar Slide */ 

for(var i = 0; i < cantidadImg; i++) {
    $('#indicadores').append('<li role-slide="'+ i +'"><span class="fa fa-circle"></span></li>')
}


