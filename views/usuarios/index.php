<!DOCTYPE html>
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
        <h1  class="text-center">Lista de Usuarios</h1>
        <div class="container">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Contrasenia</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include_once 'models/usuario.php';
                        foreach($this->usuarios as $row){
                            $usuario = new Usuario();
                            $usuario = $row;
                    ?>
                    <tr>
                        <td><?php echo $usuario->id ?></td>
                        <td><?php echo $usuario->usuario ?></td>
                        <td><?php echo $usuario->contrasenia ?></td>
                        <td><?php echo $usuario->nombre ?></td>
                        <td><?php echo $usuario->ap ?></td>
                        <td><?php echo $usuario->am ?></td>
                        <td><?php echo $usuario->telefono ?></td>
                        <td><?php echo $usuario->correo ?></td>
                        <td><?php echo $usuario->tipo ?></td>
                        <td><a href="<?php echo constant('URL') . 'usuarios/verUsuario/' . $usuario->id; ?>">Editar</a>
                        <a href="<?php echo constant('URL') . 'usuarios/eliminarUsuario/' . $usuario->id; ?>">Eliminar</a></td> 
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


        <?php require 'views/footer.php' ?>
    </body>
</html>