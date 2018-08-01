function validarIngreso(){
    var usuario = document.querySelector("#usuarioIngreso").value;
    var pass = document.querySelector("#passIngreso").value;

    if(usuario != '') {
        var caracteres = usuario.length
        var expresiones = /^[a-zA-Z0-9]*$/

        if(caracteres > 10) {
            document.querySelector("label[for='usuarioIngreso']").innerHTML += '<p>El máximo de caracteres permitidos es 10</p>';
            return false;
        }

        if(!expresiones.test(usuario)) {
            document.querySelector("label[for='usuarioIngreso']").innerHTML += '<p>No se puede introducir caracteres especiales</p>';
            return false;
        }    
    }

    if(pass != '') {
        var caracteres = pass.length
        var expresiones = /^[a-zA-Z0-9]*$/

        if(caracteres < 6) {
            document.querySelector("label[for='passIngreso']").innerHTML += "<p>La contraseña debe llevar más de 6 caracteres</p>";
            return false;
        }

        if(!expresiones.test(pass)) {
            document.querySelector("label[for='passIngreso']").innerHTML += "<p>No se pueden introducir caracteres especiales</p>";
            return false;
        }

    }

    return true;

}