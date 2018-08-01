<!--=====================================
			PERFIL       
			======================================-->
<?php
    session_start();


    if(!$_SESSION['validar']) {
        header('Location:index.php?action=signup');

        exit();
    }

    include 'buttons.php';
    include 'header.php';
        

?>
			
<div id="editarPerfil" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    
    <h1>Hola: <?php echo $_SESSION['usuario'];  ?>
    <span class="btn btn-info fa fa-pencil pull-left" id="btnEditarPerfil" style="font-size:10px; margin-right:10px"></span></h1>

    <div style="position:relative">
        <img src="<?php echo $_SESSION['foto'];  ?>" class="img-circle pull-right">
        
    </div>

    <hr>

    <h4>Perfil: 
        <?php 
        if( $_SESSION['rol'] == 0) {

            echo 'Administrador';

        } else {
            echo 'Editor';
        }
        ?>
    </h4>
    

    <h4>Email: <?php echo $_SESSION['email'];  ?></h4>

    <h4>Contraseña: *******</ph4>

</div>

<!-- Editar Perfil -->
<div id="cajaEditarPerfil" style="display: none; margin-top: 50px;" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

    <form method="POST"  enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" name="editarIdPerfil" value="<?php echo $_SESSION['id'];  ?>">
            <input type="text" name="editarUsuarioPerfil" value="<?php echo $_SESSION['usuario'];  ?>" class="form-control" required> 
            <input type="hidden" name="actualizarSesion" value="ok">
        </div>
        <div class="form-group">
            <input type="password" name="editarPasswordPerfil"  class="form-control" required>
        </div>
        <div class="form-group">
            <input type="email" name="editarEmailPerfil" value="<?php echo $_SESSION['email'];  ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <select name="editarRolPerfil" class="form-control" required>
                <option value="">Seleccione el Rol</option>
                <option value="0">Administrador</option>
                <option value="1">Editor</option>
            </select>  
        </div>
        <div class="form-group text-center">
            <img src="<?php echo $_SESSION['foto'];  ?>" class="img-circle" width="20%">
            <input type="hidden" value="<?php echo $_SESSION['foto'];  ?>" name="fotoActual">
            <input type="file" class="btn btn-default" id="editarFotoPerfil" style="display:inline-block; margin: 10px 0">
            <p class="text-center" style="font-size: 12px;">Tamaño recomendado de la imagen 100px * 100px, peso máximo 2MB</p>
        </div>
       <input type="submit" id="guardarPerfil" value="Actualizar Perfil" class="btn btn-success">
    </form>

    <?php

        $editarPerfil = new ProfilesController();
        $editarPerfil->editarPerfil();

    ?>

</div>


<?php  

        if($_SESSION['rol'] == 0 ) {

            echo '<div id="crearPerfil" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    
                    <button id="registrarPerfil" style="margin: 20px 0;" class="btn btn-default">Registrar un nuevo miembro</button>
                    
                    <form method="POST" id="formularioPerfil" style="display: none;" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="usuarioPerfil" placeholder="Ingrese hasta 10 caracteres" maxlength="10" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="passwordPerfil" placeholder="Ingrese hasta 10 caracteres para la contraseña" maxlength="10" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="emailPerfil" placeholder="Ingrese el email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <select name="rolPerfil" class="form-control" required>
                                <option value="">Seleccione el Rol</option>
                                <option value="0">Administrador</option>
                                <option value="1">Editor</option>
                            </select>  
                        </div>
                        <div class="form-group text-center">
                            <input type="file" class="btn btn-default" id="fotoPerfil" style="display:inline-block; margin: 10px 0">
                            <p class="text-center" style="font-size: 12px;">Tamaño recomendado de la imagen 100px * 100px, peso máximo 2MB</p>
                        </div>
                    <input type="submit" id="guardarPerfil" value="Guardar Perfil" class="btn btn-primary">
                    </form>'; 

                    

                        $crearPerfil = new ProfilesController();
                        $crearPerfil->crearPerfil();

                    ?>
            <?php
                echo '<hr>

                    <div class="table-responsive">

                        <table id="tablaSuscriptores" class="table table-striped display">
                            <thead>
                                <tr>
                                <th>Usuario</th>
                                <th>Perfil</th>
                                <th>Email</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>';
                                

                                    $mostrarPerfiles = new ProfilesController();
                                    $mostrarPerfiles->mostrarPerfiles();
                                    $mostrarPerfiles->borrarPerfil();

                                ?>
                        <?php
                        echo '</tbody>
                        </table>
                    </div>

                </div>';
        }


?>

<!-- Crear Perfil -->
<!--<div id="crearPerfil" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    
    <button id="registrarPerfil" style="margin: 20px 0;" class="btn btn-default">Registrar un nuevo miembro</button>
    
    <form method="POST" id="formularioPerfil" style="display: none;" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="usuarioPerfil" placeholder="Ingrese hasta 10 caracteres" maxlength="10" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="password" name="passwordPerfil" placeholder="Ingrese hasta 10 caracteres para la contraseña" maxlength="10" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="email" name="emailPerfil" placeholder="Ingrese el email" class="form-control" required>
        </div>
        <div class="form-group">
            <select name="rolPerfil" class="form-control" required>
                <option value="">Seleccione el Rol</option>
                <option value="0">Administrador</option>
                <option value="1">Editor</option>
            </select>  
        </div>
        <div class="form-group text-center">
            <input type="file" class="btn btn-default" id="fotoPerfil" style="display:inline-block; margin: 10px 0">
            <p class="text-center" style="font-size: 12px;">Tamaño recomendado de la imagen 100px * 100px, peso máximo 2MB</p>
        </div>
       <input type="submit" id="guardarPerfil" value="Guardar Perfil" class="btn btn-primary">
    </form>

    <php

        $crearPerfil = new ProfilesController();
        $crearPerfil->crearPerfil();

    ?>

    <hr>

    <div class="table-responsive">

        <table id="tablaSuscriptores" class="table table-striped display">
            <thead>
                <tr>
                <th>Usuario</th>
                <th>Perfil</th>
                <th>Email</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <php

                    $mostrarPerfiles = new ProfilesController();
                    $mostrarPerfiles->mostrarPerfiles();
                    $mostrarPerfiles->borrarPerfil();

                ?>
            </tbody>
        </table>
    </div>
</div> -->

			<!--====  Fin de PERFIL  ====-->

