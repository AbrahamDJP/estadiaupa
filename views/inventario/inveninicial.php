<body>
<?php require 'views/header.php' ?>

<div class="container">
    <div class="row">
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Inventario Inicial</th>
                    <th>Compras</th>
                    <th>Editar Inventario Inicial</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include_once 'models/producto.php';
                    foreach($this->cargarStockInicial as $row){
                        $usuario = new Producto();
                        $usuario = $row;
                ?>
                <tr>
                    <td><?php echo $usuario->nombreProducto ?></td>
                    <td><?php echo $usuario->inventarioInicial ?></td>
                    <td><?php echo $usuario->compras ?></td>
                    <td><a href="<?php echo constant('URL') . 'inventarios/vistaStockInicial/' . $usuario->idproducto; ?>">Editar</a></td> 
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
        <form action="<?php echo constant('URL'); ?>inventarios/inicial " method="post">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Inventario Inicial</th>
                        <th>Compra Semanal</th>
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
                        <td><input type="number" name="cantInicial" required size="50" ></td>
                        <td><input type="number" name="cantCompra" required size="50" ></td>
                        <td><input type="hidden" name="semana" value="<?php echo $usuario->semana ?>" ></td>
                        
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