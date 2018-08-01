

$('#registrarPerfil').on('click', function(){

    $('#formularioPerfil').slideToggle();


})

// si se inserta imagen

$('#fotoPerfil').on('change', function(){

    $('#fotoPerfil').attr("name", "fotoPerfil")

})

// mostrar Formulario Editar Perfil

$('#btnEditarPerfil').on('click', function(){

    $('#editarPerfil').hide();
    $('#cajaEditarPerfil').show();


}); 

// si se cambia foto Perfil

$('#editarFotoPerfil').on('change', function(){

    $('#editarFotoPerfil').attr("name", "editarFotoPerfil")


})