<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php require 'views/header.php' ?>
<h3>Inventario Reportado</h3>
<div class="container">
    <div class="row">
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Inventario reportado</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include_once 'models/inventario.php';
                    foreach($this->inventarioreportado as $row){
                        $usuario = new Producto();
                        $usuario = $row;
                ?>
                <tr>
                    <td><?php echo $usuario->nombreProducto ?></td>
                    <td><?php echo $usuario->inventarioreportado ?></td>
                    <td><a href="<?php echo constant('URL') . 'inventarios/editareportado/' . $usuario->idproducto; ?>">Editar</a></td>
                    <td><a href="<?php echo constant('URL') . 'inventarios/eliminareportado/' . $usuario->idproducto; ?>">Eliminar</a></td> 
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>
    
<h5>Formulario de registro de Inventario Inicial</h5>
<DIV class="container">
    <div class="row">
        <div class="col-md-6">
        <form action="<?php echo constant('URL'); ?>inventarios/registrarinventariorep " method="post">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Inventario Reportado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="producto"  id="producto">
                            <?php
                                include_once 'models/buscarsem.php';
                                foreach($this->buscarProducto as $row){
                                    $inventario = new Producto();
                                    $inventario = $row;
                            ?>
                                <option value="<?php echo $inventario->idProducto ?>"><?php echo $inventario->nombreProducto ?></option>
                            <?php } ?>
                            </select>
                        </td>
                        <td><input type="number" name="cantreportado" required size="50" ></td>                                    
                        <input type="hidden" name="semana" value="<?php echo $usuario->semana ?>" >
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="Registrar Inventario Inicial">
        </form>
        </div>
    </div>
</DIV>
<?php require 'views/footer.php' ?>
</body>
</html>