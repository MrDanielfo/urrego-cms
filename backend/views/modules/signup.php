<div id="backIngreso">
    
    <form method="post" id="formIngreso" onsubmit="return validarIngreso()">

        <h1 id="tituloFormIngreso">INGRESO AL PANEL DE CONTROL</h1>
        
        <label for="usuarioIngreso">Usuario</label>
        <input class="form-control formIngreso" id="usuarioIngreso" type="text" placeholder="Ingrese su Usuario" name="usuarioIngreso">
        <label for="passIngreso">Contraseña</label>
        <input class="form-control formIngreso" id="passIngreso" type="password" placeholder="Ingrese su Contraseña" name="passIngreso">
        <input class="form-control formIngreso btn btn-primary" type="submit" value="Enviar">
        <?php
                $ingreso = new SignUpController();
                $ingreso->signUp();
        ?>

    </form>
			
</div>


