// Subir Video 
if($('#galeriaVideo').html() == 0) {

    $('#galeriaVideo').css({
        "height" : "100px"
    })
} else {

    $('#galeriaVideo').css({
        "height": "auto"
    })
}

var video = "";

$('#subirVideo').on('change', function(){

    var video = this.files[0];

    // Validar tamaño de imagen

    var videoSize = video.size;
    if (Number(videoSize) > 50000000) {
        $('#galeriaVideo').before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido de 50 MB</div>')
    } else {
        $('.alerta').remove();
    }

    // validar formato o tipo de la imagen 

    videoType = video.type;

    if (videoType == "video/mp4") {
        $('.alerta').remove()
    } else {
        $('#galeriaVideo').before('<div class="alert alert-warning alerta text-center">Sólo se puede subir archivos en formato mp4</div>')
    }

    console.log('video: ', video);

    // Mostrar Video con Ajax 

    if (Number(videoSize) < 50000000 && videoType == "video/mp4" ) {

        var videos = new FormData();

        videos.append("video", video);

        $.ajax({
            url: "views/ajax/gestorVideos.php",
            method: "POST",
            data: videos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function () {
                $("#galeriaVideo").before('<img src="views/images/status.gif" id="status">');
            },
            success: function (response) {
                $("#status").remove();
                    $('#galeriaVideo').css({"height": "auto"})
                    $('#galeriaVideo').append('<li>' +
                                                '< span class= "fa fa-times" ></span >' +
                                                '<video controls>' +
                                                    '<source src="' + response['ruta'].slice(6)  + '" type="video/mp4">' +
                                                '</video>' +	
                                            '</li>')
                swal({
                    title: 'Ok',
                    text: 'El video se subió correctamente',
                    type: 'success',
                    confirmButtonText: 'Cerrar',
                    closeOnConfirm: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location = "videos";
                    }

                });
            }
        })

    }

})

/* Eliminar Videos */ 


$('.eliminarVideo').on('click', function(){

    if($(".eliminarVideo").length == 1) {

        $('#galeriaVideo').css({
            "height" : "100px"
        })

    }

    $(this).parent().remove();

    var videoId = $(this).parent().attr("id") // siempre debe ser this
    var videoRuta = $(this).attr("ruta")

    console.log(videoId, videoRuta)

    var eliminarVideo = new FormData()

    eliminarVideo.append('videoId', videoId)
    eliminarVideo.append('videoRuta', videoRuta)

    $.ajax({
        url: "views/ajax/gestorVideos.php",
        method: "POST",
        data: eliminarVideo,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {


        }

    })

})

/*   Ordenamiento de Videos         */

var almacenarOrden = new Array();
var ordenItem = new Array();

$('#ordenarVideo').on('click', function(){

    $('#ordenarVideo').hide();
    $('#guardarOrdenVideo').show();

    $('#galeriaVideo').css({
        "cursor" : "move"
    })

    $('#galeriaVideo span').hide()

    $('#galeriaVideo').sortable({
        revert: true,
        connectWith: ".bloqueVideo",
        handle: ".handleVideo",
        stop: function(event){

            for(var i = 0; i < $('#galeriaVideo li').length; i++) {
                almacenarOrden[i] = event.target.children[i].id
                ordenItem[i] = i + 1
            }

            console.log(almacenarOrden, ordenItem)
        }
    })

})

$('#guardarOrdenVideo').on('click', function () {

    $('#guardarOrdenVideo').hide();
    $('#ordenarVideo').show();

    $('#galeriaVideo').css({
        "cursor": "default"
    })

    $('#galeriaVideo span').show()

    for (var i = 0; i < $('#galeriaVideo li').length; i++) {

        var ordenVideos = new FormData();

        ordenVideos.append('almacenarOrden', almacenarOrden[i])
        ordenVideos.append('ordenItem', ordenItem[i])

    
        $.ajax({
            url: "views/ajax/gestorVideos.php",
            method: "POST",
            data: ordenVideos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#galeriaVideo').html(response);
                swal({
                    title: 'Ok',
                    text: 'El orden se actualizó correctamente',
                    type: 'success',
                    confirmButtonText: 'Cerrar',
                    closeOnConfirm: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location = "videos";
                    }

                });
            }

        })
        
    }

})

