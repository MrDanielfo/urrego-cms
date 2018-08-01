// Leer mensaje completo 

$('.leerMensaje').on('click', function(){

 var id = $(this).parent().attr("id");
 var nombre = $("div.well").children("h3").html();
 var email = $("div.well").children("h5").html();
 var mensaje = $("div.well").children("input").val();

 console.log(id, nombre, email, mensaje)

    $('#visorMensajes').html(
        '<div class="well well-sm">' +
            '<h3>' +  nombre  +'</h3>' +
            '<h5>'+ email   + '</h5>' +
            '<p style="background:#fff; padding:10px">' + mensaje   + '</p>' +
            '<button class="btn btn-info btn-sm responderMensaje">Responder</button>' +

        '</div >'); 

    // Responder Mensaje

    $('.responderMensaje').on('click', function () {

        enviarEmail = $(this).parent().children("h5").html()
        enviarNombre = $(this).parent().children("h3").html()

        $('#visorMensajes').html(
            '<form method="POST">' +
                '<p>Para: <input type="email" value="' + enviarEmail.slice(6) + '" name="emailRespuesta" class="form-control" readonly style="border: 0;">' +

                '<input type="hidden" value="' +   enviarNombre.slice(4)   +'" name="nombreRespuesta"></p>' +

                '<input type="text" name="tituloRespuesta" placeholder="Título del Mensaje" class="form-control">' +

                '<textarea name="mensajeRespuesta" cols="30" rows="5" placeholder="Escribe tu mensaje..." class="form-control"></textarea>' +

                '<input type="submit" class="form-control btn btn-primary" value="Enviar">' +

            '</form>');

    })

})

// Enviar mensaje masivo

$('#mensajesMasivos').on('click', function(){

    $('#visorMensajes').html(
        '<form method="POST">' +
            '<p>Para: Todos los suscriptores <input type="text" name="tituloMasivo" placeholder="Título del Mensaje" class="form-control"></p>' +

            '<textarea name="mensajeMasivo" cols="30" rows="5" placeholder="Escribe tu mensaje..." class="form-control"></textarea>' +

            '<input type="submit" class="form-control btn btn-primary" value="Enviar">' +

        '</form>');


})




