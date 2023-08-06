<!DOCTYPE <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <?php require 'views/header.php' ?>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <h2 class="text-center">Registros</h2>

        <div class="center"><?php echo $this->mensaje;?> </div>

        <div class="container">
            <div class="row">
                <div class="col-6">

                <form action="<?php echo constant('URL'); ?>registros/registrarUsuario" method="post">
                    
                    <div class="form-group">
                        <label for="" class="col-2 col-form-label">Usuario</label>
                        <input type="text" name="usuario" id="" placeholder="Usuario" required size="50" >
                    </div>
                    <div class="form-group">
                        <label for="" class="col-2 col-form-label">Contraseña</label>
                        <input type="password" name="contrasenia" id="" placeholder="Contrasña" required size="50">
                    </div>
                    <div class="form-group">
                        <label for="" class="col-2 col-form-label">Nombre</label>
                        <input type="text" name="nombre" id="" placeholder="Nombre" required size="50">
                    </div>

                    <div class="form-group">
                        <label for="" class="col-2 col-form-label">Apellido Paterno</label>
                        <input type="text" name="ap" id="" placeholder="Apellido Paterno" required size="50">
                    </div>

                    <div class="form-group">
                        <label for="" class="col-2 col-form-label">Apellido Materno</label>
                        <input type="text" name="am" id="" placeholder="Apellido Materno" required size="50">
                    </div>

                    <div class="form-group">
                        <label for="" class="col-2 col-form-label">Correo</label>
                        <input type="text" name="correo" id="" placeholder="Correo" required size="50">
                    </div>

                    <div class="form-group">
                        <label for="" class="col-2 col-form-label">Telefono</label>
                        <input type="tel" name="telefono" id="" placeholder="Telefono" required>
                    </div>

                    <div class="form-check radio" required>
                        <h3>Tipo De Usuario:</h3>
                            <input type="radio" name="tipo" required value="1"> Administrador
                            <input type="radio" name="tipo" required value="2"> Normal    
                    </div>

                    <input type="submit" value="Registrar" class="btn btn-danger">
                </form>

                </div>
            </div>
        </div>

        <script src="" async defer></script>
        <?php require 'views/footer.php' ?>
    </body>
</html>
